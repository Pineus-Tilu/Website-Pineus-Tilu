<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-cover bg-center h-[500px] flex items-center justify-center text-white text-center px-4" style="background-image: url('/images/review-hero.jpg');">
        <div class="bg-[#0f172a]/70 p-8 rounded-lg">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 italic">What People Say</h1>
            <p class="uppercase tracking-wide text-sm text-gray-300">Traveler Testimonials</p>
        </div>
    </div>

    <!-- Reviews Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-center text-2xl font-semibold mb-12 italic">Real Experiences from Real Travelers</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ([
                    ['name' => 'Amanda Lee', 'company' => 'Digital Nomad', 'quote' => 'The journey was magical! The place, the people, the vibe – everything was just unforgettable.', 'img' => ''],
                    ['name' => 'John Smith', 'company' => 'Backpacker', 'quote' => 'A must-visit destination! I enjoyed every moment there.', 'img' => ''],
                    ['name' => 'Sarah Kim', 'company' => 'Photographer', 'quote' => 'Perfect scenery for photography, and the experience was incredibly smooth.', 'img' => ''],
                    ['name' => 'Eko Prasetyo', 'company' => 'Travel Blogger', 'quote' => 'Pelayanannya sangat ramah dan terorganisir. Recommended banget!', 'img' => ''],
                    ['name' => 'Lina Mardiana', 'company' => 'Content Creator', 'quote' => 'Tempatnya indah banget, cocok buat healing dan bikin konten.', 'img' => ''],
                    ['name' => 'Andi Rahman', 'company' => 'Solo Traveler', 'quote' => 'Saya pergi sendirian tapi merasa aman dan nyaman selama trip berlangsung.', 'img' => ''],
                ] as $review)
                    <div class="bg-gray-100 p-6 rounded shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-gray-400 rounded-full"></div>
                            <div>
                                <p class="font-semibold text-sm">{{ $review['name'] }}</p>
                                <p class="text-xs text-gray-500">{{ $review['company'] }}</p>
                            </div>
                        </div>
                        <blockquote class="italic text-gray-700 text-sm">“{{ $review['quote'] }}”</blockquote>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gray-100 py-12">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-xl font-semibold italic mb-4">Ready to start your own adventure?</h3>
            <p class="text-sm text-gray-600 mb-6">Join countless happy travelers and discover something unforgettable.</p>
            <a href="/tour" class="bg-gray-900 text-white px-6 py-3 rounded-lg text-sm hover:bg-gray-800">View Our Tours</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        <p>2025 &copy; GETYOURTRIP.COM</p>
        <p>Designed by GYT Company</p>
    </footer>
</x-app-layout>
