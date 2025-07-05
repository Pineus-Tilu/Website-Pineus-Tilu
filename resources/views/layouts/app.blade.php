<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pineus Tilu')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/fonts.css', 'resources/js/swiper-init.js'])

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

   

    <!-- AOS CSS -->
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">

    <!-- flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow dark:bg-gray-800 page-content">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show" x-transition.opacity.duration.700ms>
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </main>

        {{-- Footer --}}
        @include('layouts.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <script>
        window.addEventListener('load', function() {
            AOS.init();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>
