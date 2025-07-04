<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

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
            'email' => $request->email,
            'subtotal' => $request->subtotal,
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

            $booking = Booking::find($request->booking_id);
            $orderId = 'ORDER-' . $booking->id . '-' . time();

            // Data transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $request->subtotal,
                ],
                'customer_details' => [
                    'first_name' => $request->nama,
                    'email' => $request->email,
                ],
                'item_details' => [
                    [
                        'id' => 'camping-' . $booking->unit_id,
                        'price' => (int) $request->subtotal,
                        'quantity' => 1,
                        'name' => 'Reservasi Camping - ' . ($booking->unit->area->name ?? 'Area') . ' - ' . ($booking->unit->unit_name ?? 'Unit'),
                    ]
                ],
                'callbacks' => [
                    'finish' => route('pembayaran.finish'),
                ]
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan data pembayaran dengan transaction_id = null
            Payment::create([
                'booking_id' => $booking->id,
                'order_id' => $orderId,
                'transaction_id' => null, // Ubah dari '' ke null
                'payment_type' => 'pending',
                'transaction_status' => 'pending',
                'gross_amount' => $request->subtotal,
                'snap_token' => $snapToken,
            ]);


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
                    } else {
                        $booking->update(['status_id' => 2]); // success
                        Log::info('Booking status updated to success (credit card capture)');
                    }
                }
            } elseif ($transaction == 'settlement') {
                $booking->update(['status_id' => 2]); // success
                Log::info('Booking status updated to success (settlement)');
            } elseif ($transaction == 'pending') {
                $booking->update(['status_id' => 1]); // pending
                Log::info('Booking status updated to pending');
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
                } elseif ($transactionStatus == 'pending') {
                    $booking->update(['status_id' => 1]); // pending
                    $message = 'Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.';
                    $type = 'warning';
                } else {
                    $booking->update(['status_id' => 3]); // cancel
                    $message = 'Pembayaran gagal atau dibatalkan.';
                    $type = 'error';
                }

                return redirect()->route('/')->with($type, $message);
            }
        }

        return redirect()->route('/')->with('error', 'Data pembayaran tidak ditemukan.');
    }
}