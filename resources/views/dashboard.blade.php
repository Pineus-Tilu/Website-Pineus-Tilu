@extends('layouts.app')

@section('title', 'Dashboard - Pineus Tilu')

@section('content')
<div class="max-w-full overflow-hidden" x-data="{ 
    showModal: false, 
    modalImg: '', 
    modalTitle: '',
    showDenah: false,
    showMapModal: false,
    scale: 1,
    translateX: 0,
    translateY: 0,
    isDragging: false,
    startX: 0,
    startY: 0,
    openModal(img, title) {
        this.modalImg = img;
        this.modalTitle = title;
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
    openMapModal() {
        this.showMapModal = true;
        document.body.style.overflow = 'hidden';
    },
    closeMapModal() {
        this.showMapModal = false;
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
}" @open-modal.window="openModal($event.detail.img, $event.detail.title)" @open-denah.window="openDenah()">
    @include('partials.dashboard.hero-dashboard-section')
    @include('partials.dashboard.galeri-dashboard-section', ['slides' => $slides])
    @include('partials.dashboard.story-dashboard-section')
    @include('partials.dashboard.denah-dashboard-section')
    @include('partials.dashboard.lokasi-dashboard-section')

    <!-- Modal Galeri -->
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
                 :alt="modalTitle"
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

    <!-- Modal Denah -->
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
            <img src="{{ asset('images/galeri/denah/denah.jpeg') }}" 
                 alt="Denah Pineus Tilu"
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

    <!-- Full Screen Map Modal -->
    <div x-show="showMapModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="closeMapModal()"
         @keydown.escape.window="closeMapModal()"
         class="fixed inset-0 z-[99999] bg-black bg-opacity-90 flex items-center justify-center p-4"
         style="display: none;">
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-7xl h-full max-h-[90vh] bg-white rounded-xl md:rounded-2xl overflow-hidden shadow-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 text-white md:p-6 bg-gradient-to-r from-green-600 to-blue-600">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold md:text-2xl font-typewriter">Peta Lokasi Pineus Tilu</h3>
                        <p class="text-sm md:text-base opacity-90">Pulosari, Pangalengan, Kabupaten Bandung</p>
                    </div>
                </div>
                
                <button @click="closeMapModal()"
                        class="flex items-center justify-center w-8 h-8 transition-colors rounded-full bg-white/20 hover:bg-white/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Interactive Map -->
            <div class="relative h-full">
                <iframe src="https://maps.google.com/maps?q=Pineus%20Tilu&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-full border-0" 
                    title="Pineus Tilu Interactive Map"
                    loading="lazy"></iframe>
                
                <!-- Map Controls Info -->
                <div class="absolute px-3 py-2 text-xs text-white rounded-lg bottom-4 left-4 bg-black/70 md:text-sm">
                    <p>💡 Gunakan mouse untuk zoom dan drag peta</p>
                </div>
            </div>

            <!-- Action Buttons - Bottom of Modal -->
            <div class="absolute flex space-x-3 bottom-4 right-4">
                <a href="https://maps.google.com/?q=Pineus+Tilu" target="_blank" 
                   class="inline-flex items-center px-4 py-2 text-sm font-bold text-white transition-colors bg-green-600 rounded-lg shadow-lg hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    Petunjuk Arah
                </a>
                <a href="https://maps.google.com/?q=Pineus+Tilu" target="_blank" 
                   class="inline-flex items-center px-4 py-2 text-sm font-bold text-white transition-colors bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Buka di Maps
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
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

    /* Modal styles */
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