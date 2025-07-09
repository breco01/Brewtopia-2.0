<section>
    <header>
        <p class="mt-1 text-sm text-brew-subtitle dark:text-brew-brown">
            Kies een sterk, veilig wachtwoord om je account te beveiligen.
        </p>
    </header>

<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 h-full flex flex-col justify-between">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="Huidig wachtwoord" />
            <x-text-input id="current_password" name="current_password" type="password"
                          class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Nieuw wachtwoord" />
            <x-text-input id="password" name="password" type="password"
                          class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Bevestig nieuw wachtwoord" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                          class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Opslaan</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-brew-subtitle dark:text-brew-brown">Opgeslagen.</p>
            @endif
        </div>
    </form>
</section>
