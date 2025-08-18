@php
    $sinceDays = $user->created_at->diffInDays();
    $lastLoginHuman = $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Onbekend';
@endphp

<div class="bg-white dark:bg-brew-beige shadow rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-semibold text-brew-brown mb-4">Welkom terug, {{ $user->name }}!</h2>
    <p class="text-brew-text mb-6">Hier is een snelle blik op je activiteiten binnen Brewtopia.</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl border border-brew-amber/40 text-center">
            <div class="text-2xl font-extrabold">{{ $user->reviews_count }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Reviews</div>
        </div>

        <div class="p-4 rounded-xl border border-brew-amber/40 text-center">
            <div class="text-2xl font-extrabold">
                {{ $user->reviews_count > 0 ? number_format($avgGiven, 1) : '—' }}
            </div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Gem. score</div>
        </div>

        <div class="p-4 rounded-xl border border-brew-amber/40 text-center">
            <div class="text-2xl font-extrabold">{{ $sinceDays }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Dagen lid</div>
        </div>

        <div class="p-4 rounded-xl border border-brew-amber/40 text-center">
            <div class="text-sm font-semibold">{{ $lastLoginHuman }}</div>
            <div class="text-xs uppercase tracking-wide opacity-70 mt-1">Laatste login</div>
        </div>
    </div>

    <p class="text-sm text-gray-500 mt-6">
        Statistieken, badges en persoonlijke inzichten worden verder uitgebreid zodra er meer data is.
    </p>
</div>
