<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        // Tampilkan halaman pembayaran, kirim data jika perlu
        return view('pembayaran', [
            'nama' => $request->nama,
            'email' => $request->email,
            'subtotal' => $request->subtotal,
        ]);
    }

    public function process(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Data transaksi
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->subtotal,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'email' => $request->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }
}