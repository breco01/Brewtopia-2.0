<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-brew-beige px-6">
        <div class="w-full max-w-md space-y-6">
            <h1 class="text-2xl font-bold text-center text-brew-brown dark:text-brew-amber">
                Bevestig je wachtwoord
            </h1>

            <p class="text-sm text-brew-text dark:text-gray-300 text-center">
                Dit is een beveiligde zone. Bevestig je wachtwoord om verder te gaan.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="password" :value="__('Wachtwoord')" class="text-brew-text" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <x-primary-button class="bg-brew-amber hover:bg-brew-brown text-white w-full">
                    {{ __('Bevestigen') }}
                </x-primary-button>
            </form>
        </div>
    </section>
</x-guest-layout>
