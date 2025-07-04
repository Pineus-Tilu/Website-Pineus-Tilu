<x-guest-layout>
    @section('title', 'Lupa Password - Pineus Tilu Riverside Camping Ground')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] px-4 py-8 relative overflow-hidden">
        <!-- Mobile Back Button -->
        <div class="md:hidden absolute top-6 left-6 z-20">
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center w-10 h-10 bg-white/80 backdrop-blur-md rounded-full shadow-lg border border-white/30 hover:bg-white/90 hover:scale-105 transition-all duration-300 group">
                <svg class="w-5 h-5 text-[#006C43] group-hover:text-[#005A36] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white/5 rounded-full animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-24 h-24 bg-white/10 rounded-full animate-bounce"></div>
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
                    <p class="text-sm text-gray-600 font-typewriter italic text-center">
                        "Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan link untuk reset password."
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Masukkan email terdaftar" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300 font-typewriter">
                        Kirim Link Reset Password
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-gray-600 font-typewriter">
                        Ingat password Anda? 
                        <a href="{{ route('login') }}" class="text-[#006C43] hover:text-[#005A36] font-bold transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>