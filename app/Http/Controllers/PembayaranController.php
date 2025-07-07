<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Midtrans\Transaction;

class PembayaranController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index(Request $request)
    {
        // Validasi parameter yang diperlukan
        if (!$request->booking_id) {
            return redirect()->route('reservasi')->with('error', 'Data pembayaran tidak valid.');
        }

        // Ambil data booking
        $booking = Booking::with(['bookingDetail', 'unit.area'])->find($request->booking_id);

        if (!$booking) {
            return redirect()->route('reservasi')->with('error', 'Booking tidak ditemukan.');
        }

        return view('pembayaran', [
            'booking' => $booking,
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'subtotal' => $request->subtotal,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'fasilitas' => $request->fasilitas,
            'deck' => $request->deck,
            'jumlah_orang' => $request->jumlah_orang,
        ]);
    }

    public function process(Request $request)
    {
        try {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'nama' => 'required|string',
                'email' => 'required|email',
                'subtotal' => 'required|numeric|min:1',
            ]);

            $booking = Booking::with(['bookingDetail', 'unit.area'])->find($request->booking_id);

            // 🔥 Cek apakah ada payment yang masih aktif untuk booking ini
            $existingPayment = Payment::where('booking_id', $booking->id)
                ->where('transaction_status', 'pending')
                ->orderBy('created_at', 'desc')
                ->first();
            
            // Jika ada payment yang masih valid, cek status di Midtrans
            if ($existingPayment && !empty($existingPayment->order_id)) {
                try {
                    $statusResult = Transaction::status($existingPayment->order_id);
                    $currentStatus = is_object($statusResult) ? $statusResult->transaction_status : $statusResult['transaction_status'];

                    Log::info('Existing payment status check:', [
                        'order_id' => $existingPayment->order_id,
                        'status' => $currentStatus
                    ]);

                    // Jika status masih pending, gunakan token yang ada
                    if ($currentStatus === 'pending') {
                        Log::info('Using existing snap token for booking: ' . $booking->id);
                        return response()->json(['snapToken' => $existingPayment->snap_token]);
                    } else {
                        // Jika status berubah (expired, cancel, settlement, dll), update payment lama
                        $existingPayment->update([
                            'transaction_status' => $currentStatus,
                            'payment_type' => $currentStatus
                        ]);

                        Log::info('Existing payment status changed to: ' . $currentStatus . ', creating new token');
                    }
                } catch (\Exception $statusError) {
                    Log::warning('Failed to check existing payment status:', [
                        'order_id' => $existingPayment->order_id,
                        'error' => $statusError->getMessage()
                    ]);

                    // Jika error saat cek status, anggap payment sudah tidak valid dan buat baru
                    Log::info('Status check failed, creating new token');
                }
            }

            // 🔥 Buat payment baru jika tidak ada yang valid
            $orderId = 'CAMPING-' . $booking->id . '-' . time();

            // Data transaksi dengan detail lengkap
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $request->subtotal,
                ],
                'customer_details' => [
                    'first_name' => $request->nama,
                    'email' => $request->email,
                    'phone' => $booking->bookingDetail->telepon ?? '',
                    'billing_address' => [
                        'first_name' => $request->nama,
                        'email' => $request->email,
                        'phone' => $booking->bookingDetail->telepon ?? '',
                        'address' => 'Pineus Tilu Camping Ground',
                        'city' => 'Bandung',
                        'postal_code' => '40391',
                        'country_code' => 'IDN'
                    ]
                ],
                'item_details' => [
                    [
                        'id' => 'camping-' . $booking->unit_id,
                        'price' => (int) $request->subtotal,
                        'quantity' => 1,
                        'name' => 'Reservasi Camping - ' . $booking->unit->area->name . ' - ' . $booking->unit->unit_name,
                        'brand' => 'Pineus Tilu',
                        'category' => 'Camping',
                        'merchant_name' => 'Pineus Tilu Camping Ground'
                    ]
                ],
                // Tambahkan custom field untuk detail reservasi
                'custom_field1' => 'Check-in: ' . $booking->booking_for_date,
                'custom_field2' => 'Jumlah Orang: ' . $booking->bookingDetail->number_of_people,
                'custom_field3' => 'Area: ' . $booking->unit->area->name . ' - ' . $booking->unit->unit_name,
                'callbacks' => [
                    'finish' => route('pembayaran.finish'),
                ],
                'expiry' => [
                    'start_time' => date('Y-m-d H:i:s O'),
                    'unit' => 'minutes',
                    'duration' => 30 // Pembayaran expire dalam 30 menit
                ]
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan data pembayaran baru
            Payment::create([
                'booking_id' => $booking->id,
                'order_id' => $orderId,
                'transaction_id' => null,
                'payment_type' => 'pending',
                'transaction_status' => 'pending',
                'gross_amount' => $request->subtotal,
                'snap_token' => $snapToken,
            ]);

            Log::info('New snap token created for booking: ' . $booking->id);

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json(['error' => 'Gagal membuat pembayaran: ' . $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status ?? null;

            Log::info('Midtrans Callback:', [
                'order_id' => $orderId,
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'fraud_status' => $fraud,
            ]);

            // Cari payment berdasarkan order_id
            $payment = Payment::where('order_id', $orderId)->first();

            if (!$payment) {
                Log::error('Payment not found for order_id: ' . $orderId);
                return response()->json(['status' => 'failed', 'message' => 'Payment not found']);
            }

            // Update payment data
            $payment->update([
                'transaction_id' => $notification->transaction_id,
                'payment_type' => $type,
                'transaction_status' => $transaction,
                'fraud_status' => $fraud,
            ]);

            // Update booking status berdasarkan status transaksi
            $booking = $payment->booking;

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $booking->update(['status_id' => 1]); // pending
                        Log::info('Booking status updated to pending (fraud challenge)');
                        // Send pending notification email
                        $this->sendPendingEmail($booking);
                    } else {
                        $booking->update(['status_id' => 2]); // success
                        Log::info('Booking status updated to success (credit card capture)');
                        // Send invoice email for successful payment
                        $this->sendInvoiceEmail($booking);
                    }
                }
            } elseif ($transaction == 'settlement') {
                $booking->update(['status_id' => 2]); // success
                Log::info('Booking status updated to success (settlement)');
                // Send invoice email for successful payment
                $this->sendInvoiceEmail($booking);
            } elseif ($transaction == 'pending') {
                $booking->update(['status_id' => 1]); // pending
                Log::info('Booking status updated to pending');
                // Send pending notification email
                $this->sendPendingEmail($booking);
            } elseif ($transaction == 'deny') {
                $booking->update(['status_id' => 3]); // failed/cancel
                Log::info('Booking status updated to cancel (deny)');
            } elseif ($transaction == 'expire') {
                $booking->update(['status_id' => 3]); // failed/cancel
                Log::info('Booking status updated to cancel (expire)');
            } elseif ($transaction == 'cancel') {
                $booking->update(['status_id' => 3]); // failed/cancel
                Log::info('Booking status updated to cancel');
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error:', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $transactionStatus = $request->transaction_status;

        Log::info('Payment Finish Page:', [
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'transaction_status' => $transactionStatus,
        ]);

        if ($orderId) {
            $payment = Payment::where('order_id', $orderId)->first();

            if ($payment) {
                $booking = $payment->booking;

                // Update status berdasarkan hasil pembayaran
                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                    $booking->update(['status_id' => 2]); // success
                    $message = 'Pembayaran berhasil! Booking Anda telah dikonfirmasi.';
                    $type = 'success';
                    // Send invoice email for successful payment
                    $this->sendInvoiceEmail($booking);
                } elseif ($transactionStatus == 'pending') {
                    $booking->update(['status_id' => 1]); // pending
                    $message = 'Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.';
                    $type = 'warning';
                } else {
                    $booking->update(['status_id' => 3]); // cancel
                    $message = 'Pembayaran gagal atau dibatalkan.';
                    $type = 'error';
                }

                return redirect('/')->with($type, $message);
            }
        }

        return redirect('/')->with('error', 'Data pembayaran tidak ditemukan.');
    }

    // Method untuk cancel booking
    public function cancel(Request $request)
    {
        try {
            $bookingId = $request->booking_id;
            $booking = Booking::find($bookingId);

            if (!$booking) {
                return response()->json(['error' => 'Booking tidak ditemukan'], 404);
            }

            // Update payment jika ada dan cancel di Midtrans
            $payment = Payment::where('booking_id', $bookingId)->first();
            if ($payment && !empty($payment->order_id)) {
                try {
                    // Cancel transaksi di Midtrans
                    $cancelResult = Transaction::cancel($payment->order_id);
                    
                    Log::info('Midtrans cancellation result:', [
                        'order_id' => $payment->order_id,
                        'result' => $cancelResult
                    ]);

                    // Update payment dengan status dari Midtrans
                    $payment->update([
                        'transaction_status' => 'cancel',
                        'payment_type' => 'cancel'
                    ]);

                    Log::info('Payment cancelled in Midtrans and database:', ['order_id' => $payment->order_id]);
                } catch (\Exception $midtransError) {
                    Log::warning('Failed to cancel payment in Midtrans:', [
                        'order_id' => $payment->order_id,
                        'error' => $midtransError->getMessage()
                    ]);

                    // Tetap update status lokal meskipun gagal cancel di Midtrans
                    $payment->update([
                        'transaction_status' => 'cancel',
                        'payment_type' => 'cancel'
                    ]);
                }
            }

            // Update status booking menjadi cancelled
            $booking->update(['status_id' => 3]); // 3 = cancelled

            Log::info('Booking cancelled by user:', ['booking_id' => $bookingId]);

            return response()->json(['success' => true, 'message' => 'Booking berhasil dibatalkan']);
        } catch (\Exception $e) {
            Log::error('Cancel booking error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal membatalkan booking'], 500);
        }
    }

    /**
     * Send invoice email to customer after successful payment
     */
    private function sendInvoiceEmail($booking)
    {
        try {
            Log::info('Starting sendInvoiceEmail process', ['booking_id' => $booking->id]);
            
            // Load booking detail relationship if not loaded
            if (!$booking->relationLoaded('bookingDetail')) {
                $booking->load('bookingDetail');
                Log::info('Loaded bookingDetail relationship');
            }

            // Check if booking has email in booking detail
            $customerEmail = $booking->bookingDetail->email ?? null;
            
            Log::info('Customer email found', ['email' => $customerEmail]);
            
            if (empty($customerEmail)) {
                Log::warning('Cannot send invoice email: No email address for booking', ['booking_id' => $booking->id]);
                return;
            }

            Log::info('Attempting to send invoice email', [
                'booking_id' => $booking->id,
                'email' => $customerEmail,
                'mail_driver' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host')
            ]);

            // Send the invoice email with PDF attachment
            Mail::to($customerEmail)->send(new InvoiceMail($booking));
            
            Log::info('Invoice email sent successfully', [
                'booking_id' => $booking->id,
                'email' => $customerEmail
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email', [
                'booking_id' => $booking->id,
                'email' => $booking->bookingDetail->email ?? 'N/A',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Send pending payment notification email to customer
     */
    private function sendPendingEmail($booking)
    {
        try {
            // Load booking detail relationship if not loaded
            if (!$booking->relationLoaded('bookingDetail')) {
                $booking->load('bookingDetail');
            }

            // Check if booking has email in booking detail
            $customerEmail = $booking->bookingDetail->email ?? null;
            
            if (empty($customerEmail)) {
                Log::warning('Cannot send pending email: No email address for booking', ['booking_id' => $booking->id]);
                return;
            }

            // For now, we can send a simple notification email
            // You can create a separate PendingMail class later if needed
            $customerName = $booking->bookingDetail->nama ?? 'Customer';
            $subject = 'Pembayaran Sedang Diproses - Pineus Tilu';
            $message = "Halo $customerName, pembayaran untuk booking #{$booking->id} sedang diproses. Kami akan mengirimkan konfirmasi setelah pembayaran berhasil.";
            
            Mail::raw($message, function ($mail) use ($customerEmail, $subject) {
                $mail->to($customerEmail)->subject($subject);
            });
            
            Log::info('Pending payment email sent successfully', [
                'booking_id' => $booking->id,
                'email' => $customerEmail
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send pending payment email', [
                'booking_id' => $booking->id,
                'email' => $booking->bookingDetail->email ?? 'N/A',
                'error' => $e->getMessage()
            ]);
        }
    }
}
