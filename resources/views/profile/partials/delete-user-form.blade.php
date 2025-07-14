@php
    $hasPassword = !empty(Auth::user()->password) && !Auth::user()->google_id;
    $isGoogleUser = !empty(Auth::user()->google_id);
@endphp

<section class="space-y-6">
    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-body">
        @if ($isGoogleUser)
            Hapus Akun
        @else
            Hapus Akun
        @endif
    </x-danger-button>

    <!-- Modal dengan background blur dan cerah - Fixed positioning -->
    <div x-data="{ show: false }" x-on:open-modal.window="show = ($event.detail === 'confirm-user-deletion')"
        x-on:close.window="show = false" x-show="show" class="fixed inset-0 z-[9999] flex items-center justify-center"
        style="display: none;">

        <!-- Background overlay dengan blur dan opacity tinggi -->
        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-white/90 backdrop-blur-lg" x-on:click="$dispatch('close')">
        </div>

        <!-- Modal Content -->
        <div x-show="show" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="relative z-[10000] w-full max-w-md mx-4 bg-white border border-gray-200 shadow-2xl rounded-2xl">

            <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
                @csrf
                @method('delete')

                <div class="mb-6 text-center">
                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-red-100 rounded-full">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900"
                        style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 700;">
                        @if ($isGoogleUser)
                            Konfirmasi Hapus Akun
                        @else
                            Konfirmasi Hapus Akun
                        @endif
                    </h2>
                </div>

                @if ($hasPassword)
                    <p class="mt-1 mb-4 text-sm text-gray-600 font-body">
                        Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen. Masukkan
                        password Anda untuk mengonfirmasi penghapusan akun.
                    </p>

                    <div class="p-4 mb-4 border border-red-200 rounded-lg bg-red-50">
                        <p class="text-sm text-red-800 font-body">
                            ⚠️ Semua data Anda akan dihapus permanen
                        </p>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="password" value="Password" class="sr-only" />
                        <x-text-input id="password" name="password" type="password"
                            class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="Masukkan password Anda" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
                @else
                    <p class="mt-1 mb-4 text-sm text-gray-600 font-body">
                        @if ($isGoogleUser)
                            Anda login menggunakan akun Google. Tidak diperlukan password untuk menghapus akun. Apakah
                            Anda yakin ingin menghapus akun ini?
                        @else
                            Tidak diperlukan password untuk menghapus akun ini. Klik tombol di bawah untuk mengonfirmasi
                            penghapusan.
                        @endif
                    </p>

                    <div class="p-4 mb-4 border border-red-200 rounded-lg bg-red-50">
                        <p class="text-sm text-red-800 font-body">
                            ⚠️ Semua data Anda akan dihapus permanen
                        </p>
                    </div>
                @endif

                <div class="flex gap-3 mt-6">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="justify-center flex-1 px-4 py-2 text-center text-gray-700 transition-colors bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-300 font-body">
                        Batal
                    </button>

                    <button type="submit"
                        class="justify-center flex-1 px-4 py-2 text-center text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-body">
                        @if ($isGoogleUser)
                            Ya, Hapus Akun
                        @else
                            Ya, Hapus Akun
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
