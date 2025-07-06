<!-- Galeri Section -->
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
        
        {{-- HANDLE JIKA ADA GALERI --}}
        @if(isset($data['galeri']) && count($data['galeri']) > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($data['galeri'] as $gambar)
                    <div class="relative group overflow-hidden rounded-xl cursor-pointer" 
                         data-aos="zoom-in" 
                         data-aos-delay="{{ 100 * $loop->index }}"
                         @click="openModal('{{ $gambar }}')">
                        
                        <img src="{{ $gambar }}"
                            class="object-cover w-full h-64 transition-all duration-500 group-hover:scale-110"
                            alt="Galeri {{ $data['title'] }} {{ $loop->iteration }}"
                            loading="lazy"
                            onerror="this.style.border='3px solid red'; console.log('Error loading: {{ $gambar }}');">
                            
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center">
                                <svg class="w-12 h-12 text-white mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                                <p class="text-white text-sm font-semibold">Klik untuk memperbesar</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- TAMPILKAN PESAN JIKA TIDAK ADA GALERI --}}
            <div class="text-center py-12">
                <div class="bg-white bg-opacity-10 rounded-lg p-8 max-w-md mx-auto">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white mb-2">Galeri Segera Hadir</h3>
                    <p class="text-gray-300">Foto-foto menarik dari {{ $data['title'] }} akan segera ditampilkan di sini.</p>
                </div>
            </div>
        @endif
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
            <button @click="closeModal()"
                    class="p-3 text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Image Container -->
        <div class="relative w-full h-full flex items-center justify-center p-4 overflow-hidden">
            <img :src="modalImg" 
                 alt="Preview Galeri"
                 class="max-h-full max-w-full object-contain rounded-lg shadow-2xl bg-white p-2 transition-transform duration-200 ease-out select-none"
                 :style="`transform: scale(${scale}) translate(${translateX}px, ${translateY}px)`"
                 @wheel.prevent="$event.deltaY < 0 ? zoomIn() : zoomOut()"
                 @mousedown="isDragging = true; startX = $event.clientX - translateX; startY = $event.clientY - translateY"
                 @mousemove="if(isDragging && scale > 1) { translateX = $event.clientX - startX; translateY = $event.clientY - startY }"
                 @mouseup="isDragging = false"
                 @mouseleave="isDragging = false"
                 draggable="false" />
        </div>
    </div>
</section>