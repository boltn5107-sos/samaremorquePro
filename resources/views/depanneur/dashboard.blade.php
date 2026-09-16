@extends('layouts.app')
@section('title', 'Tableau de bord Dépanneur')
@section('content')
<div class="page-shell page-enter">

    <div class="page-header reveal">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-orange-100 text-orange-600">
                        <x-icon name="wrench" class="w-5 h-5" />
                    </span>
                    <span class="gradient-text">Bonjour, Dépanneur</span>
                </h1>
                <p class="mt-1.5 text-sm md:text-base text-slate-500">Voici un aperçu de votre activité.</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-slate-400">
                <x-icon name="clock" class="w-4 h-4" />
                <span>{{ now()->translatedFormat('d M Y') }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="stat-card reveal reveal-delay-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                    <x-icon name="bell" class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">En attente</p>
                    <p class="text-3xl font-bold text-slate-900 counter">{{ $pendingDemands->count() }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card reveal reveal-delay-2">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl {{ $activeIntervention ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center">
                    <x-icon name="zap" class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">En cours</p>
                    <p class="text-3xl font-bold text-slate-900 counter">{{ $activeIntervention ? 1 : 0 }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card reveal reveal-delay-3">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <x-icon name="check-circle" class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Terminées</p>
                    <p class="text-3xl font-bold text-slate-900 counter">{{ $completedInterventions->count() }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card reveal reveal-delay-4">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <x-icon name="car" class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total</p>
                    <p class="text-3xl font-bold text-slate-900 counter">{{ $completedInterventions->count() + $pendingDemands->count() + ($activeIntervention ? 1 : 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($activeIntervention)
        <div class="card p-6 mb-8 border-l-4 border-l-orange-500 shadow-glow reveal reveal-delay-2">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
                <div class="flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                    </span>
                    <h2 class="text-lg font-bold text-slate-900">Intervention en cours</h2>
                </div>
                <span class="badge {{ $activeIntervention->status_color }}">
                    {{ $activeIntervention->status_label }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50/80">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                        <x-icon name="user" class="w-4 h-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 mb-0.5">Client</p>
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $activeIntervention->client_name }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50/80">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <x-icon name="wrench" class="w-4 h-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 mb-0.5">Service</p>
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ ucfirst($activeIntervention->service_type) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50/80">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center">
                        <x-icon name="map-pin" class="w-4 h-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 mb-0.5">Destination</p>
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $activeIntervention->destination }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50/80">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-violet-100 text-violet-600 flex items-center justify-center">
                        <x-icon name="map" class="w-4 h-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 mb-0.5">Code de suivi</p>
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $activeIntervention->tracking_code ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <a href="{{ route('depanneur.intervention.show', $activeIntervention) }}" class="btn-primary shadow-lg shadow-orange-500/20">
                <x-icon name="map" class="w-4 h-4" /> Voir le suivi
                <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        </div>
    @else
        <div class="card p-8 mb-8 bg-gradient-to-br from-orange-50/80 to-white reveal reveal-delay-2">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <span class="flex-shrink-0 w-14 h-14 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center">
                    <x-icon name="zap" class="w-7 h-7" />
                </span>
                <div class="flex-1 min-w-0">
                    <h3 class="text-base font-bold text-slate-900">Aucune intervention en cours</h3>
                    <p class="mt-0.5 text-sm text-slate-500">Acceptez une demande pour démarrer une nouvelle intervention.</p>
                </div>
                <a href="#pending" class="btn-secondary shrink-0">
                    <x-icon name="bell" class="w-4 h-4" /> Voir les demandes
                </a>
            </div>
        </div>
    @endif

    <div id="pending" class="mb-8 reveal reveal-delay-3">
        <div class="flex items-center justify-between mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold text-slate-900">
                <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                    <x-icon name="bell" class="w-4 h-4" />
                </span>
                Demandes en attente
                @if($pendingDemands->count())
                    <span class="ml-1 px-2 py-0.5 text-xs font-bold rounded-full bg-orange-100 text-orange-700">{{ $pendingDemands->count() }}</span>
                @endif
            </h2>
        </div>

        <div class="space-y-4">
            @forelse($pendingDemands as $demand)
                <div class="card overflow-hidden reveal">
                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                @if($demand->client_photo)
                                    <img src="{{ $demand->client_photo }}" alt="{{ $demand->client_name }}" class="flex-shrink-0 w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                                @else
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                        {{ strtoupper(substr($demand->client_name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <h3 class="font-bold text-slate-900">{{ ucfirst($demand->service_type) }}</h3>
                                        <span class="chip bg-orange-50 text-orange-700">
                                            <x-icon name="wrench" class="w-3 h-3" /> {{ ucfirst($demand->vehicle_type ?? 'N/A') }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-600 flex items-center gap-1.5 mb-1">
                                        <x-icon name="user" class="w-3.5 h-3.5 text-slate-400" />
                                        {{ $demand->client_name }}
                                        @if($demand->client_phone)
                                            <span class="text-slate-300 mx-0.5">·</span>
                                            <x-icon name="phone" class="w-3.5 h-3.5 text-slate-400" />
                                            {{ $demand->client_phone }}
                                        @endif
                                    </p>
                                    <p class="text-sm text-slate-500 flex items-center gap-1.5">
                                        <x-icon name="map-pin" class="w-3.5 h-3.5 text-slate-400" />
                                        <span class="truncate">{{ $demand->destination }}</span>
                                    </p>
                                    @if($demand->description)
                                        <p class="mt-2 text-sm text-slate-500 bg-slate-50 rounded-lg px-3 py-2 line-clamp-2">{{ $demand->description }}</p>
                                    @endif
                                    <p class="mt-2 text-xs text-slate-400">Il y a {{ $demand->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2 lg:shrink-0 lg:flex-col lg:w-auto">
                                <form method="POST" action="{{ route('depanneur.intervention.accept', $demand) }}" onsubmit="var b=this.querySelector('button'); b.disabled=true; b.classList.add('opacity-50');" class="w-full lg:w-auto">
                                    @csrf
                                    <button type="submit" class="btn-primary w-full py-2 px-4 text-sm shadow-lg shadow-orange-500/20">
                                        <x-icon name="check" class="w-4 h-4" /> Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('depanneur.intervention.reject', $demand) }}" onsubmit="if(!confirm('Confirmer le refus ?')) return false; var b=this.querySelector('button'); b.disabled=true; b.classList.add('opacity-50');" class="w-full lg:w-auto">
                                    @csrf
                                    <input type="hidden" name="reason" value="Refusé par le dépanneur">
                                    <button type="submit" class="btn-secondary w-full py-2 px-4 text-sm">
                                        <x-icon name="x" class="w-4 h-4" /> Refuser
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <span class="w-16 h-16 rounded-2xl bg-orange-100 text-orange-400 flex items-center justify-center mx-auto">
                        <x-icon name="bell" class="w-8 h-8" />
                    </span>
                    <h3>Aucune demande en attente</h3>
                    <p>Les nouvelles demandes apparaîtront ici.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="reveal reveal-delay-4">
        <div class="flex items-center justify-between mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold text-slate-900">
                <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <x-icon name="check-circle" class="w-4 h-4" />
                </span>
                Interventions terminées
                @if($completedInterventions->count())
                    <span class="ml-1 px-2 py-0.5 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">{{ $completedInterventions->count() }}</span>
                @endif
            </h2>
        </div>

        @if($completedInterventions->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach($completedInterventions as $intervention)
                    <div class="card p-5 hover:shadow-xl hover:shadow-emerald-500/5 reveal">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <x-icon name="check-circle" class="w-5 h-5" />
                                </span>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-900 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                    <p class="text-xs text-emerald-600 font-semibold">Terminée</p>
                                </div>
                            </div>
                            <span class="shrink-0 px-2 py-0.5 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-600">
                                {{ $intervention->status_label }}
                            </span>
                        </div>
                        <div class="space-y-1.5 text-sm">
                            <p class="text-slate-600 flex items-center gap-1.5">
                                <x-icon name="user" class="w-3.5 h-3.5 text-slate-400" /> {{ $intervention->client_name }}
                            </p>
                            <p class="text-slate-500 flex items-center gap-1.5">
                                <x-icon name="map-pin" class="w-3.5 h-3.5 text-slate-400" />
                                <span class="truncate">{{ $intervention->destination }}</span>
                            </p>
                            <p class="text-xs text-slate-400 pt-1">
                                {{ $intervention->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <span class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-400 flex items-center justify-center mx-auto">
                    <x-icon name="check-circle" class="w-8 h-8" />
                </span>
                <h3>Aucune intervention terminée</h3>
                <p>Historique de vos interventions complétées.</p>
            </div>
        @endif
    </div>

</div>
@endsection
