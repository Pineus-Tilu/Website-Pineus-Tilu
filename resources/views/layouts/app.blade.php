<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Get Your Trip') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/fonts.css'])

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Ganti Font -->
    <style>
        @font-face {
            font-family: 'jp_brush';
            src: url("{{ asset('fonts/japanesebrush.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'veterantypewriter';
            src: url("{{ asset('fonts/veterantypewriter.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        .veteran {
            font-family: 'veterantypewriter', sans-serif;
        }
        .jp-brush {
            font-family: 'jp_brush', sans-serif;
        }

        
    </style>
    <!-- Ganti Font -->


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!-- Script untuk dropdown menu -->
    <script>
        // Toggle dropdown menu di desktop
        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown jika klik di luar
            window.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }

        // Toggle mobile menu
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Toggle dropdown di mobile
        const mobileDropdownToggle = document.getElementById('mobile-dropdown-toggle');
        const mobileDropdown = document.getElementById('mobile-dropdown');
        if (mobileDropdownToggle && mobileDropdown) {
            mobileDropdownToggle.addEventListener('click', () => {
                mobileDropdown.classList.toggle('hidden');
            });
        }
    </script>

</body>

</html>
