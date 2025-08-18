<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Gebruikers
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($users->isEmpty())
                <div class="bg-white dark:bg-brew-beige rounded-xl p-8 text-center border border-brew-amber/40">
                    <p class="text-brew-text">Er zijn nog geen publieke profielen.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($users as $u)
                        @php
                            $avatar = $u->profile_picture
                                ? asset('storage/' . ltrim($u->profile_picture, '/'))
                                : asset('images/avatar-placeholder.png');
                        @endphp

                        <div class="bg-white dark:bg-brew-beige rounded-2xl border border-brew-amber/30 shadow-sm p-5 text-center">
                            <a href="{{ route('public.profile', $u->username) }}" class="inline-block">
                                <img
                                    src="{{ $avatar }}"
                                    alt="Profielfoto van {{ $u->name }}"
                                    class="w-24 h-24 rounded-full object-cover border border-brew-amber/30 mx-auto"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('images/avatar-placeholder.png') }}';"
                                >
                            </a>

                            <div class="mt-4">
                                <a href="{{ route('public.profile', $u->username) }}"
                                   class="inline-block px-3 py-1.5 rounded-lg border-2 border-brew-amber text-brew-amber font-medium hover:border-brew-brown hover:text-brew-brown hover:bg-brew-amber/10 transition">
                                    Bekijk profiel
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
