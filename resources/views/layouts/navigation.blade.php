<nav class="bg-white dark:bg-brew-beige border-b border-brew-amber shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Linkerkant: Dashboard titel -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}"
                    class="text-xl font-bold text-brew-brown dark:text-brew-amber hover:underline">
                    Dashboard
                </a>

                <a href="{{ route('news.public.index') }}"
                    class="text-md font-medium {{ request()->routeIs('news.public.*') ? 'underline text-brew-amber' : 'text-brew-brown dark:text-brew-amber hover:underline' }}">
                    Nieuws
                </a>

            </div>

            <!-- Rechterkant: User dropdown -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative">
                        <button onclick="document.getElementById('dropdown-menu').classList.toggle('hidden')"
                            class="flex items-center text-brew-brown dark:text-brew-amber font-medium focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="dropdown-menu"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-brew-beige border border-brew-amber rounded shadow-lg hidden z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm hover:bg-brew-amber/10 text-brew-text">Profiel</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm hover:bg-brew-amber/10 text-brew-text">
                                    Uitloggen
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('dropdown-menu');
        if (dropdown && !event.target.closest('button') && !event.target.closest('#dropdown-menu')) {
            dropdown.classList.add('hidden');
        }
    });
</script>