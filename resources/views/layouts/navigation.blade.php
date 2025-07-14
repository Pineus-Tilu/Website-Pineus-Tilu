<nav class="fixed top-0 left-0 z-50 w-full bg-white shadow-sm" x-data="{ mobileOpen: false }">
    <div class="flex items-center justify-between w-full px-4 py-4 sm:px-6 lg:px-20">

        <!-- Logo -->
        <div class="flex items-center">
            <a href="/">
                <img src="/images/logo.png" alt="Logo" class="h-[80px] object-contain" />
            </a>
        </div>

        <!-- Menu Desktop -->
        <ul
            class="hidden md:flex items-center space-x-6 lg:space-x-8 text-[18px] lg:text-[20px] font-medium text-green-800"
            style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 500;">
            
            <li>
                <a href="/" class="{{ request()->is('/') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Beranda</a>
            </li>

            <!-- Dropdown Fasilitas - Desktop (klik baru muncul) -->
            <li class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center hover:underline underline-offset-4 focus:outline-none">
                    Fasilitas
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul x-show="open" x-transition @click.away="open = false"
                    class="absolute left-0 z-50 mt-2 w-52 bg-white border rounded shadow-md text-green-800 text-[18px]"
                    style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
                    @foreach ($areas as $area)
                        <li>
                            <a href="/fasilitas/{{ \Str::slug($area->name) }}"
                                class="block px-4 py-2 hover:bg-gray-100">
                                {{ $area->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li>
                <a href="/ulasan" class="{{ request()->is('ulasan') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Ulasan</a>
            </li>
            <li>
                <a href="/tentang" class="{{ request()->is('tentang') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Tentang</a>
            </li>
            <li>
                <a href="/reservasi" class="{{ request()->is('reservasi') ? 'underline underline-offset-4 font-semibold' : 'hover:underline underline-offset-4' }}">Reservasi</a>
            </li>

            @guest
                <li>
                    <a href="/login"
                        class="px-4 py-2 text-white bg-[#006C43] rounded-md hover:bg-green-700">Login/Register</a>
                </li>
            @endguest

            @auth
                <li class="relative" x-data="{ userMenuOpen: false }">
                    <button @click="userMenuOpen = !userMenuOpen"
                        class="flex items-center px-4 py-2 text-white bg-[#006C43] rounded-md hover:bg-green-700 focus:outline-none">
                        {{ Auth::user()->name }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <ul x-show="userMenuOpen" x-transition @click.away="userMenuOpen = false"
                        class="absolute right-0 z-50 mt-2 w-48 bg-white border rounded shadow-md text-green-800 text-[16px] font-body">
                        <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-left hover:bg-gray-100">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
        </ul>

        <!-- Tombol Mobile -->
        <button @click="mobileOpen = !mobileOpen" class="text-green-800 focus:outline-none md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-transition class="px-4 pt-2 pb-4 space-y-2 text-green-800 bg-white border-t md:hidden font-body">
        <a href="/" class="block hover:underline">Beranda</a>
        <!-- Mobile Dropdown Fasilitas -->
        <div x-data="{ open: false }">
            <button @click="open = !open" type="button" class="flex items-center w-full text-left hover:underline">
                Fasilitas
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition class="mt-1 ml-4 space-y-1">
                @foreach ($areas as $area)
                    <a href="/fasilitas/{{ \Str::slug($area->name) }}"
                        class="block hover:underline" @click="open = false">
                        {{ $area->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <a href="/ulasan" class="block hover:underline">Ulasan</a>
        <a href="/tentang" class="block hover:underline">Tentang</a>
        <a href="/reservasi" class="block hover:underline">Reservasi</a>

        @guest
            <a href="/login"
                class="inline-block px-4 py-2 text-white bg-[#006C43] rounded-md hover:bg-green-700">Login/Register</a>
        @endguest

        @auth
            <div class="pt-2 space-y-1 border-t">
                <p class="font-semibold">{{ Auth::user()->name }}</p>
                <a href="{{ route('profile.edit') }}" class="block hover:underline">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left hover:underline">Logout</button>
                </form>
            </div>
        @endauth
    </div>
</nav>
