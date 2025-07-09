<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Brewtopia') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-brew-beige text-brew-text">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white dark:bg-brew-beige border-b-2 border-brew-amber">
                <div class="max-w-7xl mx-auto px-6 py-8 text-center">
                    <h1 class="text-3xl font-extrabold text-brew-brown dark:text-brew-amber">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        <main class="flex-grow">
            {{ $slot }}
        </main>

        <footer class="mt-12 text-center text-sm text-brew-text py-6 border-t border-brew-amber">
            &copy; {{ now()->year }} Brewtopia. Alle rechten voorbehouden.
        </footer>
    </div>
</body>

</html>