<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#0d3b2e] px-4 py-16 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-[#2d6a4f] tracking-wide" style="font-family: 'Brush Script MT', cursive;">
                    Pineus Tilu
                </h2>
                <p class="mt-2 text-lg font-semibold text-[#2d6a4f]">
                    Konfirmasi Password
                </p>
                <p class="mt-1 text-sm text-gray-500 italic">
                    "Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan."
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" 
                        type="password" 
                        name="password" 
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-[#2d6a4f] hover:bg-[#1b4332] text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                        {{ __('Konfirmasi') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-sm text-gray-600">
                <a href="{{ route('dashboard') }}" class="text-green-700 font-medium hover:underline">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</x-guest-layout>