<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Brewtopia') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-brew-text">

    <!-- 🔁 Achtergrondvideo + donkere overlay -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <video autoplay muted loop class="w-full h-full object-cover brightness-75">
            <source src="{{ asset('videos/brew-background.mp4') }}" type="video/mp4">
            Je browser ondersteunt deze video niet.
        </video>
        <div class="absolute inset-0 bg-black/40 mix-blend-multiply"></div>
    </div>

    <!-- Pagina inhoud -->
    <div class="min-h-screen flex flex-col justify-between">

        <!-- Header met transparante styling -->
        <header class="px-6 py-4 flex justify-between items-center bg-transparent text-white z-10 relative">
            <h1 class="text-2xl font-bold">Brewtopia</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                   class="hover:text-brew-amber transition font-semibold">Login</a>
                <a href="{{ route('register') }}"
                   class="hover:text-brew-amber transition font-semibold">Registreren</a>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-grow z-10 relative">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="text-center text-sm text-white py-6 z-10 relative bg-transparent">
            &copy; {{ now()->year }} Brewtopia. Alle rechten voorbehouden.
        </footer>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const video = document.querySelector("video");
        if (video) {
            video.playbackRate = 0.5;
        }
    });
</script>

</body>
</html>
