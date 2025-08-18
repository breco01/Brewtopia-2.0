<div class="bg-white dark:bg-brew-beige rounded-2xl p-6 border border-brew-amber/30 shadow-sm">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            {{-- icoon: newspaper --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brew-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5h6M3 10.5h6M12 7.5h6M12 10.5h6M5.25 4.5h13.5A2.25 2.25 0 0121 6.75v9A2.25 2.25 0 0118.75 18H5.25A2.25 2.25 0 013 15.75v-9A2.25 2.25 0 015.25 4.5z"/>
            </svg>
            <h3 class="text-xl font-extrabold">Laatste nieuws</h3>
        </div>
        <a href="{{ route('news.public.index') }}" class="text-brew-amber hover:text-brew-brown underline text-sm">Alles</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($latestNews as $item)
            <a href="{{ route('news.public.show', $item) }}"
               class="block rounded-xl border border-brew-amber/30 bg-white dark:bg-brew-beige p-5 hover:border-brew-brown hover:bg-brew-amber/10 transition">
                <h4 class="text-base font-semibold mb-1">{{ $item->title }}</h4>
                <p class="text-sm opacity-80 line-clamp-3">
                    {{ \Illuminate\Support\Str::limit($item->excerpt ?? $item->body, 120) }}
                </p>
                <div class="mt-3 text-xs text-brew-amber opacity-80">
                    {{ $item->created_at->format('d/m/Y') }}
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-sm text-brew-amber/60 italic">
                Er zijn nog geen nieuwsberichten beschikbaar.
            </div>
        @endforelse
    </div>
</div>
