<x-app-layout>

<!-- Container Hero dengan Slider sebagai background -->
<div class="w-full h-[600px] relative">
    <!-- Slider -->
    <div id="default-carousel" class="relative w-full h-full" data-carousel="slide">
        
        <!-- Overlay Hero Content -->
        <div class="absolute inset-0 flex items-center justify-center px-4 z-40 pointer-events-none">
            <div class="bg-[#0f172a]/70 p-7 rounded-lg text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white">Get Your Trip</h1>
                <p class="text-gray-200 max-w-2xl mx-auto mb-4">
                    Getyourtrip.com adalah platform informasi dan pemesanan perjalanan di Bandung yang membantu Anda merencanakan perjalanan dengan mudah dan menyenangkan.
                </p>
                <a href="#" class="text-white underline hover:text-blue-300">Learn More</a>
            </div>
        </div>

        <!-- Carousel wrapper -->
        <div class="h-full overflow-hidden rounded-lg relative">
            <!-- Item 1 -->
            <div class="duration-700 ease-in-out" data-carousel-item>
                <img src="https://dev.ayoglamping.com/wp-content/uploads/2023/07/pineus-5.jpg" 
                    class="absolute w-full h-full object-cover z-10" 
                    alt="Glamping di Bandung 1">
            </div>
            <!-- Item 2 -->
            <div class="duration-700 ease-in-out" data-carousel-item>
                <img src="https://jabarekspres.com/wp-content/uploads/2021/08/Obyek-Wisata-Pineus-Tilu-Riverside-Camping-e1627950952356.jpg" 
                    class="absolute w-full h-full object-cover z-10" 
                    alt="Glamping di Bandung 2">
            </div>
            <!-- Item 3 -->
            <div class="duration-700 ease-in-out" data-carousel-item>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrjMmIfE8lH62v5l69luXn3HYx3cMhhjk3Ww&s" 
                    class="absolute w-full h-full object-cover z-10" 
                    alt="Glamping di Bandung 3">
            </div>
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-1/2 start-4 z-50 flex items-center justify-center w-10 h-10 rounded-full bg-white/30 hover:bg-white/50 pointer-events-auto" data-carousel-prev>
            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
        </button>
        <button type="button" class="absolute top-1/2 end-4 z-50 flex items-center justify-center w-10 h-10 rounded-full bg-white/30 hover:bg-white/50 pointer-events-auto" data-carousel-next>
            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
        </button>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
            <button type="button" class="w-3 h-3 rounded-full" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-label="Slide 2" data-carousel-slide-to="2"></button>
        </div>
    </div>
</div>



    <!-- Tentang Destinasi -->
    <section id="about" class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 px-6">
            <div class="md:col-span-2">
                <h2 class="text-xl italic mb-4">About Tour Website</h2>
                <p class="text-gray-600 mb-4">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring...</p>
                <p class="text-sm text-gray-500">I am so happy, my dear friend...</p>
                <a href="#" class="inline-block mt-4 text-blue-600 hover:underline">Learn More</a>
            </div>
            <div>
                <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652_640.png" alt="Profile" class="w-20 h-20 rounded-full mb-4 mx-auto">
                <p class="text-center italic font-semibold">Rizqy Nurfauzella</p>
                <p class="text-center text-sm text-gray-600 mt-2">
                    “Everyone realizes why a new common language would be desirable...”
                </p>
                <a href="#" class="block mt-4 text-center text-blue-600 hover:underline">More About Rizqy Nurfauzella</a>
            </div>
        </div>
    </section>

<!-- Testimoni -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-start space-x-4">
            <!-- Avatar -->
            <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652_640.png" 
                 alt="Testimonial Avatar" 
                 class="w-12 h-12 rounded-full object-cover">
            <!-- Quote -->
            <blockquote class="italic text-gray-500 text-lg">
                <span class="text-4xl text-gray-300 absolute -top-2 -left-4">“</span>
                This is a testimonial related to travel, and some dummy text to make it long.
            </blockquote>
        </div>
    </div>
