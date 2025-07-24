<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Veelgestelde Vragen
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            @forelse ($categories as $category)
                <div class="bg-white dark:bg-brew-beige rounded-xl overflow-hidden shadow-sm border border-brew-amber">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-brew-text mb-4">{{ $category->name }}</h3>

                        @forelse ($category->faqs as $faq)
                            <div x-data="{ open: false }" class="mb-4 border-b pb-4">
                                <button @click="open = !open"
                                    class="text-left w-full text-brew-brown dark:text-brew-amber font-medium text-lg hover:underline focus:outline-none">
                                    {{ $faq->question }}
                                </button>

                                <div x-show="open" x-transition class="mt-2 text-brew-text">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        @empty
                            <p class="text-brew-subtitle">Geen vragen in deze categorie.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Er zijn momenteel geen veelgestelde vragen beschikbaar.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
