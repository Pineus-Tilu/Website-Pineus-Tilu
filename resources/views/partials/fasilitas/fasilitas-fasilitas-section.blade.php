<!-- Fasilitas Section -->
<section class="bg-[#0d2c25] text-white py-20 px-4 font-typewriter" data-aos="fade-up">
    <div class="max-w-6xl mx-auto">
        <h2 class="mb-12 text-4xl font-bold text-center jp-brush" data-aos="fade-down">Fasilitas Tersedia</h2>
        
        <!-- Kapasitas Card -->
        <div class="mb-12 p-8 bg-green-800 bg-opacity-30 rounded-2xl border border-green-600" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
                <h3 class="mb-4 text-3xl font-bold jp-brush text-green-300">Kapasitas</h3>
                <p class="mb-4 text-xl">
                    {{ isset($data['kapasitas']) ? $data['kapasitas'] : '-' }}
                </p>
                @if (!empty($data['extra_charge']) && $data['extra_charge'] > 0)
                    <div class="inline-block px-4 py-2 bg-red-600 bg-opacity-80 rounded-lg">
                        <p class="text-lg font-semibold">
                            Rp.{{ number_format($data['extra_charge'], 0, ',', '.') }}/orang
                        </p>
                        <p class="text-sm text-red-200">(anak di atas 2 tahun sudah terhitung)</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Fasilitas Grid -->
        <div class="grid gap-8 lg:grid-cols-2">
            <!-- Fasilitas Pribadi -->
            <div class="p-8 bg-white bg-opacity-10 rounded-2xl backdrop-blur-sm" data-aos="fade-right" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold jp-brush text-green-300">Fasilitas Pribadi</h3>
                </div>
                @if (!empty($data['fasilitas_pribadi']) && count($data['fasilitas_pribadi']))
                    <ul class="space-y-3">
                        @foreach ($data['fasilitas_pribadi'] as $item)
                            <li class="flex items-center text-lg">
                                <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-lg text-gray-300">Tidak ada fasilitas pribadi tersedia.</p>
                @endif
            </div>

            <!-- Fasilitas Umum -->
            <div class="p-8 bg-white bg-opacity-10 rounded-2xl backdrop-blur-sm" data-aos="fade-left" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold jp-brush text-blue-300">Fasilitas Umum</h3>
                </div>
                @if (!empty($data['fasilitas_umum']) && count($data['fasilitas_umum']))
                    <ul class="space-y-3">
                        @foreach ($data['fasilitas_umum'] as $item)
                            <li class="flex items-center text-lg">
                                <svg class="w-5 h-5 text-blue-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-lg text-gray-300">Tidak ada fasilitas umum tersedia.</p>
                @endif
                @if (!empty($data['catatan']))
                    <div class="mt-6 p-4 bg-yellow-600 bg-opacity-30 rounded-lg border-l-4 border-yellow-500">
                        <p class="text-lg text-yellow-200">
                            <strong>Catatan:</strong> {{ $data['catatan'] }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>