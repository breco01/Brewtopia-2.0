<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Brewtopia') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white text-gray-800 dark:bg-brew-beige dark:text-brew-text font-sans">

    <header class="border-b border-brew-amber shadow-sm bg-white">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-brew-brown hover:text-brew-amber transition">
                Brewtopia
            </a>
            <nav class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brew-amber transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-brew-amber transition">Registreren</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="mt-16 text-center text-sm text-brew-text py-6 border-t border-brew-amber">
        &copy; {{ now()->year }} Brewtopia. Alle rechten voorbehouden.
    </footer>
</body>
</html>
