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
            <h2 class="mb-4 text-2xl font-bold tracking-widest sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl " style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 700;" data-aos="fade-down" data-aos-delay="200">
                Galeri Pineus Tilu
            </h2>
            <div class="w-16 h-1 mx-auto mb-4 bg-white rounded-full sm:w-20 md:w-24 md:mb-6" data-aos="fade-up" data-aos-delay="300"></div>
            <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg font-body text-green-100" data-aos="fade-up" data-aos-delay="400">
                Jelajahi keindahan alam dan fasilitas yang menawan di Pineus Tilu
            </p>
        </div>

        <!-- Enhanced Swiper Container -->
        @if(count($slides) > 0)
            <div class="relative" data-aos="zoom-in" data-aos-delay="500">
                <div class="swiper mySwiper !pb-12 md:!pb-16">
                    <div class="swiper-wrapper">
                        @foreach ($slides as $slide)
                            <div class="swiper-slide group">
                                <div class="relative overflow-hidden transition-all duration-500 transform bg-white shadow-2xl cursor-pointer rounded-xl sm:rounded-2xl hover:scale-105 hover:shadow-3xl group-hover:shadow-green-500/20"
                                     @click="openModal('{{ $slide['img'] }}', '{{ $slide['title'] }}')">
                                    
                                    <!-- Image Container -->
                                    <div class="relative overflow-hidden">
                                        {{-- Langsung gunakan URL dari database --}}
                                        <img src="{{ $slide['img'] }}" 
                                             alt="{{ $slide['title'] }}"
                                             class="object-cover w-full h-48 sm:h-56 md:h-64 lg:h-72 transition-transform duration-700 group-hover:scale-110"
                                             loading="lazy"
                                             onerror="this.src='{{ asset('images/logo.png') }}'; console.log('Error loading: {{ $slide['img'] }}');" />
                                        
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
                                        <h3 class="text-lg font-bold text-center transition-colors duration-300 sm:text-xl text-slate-800 group-hover:text-green-600 font-body">
                                            {{ $slide['title'] }}
                                        </h3>
                                        
                                        <!-- Decorative Line -->
                                        <div class="w-12 h-0.5 mx-auto mt-2 transition-all duration-300 bg-green-200 sm:w-16 sm:mt-3 group-hover:bg-green-500 group-hover:w-20 sm:group-hover:w-24"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Enhanced Navigation Buttons -->
                    <div class="swiper-button-prev custom-nav-btn">
                        <div class="nav-btn-content">
                            <svg class="nav-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="swiper-button-next custom-nav-btn">
                        <div class="nav-btn-content">
                            <svg class="nav-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Enhanced Pagination -->
                    <div class="swiper-pagination custom-pagination"></div>
                </div>
            </div>
        @else
            {{-- Tampilkan pesan jika tidak ada galeri di database --}}
            <div class="relative" data-aos="zoom-in" data-aos-delay="500">
                <div class="p-12 text-center bg-white bg-opacity-10 rounded-xl backdrop-blur-sm">
                    <svg class="w-16 h-16 mx-auto mb-4 text-white opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mb-2 text-xl font-bold">Galeri Segera Hadir</h3>
                    <p class="text-green-100">Foto-foto menarik dari Pineus Tilu akan segera ditampilkan di sini.</p>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- Styles tetap sama --}}
<style>
    /* Custom Navigation Buttons */
    .custom-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 48px !important;
        height: 48px !important;
        margin-top: 0 !important;
        z-index: 10;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .custom-nav-btn::after {
        display: none !important;
    }

    .custom-nav-btn:hover {
        background: rgba(255, 255, 255, 0.25) !important;
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .custom-nav-btn.swiper-button-disabled {
        opacity: 0.3;
        cursor: not-allowed;
        transform: translateY(-50%) scale(0.9);
    }

    .nav-btn-content {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .nav-btn-icon {
        width: 20px;
        height: 20px;
        color: white;
        transition: all 0.3s ease;
    }

    .custom-nav-btn:hover .nav-btn-icon {
        color: #ffffff;
        transform: scale(1.2);
    }

    /* Previous Button Position */
    .swiper-button-prev.custom-nav-btn {
        left: 16px;
    }

    /* Next Button Position */
    .swiper-button-next.custom-nav-btn {
        right: 16px;
    }

    /* Custom Pagination */
    .custom-pagination {
        bottom: 0 !important;
        text-align: center;
    }

    .custom-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.4);
        opacity: 1;
        margin: 0 6px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .custom-pagination .swiper-pagination-bullet-active {
        background: white;
        border-color: rgba(255, 255, 255, 0.6);
        transform: scale(1.2);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }

    /* Responsive Navigation */
    @media (max-width: 640px) {
        .custom-nav-btn {
            width: 40px !important;
            height: 40px !important;
        }
        
        .nav-btn-icon {
            width: 16px;
            height: 16px;
        }
        
        .swiper-button-prev.custom-nav-btn {
            left: 12px;
        }
        
        .swiper-button-next.custom-nav-btn {
            right: 12px;
        }
    }

    @media (min-width: 768px) {
        .custom-nav-btn {
            width: 56px !important;
            height: 56px !important;
        }
        
        .nav-btn-icon {
            width: 24px;
            height: 24px;
        }
        
        .swiper-button-prev.custom-nav-btn {
            left: 24px;
        }
        
        .swiper-button-next.custom-nav-btn {
            right: 24px;
        }
    }

    /* Hover Effects */
    .custom-nav-btn:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1)) !important;
    }

    .custom-nav-btn:active {
        transform: translateY(-50%) scale(0.95);
    }
</style>
