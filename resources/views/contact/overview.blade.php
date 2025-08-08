<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Contacteer ons
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Succesmelding na verzenden --}}
            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg"
                    role="alert"
                >
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Contactformulier --}}
            <div class="bg-white dark:bg-brew-beige rounded-xl overflow-hidden shadow-sm border border-brew-amber">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-brew-text mb-4">Nieuw bericht</h3>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="subject" class="block text-sm font-medium text-brew-text">Onderwerp</label>
                            <input
                                type="text"
                                name="subject"
                                id="subject"
                                value="{{ old('subject') }}"
                                class="mt-1 block w-full rounded-md border-brew-amber focus:border-brew-brown focus:ring-brew-brown shadow-sm"
                            >
                            @error('subject')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-brew-text">Bericht</label>
                            <textarea
                                name="message"
                                id="message"
                                rows="5"
                                class="mt-1 block w-full rounded-md border-brew-amber focus:border-brew-brown focus:ring-brew-brown shadow-sm"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-brew-brown hover:bg-brew-amber text-white font-medium px-4 py-2 rounded-lg shadow-sm transition">
                                Verstuur bericht
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Verzonden berichten --}}
            @forelse ($messages as $message)
                <div class="bg-white dark:bg-brew-beige rounded-xl overflow-hidden shadow-sm border border-brew-amber">
                    <div class="p-6 space-y-4">
                        <div class="text-sm text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</div>
                        <h4 class="font-semibold text-lg text-brew-brown dark:text-brew-amber">
                            {{ $message->subject ?? '(Geen onderwerp)' }}
                        </h4>
                        <p class="text-brew-text whitespace-pre-line">{{ $message->message }}</p>

                        @if($message->reply_message)
                            <div class="bg-brew-amber bg-opacity-20 p-4 rounded-md border border-brew-amber text-brew-text">
                                <h5 class="font-semibold text-brew-brown dark:text-brew-amber mb-1">
                                    Antwoord van ons team:
                                </h5>
                                <p class="whitespace-pre-line">{{ $message->reply_message }}</p>
                            </div>
                        @else
                            <p class="italic text-brew-subtitle">Nog geen antwoord ontvangen.</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Je hebt nog geen berichten verzonden via het contactformulier.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
