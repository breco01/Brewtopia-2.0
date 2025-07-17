<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Gebruiker bewerken
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto bg-white dark:bg-brew-beige rounded-xl shadow-sm p-8">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Naam</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Nieuw wachtwoord <span class="text-sm text-gray-500">(optioneel)</span></label>
                    <input type="password" name="password"
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_admin" class="rounded text-brew-brown"
                            {{ $user->is_admin ? 'checked' : '' }}>
                        <span class="ml-2 text-brew-text">Admin rechten</span>
                    </label>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.users.index') }}" class="text-brew-amber underline hover:text-brew-brown">Terug</a>
                    <button type="submit"
                        class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                        Bewaar wijzigingen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
