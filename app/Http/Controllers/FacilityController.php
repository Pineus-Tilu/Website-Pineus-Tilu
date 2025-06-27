<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Facility;
use App\Models\AreaUnit;
use App\Models\Price;

class FacilityController extends Controller
{
    public function show($slug)
    {
        // Ambil area berdasarkan slug
        $area = Area::all()->first(function ($area) use ($slug) {
            $areaSlug = strtolower(str_replace([' ', '(', ')'], ['-', '', ''], $area->name));
            return $areaSlug === $slug;
        });
        if (!$area) {
            abort(404);
        }

        // Fasilitas
        $fasilitas_pribadi = Facility::where('area_id', $area->id)->where('type', 'pribadi')->pluck('description');
        $fasilitas_umum = Facility::where('area_id', $area->id)->where('type', 'umum')->pluck('description');

        // Kapasitas dari salah satu unit (atau bisa diambil semua)
        $unit = AreaUnit::whereHas('facility', function ($q) use ($area) {
            $q->where('area_id', $area->id);
        })->first();

        // Harga dari salah satu unit (atau bisa diambil semua)
        $prices = $unit ? Price::where('unit_id', $unit->id)->first() : null;


        $data = [
            'title' => $area->name,
            'hero' => $area->image_path,
            'denah' => 'denah-' . $slug . '.png', // atau ambil dari DB jika ada
            'kapasitas' => $unit ? "Standar {$unit->default_people} orang – Maksimal {$unit->max_people} orang" : '-',
            'extra_charge' => $area->extra_charge,
            'fasilitas_pribadi' => $fasilitas_pribadi,
            'fasilitas_umum' => $fasilitas_umum,
            'catatan' => null,
            'harga_biasa' => ($prices && $prices->weekday) ? 'Rp' . number_format($prices->weekday, 0, ',', '.') : '-',
            'harga_libur' => ($prices && $prices->weekend) ? 'Rp' . number_format($prices->weekend, 0, ',', '.') : '-',
            'harga_highseason' => ($prices && $prices->highseason) ? 'Rp' . number_format($prices->highseason, 0, ',', '.') : '-',
            'harga_catatan' => '*Harga Libur Nasional cenderung jatuh di tanggal libur nasional, libur sekolah, dsb.',
            'visual' => [], // tambahkan jika ada
            'galeri' => [], // tambahkan jika ada
        ];

        // Tentukan gambar denah sesuai nama area
        $title = strtolower($area->name);

        if (str_contains($title, 'pineus tilu iv')) {
            $denahImage = 'galeri/denah/pineus4.jpg';
        } elseif (
            str_contains($title, 'pineus tilu iii vip kabin') ||
            str_contains($title, 'pineus tilu iii tenda') ||
            preg_match('/pineus tilu iii\b/', $title)
        ) {
            $denahImage = 'galeri/denah/pineus3.png';
        } elseif (preg_match('/pineus tilu ii\b/', $title)) {
            $denahImage = 'galeri/denah/pineus2.jpg';
        } elseif (preg_match('/pineus tilu i\b/', $title)) {
            $denahImage = 'galeri/denah/pineus1.jpg';
        } else {
            $denahImage = 'galeri/denah/denah.jpeg';
        }
        $data['denah'] = $denahImage;

        $galeriPath = public_path('images/galeri/' . $slug);
        $galeri = [];
        if (is_dir($galeriPath)) {
            foreach (scandir($galeriPath) as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $galeri[] = 'galeri/' . $slug . '/' . $file;
                }
            }
        }
        $data['galeri'] = $galeri;

        return view('fasilitas', compact('data'));
    }
}
