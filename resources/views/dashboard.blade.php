@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section
        class="flex flex-col items-center justify-center min-h-[60vh] px-4 py-16 text-white bg-center bg-cover text-center"
        style="background-image: url('/images/hero.jpg');">
        <h1 class="text-4xl font-bold tracking-wide md:text-5xl font-japanese">PINEUS TILU</h1>
        <p class="max-w-2xl mt-4 text-base md:text-xl font-typewriter">
            adalah sebuah Glamping yang berada di tepi sungai, dikelilingi hutan pinus Rahong. Menawarkan suasana nyaman
            dengan udara sejuk khas pegunungan.
        </p>
        <a href="/reservasi"
            class="px-6 py-2 mt-6 font-semibold text-white transition duration-300 bg-[#006C43] rounded-full shadow-lg hover:bg-green-600">
            Pesan Sekarang!
        </a>
    </section>


    <!-- Sections Pineus Tilu I - IV as Swiper Slider -->
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
                        <div class="overflow-hidden text-black bg-white rounded-lg shadow-lg swiper-slide">
                            <img src="{{ asset('images/' . $slide['img']) }}" alt="{{ $slide['title'] }}"
                                class="object-cover w-full h-80" />
                            <div class="p-4 font-semibold text-center">{{ $slide['title'] }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Navigation buttons -->
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
        <div class="container px-4 mx-auto text-center text-white">
            <h2 class="mb-6 text-3xl font-bold font-japanese font-cursive">Denah Pineus Tilu</h2>
            <img src="/images/denah.png" alt="Denah Pineus Tilu" class="w-full mx-auto rounded-lg shadow-lg md:w-2/3">
        </div>
    </section>

    <!-- Location Section -->
    <section class="py-12 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-6 text-2xl font-bold text-center text-green-800 font-japanese font-cursive">Our Location</h2>
            <p class="max-w-2xl mx-auto mb-4 text-center text-gray-700 font-typewriter">
                Hutan Rahong, Pulosari, Kec. Pangalengan, Kabupaten Bandung, Jawa Barat 40378. "Pineus Tilu terletak di
                Hutan Rahong, dikelilingi oleh hutan pinus dan sungai, memberikan pengalaman camping dengan kenyamanan ruang
                yang tak terbatas"
            </p>
            <div class="flex justify-center mt-6">
                <iframe src="https://maps.google.com/maps?q=Pineus%20Tilu&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-64 border rounded-lg md:w-2/3"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 bg-white text-green">
        <div class="container px-4 mx-auto text-sm text-center">
            <p class="mb-2">&copy; 2024 Pineus Tilu. All Rights Reserved.</p>
            <div class="flex justify-center gap-6">
                <div>
                    <p>Contact:</p>
                    <p>+62 877-5355-3227</p>
                    <p>pineustilu@gmail.com</p>
                </div>
                <div>
                    <p>Follow us:</p>
                    <a href="https://instagram.com/pineustilu" target="_blank">@pineustilu</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Swiper Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.mySwiper', {
                slidesPerView: 2, // tampil 2 slide
                spaceBetween: 20,
                loop: true, // loop tanpa batas
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1
                    }, // mobile tampil 1 slide
                    640: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 2
                    },
                },
            });
        });
    </script>
@endsection
