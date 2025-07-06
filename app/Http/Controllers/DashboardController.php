<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil area dengan relasi galeri
        $areas = Area::with(['featuredGaleri', 'galeriDashboard'])->get();
        $slides = [];

        foreach ($areas as $area) {
            $slug = $area->slug;
            $img = null;
            
            // Prioritas: 1. Featured galeri, 2. Galeri dashboard pertama
            if ($area->featuredGaleri) {
                // Gunakan featured galeri
                $imagePath = $area->featuredGaleri->image_path;
                if (str_starts_with($imagePath, 'galeri/')) {
                    $img = asset('storage/' . $imagePath);
                } else {
                    $img = asset('storage/galeri/' . $imagePath);
                }
            } elseif ($area->galeriDashboard->isNotEmpty()) {
                // Gunakan galeri dashboard pertama
                $imagePath = $area->galeriDashboard->first()->image_path;
                if (str_starts_with($imagePath, 'galeri/')) {
                    $img = asset('storage/' . $imagePath);
                } else {
                    $img = asset('storage/galeri/' . $imagePath);
                }
            }

            // HANYA tambah slide jika ada gambar dari database
            if ($img) {
                $slides[] = [
                    'img' => $img,
                    'title' => $area->name,
                    'slug' => $slug,
                ];
            }
        }

        return view('dashboard', compact('slides'));
    }
}