<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#0d3b2e] px-4 py-16 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-[#2d6a4f] tracking-wide" style="font-family: 'Brush Script MT', cursive;">
                    Pineus Tilu
                </h2>
                <p class="mt-1 text-sm text-gray-500 italic">
                    "Daftarkan dirimu untuk memulai petualangan alam bersama kami."
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700" />
                    <x-text-input id="name" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
                </div>

                <div>
                    <x-primary-button class="w-full bg-[#2d6a4f] hover:bg-[#1b4332] text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-700 font-medium hover:underline">Masuk di sini</a>
            </div>
        </div>
    </div>
</x-guest-layout>
