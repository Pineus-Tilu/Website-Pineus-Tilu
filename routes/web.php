<?php

use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


// Halaman Public
Route::get('/', fn() => view('dashboard'));
Route::get('/tentang', fn() => view('tentang'));
Route::get('/kontak', fn() => view('kontak'));
Route::get('/reservasi', fn() => view('reservasi'));
Route::get('/fasilitas/{slug?}', function ($slug = 'pineus-tilu-1') {
    $data = config('fasilitas');

    if (!array_key_exists($slug, $data)) {
        abort(404);
    }

    return view('fasilitas', [
        'slug' => $slug,
        'data' => $data[$slug],
    ]);
});


// Dashboard untuk user login & verified
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');

// Group untuk halaman login-required
Route::middleware(['auth'])->group(function () {
    Route::view('/tour', 'tour');
    Route::view('/cart', 'cart');
    Route::view('/settings', 'settings');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route auth (login/register/logout)
require __DIR__ . '/auth.php';
