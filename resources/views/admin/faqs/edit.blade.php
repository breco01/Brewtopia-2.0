<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-brew-brown dark:text-brew-amber leading-tight">
            FAQ Vraag Bewerken
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brew-beige shadow-sm rounded-xl p-6">

                <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="question" class="block text-brew-brown dark:text-brew-amber mb-2 font-medium">
                            Vraag
                        </label>
                        <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-brew-amber"
                               required>
                        @error('question')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="answer" class="block text-brew-brown dark:text-brew-amber mb-2 font-medium">
                            Antwoord
                        </label>
                        <textarea name="answer" id="answer" rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-brew-amber"
                                  required>{{ old('answer', $faq->answer) }}</textarea>
                        @error('answer')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="faq_category_id" class="block text-brew-brown dark:text-brew-amber mb-2 font-medium">
                            Categorie
                        </label>
                        <select name="faq_category_id" id="faq_category_id"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-brew-amber"
                                required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ $faq->faq_category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faq_category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.faqs.index') }}"
                           class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2 hover:bg-gray-400">Annuleren</a>
                        <button type="submit"
                                class="bg-brew-amber text-white px-4 py-2 rounded hover:bg-brew-brown">
                            Bijwerken
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
