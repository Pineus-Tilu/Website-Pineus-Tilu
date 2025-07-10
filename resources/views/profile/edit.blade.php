<x-app-layout>
    <!-- Header Full Background dengan margin top untuk navigation -->
    <div class="bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] py-8 px-4 mt-20 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute w-16 h-16 bg-white rounded-full top-4 right-10 animate-pulse"></div>
            <div class="absolute w-12 h-12 delay-1000 bg-white rounded-full bottom-4 left-10 animate-pulse"></div>
        </div>

        <div class="relative z-10 text-center">
            <h2 class="mt-8 text-4xl text-white font-dancing md:text-5xl drop-shadow-lg jp-brush">
                Pengaturan Akun
            </h2>
            <div class="w-24 h-1 mx-auto mt-4 bg-white rounded-full"></div>
            <p class="mt-3 text-lg text-green-100 font-typewriter">
                Kelola informasi profil dan keamanan akun Anda
            </p>
        </div>
    </div>

    <div class="min-h-screen px-4 py-10 bg-gradient-to-br from-gray-50 via-green-50 to-blue-50">
        <div class="max-w-5xl mx-auto">
            <div class="relative overflow-hidden bg-white shadow-2xl rounded-3xl">
                <!-- Background Decorative Elements -->
                <div class="absolute inset-0 overflow-hidden">
                    <div
                        class="absolute top-10 right-10 w-32 h-32 bg-gradient-to-br from-[#006C43]/10 to-[#005A36]/10 rounded-full animate-pulse">
                    </div>
                    <div
                        class="absolute bottom-10 left-10 w-24 h-24 bg-gradient-to-br from-[#00844D]/10 to-[#006C43]/10 rounded-full animate-pulse delay-1000">
                    </div>
                </div>

                <!-- Header Profile Card -->
                <div class="bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] p-8 relative z-10">
                    <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background={{ urlencode('#FFFFFF') }}&color={{ urlencode('#006C43') }}&size=80"
                                    alt="Avatar" class="w-20 h-20 border-4 border-white rounded-full shadow-lg">
                                <div
                                    class="absolute w-6 h-6 bg-green-400 border-2 border-white rounded-full -bottom-2 -right-2">
                                </div>
                            </div>
                            <div class="text-white">
                                <h3 class="text-2xl font-bold jp-brush drop-shadow-md">
                                    {{ Auth::user()->name }}
                                </h3>
                                <p class="text-sm text-green-100 font-typewriter">
                                    📧 {{ Auth::user()->email }}
                                </p>
                                <p class="mt-1 text-xs text-green-200">
                                    🗓️ Bergabung {{ Auth::user()->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="px-6 py-3 font-medium text-white border shadow-lg bg-white/20 backdrop-blur-md border-white/30 rounded-2xl">
                            <span class="text-sm">ID: #{{ str_pad(Auth::id(), 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 p-8 space-y-8">
                    <!-- Grid Content -->
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        <!-- Update Info -->
                        <div
                            class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-lg border-2 border-[#006C43]/20 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-[#006C43] to-[#00844D] rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#006C43] jp-brush">👤 Informasi Profil</h4>
                                    <p class="text-sm text-gray-600 font-typewriter">Perbarui informasi profil dan
                                        alamat email Anda</p>
                                </div>
                            </div>
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <!-- Update Password -->
                        @if (Auth::user()->password)
                            <div
                                class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-lg border-2 border-[#006C43]/20 hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center gap-3 mb-6">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-[#00844D] to-[#005A36] rounded-xl flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-[#006C43] jp-brush">🔒 Ubah Password</h4>
                                        <p class="text-sm text-gray-600 font-typewriter">Lindungi akun dengan kata sandi
                                            yang kuat</p>
                                    </div>
                                </div>
                                @include('profile.partials.update-password-form')
                            </div>
                        @else
                            <div
                                class="p-6 transition-all duration-300 border-2 border-blue-200 shadow-lg bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl hover:shadow-xl">
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-blue-700 jp-brush">🔐 Login via Google</h4>
                                        <p class="text-sm text-blue-600 font-typewriter">Akun terlindungi dengan Google
                                            Authentication</p>
                                    </div>
                                </div>
                                <div class="p-4 border border-blue-200 bg-white/60 backdrop-blur-sm rounded-xl">
                                    <p class="text-blue-800 font-typewriter">Akun ini masuk menggunakan autentikasi
                                        Google.
                                        Jika ingin menambahkan password, silakan hubungi administrator.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Delete Account -->
                    <div
                        class="p-6 transition-all duration-300 border-2 border-red-200 shadow-lg bg-gradient-to-br from-red-50 to-red-100 rounded-2xl hover:shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="flex items-center justify-center w-12 h-12 shadow-lg bg-gradient-to-br from-red-500 to-red-600 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-red-700 jp-brush">⚠️ Hapus Akun</h4>
                                <p class="text-sm text-red-600 font-typewriter">Tindakan ini tidak dapat dibatalkan</p>
                            </div>
                        </div>
                        <div class="p-4 mb-4 border border-red-200 bg-white/60 backdrop-blur-sm rounded-xl">
                            <p class="text-red-800 font-typewriter">Hapus akun Anda. Semua data dan sumber daya terkait
                                akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data Anda jika ada.
                            </p>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
