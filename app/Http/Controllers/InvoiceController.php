<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // Ambil booking beserta detailnya
        $booking = Booking::with('bookingDetails.unit.facility.area')->findOrFail($id);

        // Render view ke PDF
        $pdf = Pdf::loadView('invoice', compact('booking'));

        // Optional: Set paper size dan orientation (misal A4 potrait)
        $pdf->setPaper('A4', 'landscape');

        // Nama file download
        $fileName = 'invoice-' . $booking->invoice_number . '.pdf';

        return $pdf->stream($fileName);
    }
}
