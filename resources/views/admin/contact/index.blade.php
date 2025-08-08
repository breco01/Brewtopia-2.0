<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Contactformulieren
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige shadow-sm rounded-xl p-6">
                <h3 class="text-2xl font-extrabold text-brew-text mb-4">Alle berichten</h3>

                @if (session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-left text-brew-subtitle border-b border-gray-300">
                            <th class="py-2">Naam</th>
                            <th>Email</th>
                            <th>Onderwerp</th>
                            <th>Status</th>
                            <th>Datum</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-brew-text">
                        @forelse ($messages as $message)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 font-medium">{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ Str::limit($message->subject ?? '-', 30) }}</td>
                                <td>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full
                                        @if($message->status == 'new') bg-yellow-200 text-yellow-800
                                        @elseif($message->status == 'read') bg-blue-200 text-blue-800
                                        @elseif($message->status == 'replied') bg-green-200 text-green-800
                                        @else bg-gray-200 text-gray-800
                                        @endif">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </td>
                                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.contact.show', $message) }}"
                                        class="bg-brew-amber text-white px-3 py-1 rounded hover:bg-brew-brown">
                                        Bekijk
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Geen berichten gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>