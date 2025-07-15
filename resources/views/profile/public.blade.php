<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm space-y-6">

                {{-- Titel --}}
                <h3 class="text-2xl font-extrabold mb-6 text-brew-brown dark:text-brew-amber">
                    Publiek profiel
                </h3>
                {{-- Profielfoto --}}
                @if ($user->profile_picture)
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="Profielfoto van {{ $user->username }}"
                            class="w-32 h-32 rounded-full object-cover shadow-md border-2 border-brew-amber">
                    </div>
                @endif

                {{-- Basisinfo --}}
                <div class="space-y-4 text-brew-text dark:text-brew-brown">
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Naam</span>
                        <span class="font-semibold">{{ $user->name }}</span>
                    </div>

                    @if ($user->username)
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Gebruikersnaam</span>
                            <span class="font-semibold">{{ $user->username }}</span>
                        </div>
                    @endif

                    @if ($user->birthdate)
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Geboortedatum</span>
                            <span class="font-semibold">
                                {{ \Carbon\Carbon::parse($user->birthdate)->locale('nl')->isoFormat('LL') }}
                            </span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <span class="font-medium">Lid sinds</span>
                        <span class="font-semibold">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                {{-- Over mij --}}
                @if ($user->about)
                    <div class="pt-6 border-t border-gray-200 dark:border-white/10">
                        <span class="text-brew-text dark:text-brew-brown font-medium block mb-1">Over mij</span>
                        <p class="font-semibold text-brew-text dark:text-brew-brown leading-relaxed">
                            {{ $user->about }}
                        </p>
                    </div>
                @endif

                {{-- Statistieken (dummy) --}}
                <div
                    class="pt-6 border-t border-gray-200 dark:border-white/10 space-y-4 text-brew-text dark:text-brew-brown">
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Bieren beoordeeld</span>
                        <span class="font-semibold">12</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Artikels gelezen</span>
                        <span class="font-semibold">3</span>
                    </div>
                </div>

                {{-- Optionele terugknop --}}
                <div class="pt-6 text-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-brew-amber hover:text-brew-brown underline font-medium">
                        Terug naar dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>