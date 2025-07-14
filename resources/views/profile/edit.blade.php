<x-app-layout>
    <!-- Tidak ada global style di sini, font diatur per elemen -->

    <!-- Header Full Background dengan margin top untuk navigation -->
    <div class="bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] py-8 px-4 mt-20 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute w-16 h-16 bg-white rounded-full top-4 right-10 animate-pulse"></div>
            <div class="absolute w-12 h-12 delay-1000 bg-white rounded-full bottom-4 left-10 animate-pulse"></div>
        </div>

        <div class="relative z-10 text-center">
            <h2 class="mt-8 text-4xl text-white md:text-5xl drop-shadow-lg"
                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight:700;">
                Pengaturan Akun
            </h2>
            <div class="w-24 h-1 mx-auto mt-4 bg-white rounded-full"></div>
            <p class="mt-3 text-lg text-green-100"
                style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                Kelola informasi profil dan keamanan akun Anda
            </p>
        </div>
    </div>

    <div class="min-h-screen px-4 py-10 bg-gradient-to-br from-gray-50 via-green-50 to-blue-50">
        <div class="max-w-5xl mx-auto">
            <div class="relative overflow-hidden bg-white shadow-2xl rounded-3xl">
                <!-- Background Decorative Elements -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute top-10 right-10 w-32 h-32 bg-gradient-to-br from-[#006C43]/10 to-[#005A36]/10 rounded-full animate-pulse"></div>
                    <div class="absolute bottom-10 left-10 w-24 h-24 bg-gradient-to-br from-[#00844D]/10 to-[#006C43]/10 rounded-full animate-pulse delay-1000"></div>
                </div>

                <!-- Header Profile Card -->
                <div class="bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] p-8 relative z-20">
                    <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background={{ urlencode('#FFFFFF') }}&color={{ urlencode('#006C43') }}&size=80"
                                    alt="Avatar" class="w-20 h-20 border-4 border-white rounded-full shadow-lg">
                                <div class="absolute w-6 h-6 bg-green-400 border-2 border-white rounded-full -bottom-2 -right-2"></div>
                            </div>
                            <div class="text-white">
                                <h3 class="text-2xl font-bold drop-shadow-md"
                                    style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight:700;">
                                    {{ Auth::user()->name }}
                                </h3>
                                <p class="text-sm text-green-100"
                                    style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                    📧 {{ Auth::user()->email }}
                                </p>
                                <p class="mt-1 text-xs text-green-200"
                                    style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                    🗓️ Bergabung {{ Auth::user()->created_at->format('d M Y') }}
                                </p>
                                @if(Auth::user()->google_id)
                                    <div class="flex items-center gap-1 mt-1">
                                        <svg class="w-4 h-4 text-blue-300" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                            <path fill="currentColor"
                                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                            <path fill="currentColor"
                                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                            <path fill="currentColor"
                                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                        </svg>
                                        <span class="text-xs text-blue-300"
                                            style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                            Login via Google
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mt-4 sm:mt-0">
                            <div class="px-6 py-3 font-medium text-white border shadow-lg bg-white/20 backdrop-blur-md border-white/30 rounded-2xl"
                                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                <span class="text-sm">ID: #{{ str_pad(Auth::id(), 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <!-- Tombol titik tiga -->
                            <div x-data="{ open: false }" class="relative z-50">
                                <button @click="open = !open"
                                    class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-white/10 transition focus:outline-none focus:ring-2 focus:ring-[#006C43]/30"
                                    style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="4" cy="10" r="2" />
                                        <circle cx="10" cy="10" r="2" />
                                        <circle cx="16" cy="10" r="2" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu hapus akun -->
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 z-50 p-3 mt-2 text-left bg-white border border-red-100 rounded-lg shadow w-52"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                    <div class="flex items-start gap-2">
                                        <div class="flex items-center justify-center flex-shrink-0 rounded-md w-7 h-7 bg-gradient-to-br from-red-400 to-red-600">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 text-sm font-bold text-red-700"
                                                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight:700;">
                                                Hapus Akun
                                            </h4>
                                            <div class="p-1 mb-2 border border-red-100 rounded bg-white/80">
                                                <p class="text-xs text-red-800"
                                                    style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                                    @if(Auth::user()->google_id)
                                                        Hapus akun. Semua data yang terkait akan dihapus permanen dari sistem kami.
                                                    @else
                                                        Hapus akun. Semua data dan sumber daya yang terkait akan dihapus secara permanen dari sistem kami.
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="mt-1">
                                                @include('profile.partials.delete-user-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 p-8 space-y-8">
                    <!-- Grid Content -->
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        <!-- Update Info -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 {{ Auth::user()->google_id ? 'opacity-75' : '' }}">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#006C43] to-[#00844D] rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#006C43]"
                                        style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight:700;">
                                        👤 Informasi Profil
                                    </h4>
                                    <p class="text-sm text-gray-600"
                                        style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                        @if(Auth::user()->google_id)
                                            Profil Google tidak dapat diubah di sini
                                        @else
                                            Perbarui informasi profil dan alamat email Anda
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if(Auth::user()->google_id)
                                <!-- Disabled form for Google users -->
                                <div class="p-4 border border-blue-200 bg-blue-50/60 backdrop-blur-sm rounded-xl">
                                    <div class="flex items-center gap-3 mb-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <h5 class="font-semibold text-blue-800"
                                            style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                            Informasi Akun Google
                                        </h5>
                                    </div>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-blue-700"
                                                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                                Nama
                                            </label>
                                            <input type="text" value="{{ Auth::user()->name }}" disabled
                                                class="w-full px-4 py-2 text-blue-800 border border-blue-200 rounded-lg cursor-not-allowed bg-blue-50"
                                                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                        </div>
                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-blue-700"
                                                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                                Email
                                            </label>
                                            <input type="email" value="{{ Auth::user()->email }}" disabled
                                                class="w-full px-4 py-2 text-blue-800 border border-blue-200 rounded-lg cursor-not-allowed bg-blue-50"
                                                style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                                        </div>
                                    </div>
                                    <p class="mt-3 text-xs text-blue-600"
                                        style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                        💡 Untuk mengubah informasi ini, silakan ubah di akun Google Anda terlebih dahulu.
                                    </p>
                                </div>
                            @else
                                @include('profile.partials.update-profile-information-form')
                            @endif
                        </div>

                        <!-- Update Password -->
                        @if (Auth::user()->password && !Auth::user()->google_id)
                            <div class="p-6 transition-all duration-300 bg-white border border-gray-200 shadow-lg rounded-2xl hover:shadow-xl">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-br from-[#00844D] to-[#005A36] rounded-xl flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-[#006C43]"
                                            style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight:700;">
                                            🔒 Ubah Password
                                        </h4>
                                        <p class="text-sm text-gray-600"
                                            style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                            Lindungi akun dengan kata sandi yang kuat
                                        </p>
                                    </div>
                                </div>
                                @include('profile.partials.update-password-form')
                            </div>
                        @else
                            <div class="p-6 transition-all duration-300 bg-white border border-gray-200 shadow-lg rounded-2xl hover:shadow-xl">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="flex items-center justify-center w-12 h-12 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-blue-700"
                                            style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight:700;">
                                            🔐 Login via Google
                                        </h4>
                                        <p class="text-sm text-blue-600"
                                            style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                            Akun terlindungi dengan Google Authentication
                                        </p>
                                    </div>
                                </div>
                                <div class="p-4 border border-blue-200 bg-white/60 backdrop-blur-sm rounded-xl">
                                    <p class="text-blue-800"
                                        style="font-family: 'Roboto Mono', 'Consolas', monospace;">
                                        @if(Auth::user()->google_id)
                                            🔒 Akun ini menggunakan autentikasi Google. Password dikelola oleh Google dan tidak dapat diubah di sini.
                                        @else
                                            Akun ini masuk menggunakan autentikasi Google. Jika ingin menambahkan password, silakan hubungi administrator.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
