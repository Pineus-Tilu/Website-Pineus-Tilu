<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-cover bg-center h-[600px] flex items-center justify-center text-white text-center px-4" style="background-image: url('/images/mustang-hero.jpg');">
        <div class="bg-[#0f172a]/70 p-8 rounded-lg">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 italic">Trip to magical land, Mustang</h1>
            <p class="uppercase tracking-wide text-sm text-gray-300">Travel</p>
        </div>
    </div>

    <!-- Content & Sidebar -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-4">
            <!-- Left: Text & Image -->
            <div class="md:col-span-2">
                <p class="text-gray-700 text-sm mb-6 leading-relaxed">
                    A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring...
                </p>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                    I should be incapable of drawing a single stroke... yet I feel that I never was a greater artist than now...
                </p>

                <div class="bg-gray-300 h-80 flex items-center justify-center mb-6">
                    <span class="text-gray-500">[Main Image]</span>
                </div>

                <div class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-gray-200 h-24"></div>
                    <div class="bg-gray-200 h-24"></div>
                    <div class="bg-gray-200 h-24"></div>
                    <div class="bg-gray-200 h-24"></div>
                </div>

                <p class="text-gray-600 text-sm">
                    A wonderful serenity has taken possession of my entire soul...
                </p>
            </div>

            <!-- Right: Testimonial -->
            <div class="bg-gray-100 p-6 rounded shadow-md sticky top-24 h-fit">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gray-400 mx-auto mb-4"></div>
                    <p class="text-sm font-bold">RIZQY NURFAUZELLA</p>
                    <p class="text-xs text-gray-500">Some Company Name</p>
                    <blockquote class="italic text-xs mt-4 mb-4 text-gray-600">
                        “One morning, when Gregor Samsa woke from troubled dreams...”
                    </blockquote>
                    <button class="bg-gray-900 text-white text-xs px-6 py-2 rounded">BOOK THIS TRIP NOW</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Secondary Image & Testimonial -->
    <section class="bg-white py-12">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-4">
            <div class="md:col-span-2">
                <div class="bg-gray-300 h-80 flex items-center justify-center">
                    <span class="text-gray-500">[Second Image]</span>
                </div>
            </div>

            <div class="bg-gray-100 p-6 rounded shadow-md h-fit">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gray-400 mx-auto mb-4"></div>
                    <p class="text-sm font-bold">M. IHSAN FIRJATULLOH</p>
                    <p class="text-xs text-gray-500">Some Company Name</p>
                    <blockquote class="italic text-xs mt-4 mb-4 text-gray-600">
                        “One morning, when Gregor Samsa woke from troubled dreams...”
                    </blockquote>
                    <button class="bg-gray-900 text-white text-xs px-6 py-2 rounded">BOOK THIS TRIP NOW</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommendation Section -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-xl italic text-center mb-12">You might be interested on these trips too</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="bg-white p-6 shadow rounded">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gray-500"></div>
                            <blockquote class="italic text-sm text-gray-600">
                                “This is a testimonial related to travel, and some dummy text to make it long.”
                            </blockquote>
                        </div>
                        <div class="bg-gray-200 h-40 mb-4"></div>
                        <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">This is title of the travel package that is being featured here.</p>
                        <a href="#" class="text-blue-600 hover:underline text-xs">Read More</a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- About Producer -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-6 px-4">
            <div class="bg-gray-100 p-6">
                <p class="text-gray-800 italic text-sm mb-2">About Producer</p>
                <p class="text-xs text-gray-600">This is a title to explain the product produced or created by the person on the left.</p>
                <a href="#" class="text-xs text-blue-600 hover:underline mt-2 inline-block">Read More</a>
            </div>
            <div class="bg-gray-100 p-6">
                <p class="uppercase text-xs text-gray-500 tracking-wide mb-2">This section is featuring soul section and some text to make title longer.</p>
                <a href="#" class="text-xs text-blue-600 hover:underline">Read More</a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="bg-gray-100 py-10">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h3 class="italic text-lg mb-4">Subscribe to our newsletter</h3>
            <form class="flex flex-col md:flex-row justify-center items-center gap-4">
                <input type="email" placeholder="Enter your email" class="w-full md:w-auto border px-4 py-2 rounded-lg">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        <p>2025 Copyright information goes here.</p>
        <p>Designed by GYT Company</p>
        <div class="mt-4 flex justify-center gap-2">
            @foreach(range(1, 4) as $i)
                <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
            @endforeach
        </div>
    </footer>
</x-app-layout>
