<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-cover bg-center h-[400px] flex items-center justify-center text-white text-center px-4" style="background-image: url('/images/contact-hero.jpg');">
        <div class="bg-[#0f172a]/70 p-8 rounded-lg">
            <h1 class="text-5xl md:text-6xl font-bold mb-2 italic">Contact Us</h1>
            <p class="uppercase tracking-wide text-sm text-gray-300">Get in Touch with Our Team</p>
        </div>
    </div>

    <!-- Contact Info Section -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-semibold mb-6 italic">We’re here to help!</h2>
            <p class="text-gray-600 text-sm mb-10">Jika kamu memiliki pertanyaan, keluhan, atau ingin bekerja sama, jangan ragu untuk menghubungi kami melalui informasi di bawah ini.</p>

            <div class="grid md:grid-cols-3 gap-8 text-left">
                <!-- Email -->
                <div class="flex flex-col items-center">
                    <svg class="w-10 h-10 text-blue-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5A2.25 2.25 0 002.25 6.75m19.5 0v.128a2.25 2.25 0 01-1.104 1.921l-7.5 4.5a2.25 2.25 0 01-2.292 0l-7.5-4.5A2.25 2.25 0 012.25 6.878V6.75"/>
                    </svg>
                    <h4 class="font-semibold text-md">Email</h4>
                    <p class="text-sm text-gray-500 mt-1">support@getyourtrip.com</p>
                </div>

                <!-- Phone -->
                <div class="flex flex-col items-center">
                    <svg class="w-10 h-10 text-blue-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 4.5l1.443 2.884a1.5 1.5 0 00.835.73l2.52.84a1.5 1.5 0 011.002 1.15l.38 1.9a1.5 1.5 0 01-.426 1.41L5.7 16.65a16.875 16.875 0 008.65 8.65l3.236-3.236a1.5 1.5 0 011.41-.426l1.9.38a1.5 1.5 0 011.15 1.002l.84 2.52a1.5 1.5 0 00.73.835L19.5 21.75"/>
                    </svg>
                    <h4 class="font-semibold text-md">Telepon</h4>
                    <p class="text-sm text-gray-500 mt-1">+62 812-3456-7890</p>
                </div>

                <!-- Address -->
                <div class="flex flex-col items-center">
                    <svg class="w-10 h-10 text-blue-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 2.25c3.727 0 6.75 3.023 6.75 6.75 0 3.727-3.023 9.472-6.75 12.75C8.273 18.472 5.25 12.727 5.25 9c0-3.727 3.023-6.75 6.75-6.75z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"/>
                    </svg>
                    <h4 class="font-semibold text-md">Alamat</h4>
                    <p class="text-sm text-gray-500 mt-1">Jl. Wisata No. 88, Bandung, Jawa Barat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        <p>2025 &copy; GETYOURTRIP.COM</p>
        <p>Designed by GYT Company</p>
    </footer>
</x-app-layout>
