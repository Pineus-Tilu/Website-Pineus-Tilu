<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function show($slug)
{
    $dataList = [
        'pineus-tilu-1' => [
            'title' => 'Pineus Tilu I',
            'hero' => 'hero-pineus-1.jpg',
            'denah' => 'denah-tilu-1.png',
            'kapasitas' => 'Standar 4 orang – Maksimal 6 orang',
            'fasilitas_pribadi' => [
                '4 Kursi tamu + 4 Bantal',
                '4 Kasur tidur',
                'Meja Kayu',
                'Colokan listrik dan lampu',
                'Tenda dome 4–6 orang',
            ],
            'fasilitas_umum' => [
                'Kamar mandi dengan pemanas air',
                'Musholla umum',
                'Alat panggang BBQ',
                'Alat makan & dispenser',
                'Toilet jongkok',
            ],
            'catatan' => 'Fasilitas tambahan 100K/orang',
            'harga_biasa' => 'Rp650.000',
            'harga_libur' => 'Rp750.000',
            'harga_catatan' => '*Libur Nasional dikenakan tambahan Rp100.000/deck/malam',
            'visual' => [
                [
                    'gambar' => 'area.jpg',
                    'judul' => 'Area',
                    'deskripsi' => 'Area camping dengan tenda di tepi sungai untuk kenyamanan alami.',
                ],
                [
                    'gambar' => 'ruang-publik.jpg',
                    'judul' => 'Ruang Publik',
                    'deskripsi' => 'Tempat duduk santai bersama di bawah pohon rindang.',
                ],
                [
                    'gambar' => 'toilet.jpg',
                    'judul' => 'Toilet',
                    'deskripsi' => 'Fasilitas kamar mandi dan toilet bersih dengan pemanas air.',
                ],
            ],
            'galeri' => [
                'galeri1.jpg',
                'galeri2.jpg',
                'galeri3.jpg',
            ],
        ],
        // Tambahkan data lain seperti 'pineus-tilu-2', dst.
    ];

    if (!array_key_exists($slug, $dataList)) {
        abort(404);
    }

    return view('fasilitas', ['data' => $dataList[$slug]]);
}

}
