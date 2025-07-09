<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-brew-beige shadow-sm sm:rounded-xl overflow-hidden">
            <div class="px-6 py-8 sm:p-10 text-brew-text">
                <h3 class="text-2xl font-extrabold mb-6">Laatste Artikels</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Artikelkaartje -->
                    @foreach ($articles ?? [] as $article)
                        <a href="{{ route('articles.show', $article) }}"
                           class="block bg-white dark:bg-brew-beige border-2 border-brew-amber rounded-xl p-6 shadow transition duration-200 hover:border-brew-brown hover:text-brew-brown hover:bg-brew-amber/10">
                            <h4 class="text-lg font-semibold mb-2">{{ $article->title }}</h4>
                            <p class="text-sm opacity-80 line-clamp-3">{{ Str::limit($article->excerpt ?? $article->body, 100) }}</p>
                            <div class="mt-4 text-xs text-brew-amber opacity-80">
                                Geplaatst op {{ $article->created_at->format('d/m/Y') }}
                            </div>
                        </a>
                    @endforeach

                    @if (empty($articles) || count($articles) === 0)
                        <div class="col-span-full text-center text-sm text-brew-amber/60 italic">
                            Er zijn nog geen artikels beschikbaar.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>