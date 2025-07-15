<x-app-layout>
    
    @php
        $user = Auth::user();
        $profielOnvolledig = empty($user->username) || empty($user->birthdate) || empty($user->about) || empty($user->profile_picture);
    @endphp

    @if ($profielOnvolledig)
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded relative mb-4 max-w-7xl mx-auto">
            <strong>Profiel onvolledig:</strong> Vul je profiel aan zodat anderen je publieke profiel kunnen zien.
            <a href="{{ route('profile.edit') }}" class="underline hover:text-red-900 font-medium">Klik hier om je profiel
                aan te vullen</a>
        </div>
    @endif


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Welkom terug, {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6">

            @include('dashboard.overview')
            @include('dashboard.quick-actions')

        </div>

        <div class="mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @include('dashboard.beer-of-the-day')
            @include('dashboard.latest-articles')
        </div>
    </div>
    <div class="mt-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-brew-beige p-6 rounded shadow text-center">
            <h3 class="text-lg font-semibold text-brew-brown dark:text-brew-amber mb-2">
                Jouw publieke profiel
            </h3>

            @if (Auth::user()->username)
                <a href="{{ route('public.profile', Auth::user()->username) }}"
                    class="text-brew-amber hover:text-brew-brown font-medium transition">
                    {{ url('/profiel/' . Auth::user()->username) }}
                </a>
            @else
                <p class="text-sm text-brew-subtitle dark:text-brew-brown">
                    Je hebt nog geen gebruikersnaam ingesteld. <br>
                    <a href="{{ route('profile.edit') }}" class="text-brew-amber hover:text-brew-brown underline">
                        Klik hier om je profiel aan te vullen
                    </a>
                </p>
            @endif
        </div>


</x-app-layout>