<nav class="bg-slate-900 text-white sticky top-0 z-40 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-3">
               <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-bold tracking-tight">
    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white overflow-hidden">
        <img src="{{ asset('favicon.png') }}" alt="{{ config('app.name') }}" class="w-7 h-7 object-contain">
    </span>
    <span>{{ config('app.name') }}</span>
</a>

                @auth
                    <span class="hidden sm:inline-flex text-xs bg-slate-700 px-2 py-1 rounded-full uppercase tracking-wide">
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

            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                @auth
                    @if(Auth::user()->isClient())
                        <a href="{{ route('client.dashboard') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="dashboard" class="w-4 h-4" /> Tableau de bord</a>
                        <a href="{{ route('client.intervention.create') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="plus" class="w-4 h-4" /> Demander</a>
                    @elseif(Auth::user()->isRemorqueur())
                        <a href="{{ route('remorqueur.dashboard') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="dashboard" class="w-4 h-4" /> Tableau de bord</a>
                        <a href="{{ route('remorqueur.intervention.incoming') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="zap" class="w-4 h-4" /> Demandes</a>
                        <a href="{{ route('remorqueur.intervention.index') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="car" class="w-4 h-4" /> Mes interventions</a>
                    @elseif(Auth::user()->isDepanneur())
                        <a href="{{ route('depanneur.dashboard') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="dashboard" class="w-4 h-4" /> Tableau de bord</a>
                        <a href="{{ route('depanneur.intervention.incoming') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="zap" class="w-4 h-4" /> Demandes</a>
                        <a href="{{ route('depanneur.intervention.index') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="car" class="w-4 h-4" /> Mes interventions</a>
                    @elseif(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="dashboard" class="w-4 h-4" /> Admin</a>
                        <a href="{{ route('admin.intervention.index') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="car" class="w-4 h-4" /> Interventions</a>
                        <a href="{{ route('admin.professionnels.index') }}" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="user" class="w-4 h-4" /> Remorqueurs/Depanneurs</a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-1.5 hover:text-orange-400">
                        <span class="w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-semibold overflow-hidden">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                            @endif
                        </span>
                        Mon profil
                    </a>

                    <a href="{{ route('notifications.index') }}" class="relative flex items-center hover:text-orange-400">
                        <x-icon name="bell" class="w-5 h-5" />
                        <span id="unread-badge" class="{{ Auth::user()->unread_notifications_count > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-2 bg-orange-500 text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">
                            {{ Auth::user()->unread_notifications_count }}
                        </span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 hover:text-orange-400"><x-icon name="logout" class="w-4 h-4" /> Deconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-orange-400">Connexion</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-1.5 bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg font-semibold">
                        <x-icon name="user" class="w-4 h-4" /> Inscription
                    </a>
                @endauth
            </div>

            <button id="mobile-menu-toggle" class="md:hidden inline-flex items-center justify-center p-2 rounded-md hover:bg-slate-800 focus:outline-none" aria-label="Menu">
                <x-icon name="menu" class="w-6 h-6" />
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden border-t border-slate-700">
        <div class="px-4 py-3 space-y-1 text-sm font-medium">
            @auth
                @if(Auth::user()->isClient())
                    <a href="{{ route('client.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="dashboard" class="w-4 h-4" /> Tableau de bord</a>
                    <a href="{{ route('client.intervention.create') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="plus" class="w-4 h-4" /> Demander</a>
                @elseif(Auth::user()->isRemorqueur())
                    <a href="{{ route('remorqueur.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="dashboard" class="w-4 h-4" /> Tableau de bord</a>
                    <a href="{{ route('remorqueur.intervention.incoming') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="zap" class="w-4 h-4" /> Demandes</a>
                    <a href="{{ route('remorqueur.intervention.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="car" class="w-4 h-4" /> Mes interventions</a>
                @elseif(Auth::user()->isDepanneur())
                    <a href="{{ route('depanneur.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="dashboard" class="w-4 h-4" /> Tableau de bord</a>
                    <a href="{{ route('depanneur.intervention.incoming') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="zap" class="w-4 h-4" /> Demandes</a>
                    <a href="{{ route('depanneur.intervention.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="car" class="w-4 h-4" /> Mes interventions</a>
                @elseif(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="dashboard" class="w-4 h-4" /> Admin</a>
                    <a href="{{ route('admin.intervention.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="car" class="w-4 h-4" /> Interventions</a>
                    <a href="{{ route('admin.professionnels.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="user" class="w-4 h-4" /> Remorqueurs/Depanneurs</a>
                @endif

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">
                    <span class="w-5 h-5 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px] font-semibold overflow-hidden">
                        @if(Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        @endif
                    </span>
                    Mon profil
                </a>

                <a href="{{ route('notifications.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800"><x-icon name="bell" class="w-4 h-4" /> Notifications</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800 w-full text-left">
                        <x-icon name="logout" class="w-4 h-4" /> Deconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">Connexion</a>
                <a href="{{ route('register') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800 text-orange-400">Inscription</a>
            @endauth
        </div>
    </div>
</nav>
