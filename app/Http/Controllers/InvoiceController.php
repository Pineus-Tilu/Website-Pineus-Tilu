<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // Ambil booking beserta detailnya dan relasi yang diperlukan
        $booking = Booking::with([
            'bookingDetail',
            'unit.area',
            'user',
            'status',
            'payment'
        ])->findOrFail($id);

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

        return $pdf->stream($fileName);
    }

    public function downloadInvoice($id)
    {
        // Ambil booking beserta detailnya dan relasi yang diperlukan
        $booking = Booking::with([
            'bookingDetail',
            'unit.area',
            'user',
            'status',
            'payment'
        ])->findOrFail($id);

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
        $fileName = 'invoice-' . $invoiceNumber . '.pdf';

        return $pdf->download($fileName);
    }

    public function previewInvoice($id)
    {
        // Ambil booking beserta detailnya dan relasi yang diperlukan
        $booking = Booking::with([
            'bookingDetail',
            'unit.area',
            'user',
            'status',
            'payment'
        ])->findOrFail($id);

        // Return view langsung untuk preview
        return view('invoice', compact('booking'));
    }
}
