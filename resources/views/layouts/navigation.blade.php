<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
  <div class="container mx-auto px-4 pt-2 pb-4 relative">
    <!-- Top Bar -->
    <div class="flex justify-between text-sm text-gray-500">
      <a href="/faq" class="hover:text-blue-600">FAQ</a>
      <div class="flex items-center space-x-4">
        <!-- Icon Cart -->
        <a href="/cart" class="hover:text-blue-600" aria-label="Cart">
          <svg class="w-9 h-9" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.293 2.293a1 1 0 00.217 1.32l.09.068a1 1 0 001.32-.217L9 15h6l1.293 1.464a1 1 0 001.32.217l.09-.068a1 1 0 00.217-1.32L17 13M9 21h.01M15 21h.01"/>
          </svg>
        </a>

        <!-- Profile Dropdown -->
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 focus:outline-none">
              <!-- Icon Profile diperbesar -->
              <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                   xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.735 6.879 2.004M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </button>
          </x-slot>
          <x-slot name="content">
            <x-dropdown-link href="/profile">Profil</x-dropdown-link>
            <x-dropdown-link href="/settings">Pengaturan</x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Keluar
                </button>
            </form>
          </x-slot>
        </x-dropdown>
      </div>
    </div>

    <!-- Logo -->
    <div class="text-center mt-4 mb-2">
      <a href="/dashboard" class="text-2xl font-semibold text-gray-700">
        GET<span class="text-blue-600">YOURTRIP</span>.COM
      </a>
    </div>

    <!-- Main Navigation -->
    <ul class="flex justify-center space-x-8 text-gray-700 font-medium mb-2">
    <li>
        <a href="/dashboard"
        class="hover:text-blue-600 {{ request()->is('dashboard') ? 'border-b-2 border-blue-600 text-blue-600' : '' }} border-transparent border-b-2 pb-1">
        HOME
        </a>
    </li>
    <li>
        <a href="/tour"
            class="hover:text-blue-600 {{ request()->is('tour') ? 'border-b-2 border-blue-600 text-blue-600' : '' }} border-transparent border-b-2 pb-1">
            TOUR
        </a>
    </li>
    <li>
        <a href="/about"
        class="hover:text-blue-600 {{ request()->is('about') ? 'border-b-2 border-blue-600 text-blue-600' : '' }} border-transparent border-b-2 pb-1">
        ABOUT
        </a>
    </li>
    <li>
        <a href="/review"
        class="hover:text-blue-600 {{ request()->is('review') ? 'border-b-2 border-blue-600 text-blue-600' : '' }} border-transparent border-b-2 pb-1">
        REVIEW
        </a>
    </li>
    <li>
        <a href="/contact"
        class="hover:text-blue-600 {{ request()->is('contact') ? 'border-b-2 border-blue-600 text-blue-600' : '' }} border-transparent border-b-2 pb-1">
        CONTACT
        </a>
    </li>
    </ul>
  </div>
</nav>
