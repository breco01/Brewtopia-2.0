<x-guest-layout>
    <div class="flex flex-col justify-center items-center text-center flex-grow px-6 py-24">
        <!-- Content -->
        <div class="max-w-3xl z-10">
            <h1 class="text-6xl font-extrabold text-white mb-6 drop-shadow-xl">
                Welkom bij Brewtopia
            </h1>
            <p class="text-xl text-white mb-10 drop-shadow-md">
                Dé community voor bierliefhebbers. Ontdek, beoordeel en deel jouw bierervaring.
            </p>

            <div class="flex justify-center flex-wrap gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-6 py-3 bg-brew-amber text-white rounded hover:bg-brew-brown transition shadow-md">
                        Ga naar Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 bg-brew-amber text-white rounded hover:bg-brew-brown transition shadow-md">
                        Inloggen
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 border border-brew-amber text-brew-amber rounded hover:bg-brew-amber hover:text-white transition shadow-md">
                        Registreren
                    </a>
                @endauth
            </div>
        </div>
    </div>
</x-guest-layout>
