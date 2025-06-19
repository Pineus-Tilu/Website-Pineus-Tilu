<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#0d3b2e] px-4 py-16 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-[#2d6a4f] tracking-wide" style="font-family: 'Brush Script MT', cursive;">
                    Pineus Tilu
                </h2>
                <p class="mt-1 text-sm text-gray-500 italic">
                    "Masuk untuk menikmati pengalaman alam yang tak terlupakan."
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-700 hover:text-green-900 font-medium" href="{{ route('password.request') }}">
                            {{ __('Lupa kata sandi?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-[#2d6a4f] hover:bg-[#1b4332] text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>

                <!-- Google Login -->
                <div class="flex items-center justify-center mt-4">
                    <a href="{{ route('google.login') }}"
                        class="flex items-center justify-center w-full bg-white text-gray-700 border border-gray-300 rounded-md py-2 hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5 mr-2">
                        Masuk dengan Google
                    </a>
                </div>
            </form>

            <div class="text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-700 font-medium hover:underline">Daftar di sini</a>
            </div>
        </div>
    </div>
</x-guest-layout>
