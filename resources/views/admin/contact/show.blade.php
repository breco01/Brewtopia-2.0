<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Contactformulier bekijken
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-6 space-y-6 border border-gray-200">

                <div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Gegevens van afzender</h3>
                    <p><span class="font-medium text-gray-700">Naam:</span> {{ $message->name }}</p>
                    <p><span class="font-medium text-gray-700">E-mail:</span> {{ $message->email }}</p>
                    @if($message->subject)
                        <p><span class="font-medium text-gray-700">Onderwerp:</span> {{ $message->subject }}</p>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Bericht</h3>
                    <div class="bg-gray-100 p-4 rounded text-gray-900 whitespace-pre-line">
                        {{ $message->message }}
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Antwoord</h3>

                    @if ($errors->any())
                        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                            <p class="font-semibold mb-1">Er trad een fout op bij het verzenden van het antwoord:</p>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.contact.reply', $message) }}" method="POST" class="space-y-4">
                        @csrf

                        <textarea name="reply_message" id="reply_message" rows="6"
                            class="w-full border border-gray-300 rounded-lg p-3 bg-white text-gray-900"
                            placeholder="Typ hier je antwoord...">{{ old('reply_message', $message->reply_message) }}</textarea>

                        @error('reply_message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-brew-brown text-white px-5 py-2 rounded hover:bg-opacity-90 transition">
                                Verstuur antwoord
                            </button>

                            <a href="{{ route('admin.contact.index') }}" class="text-brewtopia-accent hover:underline">
                                ← Terug naar overzicht
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>