<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Laatste nieuws
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            @forelse ($articles as $article)
                <div class="bg-white dark:bg-brew-beige rounded-xl overflow-hidden shadow-sm border border-brew-amber">
                    <div class="relative h-56 sm:h-64 md:h-72 lg:h-80 overflow-hidden">
                        <img src="{{ asset('storage/news/' . $article->image) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                            <h3 class="text-2xl sm:text-3xl font-bold text-white p-4">
                                {{ $article->title }}
                            </h3>
                        </div>
                    </div>

                    <div class="p-6">
                        <p class="text-sm text-brew-subtitle mb-2">
                            Gepubliceerd op {{ $article->created_at->format('d/m/Y') }}
                        </p>
                        <p class="text-brew-text mb-4">
                            {{ Str::limit(strip_tags($article->content), 200) }}
                        </p>
                        <a href="{{ route('news.public.show', $article) }}"
                            class="inline-block bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown transition">
                            Lees meer →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Er zijn momenteel geen nieuwsartikelen beschikbaar.</p>
            @endforelse

            <div>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>