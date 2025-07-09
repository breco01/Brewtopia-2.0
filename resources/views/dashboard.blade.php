<x-app-layout>
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
