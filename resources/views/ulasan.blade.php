<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-cover bg-center h-[500px] flex items-center justify-center text-white text-center px-4" style="background-image: url('/images/review-hero.jpg');">
        <div class="bg-[#0f172a]/70 p-8 rounded-lg">
            <h1 class="mb-4 text-5xl italic font-bold md:text-6xl">What People Say</h1>
            <p class="text-sm tracking-wide text-gray-300 uppercase">Traveler Testimonials</p>
        </div>
    </div>

    <!-- Reviews Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl px-4 mx-auto">
            <h2 class="mb-12 text-2xl italic font-semibold text-center">Real Experiences from Real Travelers</h2>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ([
                    ['name' => 'Amanda Lee', 'company' => 'Digital Nomad', 'quote' => 'The journey was magical! The place, the people, the vibe – everything was just unforgettable.', 'img' => ''],
                    ['name' => 'John Smith', 'company' => 'Backpacker', 'quote' => 'A must-visit destination! I enjoyed every moment there.', 'img' => ''],
                    ['name' => 'Sarah Kim', 'company' => 'Photographer', 'quote' => 'Perfect scenery for photography, and the experience was incredibly smooth.', 'img' => ''],
                    ['name' => 'Eko Prasetyo', 'company' => 'Travel Blogger', 'quote' => 'Pelayanannya sangat ramah dan terorganisir. Recommended banget!', 'img' => ''],
                    ['name' => 'Lina Mardiana', 'company' => 'Content Creator', 'quote' => 'Tempatnya indah banget, cocok buat healing dan bikin konten.', 'img' => ''],
                    ['name' => 'Andi Rahman', 'company' => 'Solo Traveler', 'quote' => 'Saya pergi sendirian tapi merasa aman dan nyaman selama trip berlangsung.', 'img' => ''],
                ] as $review)
                    <div class="p-6 bg-gray-100 rounded shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-gray-400 rounded-full"></div>
                            <div>
                                <p class="text-sm font-semibold">{{ $review['name'] }}</p>
                                <p class="text-xs text-gray-500">{{ $review['company'] }}</p>
                            </div>
                        </div>
                        <blockquote class="text-sm italic text-gray-700">“{{ $review['quote'] }}”</blockquote>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-gray-100">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="mb-4 text-xl italic font-semibold">Ready to start your own adventure?</h3>
            <p class="mb-6 text-sm text-gray-600">Join countless happy travelers and discover something unforgettable.</p>
            <a href="/tour" class="px-6 py-3 text-sm text-white bg-gray-900 rounded-lg hover:bg-gray-800">View Our Tours</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 text-sm text-center text-gray-400 bg-gray-900">
        <p>2025 &copy; GETYOURTRIP.COM</p>
        <p>Designed by GYT Company</p>
    </footer>
</x-app-layout>
