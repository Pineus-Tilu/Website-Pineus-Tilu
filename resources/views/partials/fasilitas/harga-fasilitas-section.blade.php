<!-- Harga Section -->
<section class="py-16 px-4 bg-gradient-to-br from-gray-50 to-white font-body" data-aos="fade-up">
    <div class="max-w-5xl mx-auto">
        <h2 class="mb-12 text-4xl font-bold text-center text-green-700 " style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 700;">Daftar Harga</h2>
        <div class="grid gap-6 md:grid-cols-3">
            <!-- Hari Biasa -->
            <div class="p-8 bg-white rounded-2xl shadow-lg border-2 border-gray-100 hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Hari Biasa</h3>
                    <p class="text-2xl font-bold text-green-600">
                        {{ isset($data['harga_biasa']) && $data['harga_biasa'] !== '-' ? $data['harga_biasa'] : '-' }}
                    </p>
                    @if(isset($data['harga_biasa']) && $data['harga_biasa'] !== '-')
                        <p class="text-sm text-gray-500 mt-1">/deck/malam</p>
                    @endif
                </div>
            </div>

            <!-- Hari Libur -->
            <div class="p-8 bg-white rounded-2xl shadow-lg border-2 border-blue-100 hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Hari Libur</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ isset($data['harga_libur']) && $data['harga_libur'] !== '-' ? $data['harga_libur'] : '-' }}
                    </p>
                    @if(isset($data['harga_libur']) && $data['harga_libur'] !== '-')
                        <p class="text-sm text-gray-500 mt-1">/deck/malam</p>
                    @endif
                </div>
            </div>

            <!-- High Season -->
            <div class="p-8 bg-white rounded-2xl shadow-lg border-2 border-red-100 hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">High Season</h3>
                    <p class="text-2xl font-bold text-red-600">
                        {{ isset($data['harga_highseason']) && $data['harga_highseason'] !== '-' ? $data['harga_highseason'] : '-' }}
                    </p>
                    @if(isset($data['harga_highseason']) && $data['harga_highseason'] !== '-')
                        <p class="text-sm text-gray-500 mt-1">/deck/malam</p>
                    @endif
                </div>
            </div>
        </div>
        
        @if (!empty($data['harga_catatan']))
            <div class="mt-8 p-6 bg-yellow-50 rounded-xl border-l-4 border-yellow-400">
                <p class="text-gray-700 text-center">
                    <strong>Catatan:</strong> {{ $data['harga_catatan'] }}
                </p>
            </div>
        @endif
    </div>
</section>
