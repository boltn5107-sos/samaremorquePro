<nav id="main-nav" class="sticky top-0 z-50 text-white no-print">
    <div class="backdrop-blur-2xl bg-white/[0.07] border-b border-white/[0.08] shadow-[0_4px_30px_rgba(0,0,0,0.12)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 md:h-[4.25rem] items-center">

                {{-- Logo + Brand --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-gradient-to-br from-orange-500/25 to-orange-600/10 ring-1 ring-orange-400/20 overflow-hidden transition-all duration-300 group-hover:scale-110 group-hover:ring-orange-400/40 group-hover:shadow-lg group-hover:shadow-orange-500/20">
                            <img src="{{ asset('favicon.jpg') }}" alt="{{ config('app.name') }}" class="w-7 h-7 object-contain">
                        </span>
                        <span class="hidden sm:inline font-display text-lg font-bold tracking-tight bg-gradient-to-r from-white to-white/80 bg-clip-text text-transparent">{{ config('app.name') }}</span>
                    </a>

                    @auth
                        <span class="hidden sm:inline-flex items-center gap-1 text-[10px] font-bold bg-gradient-to-r from-orange-500/15 to-orange-600/10 px-2.5 py-1 rounded-full uppercase tracking-wider ring-1 ring-inset ring-orange-400/20 text-orange-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                            @if(Auth::user()->isClient())
                                Client
                            @elseif(Auth::user()->isRemorqueur())
                                Remorqueur
                            @elseif(Auth::user()->isDepanneur())
                                Depanneur
                            @elseif(Auth::user()->isAdmin())
                                Admin
                            @endif
                        </span>
                    @endauth
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-0.5 text-[13px] font-medium">
                    @auth
                        @if(Auth::user()->isClient())
                            <a href="{{ route('client.dashboard') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="dashboard" class="w-4 h-4 opacity-70" /> Tableau de bord
                            </a>
                            <a href="{{ route('client.intervention.create') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="plus" class="w-4 h-4 opacity-70" /> Demander
                            </a>
                        @elseif(Auth::user()->isRemorqueur())
                            <a href="{{ route('remorqueur.dashboard') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="dashboard" class="w-4 h-4 opacity-70" /> Tableau de bord
                            </a>
                            <a href="{{ route('remorqueur.intervention.incoming') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="zap" class="w-4 h-4 opacity-70" /> Demandes
                            </a>
                            <a href="{{ route('remorqueur.intervention.index') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="car" class="w-4 h-4 opacity-70" /> Interventions
                            </a>
                        @elseif(Auth::user()->isDepanneur())
                            <a href="{{ route('depanneur.dashboard') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="dashboard" class="w-4 h-4 opacity-70" /> Tableau de bord
                            </a>
                            <a href="{{ route('depanneur.intervention.incoming') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="zap" class="w-4 h-4 opacity-70" /> Demandes
                            </a>
                            <a href="{{ route('depanneur.intervention.index') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="car" class="w-4 h-4 opacity-70" /> Interventions
                            </a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="dashboard" class="w-4 h-4 opacity-70" /> Admin
                            </a>
                            <a href="{{ route('admin.intervention.index') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="car" class="w-4 h-4 opacity-70" /> Interventions
                            </a>
                            <a href="{{ route('admin.professionnels.index') }}" class="px-3.5 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200 flex items-center gap-1.5">
                                <x-icon name="user" class="w-4 h-4 opacity-70" /> Pros
                            </a>
                        @endif

                        {{-- Notifications --}}
                        <a href="{{ route('notifications.index') }}" class="relative ml-1 p-2.5 rounded-xl hover:bg-white/[0.08] transition-all duration-200 group">
                            <x-icon name="bell" class="w-5 h-5 text-white/60 group-hover:text-white transition-colors" />
                            <span id="unread-badge" class="{{ Auth::user()->unread_notifications_count > 0 ? '' : 'hidden' }} absolute top-1 right-1 min-w-[16px] h-4 px-1 bg-gradient-to-r from-red-500 to-red-600 text-white text-[9px] font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/40 ring-2 ring-night">
                                {{ Auth::user()->unread_notifications_count }}
                            </span>
                        </a>

                        {{-- User Dropdown --}}
                        <div class="relative ml-1" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
                            <button @click="open = !open" class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-white/[0.08] transition-all duration-200 group" aria-haspopup="true" :aria-expanded="open.toString()">
                                <span class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400/30 to-orange-600/20 flex items-center justify-center text-xs font-bold overflow-hidden ring-1 ring-orange-400/30 transition-all duration-200 group-hover:ring-orange-400/50 group-hover:shadow-md group-hover:shadow-orange-500/20">
                                    @if(Auth::user()->photo)
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                                    @endif
                                </span>
                                <span class="hidden lg:inline text-white/70 group-hover:text-white text-sm transition-colors">{{ Auth::user()->first_name }}</span>
                                <svg class="w-3.5 h-3.5 text-white/40 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 rounded-2xl bg-slate-900/95 backdrop-blur-xl border border-white/10 shadow-2xl shadow-black/40 py-1.5 z-50" style="display:none">
                                <div class="px-4 py-3 border-b border-white/[0.06]">
                                    <p class="text-sm font-semibold text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                    <p class="text-xs text-white/50 mt-0.5">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-1.5">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/[0.06] transition-all">
                                        <x-icon name="user" class="w-4 h-4 opacity-60" /> Mon profil
                                    </a>
                                    <a href="{{ route('notifications.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/[0.06] transition-all">
                                        <x-icon name="bell" class="w-4 h-4 opacity-60" /> Notifications
                                    </a>
                                </div>
                                <div class="border-t border-white/[0.06] pt-1.5">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2.5 px-4 py-2 text-sm w-full text-left text-red-400/80 hover:text-red-300 hover:bg-red-500/[0.08] transition-all">
                                            <x-icon name="logout" class="w-4 h-4" /> Deconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/[0.08] transition-all duration-200">Connexion</a>
                        <a href="{{ route('register') }}" class="ml-1 inline-flex items-center gap-1.5 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 px-5 py-2 rounded-xl font-semibold text-[13px] transition-all duration-300 shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 hover:scale-[1.02] active:scale-[0.98]">
                            Inscription
                        </a>
                    @endauth
                </div>

                {{-- Mobile Toggle --}}
                <button id="mobile-menu-toggle" class="md:hidden inline-flex items-center justify-center p-2 rounded-xl hover:bg-white/[0.08] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20" aria-label="Menu">
                    <svg class="w-6 h-6 transition-transform duration-300" id="menu-icon-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg class="w-6 h-6 hidden transition-transform duration-300" id="menu-icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="md:hidden max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
        <div class="backdrop-blur-2xl bg-night/[0.97] border-t border-white/[0.06] shadow-2xl">
            <div class="px-4 py-4 space-y-1 text-sm font-medium max-h-[calc(100vh-4rem)] overflow-y-auto">
                @auth
                    {{-- User Info --}}
                    <div class="flex items-center gap-3 px-3 py-3 mb-2 rounded-xl bg-white/[0.04] border border-white/[0.06]">
                        <span class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400/30 to-orange-600/20 flex items-center justify-center text-sm font-bold overflow-hidden ring-1 ring-orange-400/30">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                            @endif
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ Auth::user()->first_name }}</p>
                            <p class="text-xs text-white/40">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    @if(Auth::user()->isClient())
                        <a href="{{ route('client.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="dashboard" class="w-4 h-4 opacity-60" /> Tableau de bord</a>
                        <a href="{{ route('client.intervention.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="plus" class="w-4 h-4 opacity-60" /> Demander</a>
                    @elseif(Auth::user()->isRemorqueur())
                        <a href="{{ route('remorqueur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="dashboard" class="w-4 h-4 opacity-60" /> Tableau de bord</a>
                        <a href="{{ route('remorqueur.intervention.incoming') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="zap" class="w-4 h-4 opacity-60" /> Demandes</a>
                        <a href="{{ route('remorqueur.intervention.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="car" class="w-4 h-4 opacity-60" /> Interventions</a>
                    @elseif(Auth::user()->isDepanneur())
                        <a href="{{ route('depanneur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="dashboard" class="w-4 h-4 opacity-60" /> Tableau de bord</a>
                        <a href="{{ route('depanneur.intervention.incoming') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="zap" class="w-4 h-4 opacity-60" /> Demandes</a>
                        <a href="{{ route('depanneur.intervention.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="car" class="w-4 h-4 opacity-60" /> Interventions</a>
                    @elseif(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="dashboard" class="w-4 h-4 opacity-60" /> Admin</a>
                        <a href="{{ route('admin.intervention.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="car" class="w-4 h-4 opacity-60" /> Interventions</a>
                        <a href="{{ route('admin.professionnels.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="user" class="w-4 h-4 opacity-60" /> Professionnels</a>
                    @endif

                    <div class="border-t border-white/[0.06] my-2"></div>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all"><x-icon name="user" class="w-4 h-4 opacity-60" /> Mon profil</a>
                    <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-all">
                        <x-icon name="bell" class="w-4 h-4 opacity-60" /> Notifications
                        @if(Auth::user()->unread_notifications_count > 0)
                            <span class="ml-auto text-[10px] font-bold bg-gradient-to-r from-red-500 to-red-600 text-white px-1.5 py-0.5 rounded-full">{{ Auth::user()->unread_notifications_count }}</span>
                        @endif
                    </a>

                    <div class="border-t border-white/[0.06] my-2"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-500/[0.08] transition-all w-full text-left text-red-400/80 hover:text-red-300"><x-icon name="logout" class="w-4 h-4" /> Deconnexion</button>
                    </form>
                @else
                    <div class="space-y-2 pt-1">
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-white/10 hover:bg-white/[0.06] transition-all text-white/80 font-medium">Connexion</a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 transition-all font-semibold shadow-lg shadow-orange-500/25">Inscription</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.getElementById('main-nav');
    const toggleBtn = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    // Sticky scroll effect
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll > 20) {
            nav.classList.add('shadow-lg');
        } else {
            nav.classList.remove('shadow-lg');
        }
        lastScroll = currentScroll;
    }, { passive: true });

    if (toggleBtn && menu && iconOpen && iconClose) {
        toggleBtn.addEventListener('click', function () {
            const isOpen = menu.classList.contains('open');
            if (isOpen) {
                menu.classList.remove('open');
                menu.style.maxHeight = '0';
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                menu.classList.add('open');
                menu.style.maxHeight = menu.scrollHeight + 'px';
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        });

        menu.querySelectorAll('a, button').forEach(el => {
            el.addEventListener('click', () => {
                menu.classList.remove('open');
                menu.style.maxHeight = '0';
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
                document.body.style.overflow = '';
            });
        });
    }
});
</script>
