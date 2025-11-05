{{-- En-tête du site --}}
<header class="sticky top-0 z-50 glass-card border-b border-white/10" x-data="{ mobileMenuOpen:false }">
    {{-- Lien d’évitement pour l’accessibilité --}}
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[60] bg-cosmos-bg/80 px-3 py-2 rounded">
        Aller au contenu
    </a>

    <nav class="container mx-auto px-4 py-4 flex items-center justify-between" aria-label="Navigation principale">
        {{-- Logo / Marque --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="Aller à l’accueil">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cosmos-accent-violet to-cosmos-accent-turquoise p-0.5">
                <div class="w-full h-full rounded-full bg-cosmos-bg flex items-center justify-center">
          <span class="text-lg font-bold bg-gradient-to-r from-cosmos-accent-violet to-cosmos-accent-turquoise bg-clip-text text-transparent">
            N
          </span>
                </div>
            </div>
            <span class="font-semibold text-lg transition-colors group-hover:text-cosmos-accent-turquoise">Noferu</span>
        </a>

        {{-- Menu desktop --}}
        <ul class="hidden md:flex items-center gap-8">
            <li>
                <a
                    href="{{ route('home') }}"
                    class="transition-colors hover:text-cosmos-accent-turquoise {{ Route::is('home') ? 'text-cosmos-accent-turquoise' : '' }}"
                    aria-current="{{ Route::is('home') ? 'page' : 'false' }}"
                >Accueil</a>
            </li>
            <li>
                <a
                    href="{{ route('projects.index') }}"
                    class="transition-colors hover:text-cosmos-accent-turquoise {{ Route::is('projects.*') ? 'text-cosmos-accent-turquoise' : '' }}"
                    aria-current="{{ Route::is('projects.*') ? 'page' : 'false' }}"
                >Projets</a>
            </li>
            <li>
                <a
                    href="{{ route('about') }}"
                    class="transition-colors hover:text-cosmos-accent-turquoise {{ Route::is('about') ? 'text-cosmos-accent-turquoise' : '' }}"
                    aria-current="{{ Route::is('about') ? 'page' : 'false' }}"
                >À propos</a>
            </li>
            <li>
                <a
                    href="{{ route('contact.create') }}"
                    class="btn-primary text-sm"
                >Contact</a>
            </li>
        </ul>

        {{-- Bouton mobile (Alpine.js) --}}
        <button
            type="button"
            class="md:hidden p-2 rounded hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-cosmos-accent-turquoise/60"
            aria-controls="mobile-menu"
            :aria-expanded="mobileMenuOpen.toString()"
            @click="mobileMenuOpen = !mobileMenuOpen"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span class="sr-only">Ouvrir le menu</span>
        </button>
    </nav>

    {{-- Menu mobile --}}
    <div
        id="mobile-menu"
        class="md:hidden border-t border-white/10"
        x-show="mobileMenuOpen"
        x-transition
    >
        <ul class="px-4 py-3 space-y-2">
            <li>
                <a
                    href="{{ route('home') }}"
                    class="block px-3 py-2 rounded hover:bg-white/5 {{ Route::is('home') ? 'text-cosmos-accent-turquoise' : '' }}"
                    aria-current="{{ Route::is('home') ? 'page' : 'false' }}"
                    @click="mobileMenuOpen=false"
                >Accueil</a>
            </li>
            <li>
                <a
                    href="{{ route('projects.index') }}"
                    class="block px-3 py-2 rounded hover:bg-white/5 {{ Route::is('projects.*') ? 'text-cosmos-accent-turquoise' : '' }}"
                    aria-current="{{ Route::is('projects.*') ? 'page' : 'false' }}"
                    @click="mobileMenuOpen=false"
                >Projets</a>
            </li>
            <li>
                <a
                    href="{{ route('about') }}"
                    class="block px-3 py-2 rounded hover:bg-white/5 {{ Route::is('about') ? 'text-cosmos-accent-turquoise' : '' }}"
                    aria-current="{{ Route::is('about') ? 'page' : 'false' }}"
                    @click="mobileMenuOpen=false"
                >À propos</a>
            </li>
            <li>
                <a
                    href="{{ route('contact.create') }}"
                    class="block px-3 py-2 rounded btn-primary text-center"
                    @click="mobileMenuOpen=false"
                >Contact</a>
            </li>
        </ul>
    </div>
</header>
