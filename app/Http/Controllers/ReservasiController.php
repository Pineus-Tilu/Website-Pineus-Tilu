<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function detailPembelian(Request $request)
    {
        return view('detailpembelian', [
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'fasilitas' => $request->fasilitas,
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'kode_promo' => $request->kode_promo,
            'subtotal' => 0, // Hitung sesuai kebutuhan
        ]);
    }
}