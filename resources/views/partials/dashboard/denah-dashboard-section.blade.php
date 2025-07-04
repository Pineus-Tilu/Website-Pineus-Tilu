<!-- Denah Pineus Tilu - Mobile Responsive -->
<section class="relative py-12 md:py-20 bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] overflow-hidden" 
         data-aos="zoom-in-up" 
         data-aos-duration="1000">
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
                    <div class="relative overflow-hidden rounded-lg md:rounded-2xl mb-4 md:mb-6 group cursor-pointer" @click="openDenah()">
                        <img src="{{ asset('images/galeri/denah/denah.jpeg') }}" alt="Denah Pineus Tilu"
                            class="w-full h-auto transition-transform duration-500 group-hover:scale-105 rounded-lg md:rounded-2xl shadow-2xl"
                            loading="lazy" />
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg md:rounded-2xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-white rounded-full flex items-center justify-center mb-3 md:mb-4 mx-auto">
                                    <svg class="w-6 h-6 md:w-8 md:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </div>
                                <p class="text-white font-bold text-base md:text-lg font-typewriter">Klik untuk Melihat</p>
                            </div>
                        </div>

                        <!-- Corner Badge -->
                        <div class="absolute top-2 right-2 md:top-4 md:right-4 bg-green-500 text-white px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-bold shadow-lg">
                            📍 Klik untuk Melihat
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
                    <button @click="openDenah()" 
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