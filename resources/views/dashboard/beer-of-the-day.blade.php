@php
    use Illuminate\Support\Facades\Storage;

    $src = ($beerOfTheDay && $beerOfTheDay->image && Storage::disk('public')->exists('beers/'.$beerOfTheDay->image))
        ? Storage::url('beers/'.$beerOfTheDay->image)
        : asset('images/beer-placeholder.png');
@endphp

<div class="bg-white dark:bg-brew-beige rounded-2xl p-6 border border-brew-amber/30 shadow-sm">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            {{-- icoon: sparkles --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brew-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 5.5 12 3l2.187 2.5L17 7l-2.813 1.5L12 11l-2.187-2.5L7 7l2.813-1.5zM5 15l1.5-2 1.5 2 2 1-2 1-1.5 2L5 17l-2-1 2-1zM15.5 14l1-1.5L18 14l1.5 1-1.5 1-1 1.5-1-1.5L14 15l1.5-1z"/>
            </svg>
            <h3 class="text-xl font-extrabold">Bier van de dag</h3>
        </div>
        @if($beerOfTheDay)
            <a href="{{ route('beers.public.show', $beerOfTheDay) }}" class="text-brew-amber hover:text-brew-brown underline text-sm">Bekijk</a>
        @endif
    </div>

    @if($beerOfTheDay)
        <div class="flex items-center gap-5">
            <img src="{{ $src }}" alt="{{ $beerOfTheDay->name }}" class="w-24 h-24 object-contain rounded-lg border border-brew-amber/20">
            <div class="flex-1">
                <div class="text-lg font-semibold text-brew-brown">
                    {{ $beerOfTheDay->name }} <span class="opacity-70">— {{ $beerOfTheDay->style }}</span>
                </div>
                <div class="text-sm opacity-80">
                    {{ $beerOfTheDay->brewery }}@if($beerOfTheDay->abv) · {{ $beerOfTheDay->abv }}% ABV @endif
                </div>
            </div>
            <a href="{{ route('beers.public.show', $beerOfTheDay) }}"
               class="px-4 py-2 rounded-xl border-2 border-brew-amber text-brew-amber font-semibold hover:border-brew-brown hover:text-brew-brown hover:bg-brew-amber/10 transition">
                Beoordeel
            </a>
        </div>
    @else
        <div class="text-brew-amber/60 italic">Geen bieren beschikbaar.</div>
    @endif
</div>
