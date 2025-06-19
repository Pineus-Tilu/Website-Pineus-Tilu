<x-app-layout>
    <x-slot name="header">
        <h2 class="font-dancing text-4xl text-[#006C43] dark:text-white leading-tight text-center font-bold">
            Pengaturan Akun
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-[#E8F5E9] py-10">
        <div class="max-w-5xl w-full bg-white shadow-lg rounded-2xl overflow-hidden p-8 space-y-8 relative">
            <!-- Header Profile -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 relative z-10">
                <div class="flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background={{ urlencode('#006C43') }}&color=fff" alt="Avatar"
                         class="w-16 h-16 rounded-full border-2 border-[#006C43] shadow-md">
                    <div>
                        <h3 class="text-xl font-semibold text-[#006C43]">
                            {{ Auth::user()->name }}
                        </h3>
                        <p class="text-black-700 text-sm">
                            Email: {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
                <span class="text-sm text-white font-medium px-4 py-2 rounded-full bg-[#006C43] border">
                    ID Pengguna: {{ Auth::id() }}
                </span>
            </div>

            <!-- Grid Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                <!-- Update Info -->
                <div class="bg-white rounded-xl p-6 shadow-md border border-[#006C43]">
                    <h4 class="text-lg font-semibold text-[#006C43] mb-4">Informasi Profil</h4>
                    <p class="text-black-700 mb-4">Perbarui informasi profil dan alamat email Anda.</p>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password (hanya jika user memiliki password, bukan Google-only) -->
                @if (Auth::user()->password)
                    <div class="bg-white rounded-xl p-6 shadow-md border border-[#006C43]">
                        <h4 class="text-lg font-semibold text-[#006C43] mb-4">Ubah Password</h4>
                        <p class="text-black=-700 mb-4">Lindungi akun Anda dengan menggunakan kata sandi yang kuat.</p>
                        @include('profile.partials.update-password-form')
                    </div>
                @else
                    <div class="bg-white rounded-xl p-6 shadow-md border border-[#006C43] text-[#006C43]">
                        <h4 class="text-lg font-semibold mb-2">Login via Google</h4>
                        <p>Akun ini masuk menggunakan autentikasi Google. Jika ingin menambahkan password, silakan hubungi administrator.</p>
                    </div>
                @endif
            </div>

            <!-- Delete Account -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-red-200 relative z-10">
                <h4 class="text-lg font-semibold text-red-600 mb-4">Hapus Akun</h4>
                <p class="text-black-700 mb-4">Hapus akun Anda. Semua data dan sumber daya terkait akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data Anda jika ada.</p>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>