<section>
    <header>
        <p class="mt-1 text-sm text-brew-subtitle dark:text-brew-brown">
            Pas je naam en e-mailadres aan.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 h-full flex flex-col justify-between">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Naam" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="E-mailadres" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-brew-subtitle dark:text-brew-brown">
                    Je e-mailadres is nog niet geverifieerd.
                    <button form="send-verification" class="underline text-brew-amber hover:text-brew-brown">
                        Klik hier om de bevestigingsmail opnieuw te versturen.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Er is een nieuwe bevestigingslink verzonden.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Opslaan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-brew-subtitle dark:text-brew-brown">Opgeslagen.</p>
            @endif
        </div>
    </form>
</section>
