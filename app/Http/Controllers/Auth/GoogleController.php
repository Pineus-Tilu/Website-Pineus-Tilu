<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        DB::beginTransaction();
        try {
            // Mendapatkan data pengguna dari Google
            $googleUser = Socialite::driver('google')->user();


            $user = User::firstOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(24)),
                'google_id' => $googleUser->getId(),
            ]);

            Auth::login($user);
            DB::commit();
            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['google' => 'Gagal mengautentikasi dengan Google.']);
        }
    }
}