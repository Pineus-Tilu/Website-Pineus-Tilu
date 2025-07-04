<x-guest-layout>
    @section('title', 'Verifikasi Email - Pineus Tilu Riverside Camping Ground')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] px-4 py-8 relative overflow-hidden">
        <!-- Mobile Back Button -->
        <div class="md:hidden absolute top-6 left-6 z-20">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center justify-center w-10 h-10 bg-white/80 backdrop-blur-md rounded-full shadow-lg border border-white/30 hover:bg-white/90 hover:scale-105 transition-all duration-300 group">
                <svg class="w-5 h-5 text-[#006C43] group-hover:text-[#005A36] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-20 w-40 h-40 bg-white/5 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-32 h-32 bg-white/10 rounded-full animate-bounce"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-white/5 rounded-full animate-ping"></div>
        </div>

        <div class="w-full max-w-md relative z-10">
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 space-y-6 border border-white/20">
                <!-- Header -->
                <div class="text-center space-y-4">
                    <!-- Logo -->
                    <div class="mx-auto w-50 h-50 mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Pineus Tilu Logo" 
                             class="w-full h-full object-contain drop-shadow-lg">
                    </div>
                    <p class="text-sm text-gray-600 font-typewriter italic text-center leading-relaxed">
                        "Terima kasih telah mendaftar! Silakan periksa email Anda dan klik link verifikasi untuk mengaktifkan akun."
                    </p>
                </div>

                <!-- Info Message -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-800 font-typewriter text-center">
                        {{ __('Kami telah mengirimkan link verifikasi ke email Anda. Silakan cek kotak masuk atau folder spam.') }}
                    </p>
                </div>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm text-green-800 font-typewriter text-center">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    </div>
                @endif

                <!-- Actions -->
                <div class="space-y-4">
                    <!-- Resend Button -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300 font-typewriter">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-white border-2 border-gray-200 text-gray-700 font-medium py-3 px-6 rounded-xl hover:bg-gray-50 transition-all duration-300 font-typewriter">
                            Keluar
                        </button>
                    </form>
                </div>

                <!-- Email Tips -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="text-sm font-bold text-yellow-800 font-typewriter mb-2">💡 Tips:</h4>
                    <ul class="text-xs text-yellow-700 font-typewriter space-y-1">
                        <li>• Periksa folder spam/junk mail</li>
                        <li>• Tunggu beberapa menit untuk email masuk</li>
                        <li>• Pastikan email address sudah benar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>