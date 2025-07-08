<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-brew-beige px-6">
        <div class="w-full max-w-md space-y-6">
            <h1 class="text-2xl font-bold text-center text-brew-brown dark:text-brew-amber">
                Wachtwoord vergeten?
            </h1>

            <p class="text-sm text-center text-brew-text dark:text-brew-brown leading-relaxed">
                Geen probleem. Vul hieronder je e-mailadres in, dan sturen we je een link om een nieuw wachtwoord in te stellen.
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brew-text" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex justify-center">
                    <x-primary-button class="bg-brew-amber hover:bg-brew-brown text-white px-6 py-2">
                        {{ __('Stuur reset-link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
