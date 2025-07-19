<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Artikel: {{ $article->title }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white dark:bg-brew-beige rounded-xl shadow-sm p-8">
            <h3 class="text-3xl font-bold text-brew-text mb-4">{{ $article->title }}</h3>
            <p class="text-brew-subtitle mb-6 text-sm">
                Gepubliceerd op {{ $article->created_at->format('d/m/Y H:i') }}
            </p>

            <div class="prose max-w-none text-brew-text">
                {!! nl2br(e($article->body)) !!}
            </div>

            <div class="mt-8">
                <a href="{{ route('admin.news.index') }}"
                   class="text-brew-amber underline hover:text-brew-brown">
                    ← Terug naar overzicht
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
