@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            FAQ-beheer
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige shadow-sm rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-brew-text">Alle vragen</h3>
                    <a href="{{ route('admin.faqs.create') }}"
                        class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                        + Nieuwe vraag
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
                            <th class="py-2">Vraag</th>
                            <th>Categorie</th>
                            <th>Antwoord (kort)</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-brew-text">
                        @forelse ($faqs as $faq)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 font-medium">{{ Str::limit($faq->question, 50) }}</td>
                                <td>{{ $faq->category->name ?? 'Onbekend' }}</td>
                                <td>{{ Str::limit(strip_tags($faq->answer), 80) }}</td>
                                <td class="flex space-x-2">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                                        class="bg-brew-green text-white px-3 py-1 rounded hover:bg-brew-brown">Bewerk</a>

                                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}"
                                        onsubmit="return confirm('Ben je zeker dat je deze vraag wil verwijderen?');">
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
                                <td colspan="4" class="py-4 text-center text-gray-500">Geen FAQ-vragen gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
