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

        // Fasilitas dengan eager loading
        $facilities = Facility::where('area_id', $area->id)->get();
            
        $fasilitas_pribadi = $facilities->where('type', 'pribadi')->pluck('description');
        $fasilitas_umum = $facilities->where('type', 'umum')->pluck('description');

        // Ambil unit pertama untuk kapasitas - PERBAIKAN DI SINI
        $unit = AreaUnit::where('area_id', $area->id)->first();

        // Gunakan model Price secara eksplisit
        $prices = null;
        if ($unit) {
            $prices = Price::where('unit_id', $unit->id)->first();
        }

        $data = [
            'title' => $area->name,
            'hero' => $area->image_path,
            'denah' => 'denah-' . $slug . '.png',
            'kapasitas' => $unit ? "Standar {$unit->default_people} orang – Maksimal {$unit->max_people} orang" : '-',
            'extra_charge' => $area->extra_charge,
            'fasilitas_pribadi' => $fasilitas_pribadi,
            'fasilitas_umum' => $fasilitas_umum,
            'catatan' => null,
            // Cast ke float untuk menghindari warning
            'harga_biasa' => ($prices && $prices->weekday) ? 'Rp' . number_format((float)$prices->weekday, 0, ',', '.') : '-',
            'harga_libur' => ($prices && $prices->weekend) ? 'Rp' . number_format((float)$prices->weekend, 0, ',', '.') : '-',
            'harga_highseason' => ($prices && $prices->highseason) ? 'Rp' . number_format((float)$prices->highseason, 0, ',', '.') : '-',
            'harga_catatan' => '*Harga Libur Nasional cenderung jatuh di tanggal libur nasional, libur sekolah, dsb.',
            'visual' => [],
            'galeri' => [],
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

        // Galeri dari database atau folder
        $galeri = [];
        
        // Coba ambil dari database dulu (jika facility punya image_path)
        $facilityImages = $facilities->whereNotNull('image_path')->pluck('image_path')->toArray();
        if (!empty($facilityImages)) {
            $galeri = array_merge($galeri, $facilityImages);
        }
        
        // Fallback ke folder jika tidak ada di database
        if (empty($galeri)) {
            $galeriPath = public_path('images/galeri/' . $slug);
            if (is_dir($galeriPath)) {
                foreach (scandir($galeriPath) as $file) {
                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                        $galeri[] = 'galeri/' . $slug . '/' . $file;
                    }
                }
            }
        }
        
        $data['galeri'] = $galeri;

        return view('fasilitas', compact('data'));
    }
    
    // Method tambahan untuk mendapatkan semua area dengan fasilitas
    public function index()
    {
        $areas = Area::with(['facilities'])->get();
        return view('areas.index', compact('areas'));
    }
    
    // Method untuk mendapatkan harga semua unit di area - PERBAIKAN DI SINI JUGA
    public function getPrices($areaId)
    {
        $area = Area::findOrFail($areaId);
        $units = AreaUnit::where('area_id', $areaId)->get();
        
        $allPrices = [];
        foreach ($units as $unit) {
            $price = Price::where('unit_id', $unit->id)->first();
            if ($price) {
                $allPrices[] = [
                    'unit_name' => $unit->unit_name,
                    'weekday' => $price->weekday,
                    'weekend' => $price->weekend,
                    'highseason' => $price->highseason,
                    'capacity' => "{$unit->default_people}-{$unit->max_people} orang"
                ];
            }
        }
        
        return response()->json($allPrices);
    }
}