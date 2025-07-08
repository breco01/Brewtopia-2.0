<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-brew-beige px-6">
        <div class="w-full max-w-md space-y-6">
            <h1 class="text-2xl font-bold text-center text-brew-brown dark:text-brew-amber">
                Nieuw wachtwoord instellen
            </h1>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brew-text" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Nieuw wachtwoord')" class="text-brew-text" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" class="text-brew-text" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-primary-button class="bg-brew-amber hover:bg-brew-brown text-white w-full">
                    {{ __('Wachtwoord resetten') }}
                </x-primary-button>
            </form>
        </div>
    </section>
</x-guest-layout>
