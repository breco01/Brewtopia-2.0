<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Gebruikersbeheer
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige overflow-hidden shadow-sm sm:rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-brew-text">Alle gebruikers</h3>
                    <a href="{{ route('admin.users.create') }}"
                       class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                        + Nieuwe gebruiker
                    </a>
                </div>
                @if (session('error'))
                    <div class="mb-4 text-red-700 bg-red-100 p-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
         
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
                            <th>Admin</th>
                            <th>Aangemaakt op</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-brew-text">
                        @forelse ($users as $user)
                            <tr class="border-b border-gray-200">
                                <td class="py-2">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.users.toggleAdmin', $user) }}">
                                        @csrf
                                        @method('PATCH')
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" onchange="this.form.submit()" class="sr-only peer"
                                                {{ $user->is_admin ? 'checked' : '' }}>
                                            <div class="w-10 h-5 bg-gray-300 rounded-full peer peer-checked:bg-brew-amber relative transition-all duration-300">
                                                <div class="absolute left-1 top-1 bg-white w-3 h-3 rounded-full peer-checked:translate-x-5 transition-all duration-300"></div>
                                            </div>
                                        </label>
                                    </form>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="flex space-x-2 py-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                    class="px-4 py-2 bg-brew-green text-white rounded hover:bg-green-700 transition">
                                        Bewerk
                                    </a>

                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Ben je zeker dat je deze gebruiker wil verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-brew-red text-white rounded hover:bg-red-700 transition">
                                            Verwijder
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">Geen gebruikers gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
