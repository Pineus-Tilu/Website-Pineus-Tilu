<?php

use Illuminate\Support\Facades\Route;


Route::get('generate-pdf', [App\Http\Controllers\InvoiceController::class, 'generatePdf'])->name('generate.pdf');

// Halaman Publik
Route::get('/', fn() => view('dashboard'));
Route::get('/tentang', fn() => view('tentang'));
Route::get('/ulasan', fn() => view('ulasan'));
Route::get('/reservasi', fn() => view('reservasi'));

// Fasilitas Route dengan data dari config
Route::get('/fasilitas/{slug?}', function ($slug = 'pineus-tilu-1') {
    $data = config('fasilitas');

    if (!is_array($data) || !array_key_exists($slug, $data)) {
        abort(404, 'Halaman tidak ditemukan');
    }

    return view('fasilitas', [
        'slug' => $slug,
        'data' => $data[$slug],
    ]);
})->name('fasilitas');

// Auth (login/register/logout)
require __DIR__ . '/auth.php';
