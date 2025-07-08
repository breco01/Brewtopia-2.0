<x-guest-layout>
    <section class="bg-white dark:bg-brew-beige min-h-screen flex items-center justify-center">
        <div class="max-w-3xl px-6 py-12 text-center">
            <h1 class="text-5xl font-extrabold text-brew-brown dark:text-brew-amber mb-4">
                Welkom bij Brewtopia
            </h1>
<p class="text-lg text-brew-subtitle dark:text-brew-brown mb-8 drop-shadow-sm">
                Dé community voor bierliefhebbers. Ontdek, beoordeel en deel jouw bierervaring.
            </p>

            <div class="flex justify-center space-x-4" F>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-3 bg-brew-amber text-white rounded hover:bg-brew-brown transition">
                        Ga naar Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-brew-amber text-white rounded hover:bg-brew-brown transition">
                        Inloggen
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 border border-brew-amber text-brew-amber rounded hover:bg-brew-amber hover:text-white transition">
                        Registreren
                    </a>
                @endauth
            </div>
        </div>
    </section>
</x-guest-layout>