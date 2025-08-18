@php
    $sinceDays       = $user->created_at->diffInDays();
    $lastLoginHuman  = $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Onbekend';
    $profielVolledig = filled($user->username) && filled($user->birthdate) && filled($user->about) && filled($user->profile_picture);
@endphp

<div class="bg-white dark:bg-brew-beige rounded-2xl p-6 border border-brew-amber/30 shadow-sm">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            {{-- icoon: chart --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brew-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 19.5h18M6.75 10.5v6M12 7.5v9M17.25 13.5v3"/>
            </svg>
            <h3 class="text-xl font-extrabold">Overzicht</h3>
        </div>
        @if ($profielVolledig)
            <a href="{{ route('public.profile', $user->username) }}"
               class="text-brew-amber hover:text-brew-brown underline text-sm">
                Publiek profiel
            </a>
        @endif
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="p-4 rounded-xl border border-brew-amber/30 bg-white/60 dark:bg-white/5 text-center">
            <div class="text-2xl font-extrabold">{{ $user->reviews_count }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Reviews</div>
        </div>
        <div class="p-4 rounded-xl border border-brew-amber/30 bg-white/60 dark:bg-white/5 text-center">
            <div class="text-2xl font-extrabold">{{ $user->reviews_count > 0 ? number_format($avgGiven, 1) : '—' }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Gem. score</div>
        </div>
        <div class="p-4 rounded-xl border border-brew-amber/30 bg-white/60 dark:bg-white/5 text-center">
            <div class="text-2xl font-extrabold">{{ $sinceDays }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Dagen lid</div>
        </div>
        <div class="p-4 rounded-xl border border-brew-amber/30 bg-white/60 dark:bg-white/5 text-center">
            <div class="text-sm font-semibold">{{ $lastLoginHuman }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Laatste login</div>
        </div>
    </div>

    {{-- Laatste review / call-to-action --}}
    @if($lastReview)
        <div class="p-4 rounded-xl border border-brew-amber/30 bg-white/70 dark:bg-white/5 flex items-start justify-between gap-4">
            <div>
                <div class="text-brew-text font-medium">Laatste review</div>
                <a href="{{ route('beers.public.show', $lastReview->beer) }}" class="font-semibold hover:underline">
                    {{ $lastReview->beer->name }}
                </a>
                <div class="text-sm opacity-80">
                    {{ number_format($lastReview->rating, 1) }} / 5 · {{ $lastReview->created_at->diffForHumans() }}
                </div>
                @if($lastReview->comment)
                    <p class="mt-2 text-sm">{{ $lastReview->comment }}</p>
                @endif
            </div>
            <a href="{{ route('beers.public.index') }}"
               class="self-center px-4 py-2 rounded-xl border-2 border-brew-amber text-brew-amber font-semibold hover:border-brew-brown hover:text-brew-brown hover:bg-brew-amber/10 transition">
                Bekijk bieren
            </a>
        </div>
    @else
        <div class="p-4 rounded-xl border border-brew-amber/30 flex items-center justify-between">
            <div>
                <div class="text-brew-text font-medium">Nog geen reviews</div>
                <div class="text-sm opacity-80">Start met je eerste beoordeling via de bierenlijst.</div>
            </div>
            <a href="{{ route('beers.public.index') }}"
               class="px-4 py-2 rounded-xl bg-black text-white dark:bg-brew-brown">
                Beoordeel een bier
            </a>
        </div>
    @endif
</div>
