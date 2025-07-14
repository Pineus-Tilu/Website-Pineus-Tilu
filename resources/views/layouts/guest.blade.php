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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Mono:wght@300;400;500;700&display=swap" rel="stylesheet">

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

        /* Custom Fonts */
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

        .font-typewriter {
            font-family: 'font-bodyTypewriter', monospace;
        }

        /* Legacy support */
        .font-body {
            font-family: 'font-bodyTypewriter', monospace;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased" style="font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
    {{ $slot }}
</body>
</html>
