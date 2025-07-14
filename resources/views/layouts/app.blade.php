<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pineus Tilu')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Mono:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/fonts.css', 'resources/js/swiper-init.js'])

    <!-- Swiper -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />

    <!-- AOS CSS -->
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">

    <!-- flatpickr CSS -->
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">


    <!-- Custom Font Styles -->
    <style>
        /* Import Custom Fonts */
        @font-face {
            font-family: 'JapaneseBrush';
            src: url("{{ asset('fonts/japanesebrush.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'font-bodyTypewriter';
            src: url("{{ asset('fonts/font-bodytypewriter.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* Global Font Configuration */
        body {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        /* Custom Font Classes */
        .font-heading {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            font-weight: 700;
        }

        .font-body {
            font-family: 'Roboto Mono', 'Consolas', monospace;
        }

        .font-heading {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 700;
        }

        .font-body {
            font-family: 'font-bodyTypewriter', monospace;
        }

        /* Legacy support */
        .font-body {
            font-family: 'font-bodyTypewriter', monospace;
        }
    </style>


</head>

<body class="font-sans antialiased" style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
    <div class="min-h-screen bg-white-100 dark:bg-white-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow dark:bg-white-800 page-content">
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
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <!-- AOS JS -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                AOS.init();
            }, 100);
        });
    </script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
</body>

</html>
