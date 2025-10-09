<nav x-data="{ open: false }" class="bg-amber-50 border-b border-amber-200">
    {{-- BARRE PRINCIPALE (desktop) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">

            {{-- GAUCHE : LOGO + NOM --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('accueil') }}" class="flex items-center gap-2">
                    {{-- Logo image si dispo --}}
                    @php $logo = asset('img/brand/logo-woodycraft.svg'); @endphp
                    <img src="{{ $logo }}" alt="WoodyCraft" class="h-8 w-auto hidden sm:block">
                    {{-- Fallback si pas d’image --}}
                    <span class="sm:hidden inline-block h-8 w-8 rounded-full bg-[var(--wc-primary)]"></span>

                    <span class="hidden sm:inline font-semibold text-[var(--wc-primary-dark)]">
                        WoodyCraft
                    </span>
                </a>
            </div>

            {{-- CENTRE : ONGLETS principaux --}}
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('accueil') }}"
                   class="px-4 py-2 rounded-md text-sm font-semibold
                   {{ request()->routeIs('accueil') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                    ACCUEIL
                </a>

                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 rounded-md text-sm font-semibold
                   {{ request()->routeIs('categories.*') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                    CATÉGORIES
                </a>

                @auth
                    <a href="{{ route('panier.index') }}"
                       class="px-4 py-2 rounded-md text-sm font-semibold
                       {{ request()->routeIs('panier.*') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                        PANIER
                    </a>

                    <a href="{{ route('commandes.index') }}"
                       class="px-4 py-2 rounded-md text-sm font-semibold
                       {{ request()->routeIs('commandes.*') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                        MES COMMANDES
                    </a>
                @endauth
            </div>

            {{-- DROITE : PANIER + AUTH --}}
            <div class="hidden sm:flex items-center gap-3">
                {{-- PANIER avec badge --}}
                @auth
                    @php
                        $cart = \App\Models\Panier::where('user_id', Auth::id())
                            ->where('statut', 0)
                            ->withCount('lignes')
                            ->first();
                        $count = $cart->lignes_count ?? 0;
                    @endphp

                    <a href="{{ route('panier.index') }}"
                       class="relative inline-flex items-center gap-2 px-3 py-2 rounded-full border border-amber-200 text-[var(--wc-primary-dark)] hover:bg-amber-100"
                       title="Mon panier">
                        {{-- Icône panier --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 9m12-9l2 9M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span class="text-sm font-semibold">Panier</span>

                        @if($count > 0)
                            <span class="absolute top-0 right-0 translate-x-1 -translate-y-1 bg-[var(--wc-danger)] text-white text-[11px] font-bold rounded-full px-1 min-w-[18px] text-center leading-4">
                                {{ $count }}
                            </span>
                        @endif
                    </a>
                @endauth

                {{-- Invité : Connexion / Inscription --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-md text-sm font-semibold bg-[var(--wc-primary)] text-white hover:bg-[var(--wc-primary-dark)]">
                        CONNEXION
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 rounded-md text-sm font-semibold border border-[var(--wc-primary)] text-[var(--wc-primary-dark)] hover:bg-amber-100">
                        INSCRIPTION
                    </a>
                @endguest

                {{-- Connecté : menu utilisateur --}}
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-amber-200 text-[var(--wc-primary-dark)] hover:bg-amber-100">
                                <span class="text-sm font-semibold">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                            <x-dropdown-link :href="route('commandes.index')">Mes commandes</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Déconnexion
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- BURGER (mobile) --}}
            <div class="md:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-[var(--wc-primary-dark)] hover:bg-amber-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t border-amber-200">
        <div class="px-4 py-3 space-y-2 bg-amber-50">
            <a href="{{ route('accueil') }}"
               class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('accueil') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                Accueil
            </a>
            <a href="{{ route('categories.index') }}"
               class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('categories.*') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                Catégories
            </a>

            @auth
                <a href="{{ route('panier.index') }}"
                   class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('panier.*') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                    Panier
                </a>
                <a href="{{ route('commandes.index') }}"
                   class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('commandes.*') ? 'bg-[var(--wc-primary)] text-white' : 'text-[var(--wc-primary-dark)] hover:bg-amber-100' }}">
                    Mes commandes
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 rounded-md font-semibold bg-[var(--wc-primary)] text-white">Connexion</a>
                <a href="{{ route('register') }}"
                   class="block px-3 py-2 rounded-md font-semibold border border-[var(--wc-primary)] text-[var(--wc-primary-dark)]">Inscription</a>
            @endguest
        </div>

        @auth
            <div class="border-t border-amber-200 px-4 py-3 bg-amber-50">
                <div class="font-medium text-[var(--wc-primary-dark)]">{{ Auth::user()->name }}</div>
                <div class="text-sm text-[var(--wc-primary)]">{{ Auth::user()->email }}</div>
                <div class="mt-3 space-y-2">
                    <a href="{{ route('profile.edit') }}"
                       class="block px-3 py-2 rounded-md text-[var(--wc-primary-dark)] hover:bg-amber-100">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button class="w-full text-left px-3 py-2 rounded-md text-[var(--wc-primary-dark)] hover:bg-amber-100">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
