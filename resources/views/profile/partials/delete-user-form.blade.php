<section class="space-y-6">
    <header>
        <p class="mt-1 text-sm text-brew-subtitle dark:text-brew-brown">
            Als je je account verwijdert, worden al je gegevens permanent verwijderd.
            Zorg ervoor dat je alles hebt opgeslagen wat je wil bewaren.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-brew-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-brew-brown focus:outline-none focus:ring-2 focus:ring-brew-red focus:ring-offset-2 dark:focus:ring-offset-brew-beige transition ease-in-out duration-150"
    >
        Verwijder account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-brew-brown dark:text-brew-amber">
                Weet je het zeker?
            </h2>

            <p class="mt-1 text-sm text-brew-subtitle dark:text-brew-brown">
                Vul je wachtwoord in om je account definitief te verwijderen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Wachtwoord" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Wachtwoord"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuleren
                </x-secondary-button>

                <button
                    type="submit"
                    class="ml-3 inline-flex items-center px-4 py-2 bg-brew-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-brew-brown focus:outline-none focus:ring-2 focus:ring-brew-red focus:ring-offset-2 dark:focus:ring-offset-brew-beige transition ease-in-out duration-150"
                >
                    Verwijder account
                </button>
            </div>
        </form>
    </x-modal>
</section>
