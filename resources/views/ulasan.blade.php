@extends('layouts.app')

@section('title', 'Ulasan - Pineus Tilu')

@section('content')
    <div class="max-w-full overflow-hidden">
        <!-- Hero Section -->
        <section
            class="relative flex items-center justify-center h-[55vh] px-6 text-white bg-center bg-cover overflow-hidden mt-14 sm:mt-18 md:mt-22 lg:mt-26">

            <!-- Background Image -->
            <img src="{{ asset('images/reservasi.JPG') }}" alt="Pineus Tilu"
                class="absolute top-0 left-0 z-0 object-cover w-full h-full">

            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div
                    class="absolute w-16 h-16 bg-white rounded-full top-10 left-10 sm:w-24 sm:h-24 md:w-32 md:h-32 animate-pulse">
                </div>
                <div
                    class="absolute w-12 h-12 delay-1000 bg-white rounded-full bottom-10 right-10 sm:w-16 sm:h-16 md:w-24 md:h-24 animate-pulse">
                </div>
                <div
                    class="absolute w-8 h-8 delay-500 bg-white rounded-full top-1/2 left-1/3 sm:w-12 sm:h-12 md:w-16 md:h-16 animate-pulse">
                </div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto text-center">
                <h1 class="text-4xl font-bold text-center md:text-6xl jp-brush animate-fade-in" data-aos="fade-down">
                    Ulasan
                </h1>
                <p class="mt-4 text-lg leading-relaxed text-center md:text-xl font-typewriter opacity-90" data-aos="fade-up"
                    data-aos-delay="300">
                    Tentang kami dari orang yang pernah mengunjungi pineus tilu
                </p>
            </div>
        </section>

        <!-- Video Section -->
        <section class="py-16 md:py-20 bg-gray-50">
            <div class="container max-w-6xl px-4 mx-auto">
                <!-- Section Header -->
                <div class="mb-12 text-center md:mb-16">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] jp-brush mb-4">
                        Review YouTube
                    </h2>
                    <div class="w-20 h-1 mx-auto bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] rounded-full">
                    </div>
                    <p class="mt-4 text-lg text-gray-600">
                        Lihat pengalaman nyata pengunjung melalui video review mereka
                    </p>
                </div>

                <!-- Video Grid -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                    <!-- Video 1 -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 shadow-lg rounded-xl hover:shadow-xl group">
                        <div class="aspect-video">
                            <iframe src="https://www.youtube.com/embed/07QdgOaa_HE" title="Pineus Tilu Review Video 1"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="w-full h-full rounded-xl">
                            </iframe>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 shadow-lg rounded-xl hover:shadow-xl group">
                        <div class="aspect-video">
                            <iframe src="https://www.youtube.com/embed/8OwcRHyPZLQ" title="Pineus Tilu Review Video 2"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="w-full h-full rounded-xl">
                            </iframe>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 shadow-lg rounded-xl hover:shadow-xl group">
                        <div class="aspect-video">
                            <iframe src="https://www.youtube.com/embed/fHTkbNpdC4U" title="Pineus Tilu Review Video 3"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="w-full h-full rounded-xl">
                            </iframe>
                        </div>
                    </div>

                    <!-- Video 4 -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 shadow-lg rounded-xl hover:shadow-xl group">
                        <div class="aspect-video">
                            <iframe src="https://www.youtube.com/embed/z0RaF18orEg" title="Pineus Tilu Review Video 4"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="w-full h-full rounded-xl">
                            </iframe>
                        </div>
                    </div>

                    <!-- Video 5 -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 shadow-lg rounded-xl hover:shadow-xl group">
                        <div class="aspect-video">
                            <iframe src="https://www.youtube.com/embed/AWLCCG5-W6Y" title="Pineus Tilu Review Video 5"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="w-full h-full rounded-xl">
                            </iframe>
                        </div>
                    </div>

                    <!-- Video 6 -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 shadow-lg rounded-xl hover:shadow-xl group">
                        <div class="aspect-video">
                            <iframe src="https://www.youtube.com/embed/o6Y_-gDp28Q" title="Pineus Tilu Review Video 6"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="w-full h-full rounded-xl">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Reviews Section -->
        <section class="py-16 bg-white md:py-20">
            <div class="container max-w-6xl px-4 mx-auto">
                <!-- Section Header -->
                <div class="mb-12 text-center md:mb-16">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] jp-brush mb-4">
                        Testimoni Pengunjung
                    </h2>
                    <div class="w-20 h-1 mx-auto bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] rounded-full">
                    </div>
                    <p class="mt-4 text-lg text-gray-600">
                        Tanggapan jujur mereka yang pernah mendapatkan pengalaman menakjubkan di Pineus Tilu
                    </p>
                </div>

                <!-- Elfsight Google Reviews Widget -->
                <div class="w-full">
                    <script src="https://static.elfsight.com/platform/platform.js" async></script>
                    <div class="elfsight-app-17b60940-3311-416e-bc78-3f7f62d9582c" data-elfsight-app-lazy></div>
                </div>
            </div>
        </section>
    </div>
@endsection
