@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative flex items-center justify-center min-h-screen px-4 py-32 text-white bg-center bg-cover pt-[100px] sm:pt-[120px] md:pt-[140px] lg:pt-[160px]"
        style="background-image: url('/images/PT4.jpg');">
        <div class="absolute inset-0 z-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 max-w-4xl px-4 text-center">
            <h1 class="mb-6 text-5xl font-bold tracking-wider sm:text-6xl md:text-8xl jp-brush">PINEUS TILU</h1>
            <!-- Description -->
            <p class="max-w-2xl mx-auto mb-10 text-base leading-relaxed sm:text-lg md:text-xl font-typewriter">
                adalah sebuah Glamping yang menjadi Pelopor atau Pionir di keindahan alam hutan pinus Rahong,
                dengan pemandangan sungai Palayangan yang menjadi daya tarik khusus untuk aktivitas Rafting
                di Pangalengan, Kabupaten Bandung, Indonesia.
            </p>
            <a href="/reservasi"
                class="inline-block px-8 py-4 text-lg font-bold transition duration-300 rounded-xl shadow-lg sm:px-10 sm:py-5 sm:text-2xl bg-[#006C43] hover:bg-green-700 font-typewriter">
                Pesan Sekarang!
            </a>
        </div>
    </section>

    <!-- Swiper Section -->
    <section class="bg-[#006C43] py-16 px-4 md:px-8 text-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="mb-10 text-3xl font-bold tracking-widest font-japanese md:text-4xl">Pineus Tilu</h2>

            <div class="swiper mySwiper font-typewriter">
                <div class="swiper-wrapper">
                    @php
                        $slides = [
                            ['img' => 'pineus-tilu-1.jpg', 'title' => 'Pineus Tilu I'],
                            ['img' => 'pineus-tilu-2.jpg', 'title' => 'Pineus Tilu II'],
                            ['img' => 'pineus-tilu-3-vip.jpg', 'title' => 'Pineus Tilu III (VIP)'],
                            ['img' => 'pineus-tilu-3-cabin.jpg', 'title' => 'Pineus Tilu III (Cabin)'],
                            ['img' => 'pineus-tilu-4.jpg', 'title' => 'Pineus Tilu IV'],
                        ];
                    @endphp

                    @foreach ($slides as $slide)
                        <div class="overflow-hidden bg-white rounded-lg shadow-lg swiper-slide">
                            <img src="{{ asset('images/' . $slide['img']) }}" alt="{{ $slide['title'] }}"
                                class="object-cover w-full h-64 sm:h-80" />
                            <div class="p-4 font-semibold text-center text-black">{{ $slide['title'] }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>

    <!-- Awal Mula Pineus Tilu -->
    <section class="py-12 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-6 text-3xl font-bold text-center text-green-800 font-japanese">Awal mula Pineus Tilu</h2>
            <p class="max-w-4xl mx-auto leading-relaxed text-justify text-gray-700 font-typewriter">
                Dari mencari pengalaman baru, jadi punya tempat nge-camp.<br><br>

                Pada masa awal pandemi Mei 2020, saya dan keluarga praktis tak pernah keluar rumah. Di akhir Agustus, karena
                bosan, kami nekat jalan-jalan ke daerah sepi—gunung dan hutan. Setelah menjelajah Ciwidey dan Pangalengan,
                malam itu kami bingung mencari penginapan. Hotel tidak ada yang cocok. Akhirnya, kami ditawari untuk
                menginap di tepi Sungai Palayangan dengan tenda Arpenaz Family 4.0. <br><br>
                Pengalaman pertama tidur di tengah hutan dengan suara sungai yang menenangkan ternyata luar biasa. Hawa
                dingin menusuk, tapi justru membuat tidur nyenyak. Pagi harinya, pemandangan sinar matahari di antara
                pepohonan pinus sangat indah dan menyentuh.<br><br>
                Setelah itu saya berpikir, “Andai punya tempat sendiri di sini…” Tak lama, saya mendapatkan lahan di sekitar
                sungai dan langsung menyetujuinya untuk dikelola sebagai area camping. Dari situlah lahir PINEUS TILU
                Riverside Camping Ground—tempat yang menawarkan pengalaman ruang yang menenangkan, visual alami yang indah,
                dan suasana privat dengan tiga pohon pinus ikonik yang menjorok ke sungai.<br><br>
                Kami memulai dengan 7 deck kayu untuk 9 tenda, menggunakan tipe Arpenaz Family 4.0 dan 4.2.
                Silakan rasakan sendiri sensasi ruang luar biasa ini di tepi Sungai Palayangan.<br><br>
                Feel the awesome space, feel the incredible experience.


            </p>

            <p class="max-w-4xl mx-auto mt-6 font-bold text-gray-700 font-typewriter">
                Bandung, 24 Juni 2021<br>
                BSBarchitect<br>
                PINEUS TILU Riverside Camping Ground
            </p>
        </div>
    </section>

   <!-- Denah Pineus Tilu -->
<section class="py-12 bg-[#006C43]">
    <div x-data="{ open: false, scale: 1, zoomIn() { this.scale += 0.1 }, zoomOut() { this.scale = Math.max(0.1, this.scale - 0.1) }, resetZoom() { this.scale = 1 } }"
         class="container px-4 mx-auto text-center text-white">
        <h2 class="mb-6 text-3xl font-bold font-japanese font-cursive">Denah Pineus Tilu</h2>

        <!-- Thumbnail -->
        <img @click="open = true"
             src="{{ asset('images/denah.jpeg') }}"
             alt="Denah Pineus Tilu"
             class="w-full max-w-3xl mx-auto transition-transform duration-300 rounded-lg shadow-lg cursor-pointer hover:scale-105" />

        <!-- Modal -->
        <div x-show="open"
             x-transition
             @click.self="open = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80"
             style="display: none;">
            <div class="relative">
                <!-- Tombol Close -->
                <button @click="open = false"
                        class="absolute p-2 text-white bg-black bg-opacity-50 rounded-full top-2 right-2 hover:bg-opacity-75">
                    ✕
                </button>

                <!-- Tombol Zoom -->
                <div class="absolute space-x-2 top-2 left-2">
                    <button @click="zoomIn" class="px-2 text-black bg-white rounded">+</button>
                    <button @click="zoomOut" class="px-2 text-black bg-white rounded">−</button>
                    <button @click="resetZoom" class="px-2 text-black bg-white rounded">⟳</button>
                </div>

                <!-- Gambar popup dengan zoom -->
                <div class="overflow-auto max-w-[90vw] max-h-[90vh]">
                    <img :style="'transform: scale(' + scale + ')'"
                         src="{{ asset('images/denah.jpeg') }}"
                         alt="Denah Pineus Tilu"
                         class="transition-transform duration-300 ease-in-out rounded-lg shadow-xl" />
                </div>
            </div>
        </div>
    </div>
</section>




    <!-- Location Section -->
    <section class="py-12 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-6 text-2xl font-bold text-center text-green-800 font-japanese font-cursive">Our Location</h2>
            <p class="max-w-2xl mx-auto mb-4 text-center text-gray-700 font-typewriter">
                Hutan Rahong, Pulosari, Kec. Pangalengan, Kabupaten Bandung, Jawa Barat 40378.
            </p>
            <div class="flex justify-center mt-6">
                <div class="w-full md:w-2/3 aspect-video">
                    <iframe src="https://maps.google.com/maps?q=Pineus%20Tilu&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        class="w-full h-full border rounded-lg"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
