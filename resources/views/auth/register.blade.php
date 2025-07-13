<x-guest-layout>
    @section('title', 'Daftar - Pineus Tilu Riverside Camping Ground')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] px-4 py-8 relative overflow-hidden">
        <!-- Mobile Back Button -->
        <div class="absolute z-20 md:hidden top-6 left-6">
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center w-10 h-10 transition-all duration-300 border rounded-full shadow-lg bg-white/80 backdrop-blur-md border-white/30 hover:bg-white/90 hover:scale-105 group">
                <svg class="w-5 h-5 text-[#006C43] group-hover:text-[#005A36] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-40 h-40 rounded-full top-20 right-10 bg-white/5 animate-float"></div>
            <div class="absolute rounded-full bottom-20 left-10 w-28 h-28 bg-white/10 animate-float-delayed"></div>
            <div class="absolute w-20 h-20 rounded-full top-1/3 right-1/4 bg-white/5 animate-ping"></div>
        </div>

        <div class="relative z-10 w-full max-w-md">
            <div class="p-8 space-y-6 border shadow-2xl bg-white/95 backdrop-blur-lg rounded-3xl border-white/20">
                <!-- Header -->
                <div class="space-y-4 text-center">
                    <!-- Logo -->
                    <div class="mx-auto mb-6 w-50 h-50">
                        <img src="{{ asset('images/logo.png') }}" alt="Pineus Tilu Logo" 
                             class="object-contain w-full h-full drop-shadow-lg">
                    </div>
                    <p class="text-sm italic text-gray-600 font-typewriter">
                        "Daftarkan dirimu untuk memulai petualangan alam bersama kami."
                    </p>
                </div>

                <!-- Existing form content... -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name Field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Nama lengkap" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Email Field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Alamat email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password Field with Single Icon -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Password" />
                        
                        <!-- Single Toggle Button -->
                        <button type="button" id="togglePassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 transition-colors hover:text-gray-600 focus:outline-none">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password with Single Icon -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#006C43] focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm font-typewriter"
                               placeholder="Konfirmasi password" />
                        
                        <!-- Single Toggle Button -->
                        <button type="button" id="togglePasswordConfirmation" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 transition-colors hover:text-gray-600 focus:outline-none">
                            <svg id="eyeIconConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300 font-typewriter">
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="pt-4 text-center border-t border-gray-200">
                    <p class="text-gray-600 font-typewriter">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-[#006C43] hover:text-[#005A36] font-bold transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Show/Hide Password -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove any existing event listeners
    const cleanupElement = (element) => {
        if (element) {
            const newElement = element.cloneNode(true);
            element.parentNode.replaceChild(newElement, element);
            return newElement;
        }
        return null;
    };

    // Password field toggle
    const togglePassword = cleanupElement(document.getElementById('togglePassword'));
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (togglePassword && passwordField && eyeIcon) {
        togglePassword.addEventListener('click', function(e) {
            e.preventDefault();
            
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                `;
                togglePassword.setAttribute('aria-label', 'Sembunyikan password');
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
                togglePassword.setAttribute('aria-label', 'Tampilkan password');
            }
        });
    }

    // Password confirmation field toggle
    const togglePasswordConfirmation = cleanupElement(document.getElementById('togglePasswordConfirmation'));
    const passwordConfirmationField = document.getElementById('password_confirmation');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');

    if (togglePasswordConfirmation && passwordConfirmationField && eyeIconConfirm) {
        togglePasswordConfirmation.addEventListener('click', function(e) {
            e.preventDefault();
            
            const type = passwordConfirmationField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationField.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIconConfirm.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                `;
                togglePasswordConfirmation.setAttribute('aria-label', 'Sembunyikan konfirmasi password');
            } else {
                eyeIconConfirm.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
                togglePasswordConfirmation.setAttribute('aria-label', 'Tampilkan konfirmasi password');
            }
        });
    }
});
    </script>

    <!-- CSS untuk menghilangkan duplikat password toggle dari browser -->
    <style>
        /* Pastikan hanya ada satu toggle button */
        #togglePassword,
        #togglePasswordConfirmation {
            z-index: 10;
        }

        /* Hide any potential duplicate icons from browser */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        /* Remove browser default password toggle */
        input[type="password"]::-webkit-credentials-auto-fill-button {
            visibility: hidden;
            pointer-events: none;
            position: absolute;
            right: 0;
        }

        /* Remove any webkit reveal button */
        input[type="password"]::-webkit-textfield-decoration-container {
            visibility: hidden;
            pointer-events: none;
        }

        /* Float animation tetap sama */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float-delayed 8s ease-in-out infinite 2s;
        }
    </style>
</x-guest-layout>