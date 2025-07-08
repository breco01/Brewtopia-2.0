<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-brew-beige shadow-sm sm:rounded-xl overflow-hidden">
            <div class="px-6 py-8 sm:p-10 text-brew-text">
                <h3 class="text-2xl font-extrabold mb-6">Snelle Acties</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    
                    <!-- Bier beoordelen -->
                    <a href="#"
                        class="group flex flex-col items-center justify-center text-center px-6 py-8 bg-brew-amber text-white rounded-xl shadow-md hover:bg-brew-brown transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6M9 7h6m-3 10a9 9 0 100-18 9 9 0 000 18z" />
                        </svg>
                        <h4 class="text-lg font-semibold mb-1">Bier beoordelen</h4>
                        <p class="text-sm opacity-90">Voeg een nieuwe beoordeling toe</p>
                    </a>

                    <!-- Artikels -->
                    <a href="#"
                        class="group flex flex-col items-center justify-center text-center px-6 py-8 bg-brew-amber text-white rounded-xl shadow-md hover:bg-brew-brown transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 4H5m14-8H5m4 12h6" />
                        </svg>
                        <h4 class="text-lg font-semibold mb-1">Lees artikels</h4>
                        <p class="text-sm opacity-90">Ontdek nieuwe bierinzichten</p>
                    </a>

                    <!-- Profiel -->
                    <a href="{{ route('profile.edit') }}"
                        class="group flex flex-col items-center justify-center text-center px-6 py-8 bg-brew-amber text-white rounded-xl shadow-md hover:bg-brew-brown transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.992 4.992 0 0112 15a4.992 4.992 0 016.879 2.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                        </svg>
                        <h4 class="text-lg font-semibold mb-1">Profiel</h4>
                        <p class="text-sm opacity-90">Beheer je accountinstellingen</p>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