</section>

<!-- Info Paket & Section -->
<section class="bg-gray-100 py-20">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 px-6">
        <!-- Kiri - Info Paket -->
        <div class="bg-gray-300 p-10">
            <h3 class="text-sm font-semibold tracking-wide uppercase text-gray-600">
                This is title of the travel package that is being featured here.
            </h3>
            <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">Read More</a>
        </div>
        <!-- Kanan - Section -->
        <div class="space-y-6">
            <div class="bg-gray-300 p-6">
                <h3 class="italic text-gray-600">About Producer</h3>
                <p class="text-xs text-gray-500">This is a title to explain the product produced or created by the person on the left.</p>
                <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">Read More</a>
            </div>
            <div class="bg-gray-300 p-6">
                <h3 class="text-sm font-semibold tracking-wide uppercase text-gray-600">
                    This section is featuring soul section and some text to make title longer.
                </h3>
                <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">Read More</a>
            </div>
        </div>
    </div>
</section>


    <!-- Our Stories -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-center text-2xl font-semibold mb-10 italic">Our Stories</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach (range(1, 3) as $i)
                    <div>
                        <div class="bg-gray-200 h-40 mb-4"></div>
                        <p class="text-sm text-gray-500">10 April, 2025</p>
                        <p class="text-gray-700 text-sm mt-1">This is title of the travel package that is being featured here.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

<!-- Testimoni -->
<section class="bg-gray-100 py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-center text-2xl font-semibold mb-10 italic text-gray-500">
            What people are saying about us
        </h2>
        <div class="grid md:grid-cols-2 gap-10">
            <!-- Testimoni 1 -->
            <div class="flex items-start space-x-4">
                <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652_640.png" 
                     alt="Avatar Sofia Brichet" 
                     class="w-12 h-12 rounded-full object-cover">
                <div>
                    <blockquote class="italic text-gray-600 text-sm relative">
                        <span class="text-4xl text-gray-300 absolute -top-2 -left-4">“</span>
                        This is a testimonial Cras dapibus. Vivamus elementum semper nisi. 
                        Aenean vulputate eleifend tellus.
                    </blockquote>
                    <p class="mt-4 font-semibold text-gray-700 uppercase text-xs">Rizqy Nurfauzella</p>
                    <p class="text-xs text-gray-500 italic">Some Company Name</p>
                </div>
            </div>
            <!-- Testimoni 2 -->
            <div class="flex items-start space-x-4">
                <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652_640.png" 
                     alt="Avatar James Thomas" 
                     class="w-12 h-12 rounded-full object-cover">
                <div>
                    <blockquote class="italic text-gray-600 text-sm relative">
                        <span class="text-4xl text-gray-300 absolute -top-2 -left-4">“</span>
                        One morning, when Gregor Samsa woke from troubled dreams, 
                        he found himself transformed in his bed into a horrible vermin.
                    </blockquote>
                    <p class="mt-4 font-semibold text-gray-700 uppercase text-xs">M. Ihsan Firjatulloh</p>
                    <p class="text-xs text-gray-500 italic">Some Company Name</p>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Newsletter -->
    <section class="bg-white py-10 border-t">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h3 class="italic text-lg mb-4">Subscribe to our newsletter</h3>
            <form class="flex flex-col md:flex-row justify-center items-center gap-4">
                <input type="email" placeholder="Enter your email" class="w-full md:w-auto border px-4 py-2 rounded-lg">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-20 py-8 text-center text-sm">
        <p>2025 Copyright information goes here.</p>
        <p>Designed by GYT Company</p>
        <div class="mt-4 flex justify-center gap-2">
            @foreach(range(1, 4) as $i)
                <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
            @endforeach
        </div>
    </footer>
</x-app-layout>
