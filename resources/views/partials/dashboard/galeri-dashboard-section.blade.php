<!-- Swiper Section - Mobile Responsive -->
<section class="bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] py-12 px-4 md:py-20 md:px-8 text-white relative overflow-hidden" 
         data-aos="fade-up" 
         data-aos-duration="1000">
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
                                 @click="openModal('{{ asset('images/' . $slide['img']) }}', '{{ $slide['title'] }}')">
                                
                                <!-- Image Container -->
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset('images/' . $slide['img']) }}" 
                                         alt="{{ $slide['title'] }}"
                                         class="object-cover w-full h-48 sm:h-56 md:h-64 lg:h-72 transition-transform duration-700 group-hover:scale-110"
                                         loading="lazy" />
                                    
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