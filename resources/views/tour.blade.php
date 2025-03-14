<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-cover bg-center h-[500px] flex items-center justify-center text-white text-center px-4" style="background-image: url('/images/tour-hero.jpg');">
        <div class="bg-[#0f172a]/70 p-6 rounded-lg">
            <h1 class="text-5xl font-bold mb-4 italic">Explore Our Amazing Tours</h1>
            <p class="uppercase tracking-wide text-sm text-gray-300">Your adventure starts here</p>
        </div>
    </div>

    <!-- Tour Content -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Available Tour Packages</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @for($i = 0; $i < 3; $i++)
                    <div class="bg-gray-100 rounded-lg shadow-md p-6">
                        <div class="bg-gray-300 h-40 mb-4 flex items-center justify-center">
                            <span class="text-gray-500">[Tour Image]</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Tour Package Title</h3>
                        <p class="text-sm text-gray-600 mb-4">Short description of the tour package goes here. Something that makes it appealing.</p>
                        <a href="#" class="text-blue-600 text-sm hover:underline">View Details</a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gray-900 text-white py-12 text-center">
        <h2 class="text-2xl font-bold mb-4">Ready for your next adventure?</h2>
        <p class="mb-6">Choose a destination and book your tour with us today!</p>
        <a href="/contact" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">Contact Us</a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        <p>&copy; 2025 GetYourTrip. All rights reserved.</p>
        <p>Designed by GYT Company</p>
    </footer>
</x-app-layout>
