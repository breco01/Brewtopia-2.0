<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Welkom terug, {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    @include('dashboard.overview')
    @include('dashboard.quick-actions')
    @include('dashboard.beer-of-the-day')
    @include('dashboard.latest-articles')
</x-app-layout>
