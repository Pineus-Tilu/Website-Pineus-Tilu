<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\FacilityController; // ✅ Fasilitas
use App\Http\Controllers\Auth\GoogleController; // ✅ Google OAuth


Route::get('generate-pdf', [App\Http\Controllers\InvoiceController::class, 'generatePdf'])->name('generate.pdf');

// Halaman Publik
Route::get('/', fn() => view('dashboard'));
Route::get('/tentang', fn() => view('tentang'));
Route::get('/ulasan', fn() => view('ulasan'));
Route::get('/reservasi', fn() => view('reservasi'));

// Fasilitas Route dengan data dari config
Route::get('/fasilitas/{slug}', [FacilityController::class, 'show'])->name('fasilitas');

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

// Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
Route::post('/pembayaran/process', [PembayaranController::class, 'process'])->name('pembayaran.process');