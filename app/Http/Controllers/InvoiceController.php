<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
   public function generatePdf(Request $request)
    {
        // Ambil data dari request atau buat data dummy
        $data = [
            'title' => 'Invoice',
            'date' => now()->format('Y-m-d'),
            'items' => [
                ['name' => 'Item 1', 'price' => 100],
                ['name' => 'Item 2', 'price' => 200],
            ],
            'total' => 300,
        ];

        // Buat PDF
        $pdf = Pdf::loadView('invoice', $data);

        // Kembalikan PDF sebagai response
        return $pdf->download('invoice.pdf');
    }
}
