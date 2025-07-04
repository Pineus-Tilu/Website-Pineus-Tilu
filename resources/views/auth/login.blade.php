<x-guest-layout>
    @section('title', 'Masuk - Pineus Tilu Riverside Camping Ground')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] px-4 py-8 relative overflow-hidden">
        <div class="md:hidden absolute top-6 left-6 z-20">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center justify-center w-10 h-10 bg-white/80 backdrop-blur-md rounded-full shadow-lg border border-white/30 hover:bg-white/90 hover:scale-105 transition-all duration-300 group">
                <svg class="w-5 h-5 text-[#006C43] group-hover:text-[#005A36] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-32 h-32 bg-white/5 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-24 h-24 bg-white/10 rounded-full animate-bounce"></div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white/5 rounded-full animate-ping"></div>
            <div class="absolute top-1/4 right-1/3 w-20 h-20 bg-white/5 rounded-full animate-pulse delay-1000"></div>
        </div>

        <div class="w-full max-w-md relative z-10">
            <!-- Card Container -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 space-y-6 border border-white/20 relative">
                <!-- Header Section -->
                <div class="text-center space-y-4">
                    <!-- Logo -->
                    <div class="mx-auto w-50 h-50 mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Pineus Tilu Logo" 
                             class="w-full h-full object-contain drop-shadow-lg">
                    </div>
                    
                    <p class="text-sm text-gray-600 font-typewriter italic max-w-sm mx-auto">
                        "Masuk untuk menikmati pengalaman alam yang tak terlupakan."
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Masukkan email Anda" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Password Field with Show/Hide -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Masukkan password" />
                        
                        <!-- Show/Hide Password Button -->
                        <button type="button" id="togglePassword" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                            <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eyeSlashIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                            </svg>
                        </button>
                        
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-[#006C43] border-gray-300 rounded focus:ring-[#006C43]">
                            <span class="text-gray-600 font-typewriter">Ingat Saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[#006C43] hover:text-[#005A36] font-medium font-typewriter transition-colors">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300 font-typewriter">
                        Masuk
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500 font-typewriter">atau</span>
                        </div>
                    </div>

                    <!-- Google Login -->
                    <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center py-3 px-6 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-all duration-300 group">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5 mr-3">
                        <span class="text-gray-700 font-medium font-typewriter group-hover:text-gray-900">Masuk dengan Google</span>
                    </a>
                </form>

                <!-- Register Link -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-gray-600 font-typewriter">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-[#006C43] hover:text-[#005A36] font-bold transition-colors">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Show/Hide Password -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            togglePassword.addEventListener('click', function() {
                // Toggle password field type
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle eye icons
                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
            });
        });
    </script>
</x-guest-layout>