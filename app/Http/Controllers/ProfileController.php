<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {        
        return view('profile.edit', [
            'user' => $request->user(),
            'isGoogleUser' => !is_null($request->user()->google_id), 
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $isGoogleUser = !is_null($user->google_id);

        // Validasi dasar untuk semua user
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ];

        $request->validate($rules, $messages);

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Reset email verification jika email berubah dan bukan Google user
        if ($user->isDirty('email') && !$isGoogleUser) {
            $user->forceFill(['email_verified_at' => null]);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();
        $isGoogleUser = !is_null($user->google_id);

        // Google user tidak bisa update password
        if ($isGoogleUser) {
            return Redirect::route('profile.edit')->withErrors([
                'password' => 'Pengguna Google tidak dapat mengubah password.'
            ]);
        }

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();
        $isGoogleUser = !is_null($user->google_id);

        // Hanya minta password jika bukan Google user
        if (!$isGoogleUser) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ], [
                'password.required' => 'Password wajib diisi.',
                'password.current_password' => 'Password tidak sesuai.',
            ]);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}