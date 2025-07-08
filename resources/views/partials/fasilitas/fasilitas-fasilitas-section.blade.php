<!-- Fasilitas Section -->
<section class="bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] text-white py-20 px-4 font-typewriter relative overflow-hidden" data-aos="fade-up">
    <!-- Decorative Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 rounded-full bg-white animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-24 h-24 rounded-full bg-white animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 rounded-full bg-white animate-pulse delay-500"></div>
    </div>
    
    <div class="max-w-6xl mx-auto relative z-10">
        <h2 class="mb-12 text-4xl font-bold text-center jp-brush drop-shadow-lg" data-aos="fade-down">Fasilitas Tersedia</h2>
        
        <!-- Kapasitas Card -->
        <div class="mb-12 p-8 bg-white bg-opacity-15 backdrop-blur-md rounded-2xl border border-white border-opacity-20 shadow-2xl" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
                <h3 class="mb-4 text-3xl font-bold jp-brush text-white drop-shadow-md">💎 Kapasitas</h3>
                <p class="mb-4 text-xl font-semibold text-gray-100">
                    {{ isset($data['kapasitas']) ? $data['kapasitas'] : '-' }}
                </p>
                @if (!empty($data['extra_charge']) && $data['extra_charge'] > 0)
                    <div class="inline-block px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                        <p class="text-lg font-bold text-white">
                            Rp.{{ number_format($data['extra_charge'], 0, ',', '.') }}/orang
                        </p>
                        <p class="text-sm text-red-100">(anak di atas 2 tahun sudah terhitung)</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Fasilitas Grid -->
        <div class="grid gap-8 lg:grid-cols-2">
            <!-- Fasilitas Pribadi -->
            <div class="p-8 bg-white bg-opacity-15 backdrop-blur-md rounded-2xl border border-white border-opacity-20 shadow-xl hover:bg-opacity-20 transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-right" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold jp-brush text-white drop-shadow-md">🏠 Fasilitas Pribadi</h3>
                </div>
                @if (!empty($data['fasilitas_pribadi']) && count($data['fasilitas_pribadi']))
                    <ul class="space-y-4">
                        @foreach ($data['fasilitas_pribadi'] as $item)
                            <li class="flex items-center text-lg text-gray-100 hover:text-white transition-colors">
                                <div class="w-6 h-6 bg-emerald-400 rounded-full flex items-center justify-center mr-4 flex-shrink-0 shadow-md">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="leading-relaxed">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-lg text-gray-200 italic">Tidak ada fasilitas pribadi tersedia.</p>
                @endif
            </div>

            <!-- Fasilitas Umum -->
            <div class="p-8 bg-white bg-opacity-15 backdrop-blur-md rounded-2xl border border-white border-opacity-20 shadow-xl hover:bg-opacity-20 transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-left" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold jp-brush text-white drop-shadow-md">🌍 Fasilitas Umum</h3>
                </div>
                @if (!empty($data['fasilitas_umum']) && count($data['fasilitas_umum']))
                    <ul class="space-y-4">
                        @foreach ($data['fasilitas_umum'] as $item)
                            <li class="flex items-center text-lg text-gray-100 hover:text-white transition-colors">
                                <div class="w-6 h-6 bg-blue-400 rounded-full flex items-center justify-center mr-4 flex-shrink-0 shadow-md">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="leading-relaxed">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-lg text-gray-200 italic">Tidak ada fasilitas umum tersedia.</p>
                @endif
                @if (!empty($data['catatan']))
                    <div class="mt-6 p-5 bg-gradient-to-r from-yellow-500 to-yellow-600 bg-opacity-90 rounded-xl border-l-4 border-yellow-300 shadow-lg">
                        <p class="text-lg text-white font-medium">
                            <span class="font-bold">📝 Catatan:</span> {{ $data['catatan'] }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>