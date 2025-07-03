@extends('layouts.app')

@section('content')
<div class="max-w-full overflow-hidden">
    <!-- Hero Section -->
    <section class="relative h-[400px] pt-[120px] flex items-center justify-center" data-aos="fade-down">
        <img src="{{ asset('images/' . $data['hero']) }}" alt="{{ $data['title'] }}"
            class="absolute top-0 left-0 z-0 object-cover w-full h-full">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="relative z-10 flex flex-col items-center justify-center w-full h-full px-4">
            <h1 class="text-4xl font-bold text-center text-white md:text-5xl lg:text-6xl jp-brush drop-shadow-2xl">
                {{ strtoupper($data['title']) }}
            </h1>
            <div class="w-24 h-1 mt-4 bg-green-500"></div>
        </div>
    </section>

    <!-- Denah Section -->
    <section class="px-4 py-16 text-center bg-gray-50" x-data="{ 
        showDenah: false,
        scale: 1,
        translateX: 0,
        translateY: 0,
        isDragging: false,
        startX: 0,
        startY: 0,
        openDenah() {
            this.showDenah = true;
            this.scale = 1;
            this.translateX = 0;
            this.translateY = 0;
            document.body.style.overflow = 'hidden';
        },
        closeDenah() {
            this.showDenah = false;
            this.scale = 1;
            this.translateX = 0;
            this.translateY = 0;
            document.body.style.overflow = 'auto';
        },
        zoomIn() {
            this.scale = Math.min(this.scale + 0.3, 3);
        },
        zoomOut() {
            this.scale = Math.max(this.scale - 0.3, 0.5);
        },
        resetZoom() {
            this.scale = 1;
            this.translateX = 0;
            this.translateY = 0;
        }
    }">
        <div class="max-w-4xl mx-auto">
            <h2 class="mb-4 text-4xl font-bold text-green-700 jp-brush" data-aos="fade-right">Denah Lokasi</h2>
            <p class="mb-8 text-lg text-gray-600 font-typewriter" data-aos="fade-left">
                Denah area {{ $data['title'] }} untuk memudahkan pengunjung memahami lokasi fasilitas yang tersedia.
            </p>
            <div class="flex justify-center">
                <div class="relative cursor-pointer group" @click="openDenah()">
                    <img src="{{ asset('images/' . $data['denah']) }}"
                        class="w-full max-w-3xl mx-auto transition-all duration-300 shadow-lg rounded-xl group-hover:shadow-2xl group-hover:scale-105"
                        alt="Denah {{ $data['title'] }}" data-aos="zoom-in">
                    <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black opacity-0 group-hover:opacity-100 bg-opacity-20 rounded-xl">
                        <span class="px-4 py-2 text-white bg-green-600 rounded-lg font-typewriter">Klik untuk memperbesar</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Modal Denah with Zoom -->
        <div x-show="showDenah" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click.self="closeDenah()"
             @keydown.escape.window="closeDenah()"
             class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-95" 
             style="display: none;">
            
            <!-- Control Buttons -->
            <div class="absolute top-4 left-4 right-4 flex justify-between items-center z-[100001]">
                <!-- Zoom Controls -->
                <div class="flex space-x-2">
                    <button @click="zoomIn()" 
                            class="p-3 text-white transition-colors bg-green-600 rounded-full hover:bg-green-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                    <button @click="zoomOut()" 
                            class="p-3 text-white transition-colors bg-green-600 rounded-full hover:bg-green-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                        </svg>
                    </button>
                    <button @click="resetZoom()" 
                            class="p-3 text-white transition-colors bg-blue-600 rounded-full hover:bg-blue-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Close Button -->
                <button @click="closeDenah()"
                        class="p-3 text-white transition-colors bg-red-600 rounded-full hover:bg-red-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Zoom Info -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-[100001]">
                <div class="px-4 py-2 text-white bg-black rounded-lg bg-opacity-60">
                    <span x-text="`Zoom: ${Math.round(scale * 100)}%`"></span>
                </div>
            </div>
            
            <!-- Image Container -->
            <div class="relative flex items-center justify-center w-full h-full p-4 overflow-hidden">
                <img src="{{ asset('images/' . $data['denah']) }}" 
                     alt="Denah {{ $data['title'] }}"
                     class="object-contain max-w-full max-h-full p-2 transition-transform duration-200 ease-out bg-white rounded-lg shadow-2xl select-none"
                     :style="`transform: scale(${scale}) translate(${translateX}px, ${translateY}px)`"
                     @wheel.prevent="$event.deltaY < 0 ? zoomIn() : zoomOut()"
                     @mousedown="isDragging = true; startX = $event.clientX - translateX; startY = $event.clientY - translateY"
                     @mousemove="if(isDragging && scale > 1) { translateX = $event.clientX - startX; translateY = $event.clientY - startY }"
                     @mouseup="isDragging = false"
                     @mouseleave="isDragging = false"
                     draggable="false" />
            </div>

            <!-- Instructions -->
            <div class="absolute bottom-4 right-4 z-[100001]">
                <div class="max-w-xs px-3 py-2 text-xs text-white bg-black rounded-lg bg-opacity-60">
                    <p>• Scroll mouse untuk zoom</p>
                    <p>• Drag untuk pindah posisi</p>
                    <p>• ESC untuk keluar</p>
                </div>
            </div>
        
        <!-- Modal Denah -->
        <div x-show="showDenah" x-transition @click.self="showDenah = false"
            class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-90" style="display: none;">
            <button @click="showDenah = false"
                class="absolute top-6 right-6 z-[100000] p-3 text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img src="{{ asset('images/' . $data['denah']) }}" alt="Denah {{ $data['title'] }}"
                class="max-h-[85vh] max-w-[85vw] object-contain rounded-lg shadow-2xl bg-white p-2" />
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="bg-[#0d2c25] text-white py-20 px-4 font-typewriter" data-aos="fade-up">
        <div class="max-w-6xl mx-auto">
            <h2 class="mb-12 text-4xl font-bold text-center jp-brush" data-aos="fade-down">Fasilitas Tersedia</h2>
            
            <!-- Kapasitas Card -->
            <div class="p-8 mb-12 bg-green-800 border border-green-600 bg-opacity-30 rounded-2xl" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <h3 class="mb-4 text-3xl font-bold text-green-300 jp-brush">Kapasitas</h3>
                    <p class="mb-4 text-xl">
                        {{ isset($data['kapasitas']) ? $data['kapasitas'] : '-' }}
                    </p>
                    @if (!empty($data['extra_charge']) && $data['extra_charge'] > 0)
                        <div class="inline-block px-4 py-2 bg-red-600 rounded-lg bg-opacity-80">
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
                        <div class="flex items-center justify-center w-12 h-12 mr-4 bg-green-600 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-green-300 jp-brush">Fasilitas Pribadi</h3>
                    </div>
                    @if (!empty($data['fasilitas_pribadi']) && count($data['fasilitas_pribadi']))
                        <ul class="space-y-3">
                            @foreach ($data['fasilitas_pribadi'] as $item)
                                <li class="flex items-center text-lg">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-green-400" fill="currentColor" viewBox="0 0 20 20">
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
                        <div class="flex items-center justify-center w-12 h-12 mr-4 bg-blue-600 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-300 jp-brush">Fasilitas Umum</h3>
                    </div>
                    @if (!empty($data['fasilitas_umum']) && count($data['fasilitas_umum']))
                        <ul class="space-y-3">
                            @foreach ($data['fasilitas_umum'] as $item)
                                <li class="flex items-center text-lg">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
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
                        <div class="p-4 mt-6 bg-yellow-600 border-l-4 border-yellow-500 rounded-lg bg-opacity-30">
                            <p class="text-lg text-yellow-200">
                                <strong>Catatan:</strong> {{ $data['catatan'] }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Harga Section -->
    <section class="px-4 py-16 bg-gradient-to-br from-gray-50 to-white font-typewriter" data-aos="fade-up">
        <div class="max-w-5xl mx-auto">
            <h2 class="mb-12 text-4xl font-bold text-center text-green-700 jp-brush">Daftar Harga</h2>
            <div class="grid gap-6 md:grid-cols-3">
                <!-- Hari Biasa -->
                <div class="p-8 transition-shadow bg-white border-2 border-gray-100 shadow-lg rounded-2xl hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Hari Biasa</h3>
                        <p class="text-2xl font-bold text-green-600">
                            {{ isset($data['harga_biasa']) && $data['harga_biasa'] !== '-' ? $data['harga_biasa'] : '-' }}
                        </p>
                        @if(isset($data['harga_biasa']) && $data['harga_biasa'] !== '-')
                            <p class="mt-1 text-sm text-gray-500">/deck/malam</p>
                        @endif
                    </div>
                </div>

                <!-- Hari Libur -->
                <div class="p-8 transition-shadow bg-white border-2 border-blue-100 shadow-lg rounded-2xl hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Hari Libur</h3>
                        <p class="text-2xl font-bold text-blue-600">
                            {{ isset($data['harga_libur']) && $data['harga_libur'] !== '-' ? $data['harga_libur'] : '-' }}
                        </p>
                        @if(isset($data['harga_libur']) && $data['harga_libur'] !== '-')
                            <p class="mt-1 text-sm text-gray-500">/deck/malam</p>
                        @endif
                    </div>
                </div>

                <!-- High Season -->
                <div class="p-8 transition-shadow bg-white border-2 border-red-100 shadow-lg rounded-2xl hover:shadow-xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800">High Season</h3>
                        <p class="text-2xl font-bold text-red-600">
                            {{ isset($data['harga_highseason']) && $data['harga_highseason'] !== '-' ? $data['harga_highseason'] : '-' }}
                        </p>
                        @if(isset($data['harga_highseason']) && $data['harga_highseason'] !== '-')
                            <p class="mt-1 text-sm text-gray-500">/deck/malam</p>
                        @endif
                    </div>
                </div>
            </div>
            
            @if (!empty($data['harga_catatan']))
                <div class="p-6 mt-8 border-l-4 border-yellow-400 bg-yellow-50 rounded-xl">
                    <p class="text-center text-gray-700">
                        <strong>Catatan:</strong> {{ $data['harga_catatan'] }}
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Galeri Section -->
    @if (!empty($data['galeri']) && count($data['galeri']))
        <section class="py-16 px-4 bg-[#0d2c25] font-typewriter" x-data="{ 
            showModal: false, 
            modalImg: '', 
            scale: 1,
            translateX: 0,
            translateY: 0,
            isDragging: false,
            startX: 0,
            startY: 0,
            openModal(img) {
                this.modalImg = img;
                this.showModal = true;
                this.scale = 1;
                this.translateX = 0;
                this.translateY = 0;
                document.body.style.overflow = 'hidden';
            },
            closeModal() {
                this.showModal = false;
                this.scale = 1;
                this.translateX = 0;
                this.translateY = 0;
                document.body.style.overflow = 'auto';
            },
            zoomIn() {
                this.scale = Math.min(this.scale + 0.3, 3);
            },
            zoomOut() {
                this.scale = Math.max(this.scale - 0.3, 0.5);
            },
            resetZoom() {
                this.scale = 1;
                this.translateX = 0;
                this.translateY = 0;
            }
        }">
            <div class="max-w-6xl mx-auto">
                <h2 class="mb-6 text-4xl font-bold text-center text-white jp-brush" data-aos="fade-down">Galeri Foto</h2>
                <p class="mb-12 text-lg text-center text-gray-300" data-aos="fade-up" data-aos-delay="100">
                    Nikmati momen tak terlupakan di {{ $data['title'] }} Riverside Camp.
                </p>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($data['galeri'] as $gambar)
                        <div class="relative overflow-hidden cursor-pointer group rounded-xl" 
                             data-aos="zoom-in" 
                             data-aos-delay="{{ 100 * $loop->index }}"
                             @click="openModal('{{ asset('images/' . $gambar) }}')">
                            <img src="{{ asset('images/' . $gambar) }}"
                                class="object-cover w-full h-64 transition-all duration-500 group-hover:scale-110"
                                alt="Galeri {{ $loop->iteration }}">
                            <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-0 group-hover:bg-opacity-40">
                                <div class="text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                    <p class="text-sm font-semibold text-white">Klik untuk memperbesar</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Enhanced Modal with Zoom -->
            <div x-show="showModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click.self="closeModal()"
                 @keydown.escape.window="closeModal()"
                 class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-95"
                 style="display: none;">
                
                <!-- Control Buttons -->
                <div class="absolute top-4 left-4 right-4 flex justify-between items-center z-[100001]">
                    <!-- Zoom Controls -->
                    <div class="flex space-x-2">
                        <button @click="zoomIn()" 
                                class="p-3 text-white transition-colors bg-green-600 rounded-full hover:bg-green-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                        <button @click="zoomOut()" 
                                class="p-3 text-white transition-colors bg-green-600 rounded-full hover:bg-green-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                            </svg>
                        </button>
                        <button @click="resetZoom()" 
                                class="p-3 text-white transition-colors bg-blue-600 rounded-full hover:bg-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Close Button -->
                    <button @click="closeModal()"
                            class="p-3 text-white transition-colors bg-red-600 rounded-full hover:bg-red-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Zoom Info -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-[100001]">
                    <div class="px-4 py-2 text-white bg-black rounded-lg bg-opacity-60">
                        <span x-text="`Zoom: ${Math.round(scale * 100)}%`"></span>
                    </div>
                </div>
                
                <!-- Image Container -->
                <div class="relative flex items-center justify-center w-full h-full p-4 overflow-hidden">
                    <img :src="modalImg" 
                         alt="Preview Galeri"
                         class="object-contain max-w-full max-h-full p-2 transition-transform duration-200 ease-out bg-white rounded-lg shadow-2xl select-none"
                         :style="`transform: scale(${scale}) translate(${translateX}px, ${translateY}px)`"
                         @wheel.prevent="$event.deltaY < 0 ? zoomIn() : zoomOut()"
                         @mousedown="isDragging = true; startX = $event.clientX - translateX; startY = $event.clientY - translateY"
                         @mousemove="if(isDragging && scale > 1) { translateX = $event.clientX - startX; translateY = $event.clientY - startY }"
                         @mouseup="isDragging = false"
                         @mouseleave="isDragging = false"
                         draggable="false" />
                </div>

                <!-- Instructions -->
                <div class="absolute bottom-4 right-4 z-[100001]">
                    <div class="max-w-xs px-3 py-2 text-xs text-white bg-black rounded-lg bg-opacity-60">
                        <p>• Scroll mouse untuk zoom</p>
                        <p>• Drag untuk pindah posisi</p>
                        <p>• ESC untuk keluar</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Reservasi Section -->
    <section class="relative" data-aos="fade-up">
        <img src="{{ asset('images/reservasi.jpg') }}" class="w-full h-[400px] object-cover" alt="Reservasi">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/30"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white">
            <h2 class="mb-6 text-5xl font-bold jp-brush">Siap untuk Reservasi?</h2>
            <p class="max-w-2xl mb-8 text-xl font-typewriter">
                Pesan sekarang untuk merasakan pengalaman camping yang tak terlupakan di pinggir sungai!
            </p>
            <a href="/reservasi"
                class="inline-flex items-center px-8 py-4 text-xl font-semibold text-white transition-all duration-300 transform rounded-full shadow-lg bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 hover:scale-105 font-typewriter">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Booking Sekarang
            </a>
        </div>
    </section>
</div>

<!-- Add custom styles for better interaction -->
<style>
    .modal-image {
        cursor: grab;
    }
    .modal-image:active {
        cursor: grabbing;
    }
    .modal-image.zoomed {
        cursor: move;
    }
</style>

@endsection