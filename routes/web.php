<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Auth\GoogleController; // ✅ Google OAuth

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

// Profile 
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Auth (login/register/logout)
require __DIR__ . '/auth.php';

// ✅ Google OAuth routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Reservasi
Route::post('/detailpembelian', [ReservasiController::class, 'detailPembelian'])->name('detailpembelian');

Route::get('/pembayaran', function () {
    return view('pembayaran');})->name('pembayaran');