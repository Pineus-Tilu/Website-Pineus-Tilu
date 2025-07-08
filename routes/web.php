<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\InvoiceController; // ✅ Invoice PDF
use App\Http\Controllers\FacilityController; // ✅ Fasilitas
use App\Http\Controllers\Auth\GoogleController; // ✅ Google OAuth


// Halaman Publik
// Route::get('/', fn() => view('dashboard'));
Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/tentang', fn() => view('tentang'));
Route::get('/ulasan', fn() => view('ulasan'));

// Fasilitas Route dengan data dari config

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
Route::get('/reservasi', [ReservasiController::class, 'showReservasi'])->name('reservasi');
Route::post('/reservasi/store', [ReservasiController::class, 'storeReservasi'])->name('reservasi.store');

// Pembayaran - mendukung GET dan POST
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
Route::post('/pembayaran/process', [PembayaranController::class, 'process'])->name('pembayaran.process');
Route::get('/pembayaran/finish', [PembayaranController::class, 'finish'])->name('pembayaran.finish');
Route::post('/pembayaran/cancel', [PembayaranController::class, 'cancel'])->name('pembayaran.cancel');
// Midtrans callback
Route::post('/pembayaran/callback', [PembayaranController::class, 'callback'])->name('pembayaran.callback');

// Invoice routes
Route::get('/invoice/{id}/generate', [App\Http\Controllers\InvoiceController::class, 'generateInvoice'])->name('invoice.generate');

// Invoice PDF
Route::get('/invoice/{booking_id}', [InvoiceController::class, 'generateInvoice'])->name('invoice');
Route::get('/invoice/{booking_id}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
Route::get('/invoice/{booking_id}/preview', [InvoiceController::class, 'previewInvoice'])->name('invoice.preview');