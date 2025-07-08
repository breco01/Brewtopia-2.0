<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-brew-beige overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-brew-text">
                <h3 class="text-lg font-bold mb-4">Welkom terug, {{ Auth::user()->name }}!</h3>
                <p class="mb-2">
                    Je bent sinds <strong>{{ Auth::user()->created_at->format('d/m/Y') }}</strong> lid van Brewtopia.
                </p>
                <p class="mb-2">
                    Je hebt <strong>12 bieren</strong> beoordeeld en <strong>3 artikels</strong> gelezen.
                </p>
                <p class="mb-2">
                    Laatste login:
                    <strong>
                        {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('d/m/Y H:i') : 'Onbekend' }}
                    </strong>
                </p>
            </div>
        </div>
    </div>
</div>
