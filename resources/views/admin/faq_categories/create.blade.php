<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Nieuwe FAQ Categorie
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige shadow-sm rounded-xl p-6">

                <form action="{{ route('admin.faq-categories.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-brew-brown dark:text-brew-amber mb-2 font-medium">
                            Naam categorie
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-brew-amber"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.faq-categories.index') }}"
                           class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2 hover:bg-gray-400">Annuleren</a>
                        <button type="submit"
                                class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                            Opslaan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
