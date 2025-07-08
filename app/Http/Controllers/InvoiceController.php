<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        try {
            // Ambil booking beserta detailnya dan relasi yang diperlukan
            $booking = Booking::with([
                'bookingDetail',
                'unit.area',
                'user',
                'status',
                'payment'
            ])->findOrFail($id);

            Log::info('Generating invoice for booking: ' . $id);

            // Render view ke PDF
            $pdf = Pdf::loadView('invoice', compact('booking'));

            // Set paper size dan orientation (A4 landscape untuk invoice)
            $pdf->setPaper('A4', 'landscape');

            // Set options untuk PDF
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
                'dpi' => 150,
                'defaultPaperSize' => 'A4',
                'chroot' => public_path(),
            ]);

            // Nama file download
            $invoiceNumber = $booking->invoice_number ?? 'INV-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT);
            $fileName = 'invoice-' . $invoiceNumber . '.pdf';

            Log::info('Invoice generated successfully: ' . $fileName);

            return $pdf->stream($fileName);
        } catch (\Exception $e) {
            Log::error('Error generating invoice: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat invoice: ' . $e->getMessage()], 500);
        }
    }

    public function downloadInvoice($id)
    {
        try {
            // Ambil booking beserta detailnya dan relasi yang diperlukan
            $booking = Booking::with([
                'bookingDetail',
                'unit.area',
                'user',
                'status',
                'payment'
            ])->findOrFail($id);

            // Validasi apakah booking memiliki detail yang lengkap
            if (!$booking->bookingDetail) {
                return response()->json(['error' => 'Booking detail tidak ditemukan'], 404);
            }

            Log::info('Downloading invoice for booking: ' . $id);

            // Render view ke PDF
            $pdf = Pdf::loadView('invoice', compact('booking'));

            // Set paper size dan orientation
            $pdf->setPaper('A4', 'landscape');

            // Set options untuk PDF
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
                'dpi' => 150,
                'defaultPaperSize' => 'A4',
                'chroot' => public_path(),
            ]);

            // Nama file download
            $invoiceNumber = $booking->invoice_number ?? 'INV-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT);
            $customerName = $booking->bookingDetail->nama ?? 'Guest';
            $fileName = 'Invoice-' . $invoiceNumber . '-' . str_replace(' ', '_', $customerName) . '.pdf';

            Log::info('Invoice downloaded successfully: ' . $fileName);

            return $pdf->download($fileName);
        } catch (\Exception $e) {
            Log::error('Error downloading invoice: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengunduh invoice: ' . $e->getMessage());
        }
    }

    public function previewInvoice($id)
    {
        try {
            // Ambil booking beserta detailnya dan relasi yang diperlukan
            $booking = Booking::with([
                'bookingDetail',
                'unit.area',
                'user',
                'status',
                'payment'
            ])->findOrFail($id);

            // Validasi apakah booking memiliki detail yang lengkap
            if (!$booking->bookingDetail) {
                return response()->json(['error' => 'Booking detail tidak ditemukan'], 404);
            }

            Log::info('Previewing invoice for booking: ' . $id);

            // Return view langsung untuk preview
            return view('invoice', compact('booking'));
        } catch (\Exception $e) {
            Log::error('Error previewing invoice: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menampilkan preview invoice: ' . $e->getMessage()], 500);
        }
    }

    // Method untuk admin download multiple invoices
    public function downloadMultipleInvoices(Request $request)
    {
        try {
            $bookingIds = $request->input('booking_ids', []);
            
            if (empty($bookingIds)) {
                return response()->json(['error' => 'Tidak ada booking yang dipilih'], 400);
            }

            $bookings = Booking::with([
                'bookingDetail',
                'unit.area',
                'user',
                'status',
                'payment'
            ])->whereIn('id', $bookingIds)->get();

            if ($bookings->isEmpty()) {
                return response()->json(['error' => 'Booking tidak ditemukan'], 404);
            }

            // Create ZIP file with multiple invoices
            $zip = new \ZipArchive();
            $zipFileName = 'invoices-' . now()->format('Y-m-d-H-i-s') . '.zip';
            $zipPath = storage_path('app/temp/' . $zipFileName);

            // Create temp directory if not exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                foreach ($bookings as $booking) {
                    if ($booking->bookingDetail) {
                        $pdf = Pdf::loadView('invoice', compact('booking'));
                        $pdf->setPaper('A4', 'landscape');
                        
                        $invoiceNumber = $booking->invoice_number ?? 'INV-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT);
                        $customerName = $booking->bookingDetail->nama ?? 'Guest';
                        $pdfFileName = 'Invoice-' . $invoiceNumber . '-' . str_replace(' ', '_', $customerName) . '.pdf';
                        
                        $zip->addFromString($pdfFileName, $pdf->output());
                    }
                }
                $zip->close();

                Log::info('Multiple invoices downloaded: ' . count($bookings) . ' invoices');

                return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
            } else {
                return response()->json(['error' => 'Gagal membuat file ZIP'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error downloading multiple invoices: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengunduh invoice: ' . $e->getMessage()], 500);
        }
    }
}
}
