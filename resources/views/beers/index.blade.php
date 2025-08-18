<x-app-layout>
    <x-slot name="header">
        Bieren
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-4">
        <div class="grid md:grid-cols-2 gap-4">
            @forelse($beers as $beer)
                <a href="{{ route('beers.public.show', $beer) }}" class="block p-4 rounded-xl border hover:shadow">
                    <div class="text-lg font-semibold">{{ $beer->name }}</div>
                    <div class="text-sm opacity-80">{{ $beer->brewery }} · {{ $beer->style }}</div>
                    <div class="mt-2 text-sm">
                        Gemiddeld: {{ number_format($beer->averageRating() ?? 0, 1) }} / 5 ({{ $beer->reviews_count }} reviews)
                    </div>
                </a>
            @empty
                <p class="text-sm opacity-70">Nog geen bieren gevonden.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
