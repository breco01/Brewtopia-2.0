<x-app-layout>
    <x-slot name="header">Bieren</x-slot>

    <div class="max-w-5xl mx-auto space-y-4">
        <div class="grid md:grid-cols-2 gap-4">
            @foreach($beers as $beer)
                <a href="{{ route('beers.public.show', $beer) }}"
                    class="group block p-4 rounded-xl border hover:shadow flex items-center gap-4">
                    <div class="flex-1">
                        <div class="text-lg font-semibold group-hover:underline">{{ $beer->name }}</div>
                        <div class="text-sm opacity-80">{{ $beer->brewery }} · {{ $beer->style }}</div>
                        <div class="mt-2 text-sm">
                            Gemiddeld: {{ number_format($beer->averageRating(), 1) }} / 5 ({{ $beer->reviews_count }}
                            reviews)
                        </div>
                    </div>

                    <div class="w-20 h-20 md:w-24 md:h-24 shrink-0">
                        <img src="{{ asset('images/beers/' . \Illuminate\Support\Str::of($beer->name)->ascii()->studly() . '.jpg') }}"
                            alt="Label van {{ $beer->name }}" class="w-28 h-28 object-cover rounded-lg border shrink-0"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('images/beer-placeholder.png') }}';" />
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>