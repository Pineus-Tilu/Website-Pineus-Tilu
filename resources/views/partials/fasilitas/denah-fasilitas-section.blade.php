<!-- Denah Section -->
<section class="py-16 px-4 text-center bg-gray-50" x-data="{ 
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
        <h2 class="mb-4 text-4xl font-bold text-green-700 " style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 700;" data-aos="fade-right">Denah Lokasi</h2>
        <p class="mb-8 text-lg text-gray-600 font-body" data-aos="fade-left">
            Denah area {{ $data['title'] }} untuk memudahkan pengunjung memahami lokasi fasilitas yang tersedia.
        </p>
        
        <div class="flex justify-center">
            <div class="relative group cursor-pointer" @click="openDenah()">
                <img src="{{ $data['denah'] }}"
                    class="w-full max-w-3xl mx-auto transition-all duration-300 rounded-xl shadow-lg group-hover:shadow-2xl group-hover:scale-105"
                    alt="Denah {{ $data['title'] }}" 
                    data-aos="zoom-in">
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-20 rounded-xl">
                    <span class="px-4 py-2 text-white bg-green-600 rounded-lg font-body">Klik untuk memperbesar</span>
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
                        class="p-3 text-white bg-green-600 rounded-full hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <button @click="zoomOut()" 
                        class="p-3 text-white bg-green-600 rounded-full hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                    </svg>
                </button>
                <button @click="resetZoom()" 
                        class="p-3 text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Close Button -->
            <button @click="closeDenah()"
                    class="p-3 text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Zoom Info -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-[100001]">
            <div class="bg-black bg-opacity-60 text-white px-4 py-2 rounded-lg">
                <span x-text="`Zoom: ${Math.round(scale * 100)}%`"></span>
            </div>
        </div>
        
        <!-- Image Container -->
        <div class="relative w-full h-full flex items-center justify-center p-4 overflow-hidden">
            <img src="{{ $data['denah'] }}" 
                 alt="Denah {{ $data['title'] }}"
                 class="max-h-full max-w-full object-contain rounded-lg shadow-2xl bg-white p-2 transition-transform duration-200 ease-out select-none"
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
            <div class="bg-black bg-opacity-60 text-white text-xs px-3 py-2 rounded-lg max-w-xs">
                <p>• Scroll mouse untuk zoom</p>
                <p>• Drag untuk pindah posisi</p>
                <p>• ESC untuk keluar</p>
            </div>
        </div>
    </div>
</section>
