@extends('layouts.app')
@section('title', 'Tableau de bord remorqueur')
@section('content')
    <div class="relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-orange-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-32 -left-20 w-56 h-56 bg-amber-200/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-orange-100/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <span class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-orange-500/25">
                        <x-icon name="truck" class="w-7 h-7" />
                    </span>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                            Bienvenue, {{ Auth::user()->first_name ?? Auth::user()->name }}
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">Voici un aperçu de votre activité de remorquage.</p>
                    </div>
                </div>
                <span class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-orange-100 text-orange-700 font-semibold text-sm border border-orange-200/60 w-fit">
                    <x-icon name="zap" class="w-4 h-4" />
                    Remorqueur
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
                    <span class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                        <x-icon name="bell" class="w-6 h-6" />
                    </span>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">{{ $pendingDemands->count() }}</p>
                        <p class="text-sm text-slate-500">Demandes en attente</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
                    <span class="flex-shrink-0 w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <x-icon name="check-circle" class="w-6 h-6" />
                    </span>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">{{ $completedInterventions->count() }}</p>
                        <p class="text-sm text-slate-500">Interventions terminées</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
                    <span class="flex-shrink-0 w-12 h-12 rounded-xl {{ $activeIntervention ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center">
                        <x-icon name="map" class="w-6 h-6" />
                    </span>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">{{ $activeIntervention ? 1 : 0 }}</p>
                        <p class="text-sm text-slate-500">Intervention en cours</p>
                    </div>
                </div>
            </div>

            @if($activeIntervention)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-orange-500/5 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-1.5 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-white text-sm font-semibold">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
                            </span>
                            Intervention en cours
                        </div>
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                            <x-icon name="clock" class="w-3.5 h-3.5" />
                            {{ $activeIntervention->status_label }}
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-5">
                            <div class="bg-slate-50 rounded-xl p-3.5 flex items-start gap-3">
                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                                    <x-icon name="user" class="w-4 h-4" />
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Client</p>
                                    <p class="font-semibold text-slate-900 truncate">{{ $activeIntervention->client_name }}</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3.5 flex items-start gap-3">
                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center">
                                    <x-icon name="map-pin" class="w-4 h-4" />
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Destination</p>
                                    <p class="font-semibold text-slate-900 truncate">{{ $activeIntervention->destination }}</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3.5 flex items-start gap-3">
                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-violet-100 text-violet-600 flex items-center justify-center">
                                    <x-icon name="wrench" class="w-4 h-4" />
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Service</p>
                                    <p class="font-semibold text-slate-900 truncate">{{ ucfirst($activeIntervention->service_type) }}</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3.5 flex items-start gap-3">
                                <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <x-icon name="map" class="w-4 h-4" />
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Code de suivi</p>
                                    <p class="font-semibold text-slate-900 truncate">{{ $activeIntervention->tracking_code }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('remorqueur.intervention.show', $activeIntervention) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-orange-500/25 transition-all duration-300">
                            <x-icon name="map" class="w-4 h-4" />
                            Voir le suivi
                            <x-icon name="arrow-right" class="w-4 h-4" />
                        </a>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="font-semibold text-slate-900 flex items-center gap-2.5">
                            <span class="w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                                <x-icon name="bell" class="w-4 h-4" />
                            </span>
                            Demandes en attente
                        </h2>
                        @if($pendingDemands->count())
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-orange-100 text-orange-700">{{ $pendingDemands->count() }}</span>
                        @endif
                    </div>
                    <ul class="divide-y divide-slate-100">
                        @forelse($pendingDemands as $demand)
                            <li class="p-5 hover:bg-slate-50/70 transition-colors duration-200">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div class="flex items-start gap-3 min-w-0">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($demand->client_name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0 space-y-0.5">
                                            <p class="font-semibold text-slate-900 truncate">{{ ucfirst($demand->service_type) }}</p>
                                            <p class="text-sm text-slate-500 flex items-center gap-1.5 truncate">
                                                <x-icon name="map-pin" class="w-3.5 h-3.5 text-slate-400" />
                                                {{ $demand->destination }}
                                            </p>
                                            <p class="text-xs text-slate-400">{{ $demand->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 sm:flex-shrink-0">
                                        <form method="POST" action="{{ route('remorqueur.intervention.accept', $demand) }}" onsubmit="var b=this.querySelector('button'); b.disabled=true; b.classList.add('opacity-50');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-500/25 transition-all duration-200">
                                                <x-icon name="check" class="w-4 h-4" />
                                                Accepter
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('remorqueur.intervention.reject', $demand) }}" onsubmit="if(!confirm('Confirmer le refus de cette demande ?')) return false; var b=this.querySelector('button'); b.disabled=true; b.classList.add('opacity-50');">
                                            @csrf
                                            <input type="hidden" name="reason" value="Refusé par le remorqueur">
                                            <button type="submit" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-xl text-slate-600 bg-slate-100 hover:bg-red-50 hover:text-red-600 border border-slate-200 transition-all duration-200">
                                                <x-icon name="x" class="w-4 h-4" />
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-6 py-14 text-center">
                                <span class="w-16 h-16 rounded-2xl bg-orange-50 text-orange-300 flex items-center justify-center mx-auto mb-3">
                                    <x-icon name="bell" class="w-8 h-8" />
                                </span>
                                <p class="font-semibold text-slate-700">Aucune demande en attente</p>
                                <p class="mt-1 text-sm text-slate-500">Les nouvelles demandes de remorquage apparaîtront ici.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="font-semibold text-slate-900 flex items-center gap-2.5">
                            <span class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <x-icon name="check-circle" class="w-4 h-4" />
                            </span>
                            Interventions terminées
                        </h2>
                        @if($completedInterventions->count())
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">{{ $completedInterventions->count() }}</span>
                        @endif
                    </div>
                    <ul class="divide-y divide-slate-100">
                        @forelse($completedInterventions as $intervention)
                            <li class="p-5 hover:bg-slate-50/70 transition-colors duration-200">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                        <x-icon name="map-pin" class="w-4 h-4" />
                                    </span>
                                    <div class="min-w-0 space-y-0.5">
                                        <p class="font-semibold text-slate-900 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                        <p class="text-sm text-slate-500 truncate">{{ $intervention->destination }}</p>
                                        <p class="text-xs text-slate-400">{{ $intervention->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-6 py-14 text-center">
                                <span class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-300 flex items-center justify-center mx-auto mb-3">
                                    <x-icon name="check-circle" class="w-8 h-8" />
                                </span>
                                <p class="font-semibold text-slate-700">Aucune intervention terminée</p>
                                <p class="mt-1 text-sm text-slate-500">Vos interventions terminées apparaîtront ici.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
