@extends('layouts.app')

@section('title', 'Ulasan - Pineus Tilu')

@section('content')
<div class="max-w-full overflow-hidden">
    <!-- Hero Section -->
    <section class="relative flex items-center justify-center h-[55vh] px-6 text-white bg-center bg-cover bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36] overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-16 h-16 sm:w-24 sm:h-24 md:w-32 md:h-32 rounded-full bg-white animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24 rounded-full bg-white animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/3 w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 rounded-full bg-white animate-pulse delay-500"></div>
        </div>

        <div class="relative z-10 text-center max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold md:text-6xl jp-brush animate-fade-in text-center" data-aos="fade-down">
                Ulasan
            </h1>
            <p class="mt-4 text-lg md:text-xl font-typewriter opacity-90 text-center leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                Tentang kami dari orang yang pernah mengunjungi pineus tilu
            </p>
        </div>
    </section>

    <!-- Video Section -->
    <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                <!-- Video 1 -->
                <div class="relative rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                    <div class="aspect-video">
                        <iframe 
                            src="https://www.youtube.com/embed/07QdgOaa_HE" 
                            title="Pineus Tilu Review Video 1"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            class="w-full h-full rounded-xl">
                        </iframe>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="relative rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                    <div class="aspect-video">
                        <iframe 
                            src="https://www.youtube.com/embed/8OwcRHyPZLQ" 
                            title="Pineus Tilu Review Video 2"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            class="w-full h-full rounded-xl">
                        </iframe>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="relative rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                    <div class="aspect-video">
                        <iframe 
                            src="https://www.youtube.com/embed/fHTkbNpdC4U" 
                            title="Pineus Tilu Review Video 3"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            class="w-full h-full rounded-xl">
                        </iframe>
                    </div>
                </div>

                <!-- Video 4 -->
                <div class="relative rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                    <div class="aspect-video">
                        <iframe 
                            src="https://www.youtube.com/embed/z0RaF18orEg" 
                            title="Pineus Tilu Review Video 4"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen
                            class="w-full h-full rounded-xl">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Section Header -->
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-blue-600 jp-brush mb-4">
                    Testimoni dari pengunjung
                </h2>
                <div class="w-20 h-1 mx-auto bg-gradient-to-r from-green-500 to-blue-500 rounded-full"></div>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold text-yellow-600">F</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-bold text-gray-800">Floyd Miles</h3>
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Tempat yang sangat indah dan cocok untuk camping bersama keluarga. Fasilitas yang disediakan juga sangat lengkap dan bersih. Sangat merekomendasikan tempat ini!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold text-blue-600">R</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-bold text-gray-800">Ronald Richards</h3>
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Pengalaman camping yang tak terlupakan! Udara segar, pemandangan indah, dan suasana yang tenang. Staff yang ramah dan pelayanan yang memuaskan. Pasti akan kembali lagi!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold text-green-600">S</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-bold text-gray-800">Savannah Nguyen</h3>
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Lokasi yang strategis dan mudah dijangkau. Spot foto yang instagramable dan cocok untuk healing. Harga yang terjangkau dengan kualitas yang memuaskan. Recommended banget!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold text-purple-600">A</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-bold text-gray-800">Andi Wijaya</h3>
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Tempat camping yang sangat nyaman dan aman. Cocok untuk keluarga dan rombongan. Fasilitas toilet dan tempat ibadah yang bersih. Pemandangan alam yang menakjubkan!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection