<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Gebruiker bewerken
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto bg-white dark:bg-brew-beige rounded-xl shadow-sm p-8">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Naam</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">E-mailadres</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Gebruikersnaam</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Geboortedatum</label>
                    <input type="date" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}"
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Profielfoto</label>
                    @if ($user->profile_picture)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profielfoto"
                                 class="w-24 h-24 object-cover rounded-full">
                        </div>
                    @endif
                    <input type="file" name="profile_picture"
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Over mij</label>
                    <textarea name="about" rows="4" class="w-full rounded border-gray-300 mt-1">{{ old('about', $user->about) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_admin" class="rounded text-brew-brown"
                               {{ $user->is_admin ? 'checked' : '' }}>
                        <span class="ml-2 text-brew-text">Admin rechten</span>
                    </label>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.users.index') }}" class="text-brew-amber underline hover:text-brew-brown">
                        Terug
                    </a>
                    <button type="submit"
                        class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown transition">
                        Bewaar wijzigingen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
