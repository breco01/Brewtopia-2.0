<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-brew-beige px-6">
        <div class="w-full max-w-md space-y-6">
            <h1 class="text-3xl font-bold text-center text-brew-brown dark:text-brew-amber">Registreren</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Naam')" class="text-brew-text" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brew-text" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Wachtwoord')" class="text-brew-text" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Bevestig Wachtwoord')" class="text-brew-text" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex justify-between items-center mt-4">
                    <a class="text-sm text-brew-amber hover:underline" href="{{ route('login') }}">
                        {{ __('Al een account?') }}
                    </a>

                    <x-primary-button class="bg-brew-amber hover:bg-brew-brown text-white">
                        {{ __('Registreren') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
