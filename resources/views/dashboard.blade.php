@extends('layouts.app')

@section('content')
    <div class="max-w-full overflow-hidden">
        <!-- Hero Section -->
        <section
            class="relative flex items-center justify-center min-h-screen px-4 py-32 text-white bg-center bg-cover pt-[64px] sm:pt-[80px] md:pt-[96px] lg:pt-[112px]"
            style="background-image: url('/images/dashboard.png');" data-aos="fade-in" data-aos-duration="1000">
            <div class="absolute inset-0 z-0 bg-black bg-opacity-60"></div>
            <div class="relative z-10 max-w-4xl px-4 text-center">
                <h1 class="mb-6 text-5xl font-bold tracking-wider sm:text-6xl md:text-8xl jp-brush">PINEUS TILU</h1>
                <p class="max-w-2xl mx-auto mb-10 text-base leading-relaxed sm:text-lg md:text-xl font-typewriter">
                    adalah sebuah Glamping yang menjadi Pelopor atau Pionir di keindahan alam hutan pinus Rahong,
                    dengan pemandangan sungai Palayangan yang menjadi daya tarik khusus untuk aktivitas Rafting
                    di Pangalengan, Kabupaten Bandung, Indonesia.
                </p>
                <a href="/reservasi"
                    class="inline-block px-8 py-4 text-lg font-bold transition duration-300 rounded-xl shadow-lg sm:px-10 sm:py-5 sm:text-2xl bg-[#006C43] hover:bg-green-700 font-typewriter"
                    data-aos="zoom-in" data-aos-delay="400">
                    Pesan Sekarang!
                </a>
            </div>
        </section>

        <!-- Swiper Section -->
        <section class="bg-[#006C43] py-16 px-4 md:px-8 text-white" data-aos="fade-up" data-aos-duration="1000"
            x-data="{ showModal: false, modalImg: '', modalTitle: '' }">
            <div class="mx-auto text-center max-w-7xl">
                <h2 class="mb-10 text-3xl font-bold tracking-widest jp-brush md:text-4xl" data-aos="fade-down"
                    data-aos-delay="200">Pineus Tilu</h2>

                <div class="relative">
                    <!-- Swiper Wrapper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">

                            @foreach ($slides as $slide)
                                <div class="flex flex-col items-center justify-start overflow-hidden bg-white rounded-lg shadow-lg cursor-pointer swiper-slide"
                                    @click="showModal = true; modalImg = '{{ asset('images/' . $slide['img']) }}'; modalTitle = '{{ $slide['title'] }}'">
                                    <img src="{{ asset('images/' . $slide['img']) }}" alt="{{ $slide['title'] }}"
                                        class="object-cover w-full h-64" />
                                    <div class="p-4 font-semibold text-center text-black">{{ $slide['title'] }}</div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Swiper Navigation -->
                        <div class="swiper-button-prev !text-white"></div>
                        <div class="swiper-button-next !text-white"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <!-- Modal Preview Gambar (FULLSCREEN, DILUAR semua section) -->
            <div x-show="showModal" x-transition @click.self="showModal = false"
                class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-80"
                style="display: none;">

                <!-- Tombol Close -->
                <button @click="showModal = false"
                    class="absolute top-4 right-4 z-[100000] p-2 text-white bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                    ✕
                </button>

                <!-- Konten Modal -->
                <div class="relative flex items-center justify-center w-full h-full overflow-y-auto">
                    <img :src="modalImg" :alt="modalTitle"
                        class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-xl bg-white" />
                    <div class="absolute w-full px-4 -translate-x-1/2 bottom-8 left-1/2">
                        <div class="text-xl font-bold text-center text-white drop-shadow" x-text="modalTitle"></div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Awal Mula Pineus Tilu -->
        <section class="py-12 bg-white" data-aos="fade-up" data-aos-duration="1000">
            <div class="container max-w-full px-4 mx-auto">
                <h2 class="mb-6 text-3xl font-bold text-center text-green-800 jp-brush" data-aos="fade-right">Awal mula
                    Pineus
                    Tilu</h2>
                <p class="max-w-4xl mx-auto leading-relaxed text-justify text-gray-700 font-typewriter" data-aos="fade-left"
                    data-aos-delay="200">
                    Dari mencari pengalaman baru, jadi punya tempat nge-camp.<br><br>
                    Pada masa awal pandemi Mei 2020, saya dan keluarga praktis tak pernah keluar rumah. Di akhir Agustus,
                    karena
                    bosan, kami nekat jalan-jalan ke daerah sepi—gunung dan hutan. Setelah menjelajah Ciwidey dan
                    Pangalengan,
                    malam itu kami bingung mencari penginapan. Hotel tidak ada yang cocok. Akhirnya, kami ditawari untuk
                    menginap di tepi Sungai Palayangan dengan tenda Arpenaz Family 4.0. <br><br>
                    Pengalaman pertama tidur di tengah hutan dengan suara sungai yang menenangkan ternyata luar biasa. Hawa
                    dingin menusuk, tapi justru membuat tidur nyenyak. Pagi harinya, pemandangan sinar matahari di antara
                    pepohonan pinus sangat indah dan menyentuh.<br><br>
                    Setelah itu saya berpikir, “Andai punya tempat sendiri di sini…” Tak lama, saya mendapatkan lahan di
                    sekitar
                    sungai dan langsung menyetujuinya untuk dikelola sebagai area camping. Dari situlah lahir PINEUS TILU
                    Riverside Camping Ground—tempat yang menawarkan pengalaman ruang yang menenangkan, visual alami yang
                    indah,
                    dan suasana privat dengan tiga pohon pinus ikonik yang menjorok ke sungai.<br><br>
                    Kami memulai dengan 7 deck kayu untuk 9 tenda, menggunakan tipe Arpenaz Family 4.0 dan 4.2.
                    Silakan rasakan sendiri sensasi ruang luar biasa ini di tepi Sungai Palayangan.<br><br>
                    Feel the awesome space, feel the incredible experience.
                </p>
                <p class="max-w-4xl mx-auto mt-6 font-bold text-gray-700 font-typewriter" data-aos="fade-up"
                    data-aos-delay="400">
                    Bandung, 24 Juni 2021<br>
                    BSBarchitect<br>
                    PINEUS TILU Riverside Camping Ground
                </p>
            </div>
        </section>

        <!-- Denah Pineus Tilu -->
        <section class="py-12 bg-[#006C43]" data-aos="zoom-in-up" data-aos-duration="1000">
            <div x-data="{ open: false, scale: 1, zoomIn() { this.scale += 0.1 }, zoomOut() { this.scale = Math.max(0.1, this.scale - 0.1) }, resetZoom() { this.scale = 1 } }" class="container px-4 mx-auto text-center text-white">
                <h2 class="mb-6 text-3xl font-bold jp-brush font-cursive">Denah Pineus Tilu</h2>
                <!-- Thumbnail -->
                <img @click="open = true" src="{{ asset('images/galeri/denah/denah.jpeg') }}" alt="Denah Pineus Tilu"
                    class="w-full max-w-3xl mx-auto transition-transform duration-300 rounded-lg shadow-lg cursor-pointer hover:scale-105"
                    data-aos="zoom-in" data-aos-delay="200" />
                <!-- Modal HARUS di luar .container agar tidak terbatasi -->
                <template x-if="open">
                    <!-- Modal Fullscreen -->
                    <div x-show="open" x-transition @click.self="open = false"
                        class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-80"
                        style="display: flex;">
                        <!-- Tombol Close -->
                        <button @click="open = false"
                            class="fixed z-[100000] top-4 right-4 p-2 text-white bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                            ✕
                        </button>
                        <!-- Gambar Zoom (fullscreen center) -->
                        <img :style="'transform: scale(' + scale + '); transform-origin: center center;'"
                            src="{{ asset('images/galeri/denah/denah.jpeg') }}" alt="Denah Pineus Tilu"
                            class="max-h-[90vh] max-w-[90vw] transition-transform duration-300 ease-in-out rounded-lg shadow-xl bg-white" />
                        <!-- Tombol Zoom -->
                        <div class="fixed z-[100000] left-1/2 bottom-8 -translate-x-1/2">
                            <div class="flex px-3 py-2 space-x-2 rounded shadow bg-white/80">
                                <button @click.stop="zoomIn" class="px-3 py-1 text-black bg-white rounded shadow">+</button>
                                <button @click.stop="zoomOut"
                                    class="px-3 py-1 text-black bg-white rounded shadow">−</button>
                                <button @click.stop="resetZoom"
                                    class="px-3 py-1 text-black bg-white rounded shadow">⟳</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>

        <!-- Location Section -->
        <section class="py-12 bg-white" data-aos="fade-up" data-aos-duration="1000">
            <div class="container px-4 mx-auto">
                <h2 class="mb-6 text-2xl font-bold text-center text-green-800 jp-brush font-cursive" data-aos="fade-down">
                    Our
                    Location</h2>
                <p class="max-w-2xl mx-auto mb-4 text-center text-gray-700 font-typewriter" data-aos="fade-up"
                    data-aos-delay="200">
                    Hutan Rahong, Pulosari, Kec. Pangalengan, Kabupaten Bandung, Jawa Barat 40378.
                </p>
                <div class="flex justify-center mt-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="w-full md:w-2/3 aspect-video">
                        <iframe src="https://maps.google.com/maps?q=Pineus%20Tilu&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            class="w-full h-full border rounded-lg" title="Pineus Tilu Location Map"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
