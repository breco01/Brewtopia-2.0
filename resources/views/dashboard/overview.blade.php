<div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm">
    <h3 class="text-2xl font-extrabold mb-6">Overzicht</h3>

    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Lid sinds</span>
            <span class="font-semibold">{{ $user->created_at->format('d/m/Y') }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Bieren beoordeeld</span>
            <span class="font-semibold">
                {{ $user->reviews_count }}
            </span>
        </div>

        {{-- Optioneel: toon gemiddelde score die de gebruiker geeft --}}
        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Gemiddelde score (mijn reviews)</span>
            <span class="font-semibold">
                {{ $user->reviews_count > 0 ? number_format($avgGiven, 1) . ' / 5' : '—' }}
            </span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Artikels gelezen</span>
            <span class="font-semibold">3</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Laatste login</span>
            <span class="font-semibold">
                {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Onbekend' }}
            </span>
        </div>
    </div>

    {{-- Optioneel: laatste review samenvatting --}}
    @if($lastReview)
        <div class="mt-6 p-4 rounded-lg border dark:border-brew-brown/30">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-brew-text font-medium">Laatste review</div>
                    <a href="{{ route('beers.public.show', $lastReview->beer) }}"
                       class="font-semibold hover:underline">
                        {{ $lastReview->beer->name }}
                    </a>
                    <div class="text-sm opacity-80">
                        {{ number_format($lastReview->rating, 1) }} / 5
                        · {{ $lastReview->created_at->diffForHumans() }}
                    </div>
                    @if($lastReview->comment)
                        <p class="mt-2 text-sm">{{ $lastReview->comment }}</p>
                    @endif
                </div>
                <a href="{{ route('beers.public.index') }}"
                   class="text-brew-amber hover:text-brew-brown underline ml-4 whitespace-nowrap">
                    Bekijk alle bieren
                </a>
            </div>
        </div>
    @else
        {{-- Aanmoediging als er nog geen reviews zijn --}}
        <div class="mt-6 p-4 rounded-lg border dark:border-brew-brown/30 flex items-center justify-between">
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

    @php
        $profielVolledig = !empty($user->username) && !empty($user->birthdate) && !empty($user->about) && !empty($user->profile_picture);
    @endphp

    @if ($profielVolledig)
        <div class="flex justify-between items-center mt-6">
            <span class="text-brew-text font-medium">Publiek profiel</span>
            <a href="{{ route('public.profile', $user->username) }}"
               class="text-brew-amber hover:text-brew-brown underline">
                brewtopia.test/profiel/{{ $user->username }}
            </a>
        </div>
    @endif
</div>
