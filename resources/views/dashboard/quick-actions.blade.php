@php
    $hasBeerOfTheDay  = isset($beerOfTheDay) && $beerOfTheDay;
    $hasLastReview    = isset($lastReview) && $lastReview;
    $hasPublicProfile = isset($user) && !empty($user->username);
@endphp

<div class="bg-white dark:bg-brew-beige rounded-2xl p-6 border border-brew-amber/30 shadow-sm">
    <div class="flex items-center gap-3 mb-5">
        {{-- icoon: bolt --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brew-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 13.5 12 3l.75 6H18l-6 12 .75-6H7.5z"/>
        </svg>
        <h3 class="text-xl font-extrabold">Snelle acties</h3>
    </div>

    {{-- Compacte vier knoppen, geen herhaalde lange rijen --}}
    <div class="grid grid-cols-2 gap-3">
        <a
            @if($hasBeerOfTheDay)
                href="{{ route('beers.public.show', $beerOfTheDay) }}"
            @else
                href="{{ route('beers.public.index') }}"
            @endif
            class="flex flex-col items-center gap-2 rounded-xl border border-brew-amber/30 p-4 hover:border-brew-brown hover:bg-brew-amber/10 transition text-center"
        >
            {{-- star --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.5l2.06 4.18 4.61.67-3.33 3.25.79 4.59-4.13-2.17-4.13 2.17.79-4.59L4.36 8.35l4.61-.67L11.48 3.5z"/>
            </svg>
            <div class="text-sm font-semibold">Bier van de dag</div>
            <div class="text-xs opacity-70 line-clamp-1">
                {{ $hasBeerOfTheDay ? $beerOfTheDay->name : 'Kies & beoordeel' }}
            </div>
        </a>

        <a href="{{ route('beers.public.index') }}"
           class="flex flex-col items-center gap-2 rounded-xl border border-brew-amber/30 p-4 hover:border-brew-brown hover:bg-brew-amber/10 transition text-center">
            {{-- beaker --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 2.25v3.5c0 .41-.17.81-.47 1.1L5.8 9.5a4.5 4.5 0 00-1.3 3.18V17.25A4.5 4.5 0 009 21.75h6a4.5 4.5 0 004.5-4.5v-4.57a4.5 4.5 0 00-1.3-3.18l-2.73-2.64c-.3-.29-.47-.69-.47-1.1v-3.5"/>
            </svg>
            <div class="text-sm font-semibold">Alle bieren</div>
            <div class="text-xs opacity-70">Ontdek & review</div>
        </a>

        <a href="{{ route('news.public.index') }}"
           class="flex flex-col items-center gap-2 rounded-xl border border-brew-amber/30 p-4 hover:border-brew-brown hover:bg-brew-amber/10 transition text-center">
            {{-- newspaper --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h6M12 10.5h6M3 7.5h6M3 10.5h6M3 6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v9A2.25 2.25 0 0118.75 18H5.25A2.25 2.25 0 013 15.75v-9z"/>
            </svg>
            <div class="text-sm font-semibold">Nieuws</div>
            <div class="text-xs opacity-70">Top 3 artikels</div>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="flex flex-col items-center gap-2 rounded-xl border border-brew-amber/30 p-4 hover:border-brew-brown hover:bg-brew-amber/10 transition text-center">
            {{-- user --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9A3.75 3.75 0 1112 5.25 3.75 3.75 0 0115.75 9zM4.5 19.5a7.5 7.5 0 0115 0"/>
            </svg>
            <div class="text-sm font-semibold">Profiel</div>
            <div class="text-xs opacity-70">{{ $hasPublicProfile ? 'Publiek profiel klaar' : 'Vul je profiel aan' }}</div>
        </a>
    </div>

    {{-- Secundaire links onderaan (zonder herhaling) --}}
    <div class="mt-4 flex flex-wrap gap-4 text-sm">
        @if($hasLastReview)
            <a href="{{ route('beers.public.show', $lastReview->beer) }}" class="text-brew-amber hover:text-brew-brown underline">
                Laatste review bewerken
            </a>
        @endif
        <a href="{{ route('contact.overzicht') }}" class="text-brew-amber hover:text-brew-brown underline">
            Mijn berichten
        </a>
        @if($hasPublicProfile)
            <a href="{{ route('public.profile', $user->username) }}" class="text-brew-amber hover:text-brew-brown underline">
                Publiek profiel
            </a>
        @endif
    </div>
</div>
