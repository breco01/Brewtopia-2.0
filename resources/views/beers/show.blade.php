<x-app-layout>
    <x-slot name="header">
        {{ $beer->name }}
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Hero: info + afbeelding --}}
        <div class="p-5 rounded-2xl border border-brew-amber/30 bg-white dark:bg-brew-beige shadow-sm">
            <div class="flex items-start gap-5">
                <img
                    src="{{ $beer->image_url }}"
                    alt="Label van {{ $beer->name }}"
                    class="w-28 h-28 object-contain rounded-lg border border-brew-amber/20 shrink-0"
                    loading="lazy"
                >

                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-brew-brown dark:text-brew-amber">{{ $beer->name }}</h1>
                    <div class="opacity-80">
                        {{ $beer->brewery }} · {{ $beer->style }}
                        @if($beer->abv) · {{ $beer->abv }}% ABV @endif
                    </div>

                    @php
                        $avgSafe   = $avg ?? ($beer->averageRating ? $beer->averageRating() : ($beer->reviews->avg('rating') ?? 0));
                        $countSafe = $count ?? ($beer->reviews_count ?? $beer->reviews->count());
                    @endphp

                    <div class="mt-2">
                        Gemiddeld: <strong>{{ number_format($avgSafe, 1) }}/5</strong> ({{ $countSafe }} reviews)
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="p-5 rounded-2xl border border-brew-amber/30 bg-white dark:bg-brew-beige shadow-sm">
                <h2 class="font-semibold text-lg mb-3">
                    {{ $userReview ? 'Bewerk je review' : 'Schrijf een review' }}
                </h2>

                @if(session('success'))
                    <div class="p-3 rounded bg-green-100 text-green-800 mb-3">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('reviews.store', $beer) }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium mb-1">Score (0–5)</label>
                        <div class="flex items-center gap-3">
                            <input
                                type="range"
                                name="rating"
                                min="0"
                                max="5"
                                step="0.5"
                                value="{{ old('rating', optional($userReview)->rating ?? 3) }}"
                                oninput="document.getElementById('ratingOutput').value = this.value"
                                class="w-full"
                            />
                            <output id="ratingOutput">{{ old('rating', optional($userReview)->rating ?? 3) }}</output>
                        </div>
                        @error('rating') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Commentaar (optioneel)</label>
                        <textarea
                            name="comment"
                            rows="4"
                            class="w-full rounded border p-2"
                            placeholder="Wat vond je ervan?"
                        >{{ old('comment', optional($userReview)->comment) }}</textarea>
                        @error('comment') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-2">
                        <button class="px-4 py-2 rounded-xl bg-black text-white dark:bg-brew-brown">Opslaan</button>
                    </div>
                </form>

                @if($userReview)
                    <form method="POST" action="{{ route('reviews.destroy', $beer) }}" class="mt-3">
                        @csrf @method('DELETE')
                        <button class="text-sm opacity-80 hover:opacity-100 underline">Verwijder mijn review</button>
                    </form>
                @endif
            </div>
        @endauth

        <div class="p-5 rounded-2xl border border-brew-amber/30 bg-white dark:bg-brew-beige shadow-sm">
            <h2 class="font-semibold text-lg mb-3">Alle reviews</h2>

            <div class="space-y-4">
                @forelse($beer->reviews as $review)
                    <div class="border rounded p-3">
                        <div class="text-sm opacity-80">
                            {{ optional($review->user)->username ?: optional($review->user)->name ?: 'Anonieme gebruiker' }}
                            — {{ number_format($review->rating, 1) }}/5
                        </div>
                        @if($review->comment)
                            <p class="mt-1">{{ $review->comment }}</p>
                        @endif
                        <div class="text-xs opacity-60 mt-1">{{ $review->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <p class="opacity-70">Nog geen reviews. Wees de eerste!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
