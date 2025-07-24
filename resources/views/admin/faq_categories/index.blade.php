<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            FAQ-categoriebeheer
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige shadow-sm rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-brew-text">Alle categorieën</h3>
                    <a href="{{ route('admin.faq-categories.create') }}"
                        class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                        + Nieuwe categorie
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-left text-brew-subtitle border-b border-gray-300">
                            <th class="py-2">Naam</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-brew-text">
                        @forelse ($categories as $category)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 font-medium">{{ $category->name }}</td>
                                <td class="flex space-x-2">
                                    <a href="{{ route('admin.faq-categories.edit', $category) }}"
                                        class="bg-brew-green text-white px-3 py-1 rounded hover:bg-brew-brown">Bewerk</a>

                                    <form method="POST" action="{{ route('admin.faq-categories.destroy', $category) }}"
                                        onsubmit="return confirm('Ben je zeker dat je deze categorie wil verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-brew-red text-white px-3 py-1 rounded hover:bg-red-800">
                                            Verwijder
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-4 text-center text-gray-500">Geen categorieën gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
