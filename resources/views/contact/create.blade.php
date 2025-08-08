<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Contact
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Naam</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2">
                @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2">
                @error('email') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Onderwerp</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full border rounded p-2">
                @error('subject') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Bericht</label>
                <textarea name="message" rows="5" class="w-full border rounded p-2">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-brew-brown text-white px-4 py-2 rounded hover:bg-brew-amber">
                Verzenden
            </button>
        </form>
    </div>
</x-app-layout>
