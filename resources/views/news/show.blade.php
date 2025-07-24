<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Nieuwsbericht
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white dark:bg-brew-beige rounded-xl shadow-sm overflow-hidden">
            
            @if ($article->image)
                <img src="{{ asset('storage/news/' . $article->image) }}"
                     alt="{{ $article->title }}"
                     class="w-full h-64 sm:h-80 md:h-96 object-cover">
            @endif

            <div class="p-6 sm:p-8">
                <p class="text-sm text-brew-subtitle mb-2">
                    Gepubliceerd op {{ $article->created_at->format('d/m/Y') }}
                </p>
                
                <h1 class="text-3xl font-bold text-brew-brown dark:text-brew-amber mb-6">
                    {{ $article->title }}
                </h1>

                <div class="text-brew-text prose dark:prose-invert max-w-none">
                    {!! nl2br(e($article->body)) !!}
                </div>

                <div class="mt-10">
                    <a href="{{ route('news.public.index') }}"
                       class="inline-block bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown transition">
                        ← Terug naar het overzicht
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
