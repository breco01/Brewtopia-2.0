<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-brew-text mb-4">Gebruikersbeheer</h3>
                <p class="text-brew-subtitle mb-4">Bekijk, wijzig of maak gebruikers aan.</p>
                <a href="{{ route('admin.users.index') }}" class="text-brew-amber underline hover:text-brew-brown">Naar
                    gebruikersbeheer</a>
            </div>

            <div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-brew-text mb-4">Nieuwsbeheer</h3>
                <p class="text-brew-subtitle mb-4">Beheer alle nieuwsberichten op de site.</p>
                <a href="{{ route('admin.news.index') }}" class="text-brew-amber underline hover:text-brew-brown">Naar
                    nieuwsbeheer</a>
            </div>

            <div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-brew-text mb-4">FAQ Beheer</h3>
                <p class="text-brew-subtitle mb-4">Beheer vragen, antwoorden en categorieën.</p>
                <a href="{{ route('admin.faqs.index') }}" class="text-brew-amber underline hover:text-brew-brown">Naar
                    FAQ-beheer</a>
            </div>

            <div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-brew-text mb-4">Contactformulieren</h3>
                <p class="text-brew-subtitle mb-4">Bekijk en beantwoord berichten van bezoekers.</p>
                <a href="{{ route('admin.contact.index') }}"
                    class="text-brew-amber underline hover:text-brew-brown">Naar berichten</a>
            </div>

        </div>
    </div>
</x-app-layout>