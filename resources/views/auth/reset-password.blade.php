<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#0d3b2e] px-4 py-16 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-[#2d6a4f] tracking-wide" style="font-family: 'Brush Script MT', cursive;">
                    Pineus Tilu
                </h2>
                <p class="mt-2 text-lg font-semibold text-[#2d6a4f]">
                    Reset Password
                </p>
                <p class="mt-1 text-sm text-gray-500 italic">
                    "Masukkan email dan password baru Anda untuk mereset akses akun."
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" 
                        type="email" 
                        name="email" 
                        :value="old('email', $request->email)" 
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password Baru')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" 
                        type="password" 
                        name="password" 
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" 
                        type="password" 
                        name="password_confirmation" 
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-[#2d6a4f] hover:bg-[#1b4332] text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-sm text-gray-600">
                Ingat password Anda?
                <a href="{{ route('login') }}" class="text-green-700 font-medium hover:underline">Masuk di sini</a>
            </div>
        </div>
    </div>
</x-guest-layout>