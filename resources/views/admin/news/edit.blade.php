<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            Artikel bewerken
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white dark:bg-brew-beige rounded-xl shadow-sm p-8">
            <form method="POST" action="{{ route('admin.news.update', $article) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Titel</label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                        class="w-full rounded border-gray-300 mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-brew-text font-medium">Inhoud</label>
                    <textarea name="body" rows="8" required
                        class="w-full rounded border-gray-300 mt-1">{{ old('body', $article->body) }}</textarea>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.news.index') }}"
                       class="text-brew-amber underline hover:text-brew-brown">
                        Annuleer
                    </a>
                    <button type="submit"
                        class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                        Wijzigingen opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
