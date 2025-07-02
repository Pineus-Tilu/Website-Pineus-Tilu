<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Daftar area dan slug folder galeri
        $areas = [
            [
                'slug' => 'pineus-tilu-i',
                'title' => 'Pineus Tilu I',
            ],
            [
                'slug' => 'pineus-tilu-ii',
                'title' => 'Pineus Tilu II',
            ],
            [
                'slug' => 'pineus-tilu-iii-vip-tenda',
                'title' => 'Pineus Tilu III (VIP Tenda)',
            ],
            [
                'slug' => 'pineus-tilu-iii-vip-kabin',
                'title' => 'Pineus Tilu III (VIP Kabin)',
            ],
            [
                'slug' => 'pineus-tilu-iv',
                'title' => 'Pineus Tilu IV',
            ],
        ];

        $slides = [];
        foreach ($areas as $area) {
            $galeriPath = public_path('images/galeri/' . $area['slug']);
            $img = null;
            if (is_dir($galeriPath)) {
                foreach (['jpg', 'jpeg', 'png', 'webp', 'JPG', 'PNG', 'JPEG', 'WEBP'] as $ext) {
                    $file = "utama.$ext";
                    if (file_exists($galeriPath . '/' . $file)) {
                        $img = 'galeri/' . $area['slug'] . '/' . $file;
                        break;
                    }
                }
            }
            $slides[] = [
                'img' => $img ?? 'logo.png',
                'title' => $area['title'],
            ];
        }

        return view('dashboard', compact('slides'));
    }
}
