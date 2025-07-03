<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#0d3b2e] px-4 py-16 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-[#2d6a4f] tracking-wide" style="font-family: 'Brush Script MT', cursive;">
                    Pineus Tilu
                </h2>
                <p class="mt-2 text-lg font-semibold text-[#2d6a4f]">
                    Verifikasi Email
                </p>
                <p class="mt-1 text-sm text-gray-500 italic">
                    "Untuk mengaktifkan akun Anda, silakan periksa kotak masuk email dan klik link verifikasi yang telah kami kirimkan."
                </p>
            </div>

            <!-- Email Icon -->
            <div class="flex justify-center">
                <div class="bg-[#2d6a4f] rounded-full p-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 1.99 2H20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
            </div>

            <div class="text-center text-sm text-gray-600 bg-gray-50 p-4 rounded-lg">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan kepada Anda? Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang lain.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                    {{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="w-full bg-[#2d6a4f] hover:bg-[#1b4332] text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-sm text-gray-600 hover:text-gray-900 py-2 px-4 border border-gray-300 rounded-md hover:bg-gray-50 transition duration-200">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>