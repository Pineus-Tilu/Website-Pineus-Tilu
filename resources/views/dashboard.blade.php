@extends('layouts.app')

@section('content')
    <div class="max-w-full overflow-hidden">
        <!-- Hero Section - Mobile Responsive -->
        <section
            class="relative flex items-center justify-center min-h-screen px-4 py-20 text-white bg-center bg-cover bg-fixed pt-[64px] sm:pt-[80px] md:pt-[96px] lg:pt-[112px]"
            style="background-image: url('/images/dashboard.png');" data-aos="fade-in" data-aos-duration="1500">
            
            <!-- Enhanced Background Overlay -->
            <div class="absolute inset-0 z-0 bg-gradient-to-b from-black/40 via-black/60 to-black/70"></div>
            
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 z-0 overflow-hidden">
                <div class="absolute top-20 left-10 w-2 h-2 bg-white rounded-full animate-pulse opacity-70"></div>
                <div class="absolute top-40 right-20 w-1 h-1 bg-white rounded-full animate-pulse opacity-50 delay-1000"></div>
                <div class="absolute bottom-32 left-16 w-1.5 h-1.5 bg-white rounded-full animate-pulse opacity-60 delay-500"></div>
                <div class="absolute bottom-20 right-32 w-2 h-2 bg-white rounded-full animate-pulse opacity-40 delay-1500"></div>
            </div>

            <!-- Main Content -->
            <div class="relative z-10 max-w-5xl px-4 text-center">
                <!-- Main Title with Enhanced Typography -->
                <h1 class="mb-6 text-4xl font-bold tracking-wider sm:text-5xl md:text-7xl lg:text-8xl xl:text-9xl jp-brush text-white drop-shadow-2xl" 
                    data-aos="zoom-in" data-aos-delay="400">
                    PINEUS TILU
                </h1>

                <!-- Subtitle with Better Spacing -->
                <div class="mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="600">
                    <p class="max-w-3xl mx-auto text-base leading-relaxed sm:text-lg md:text-xl lg:text-2xl font-typewriter text-green-50 drop-shadow-lg">
                        adalah sebuah <span class="text-green-300 font-bold">Glamping</span> yang menjadi <span class="text-green-300 font-bold">Pelopor</span> atau <span class="text-green-300 font-bold">Pionir</span> di keindahan alam hutan pinus Rahong,
                        dengan pemandangan sungai Palayangan yang menjadi daya tarik khusus untuk aktivitas <span class="text-blue-300 font-bold">Rafting</span>
                        di Pangalengan, Kabupaten Bandung, Indonesia.
                    </p>
                </div>

                <!-- Enhanced CTA Button -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6" data-aos="zoom-in" data-aos-delay="800">
                    <a href="/reservasi"
                        class="group relative inline-flex items-center px-8 py-4 text-lg font-bold transition-all duration-500 transform rounded-2xl shadow-2xl sm:px-10 sm:py-5 sm:text-xl md:px-12 md:py-6 md:text-2xl bg-gradient-to-r from-[#006C43] via-green-600 to-[#006C43] hover:from-green-700 hover:via-green-800 hover:to-green-700 hover:scale-105 hover:shadow-green-500/25 font-typewriter overflow-hidden">
                        <!-- Button Background Animation -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        
                        <!-- Button Icon -->
                        <svg class="w-5 h-5 mr-3 sm:w-6 sm:h-6 md:w-7 md:h-7 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        
                        <span class="relative">Pesan Sekarang!</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Swiper Section - Mobile Responsive -->
        <section class="bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] py-12 px-4 md:py-20 md:px-8 text-white relative overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-16 h-16 sm:w-24 sm:h-24 md:w-32 md:h-32 rounded-full bg-white animate-pulse"></div>
                <div class="absolute bottom-10 right-10 w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24 rounded-full bg-white animate-pulse delay-1000"></div>
                <div class="absolute top-1/2 left-1/3 w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 rounded-full bg-white animate-pulse delay-500"></div>
            </div>

            <div class="relative z-10 mx-auto text-center max-w-7xl">
                <!-- Section Header -->
                <div class="mb-10 md:mb-16">
                    <h2 class="mb-4 text-2xl font-bold tracking-widest sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl jp-brush" data-aos="fade-down" data-aos-delay="200">
                        Galeri Pineus Tilu
                    </h2>
                    <div class="w-16 h-1 mx-auto mb-4 bg-white rounded-full sm:w-20 md:w-24 md:mb-6" data-aos="fade-up" data-aos-delay="300"></div>
                    <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg font-typewriter text-green-100" data-aos="fade-up" data-aos-delay="400">
                        Jelajahi keindahan alam dan fasilitas yang menawan di Pineus Tilu
                    </p>
                </div>

                <!-- Enhanced Swiper Container -->
                <div class="relative" data-aos="zoom-in" data-aos-delay="500">
                    <div class="swiper mySwiper !pb-12 md:!pb-16">
                        <div class="swiper-wrapper">
                            @foreach ($slides as $slide)
                                <div class="swiper-slide group">
                                    <div class="relative overflow-hidden transition-all duration-500 transform bg-white shadow-2xl cursor-pointer rounded-xl sm:rounded-2xl hover:scale-105 hover:shadow-3xl group-hover:shadow-green-500/20"
                                         onclick="openImageModal('{{ asset('images/' . $slide['img']) }}', '{{ $slide['title'] }}')">
                                        
                                        <!-- Image Container -->
                                        <div class="relative overflow-hidden">
                                            <img src="{{ asset('images/' . $slide['img']) }}" 
                                                 alt="{{ $slide['title'] }}"
                                                 class="object-cover w-full h-48 sm:h-56 md:h-64 lg:h-72 transition-transform duration-700 group-hover:scale-110" />
                                            
                                            <!-- Overlay on Hover -->
                                            <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent group-hover:opacity-100">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="p-2 transition-transform duration-300 transform bg-white rounded-full shadow-lg sm:p-3 group-hover:scale-110">
                                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Corner Badge -->
                                            <div class="absolute top-2 right-2 sm:top-4 sm:right-4">
                                                <div class="px-2 py-1 text-xs font-bold text-white bg-green-600 rounded-full shadow-lg sm:px-3 backdrop-blur-sm bg-opacity-90">
                                                    Klik untuk Melihat
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content Section -->
                                        <div class="p-4 sm:p-6">
                                            <h3 class="text-lg font-bold text-center transition-colors duration-300 sm:text-xl text-slate-800 group-hover:text-green-600 font-typewriter">
                                                {{ $slide['title'] }}
                                            </h3>
                                            
                                            <!-- Decorative Line -->
                                            <div class="w-12 h-0.5 mx-auto mt-2 transition-all duration-300 bg-green-200 sm:w-16 sm:mt-3 group-hover:bg-green-500 group-hover:w-20 sm:group-hover:w-24"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Enhanced Navigation -->
                        <div class="swiper-button-prev !w-10 !h-10 sm:!w-12 sm:!h-12 md:!w-14 md:!h-14 !mt-0 !top-1/2 !-translate-y-1/2 !left-2 sm:!left-4 !bg-white/20 !backdrop-blur-sm !rounded-full !border-2 !border-white/30 hover:!bg-white/30 transition-all duration-300">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="swiper-button-next !w-10 !h-10 sm:!w-12 sm:!h-12 md:!w-14 md:!h-14 !mt-0 !top-1/2 !-translate-y-1/2 !right-2 sm:!right-4 !bg-white/20 !backdrop-blur-sm !rounded-full !border-2 !border-white/30 hover:!bg-white/30 transition-all duration-300">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>

                        <!-- Enhanced Pagination -->
                        <div class="swiper-pagination !bottom-0"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Preview Gambar untuk Swiper (FULLSCREEN, DILUAR semua section) -->
        <div id="imageModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black bg-opacity-95 p-2 sm:p-4 backdrop-blur-sm">
            <!-- Tombol Close -->
            <button onclick="closeImageModal()"
                class="absolute top-4 right-4 sm:top-6 sm:right-6 z-[10000] p-3 sm:p-4 text-white bg-black/50 backdrop-blur-sm rounded-full hover:bg-black/70 transition-all duration-300 text-xl sm:text-2xl leading-none w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 flex items-center justify-center group">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Konten Modal -->
            <div class="relative flex items-center justify-center w-full h-full">
                <div class="relative max-w-[90vw] max-h-[90vh] flex flex-col items-center">
                    <!-- Image Container -->
                    <div class="relative mb-6 sm:mb-8">
                        <img id="modalImage" src="" alt=""
                            class="max-h-[60vh] sm:max-h-[70vh] max-w-[90vw] object-contain rounded-lg sm:rounded-2xl shadow-2xl ring-2 sm:ring-4 ring-white/20"
                            style="transform: scale(1); transform-origin: center center;" />
                    </div>
                    
                    <!-- Title Container - Moved lower to avoid overlap -->
                    <div class="px-4 sm:px-8 py-3 sm:py-4 bg-black/70 backdrop-blur-sm rounded-xl sm:rounded-2xl border border-white/20 max-w-[90vw]">
                        <h3 id="modalTitle" class="text-lg sm:text-xl md:text-2xl font-bold text-white text-center font-typewriter leading-tight"></h3>
                    </div>
                </div>
            </div>

            <!-- Tombol Zoom untuk Image Modal - Positioned higher to avoid title overlap -->
            <div class="fixed z-[10000] left-1/2 bottom-16 sm:bottom-20 -translate-x-1/2">
                <div class="flex px-4 py-2 sm:px-6 sm:py-3 space-x-3 sm:space-x-4 rounded-xl sm:rounded-2xl shadow-lg bg-white/10 backdrop-blur-sm border border-white/20">
                    <button onclick="zoomImageIn()" class="px-3 py-2 sm:px-4 sm:py-2 text-white bg-white/20 rounded-lg sm:rounded-xl shadow hover:bg-white/30 font-bold text-base sm:text-lg transition-all duration-300 min-w-[40px]">+</button>
                    <button onclick="zoomImageOut()" class="px-3 py-2 sm:px-4 sm:py-2 text-white bg-white/20 rounded-lg sm:rounded-xl shadow hover:bg-white/30 font-bold text-base sm:text-lg transition-all duration-300 min-w-[40px]">−</button>
                    <button onclick="resetImageZoom()" class="px-3 py-2 sm:px-4 sm:py-2 text-white bg-white/20 rounded-lg sm:rounded-xl shadow hover:bg-white/30 font-bold text-base sm:text-lg transition-all duration-300 min-w-[40px]">⟳</button>
                </div>
            </div>
        </div>

        <!-- Awal Mula Pineus Tilu - Mobile Responsive -->
        <section class="relative py-12 md:py-20 bg-gradient-to-br from-gray-50 to-green-50 overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
            <!-- Background Decorations -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-20 left-10 w-32 h-32 sm:w-48 sm:h-48 md:w-64 md:h-64 rounded-full bg-green-300 animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 sm:w-36 sm:h-36 md:w-48 md:h-48 rounded-full bg-green-400 animate-pulse delay-1000"></div>
            </div>

            <div class="container relative z-10 max-w-6xl px-4 mx-auto">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold text-green-800 sm:text-4xl md:text-5xl jp-brush" data-aos="fade-down" data-aos-delay="200">
                        Awal Mula Pineus Tilu
                    </h2>
                    <div class="w-20 h-1 mx-auto mb-6 bg-gradient-to-r from-green-500 to-green-700 rounded-full sm:w-24 md:w-32 md:mb-8" data-aos="fade-up" data-aos-delay="300"></div>
                    <p class="text-lg text-gray-600 font-typewriter max-w-3xl mx-auto sm:text-xl" data-aos="fade-up" data-aos-delay="400">
                        Sebuah perjalanan dari pencarian pengalaman baru menuju penciptaan surga alam
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">
                    <!-- Story Content -->
                    <div class="space-y-4 md:space-y-6" data-aos="fade-right" data-aos-delay="500">
                        <div class="bg-white rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg border border-green-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-3 md:space-x-4 mb-4 md:mb-6">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 font-typewriter">Mei 2020</h3>
                                    <p class="text-gray-600 leading-relaxed font-typewriter text-sm md:text-base">
                                        Pada masa awal pandemi, saya dan keluarga praktis tak pernah keluar rumah. Namun di akhir Agustus, karena bosan, kami nekat jalan-jalan ke daerah sepi—gunung dan hutan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg border border-green-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-3 md:space-x-4 mb-4 md:mb-6">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 718.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 font-typewriter">Malam Pertama</h3>
                                    <p class="text-gray-600 leading-relaxed font-typewriter text-sm md:text-base">
                                        Setelah menjelajah Ciwidey dan Pangalengan, kami bingung mencari penginapan. Akhirnya, kami ditawari menginap di tepi Sungai Palayangan dengan tenda Arpenaz Family 4.0.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl md:rounded-2xl p-6 md:p-8 text-white shadow-lg hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-3 md:space-x-4">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl md:text-2xl font-bold mb-2 font-typewriter">Pagi yang Menginspirasi</h3>
                                    <p class="leading-relaxed font-typewriter text-sm md:text-base">
                                        Pengalaman tidur di tengah hutan dengan suara sungai yang menenangkan ternyata luar biasa. Pemandangan sinar matahari di antara pepohonan pinus sangat indah dan menyentuh.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Content -->
                    <div class="space-y-4 md:space-y-6" data-aos="fade-left" data-aos-delay="600">
                        <div class="bg-white rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg border border-green-100">
                            <blockquote class="text-xl md:text-2xl font-bold text-gray-800 mb-4 md:mb-6 italic font-typewriter text-center">
                                "Andai punya tempat sendiri di sini..."
                            </blockquote>
                            <p class="text-gray-600 leading-relaxed font-typewriter mb-4 md:mb-6 text-sm md:text-base">
                                Dari situlah lahir <span class="font-bold text-green-600">PINEUS TILU Riverside Camping Ground</span>—tempat yang menawarkan pengalaman ruang yang menenangkan, visual alami yang indah, dan suasana privat dengan tiga pohon pinus ikonik yang menjorok ke sungai.
                            </p>
                            <div class="bg-green-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-green-500">
                                <p class="text-green-800 font-semibold font-typewriter text-sm md:text-base">
                                    Feel the awesome space, feel the incredible experience.
                                </p>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="bg-white rounded-lg md:rounded-xl p-4 md:p-6 text-center shadow-lg border border-green-100">
                                <div class="text-2xl md:text-3xl font-bold text-green-600 mb-1 md:mb-2 font-typewriter">7</div>
                                <div class="text-gray-600 font-typewriter text-sm md:text-base">Deck Kayu</div>
                            </div>
                            <div class="bg-white rounded-lg md:rounded-xl p-4 md:p-6 text-center shadow-lg border border-green-100">
                                <div class="text-2xl md:text-3xl font-bold text-green-600 mb-1 md:mb-2 font-typewriter">9</div>
                                <div class="text-gray-600 font-typewriter text-sm md:text-base">Tenda</div>
                            </div>
                        </div>

                        <!-- Signature -->
                        <div class="bg-gray-800 rounded-xl md:rounded-2xl p-6 md:p-8 text-white shadow-lg">
                            <div class="text-right">
                                <p class="font-bold mb-2 font-typewriter text-sm md:text-base">Bandung, 24 Juni 2021</p>
                                <p class="text-gray-300 font-typewriter text-sm md:text-base">BSBarchitect</p>
                                <p class="text-green-400 font-bold font-typewriter text-sm md:text-base">PINEUS TILU Riverside Camping Ground</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Denah Pineus Tilu - Mobile Responsive -->
        <section class="relative py-12 md:py-20 bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] overflow-hidden" data-aos="zoom-in-up" data-aos-duration="1000">
            <!-- Background Elements -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-1/4 left-1/4 w-48 h-48 sm:w-64 sm:h-64 md:w-96 md:h-96 rounded-full bg-white animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-32 h-32 sm:w-48 sm:h-48 md:w-64 md:h-64 rounded-full bg-white animate-pulse delay-1000"></div>
            </div>

            <div class="container relative z-10 px-4 mx-auto text-center text-white max-w-6xl">
                <!-- Header -->
                <div class="mb-12 md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold sm:text-4xl md:text-5xl jp-brush md:mb-6" data-aos="fade-down" data-aos-delay="200">
                        Denah Pineus Tilu
                    </h2>
                    <div class="w-20 h-1 mx-auto mb-6 bg-white rounded-full sm:w-24 md:w-32 md:mb-8" data-aos="fade-up" data-aos-delay="300"></div>
                    <p class="text-lg text-green-100 font-typewriter max-w-3xl mx-auto sm:text-xl" data-aos="fade-up" data-aos-delay="400">
                        Eksplorasi layout lengkap area camping dan fasilitas yang tersedia di Pineus Tilu
                    </p>
                </div>

                <!-- Denah Container -->
                <div class="max-w-4xl mx-auto" data-aos="zoom-in" data-aos-delay="500">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-400/20 to-blue-400/20 rounded-2xl md:rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-300"></div>
                        <div class="relative bg-white/10 backdrop-blur-sm rounded-2xl md:rounded-3xl p-4 md:p-8 border border-white/20 hover:border-white/40 transition-all duration-300">
                            <!-- Preview Image -->
                            <div class="relative overflow-hidden rounded-lg md:rounded-2xl mb-4 md:mb-6 group cursor-pointer" onclick="openDenahModal()">
                                <img src="{{ asset('images/galeri/denah/denah.jpeg') }}" alt="Denah Pineus Tilu"
                                    class="w-full h-auto transition-transform duration-500 group-hover:scale-105 rounded-lg md:rounded-2xl shadow-2xl" />
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg md:rounded-2xl flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="w-12 h-12 md:w-16 md:h-16 bg-white rounded-full flex items-center justify-center mb-3 md:mb-4 mx-auto">
                                            <svg class="w-6 h-6 md:w-8 md:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                            </svg>
                                        </div>
                                        <p class="text-white font-bold text-base md:text-lg font-typewriter">Klik untuk Zoom</p>
                                    </div>
                                </div>

                                <!-- Corner Badge -->
                                <div class="absolute top-2 right-2 md:top-4 md:right-4 bg-green-500 text-white px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-bold shadow-lg">
                                    📍 Layout Site
                                </div>
                            </div>

                            <!-- Features Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 mb-4 md:mb-6">
                                <div class="bg-white/10 rounded-lg md:rounded-xl p-3 md:p-4 text-center backdrop-blur-sm border border-white/20">
                                    <div class="text-lg md:text-2xl mb-1 md:mb-2">🏕️</div>
                                    <div class="text-xs md:text-sm font-bold font-typewriter">Area Camping</div>
                                </div>
                                <div class="bg-white/10 rounded-lg md:rounded-xl p-3 md:p-4 text-center backdrop-blur-sm border border-white/20">
                                    <div class="text-lg md:text-2xl mb-1 md:mb-2">🌊</div>
                                    <div class="text-xs md:text-sm font-bold font-typewriter">Sungai Palayangan</div>
                                </div>
                                <div class="bg-white/10 rounded-lg md:rounded-xl p-3 md:p-4 text-center backdrop-blur-sm border border-white/20">
                                    <div class="text-lg md:text-2xl mb-1 md:mb-2">🌲</div>
                                    <div class="text-xs md:text-sm font-bold font-typewriter">Hutan Pinus</div>
                                </div>
                                <div class="bg-white/10 rounded-lg md:rounded-xl p-3 md:p-4 text-center backdrop-blur-sm border border-white/20">
                                    <div class="text-lg md:text-2xl mb-1 md:mb-2">🚻</div>
                                    <div class="text-xs md:text-sm font-bold font-typewriter">Fasilitas Umum</div>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <button onclick="openDenahModal()" 
                                class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white text-green-600 rounded-lg md:rounded-xl font-bold text-base md:text-lg shadow-lg hover:bg-gray-50 hover:scale-105 transition-all duration-300 font-typewriter">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                                Lihat Denah Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal untuk Denah (FULLSCREEN, DILUAR semua section) -->
        <div id="denahModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black bg-opacity-95 p-2 sm:p-4 backdrop-blur-sm">
            <!-- Tombol Close -->
            <button onclick="closeDenahModal()"
                class="absolute top-4 right-4 sm:top-6 sm:right-6 z-[10000] p-3 sm:p-4 text-white bg-black/50 backdrop-blur-sm rounded-full hover:bg-black/70 transition-all duration-300 text-xl sm:text-2xl leading-none w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 flex items-center justify-center group">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Gambar Zoom (fullscreen center) -->
            <img id="denahImage" src="{{ asset('images/galeri/denah/denah.jpeg') }}" alt="Denah Pineus Tilu"
                class="max-h-[75vh] sm:max-h-[85vh] max-w-[85vw] object-contain transition-transform duration-300 ease-in-out rounded-lg sm:rounded-2xl shadow-2xl ring-2 sm:ring-4 ring-white/20"
                style="transform: scale(1); transform-origin: center center;" />
            
            <!-- Tombol Zoom -->
            <div class="fixed z-[10000] left-1/2 bottom-4 sm:bottom-8 -translate-x-1/2">
                <div class="flex px-4 py-2 sm:px-6 sm:py-4 space-x-2 sm:space-x-4 rounded-xl sm:rounded-2xl shadow-lg bg-white/10 backdrop-blur-sm border border-white/20">
                    <button onclick="zoomIn()" class="px-3 py-1 sm:px-4 sm:py-2 text-white bg-white/20 rounded-lg sm:rounded-xl shadow hover:bg-white/30 font-bold text-base sm:text-lg transition-all duration-300">+</button>
                    <button onclick="zoomOut()" class="px-3 py-1 sm:px-4 sm:py-2 text-white bg-white/20 rounded-lg sm:rounded-xl shadow hover:bg-white/30 font-bold text-base sm:text-lg transition-all duration-300">−</button>
                    <button onclick="resetZoom()" class="px-3 py-1 sm:px-4 sm:py-2 text-white bg-white/20 rounded-lg sm:rounded-xl shadow hover:bg-white/30 font-bold text-base sm:text-lg transition-all duration-300">⟳</button>
                </div>
            </div>
        </div>

        <!-- Location Section - Mobile Responsive -->
        <section class="relative py-12 md:py-20 bg-gradient-to-br from-gray-50 to-green-50 overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
            <!-- Background Decorations -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-1/4 right-1/4 w-36 h-36 sm:w-48 sm:h-48 md:w-72 md:h-72 rounded-full bg-green-300 animate-pulse"></div>
                <div class="absolute bottom-1/4 left-1/4 w-24 h-24 sm:w-32 sm:h-32 md:w-48 md:h-48 rounded-full bg-green-400 animate-pulse delay-1000"></div>
            </div>

            <div class="container relative z-10 px-4 mx-auto max-w-6xl">
                <!-- Header -->
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold text-green-800 sm:text-4xl md:text-5xl jp-brush md:mb-6" data-aos="fade-down" data-aos-delay="200">
                        📍 Lokasi Kami
                    </h2>
                    <div class="w-20 h-1 mx-auto mb-6 bg-gradient-to-r from-green-500 to-green-700 rounded-full sm:w-24 md:w-32 md:mb-8" data-aos="fade-up" data-aos-delay="300"></div>
                    <p class="text-lg text-gray-600 font-typewriter max-w-3xl mx-auto sm:text-xl" data-aos="fade-up" data-aos-delay="400">
                        Temukan kami di jantung keindahan alam Pangalengan, Kabupaten Bandung
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">
                    <!-- Location Info -->
                    <div class="space-y-6 md:space-y-8" data-aos="fade-right" data-aos-delay="500">
                        <!-- Address Card -->
                        <div class="bg-white rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg border border-green-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-3 md:space-x-4">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-3 font-typewriter">Alamat Lengkap</h3>
                                    <p class="text-gray-600 leading-relaxed font-typewriter text-base md:text-lg">
                                        Pulosari, Kec. Pangalengan, Kabupaten Bandung, Jawa Barat 40378
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg md:rounded-xl p-4 md:p-6 text-white text-center shadow-lg">
                                <div class="text-2xl md:text-3xl mb-1 md:mb-2">🏔️</div>
                                <div class="font-bold font-typewriter text-sm md:text-base">Pemandangan Pegunungan</div>
                            </div>
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg md:rounded-xl p-4 md:p-6 text-white text-center shadow-lg">
                                <div class="text-2xl md:text-3xl mb-1 md:mb-2">🌊</div>
                                <div class="font-bold font-typewriter text-sm md:text-base">Sungai Palayangan</div>
                            </div>
                            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg md:rounded-xl p-4 md:p-6 text-white text-center shadow-lg">
                                <div class="text-2xl md:text-3xl mb-1 md:mb-2">🌲</div>
                                <div class="font-bold font-typewriter text-sm md:text-base">Hutan Pinus Rahong</div>
                            </div>
                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg md:rounded-xl p-4 md:p-6 text-white text-center shadow-lg">
                                <div class="text-2xl md:text-3xl mb-1 md:mb-2">🚣</div>
                                <div class="font-bold font-typewriter text-sm md:text-base">Aktivitas Rafting</div>
                            </div>
                        </div>

                        <!-- Direction Button -->
                        <div class="text-center">
                            <a href="https://maps.google.com/?q=Pineus+Tilu" target="_blank" 
                               class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-green-600 text-white rounded-lg md:rounded-xl font-bold text-base md:text-lg shadow-lg hover:bg-green-700 hover:scale-105 transition-all duration-300 font-typewriter">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                Petunjuk Arah
                            </a>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="relative" data-aos="fade-left" data-aos-delay="600">
                        <div class="relative bg-white rounded-xl md:rounded-2xl p-2 shadow-lg border border-green-100">
                            <div class="relative overflow-hidden rounded-lg md:rounded-xl aspect-video group">
                                <iframe src="https://maps.google.com/maps?q=Pineus%20Tilu&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                    class="w-full h-full border-0 rounded-lg md:rounded-xl transition-transform duration-300 group-hover:scale-105" 
                                    title="Pineus Tilu Location Map"></iframe>
                                
                                <!-- Map Overlay -->
                                <div class="absolute inset-0 bg-black/0 hover:bg-black/10 transition-colors duration-300 rounded-lg md:rounded-xl flex items-center justify-center opacity-0 hover:opacity-100">
                                    <div class="bg-white/90 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <p class="text-gray-800 font-bold font-typewriter text-sm md:text-base">📍 Pineus Tilu</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map Badge -->
                        <div class="absolute -top-2 -right-2 md:-top-4 md:-right-4 bg-green-500 text-white px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-bold shadow-lg">
                            🗺️ Interactive Map
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Custom CSS untuk Swiper -->
    <style>
        /* Custom Swiper Pagination */
        .swiper-pagination-bullet {
            width: 8px !important;
            height: 8px !important;
            background: rgba(255, 255, 255, 0.5) !important;
            opacity: 1 !important;
            transition: all 0.3s ease !important;
        }

        @media (min-width: 640px) {
            .swiper-pagination-bullet {
                width: 10px !important;
                height: 10px !important;
            }
        }

        @media (min-width: 768px) {
            .swiper-pagination-bullet {
                width: 12px !important;
                height: 12px !important;
            }
        }
        
        .swiper-pagination-bullet-active {
            background: white !important;
            transform: scale(1.2) !important;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5) !important;
        }

        /* Remove default button content */
        .swiper-button-next:after,
        .swiper-button-prev:after {
            content: '' !important;
        }

        /* Custom hover effects */
        .swiper-slide {
            transition: all 0.3s ease;
        }

        /* Background animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Mobile improvements */
        @media (max-width: 767px) {
            .swiper-container {
                padding: 0 10px;
            }
            
            .swiper-slide {
                padding: 0 5px;
            }
        }
    </style>

    <!-- JavaScript untuk Modal Gambar -->
    <script>
        let currentScale = 1;
        let currentImageScale = 1;

        // Modal untuk Swiper dengan fungsi zoom
        function openImageModal(imageSrc, imageTitle) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            
            modalImage.src = imageSrc;
            modalImage.alt = imageTitle;
            modalTitle.textContent = imageTitle;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            // Reset zoom untuk image modal
            currentImageScale = 1;
            updateImageZoom();
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            currentImageScale = 1;
        }

        // Fungsi zoom untuk Image Modal
        function zoomImageIn() {
            currentImageScale += 0.2;
            updateImageZoom();
        }

        function zoomImageOut() {
            currentImageScale = Math.max(0.2, currentImageScale - 0.2);
            updateImageZoom();
        }

        function resetImageZoom() {
            currentImageScale = 1;
            updateImageZoom();
        }

        function updateImageZoom() {
            const modalImage = document.getElementById('modalImage');
            modalImage.style.transform = `scale(${currentImageScale})`;
        }

        // Modal untuk Denah
        function openDenahModal() {
            const modal = document.getElementById('denahModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            currentScale = 1;
            updateDenahZoom();
        }

        function closeDenahModal() {
            const modal = document.getElementById('denahModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            currentScale = 1;
        }

        function zoomIn() {
            currentScale += 0.1;
            updateDenahZoom();
        }

        function zoomOut() {
            currentScale = Math.max(0.1, currentScale - 0.1);
            updateDenahZoom();
        }

        function resetZoom() {
            currentScale = 1;
            updateDenahZoom();
        }

        function updateDenahZoom() {
            const denahImage = document.getElementById('denahImage');
            denahImage.style.transform = `scale(${currentScale})`;
        }

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
                closeDenahModal();
            }
        });

        // Close modal dengan click outside untuk Swiper
        document.getElementById('imageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeImageModal();
            }
        });

        // Close modal dengan click outside untuk Denah
        document.getElementById('denahModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeDenahModal();
            }
        });

        // Touch handling untuk mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function(event) {
            touchStartX = event.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function(event) {
            touchEndX = event.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                // Swipe left - could be used for navigation
            }
            if (touchEndX > touchStartX + 50) {
                // Swipe right - could be used for navigation
            }
        }
    </script>
@endsection