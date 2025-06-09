<nav class="fixed top-0 left-0 z-50 w-full bg-white shadow-sm">
    <div class="flex items-center justify-between w-full px-4 py-4 sm:px-20">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="/images/logo.png" alt="Logo" class="h-[100px]" />
        </div>

        <!-- Desktop Menu -->
        <ul class="items-center hidden space-x-8 text-[22px] font-medium text-green-800 font-typewriter md:flex">
            <li>
                <a href="/" class="{{ request()->is('/') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">
                    Beranda
                </a>
            </li>

            <!-- Dropdown klik -->
            <li class="relative">
                <button id="dropdownToggle" class="flex items-center hover:underline underline-offset-4 focus:outline-none ">
                    Fasilitas
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul id="dropdownMenu" class="absolute left-0 z-50 hidden w-48 mt-2 space-y-2 text-sm text-green-800 bg-white border rounded shadow-md text-[22px] font-typewriter">
                    <li><a href="/fasilitas/pineus-tilu-1" class="block px-4 py-2 hover:bg-gray-100">Pineus Tilu I</a></li>
                    <li><a href="/fasilitas/pineus-tilu-2" class="block px-4 py-2 hover:bg-gray-100">Pineus Tilu II</a></li>
                    <li><a href="/fasilitas/pineus-tilu-3" class="block px-4 py-2 hover:bg-gray-100">Pineus Tilu III</a></li>
                    <li><a href="/fasilitas/pineus-tilu-4" class="block px-4 py-2 hover:bg-gray-100">Pineus Tilu IV</a></li>
                </ul>
            </li>

            <li><a href="/ulasan" class="{{ request()->is('ulasan') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Ulasan</a></li>
            <li><a href="/tentang" class="{{ request()->is('tentang') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Tentang</a></li>
            <li><a href="/reservasi" class="{{ request()->is('reservasi') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Reservasi</a></li>
            <li>
                <a href="/login" class="px-4 py-2 text-white transition bg-[#006C43] rounded-md hover:bg-green-700">Login/Register</a>
            </li>
        </ul>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="mobile-menu-toggle" class="text-green-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden px-4 pt-2 pb-4 space-y-2 text-green-800 bg-white border-t md:hidden font-typewriter">
        <a href="/" class="block hover:underline">Beranda</a>

        <!-- Mobile Dropdown -->
        <div class="space-y-1">
            <button id="mobile-dropdown-toggle" class="flex items-center w-full text-left hover:underline">
                Fasilitas
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="mobile-dropdown" class="hidden ml-4 space-y-1">
                <a href="/fasilitas/pineus-tilu-1" class="block hover:underline">Pineus Tilu I</a>
                <a href="/fasilitas/pineus-tilu-2" class="block hover:underline">Pineus Tilu II</a>
                <a href="/fasilitas/pineus-tilu-3" class="block hover:underline">Pineus Tilu III</a>
                <a href="/fasilitas/pineus-tilu-4" class="block hover:underline">Pineus Tilu IV</a>
            </div>
        </div>

        <a href="/ulasan" class="block hover:underline">Ulasan</a>
        <a href="/tentang" class="block hover:underline">Tentang</a>
        <a href="/reservasi" class="block hover:underline">Reservasi</a>
        <a href="/login" class="inline-block px-4 py-2 text-white bg-[#006C43] rounded-md hover:bg-green-700">Login/Register</a>
    </div>
</nav>
