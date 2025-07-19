@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Nieuwsbeheer
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige shadow-sm rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-brew-text">Alle artikels</h3>
                    <a href="{{ route('admin.news.create') }}"
                        class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                        + Nieuw artikel
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
                            <th class="py-2">Titel</th>
                            <th>Datum</th>
                            <th>Inhoud (samenvatting)</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-brew-text">
                        @forelse ($articles as $article)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 font-medium">{{ $article->title }}</td>
                                <td>{{ $article->created_at->format('d/m/Y') }}</td>
                                <td>{{ Str::limit(strip_tags($article->body), 80) }}</td>
                                <td class="flex space-x-2">
                                    <a href="{{ route('admin.news.edit', $article) }}"
                                        class="bg-brew-green text-white px-3 py-1 rounded hover:bg-brew-brown">Bewerk</a>

                                    <form method="POST" action="{{ route('admin.news.destroy', $article) }}"
                                        onsubmit="return confirm('Ben je zeker dat je dit artikel wil verwijderen?');">
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
                                <td colspan="4" class="py-4 text-center text-gray-500">Geen nieuwsartikels gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>