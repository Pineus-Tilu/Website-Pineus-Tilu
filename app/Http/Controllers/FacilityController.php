<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Facility;
use App\Models\AreaUnit;
use App\Models\Price;
use App\Models\Galeri;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    public function show($slug)
    {
        // Ambil area berdasarkan slug yang dibuat dari name
        $area = Area::with(['facilities', 'units.price'])
            ->get()
            ->first(function ($area) use ($slug) {
                return Str::slug($area->name) === $slug;
            });

        if (!$area) {
            abort(404);
        }

        // Fasilitas
        $facilities = $area->facilities;
        $fasilitas_pribadi = $facilities->where('type', 'pribadi')->pluck('description');
        $fasilitas_umum = $facilities->where('type', 'umum')->pluck('description');

        // Unit dan harga
        $unit = $area->units->first();
        $prices = $unit?->price;

        // GALERI - Dari database storage
        $galeri = [];

        $galeriData = Galeri::where('area_id', $area->id)
            ->where('type', 'facility')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($galeriData as $item) {
            $imagePath = $item->image_path;

            if (str_starts_with($imagePath, 'galeri/')) {
                $imageUrl = asset('storage/' . $imagePath);
            } else {
                $imageUrl = asset('storage/galeri/' . $imagePath);
            }

            $galeri[] = $imageUrl;
        }

        // DENAH - Dari folder public/images (BUKAN dari database)
        $denahImage = $this->getDenahImage($slug); // Gunakan slug, bukan title

        // Data untuk view
        $data = [
            'title' => $area->name,
            'hero' => $area->image_url,
            'denah' => $denahImage, // Ini dari folder public/images
            'kapasitas' => $unit ? "Standar {$unit->default_people} orang – Maksimal {$unit->max_people} orang" : '-',
            'extra_charge' => $area->extra_charge,
            'fasilitas_pribadi' => $fasilitas_pribadi,
            'fasilitas_umum' => $fasilitas_umum,
            'catatan' => null,
            'harga_biasa' => $prices?->weekday ? 'Rp' . number_format((float)$prices->weekday, 0, ',', '.') : '-',
            'harga_libur' => $prices?->weekend ? 'Rp' . number_format((float)$prices->weekend, 0, ',', '.') : '-',
            'harga_highseason' => $prices?->highseason ? 'Rp' . number_format((float)$prices->highseason, 0, ',', '.') : '-',
            'harga_catatan' => '*Harga Libur Nasional cenderung jatuh di tanggal libur nasional, libur sekolah, dsb.',
            'visual' => [],
            'galeri' => $galeri, // Ini dari database storage
        ];

        return view('fasilitas', compact('data'));
    }

    // METHOD DENAH - FIX untuk menggunakan file dari public/images
    private function getDenahImage($slug)
    {
        // Mapping slug ke file denah yang ada di public/images/galeri/denah/
        $denahMapping = [
            'pineus-tilu-i' => 'pineus1.jpg',
            'pineus-tilu-ii' => 'pineus2.jpg',
            'pineus-tilu-iii' => 'pineus3.png',
            'pineus-tilu-iii-vip-kabin' => 'pineus3.png',
            'pineus-tilu-iii-vip-tenda' => 'pineus3.png',
            'pineus-tilu-iv' => 'pineus4.jpg',
        ];

        // Ambil nama file denah berdasarkan slug
        $denahFile = $denahMapping[$slug] ?? 'denah.jpeg'; // Default fallback

        // Return URL lengkap ke file di public/images/galeri/denah/
        $denahPath = public_path('images/galeri/denah/' . $denahFile);

        // Cek apakah file benar-benar ada
        if (file_exists($denahPath)) {
            return asset('images/galeri/denah/' . $denahFile);
        } else {
            // Fallback ke denah default jika file tidak ditemukan
            return asset('images/galeri/denah/denah.jpeg');
        }
    }
}
