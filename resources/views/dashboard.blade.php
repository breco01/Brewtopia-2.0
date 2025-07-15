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

</x-app-layout>