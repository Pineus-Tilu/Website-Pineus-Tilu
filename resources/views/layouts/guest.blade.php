<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title', 'Pineus Tilu Riverside Camping Ground')</title>
    
    <!-- Favicon/Logo -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/fonts.css'])

    <!-- Custom Fonts -->
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

        .font-typewriter {
            font-family: 'veterantypewriter', sans-serif;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</body>
</html>