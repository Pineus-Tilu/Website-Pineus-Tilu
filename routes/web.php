<?php

use Illuminate\Support\Facades\Route;
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

// Booking Management
Route::get('/booking/{booking_id}', [ReservasiController::class, 'showBookingDetail'])->name('booking.detail');
Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [ReservasiController::class, 'showMyBookings'])->name('my.bookings');
});

// Pembayaran - mendukung GET dan POST
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
Route::post('/pembayaran/process', [PembayaranController::class, 'process'])->name('pembayaran.process');
Route::get('/pembayaran/finish', [PembayaranController::class, 'finish'])->name('pembayaran.finish');
Route::post('/pembayaran/cancel', [PembayaranController::class, 'cancel'])->name('pembayaran.cancel');
// Midtrans callback
Route::post('/pembayaran/callback', [PembayaranController::class, 'callback'])->name('pembayaran.callback');

// Invoice PDF
Route::get('/invoice/{booking_id}', [InvoiceController::class, 'generateInvoice'])->name('invoice');
Route::get('/invoice/{booking_id}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
Route::get('/invoice/{booking_id}/preview', [InvoiceController::class, 'previewInvoice'])->name('invoice.preview');

// Test Invoice (for development only)
Route::get('/test-invoice', fn() => view('test-invoice'))->name('test.invoice');

// Test Payment Finish (for debugging email issue)
Route::get('/test-finish/{order_id?}', function($order_id = null) {
    try {
        // Get latest payment if no order_id provided
        if (!$order_id) {
            $payment = \App\Models\Payment::latest()->first();
            $order_id = $payment ? $payment->order_id : null;
        }
        
        if (!$order_id) {
            return response()->json(['error' => 'No order ID found']);
        }
        
        // Simulate finish request
        $request = request();
        $request->merge([
            'order_id' => $order_id,
            'status_code' => '200',
            'transaction_status' => 'settlement'
        ]);
        
        $controller = new \App\Http\Controllers\PembayaranController();
        $response = $controller->finish($request);
        
        return response()->json([
            'success' => true,
            'message' => 'Finish method called successfully',
            'order_id' => $order_id,
            'response' => $response->getStatusCode()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);
    }
});


