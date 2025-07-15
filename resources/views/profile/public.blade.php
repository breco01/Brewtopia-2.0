<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige p-8 rounded shadow text-center">

                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                         alt="Profielfoto van {{ $user->username }}"
                         class="w-32 h-32 mx-auto mb-4 rounded-full object-cover shadow-md">
                @endif

                <h1 class="text-3xl font-bold text-brew-brown dark:text-brew-amber mb-2">
                    {{ $user->username ?? $user->name }}
                </h1>

                @if ($user->birthdate)
                    <p class="text-sm text-brew-subtitle dark:text-brew-brown mb-2">
                        Geboren op {{ \Carbon\Carbon::parse($user->birthdate)->locale('nl')->isoFormat('LL') }}
                    </p>
                @endif

                @if ($user->about)
                    <p class="text-base text-brew-text dark:text-white mt-4">
                        {{ $user->about }}
                    </p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
