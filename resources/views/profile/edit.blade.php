<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Profielinstellingen
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Profielinformatie bijwerken --}}
            <div class="bg-white dark:bg-brew-beige shadow-sm sm:rounded-xl p-6 sm:p-10">
                <h3 class="text-2xl font-extrabold mb-6 text-brew-brown dark:text-brew-amber">Profielgegevens</h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Wachtwoord bijwerken --}}
            <div class="bg-white dark:bg-brew-beige shadow-sm sm:rounded-xl p-6 sm:p-10">
                <h3 class="text-2xl font-extrabold mb-6 text-brew-brown dark:text-brew-amber">Wachtwoord wijzigen</h3>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Account verwijderen --}}
            <div class="bg-white dark:bg-brew-beige shadow-sm sm:rounded-xl p-6 sm:p-10">
                <h3 class="text-2xl font-extrabold mb-6 text-brew-brown dark:text-brew-amber">Account verwijderen</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
