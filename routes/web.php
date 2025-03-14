<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


// Halaman Public
Route::get('/', fn () => view('welcome'));
Route::get('/about', fn () => view('about'));
Route::get('/review', fn () => view('review'));
Route::get('/faq', fn () => view('faq'));
Route::get('/contact', fn () => view('contact'));
Route::get('/explore', fn () => view('explore'));

// Dashboard untuk user login & verified
Route::get('/dashboard', fn () => view('dashboard'))
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
require __DIR__.'/auth.php';