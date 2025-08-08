<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Mijn Contactberichten</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse ($messages as $message)
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow">
                    <div class="mb-2">
                        <span class="text-sm text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <h3 class="font-semibold text-gray-800">{{ $message->subject ?? '(Geen onderwerp)' }}</h3>
                    <p class="text-gray-700 whitespace-pre-line mt-2">{{ $message->message }}</p>

                    @if($message->reply_message)
                        <div class="mt-4 bg-gray-100 p-4 rounded-lg border border-brewtopia-accent text-gray-800">
                            <h4 class="font-semibold text-brewtopia-accent mb-1">Antwoord van ons team:</h4>
                            <p class="whitespace-pre-line">{{ $message->reply_message }}</p>
                        </div>
                    @else
                        <p class="mt-4 text-gray-500 italic">Nog geen antwoord ontvangen.</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-600">Je hebt nog geen berichten verzonden via het contactformulier.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
