<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-brew-beige px-6">
        <div class="w-full max-w-md space-y-6">
            <h1 class="text-3xl font-bold text-center text-brew-brown dark:text-brew-amber">Inloggen</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brew-text" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Wachtwoord')" class="text-brew-text" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-brew-amber shadow-sm focus:ring-brew-brown" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-brew-text">
                        {{ __('Onthoud mij') }}
                    </label>
                </div>

                <div class="flex justify-between items-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-brew-amber hover:underline" href="{{ route('password.request') }}">
                            {{ __('Wachtwoord vergeten?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-brew-amber hover:bg-brew-brown text-white">
                        {{ __('Inloggen') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
