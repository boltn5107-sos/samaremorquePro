@extends('layouts.app')

@section('title', 'Tableau de bord remorqueur')

@section('content')
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="dashboard" class="w-6 h-6 text-orange-500" />
            Tableau de bord Remorqueur
        </h1>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="card p-4">
                <div class="p-2.5 rounded-lg bg-orange-100 text-orange-600 w-fit mb-2">
                    <x-icon name="bell" class="w-5 h-5" />
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $pendingDemands->count() }}</p>
                <p class="text-xs text-slate-500">Demandes en attente</p>
            </div>
            <div class="card p-4">
                <div class="p-2.5 rounded-lg bg-emerald-100 text-emerald-600 w-fit mb-2">
                    <x-icon name="check-circle" class="w-5 h-5" />
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $completedInterventions->count() }}</p>
                <p class="text-xs text-slate-500">Interventions terminees</p>
            </div>
        </div>

        @if($activeIntervention)
            <div class="card p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                        <x-icon name="zap" class="w-5 h-5 text-orange-500" />
                        Intervention en cours
                    </h2>
                    <span class="badge {{ $activeIntervention->status_color }}">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        {{ $activeIntervention->status_label }}
                    </span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm mb-4">
                    <div class="bg-slate-50 rounded-lg p-3">
                        <p class="text-xs text-slate-500 flex items-center gap-1"><x-icon name="user" class="w-3.5 h-3.5" /> Client</p>
                        <p class="font-medium text-slate-900">{{ $activeIntervention->client_name }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-3">
                        <p class="text-xs text-slate-500 flex items-center gap-1"><x-icon name="map-pin" class="w-3.5 h-3.5" /> Destination</p>
                        <p class="font-medium text-slate-900">{{ $activeIntervention->destination }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-3">
                        <p class="text-xs text-slate-500 flex items-center gap-1"><x-icon name="wrench" class="w-3.5 h-3.5" /> Service</p>
                        <p class="font-medium text-slate-900">{{ ucfirst($activeIntervention->service_type) }}</p>
                    </div>
                </div>
                <a href="{{ route('remorqueur.intervention.show', $activeIntervention) }}" class="btn-primary">
                    <x-icon name="map" class="w-4 h-4" /> Voir le suivi
                </a>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-200 flex items-center gap-2">
                    <x-icon name="bell" class="w-5 h-5 text-orange-500" />
                    <h2 class="font-semibold text-slate-900">Demandes en attente</h2>
                </div>
                <ul class="divide-y divide-slate-200">
                    @forelse($pendingDemands as $demand)
                        <li class="px-5 py-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div class="space-y-0.5">
                                    <p class="font-medium text-slate-900">{{ ucfirst($demand->service_type) }}</p>
                                    <p class="text-sm text-slate-500 flex items-center gap-1"><x-icon name="map-pin" class="w-3.5 h-3.5" /> {{ $demand->destination }}</p>
                                    <p class="text-xs text-slate-400">{{ $demand->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('remorqueur.intervention.accept', $demand) }}" onsubmit="var b=this.querySelector('button'); b.disabled = true; b.classList.add('opacity-50');">
                                        @csrf
                                        <button type="submit" class="btn-primary py-1.5 px-3 text-sm">
                                            <x-icon name="check" class="w-4 h-4" /> Accepter
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('remorqueur.intervention.reject', $demand) }}" onsubmit="if(!confirm('Confirmer le refus ?')) return false; var b=this.querySelector('button'); b.disabled = true; b.classList.add('opacity-50');">
                                        @csrf
                                        <input type="hidden" name="reason" value="Refuse par le remorqueur">
                                        <button type="submit" class="btn-secondary py-1.5 px-3 text-sm">
                                            <x-icon name="x" class="w-4 h-4" /> Refuser
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="px-5 py-10 text-center text-slate-500">
                            <x-icon name="bell" class="w-10 h-10 mx-auto mb-2 text-slate-300" />
                            Aucune demande en attente.
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="card overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-200 flex items-center gap-2">
                    <x-icon name="check-circle" class="w-5 h-5 text-emerald-500" />
                    <h2 class="font-semibold text-slate-900">Interventions terminees</h2>
                </div>
                <ul class="divide-y divide-slate-200">
                    @forelse($completedInterventions as $intervention)
                        <li class="px-5 py-4">
                            <p class="font-medium text-slate-900">{{ ucfirst($intervention->service_type) }}</p>
                            <p class="text-sm text-slate-500 flex items-center gap-1"><x-icon name="map-pin" class="w-3.5 h-3.5" /> {{ $intervention->destination }}</p>
                            <p class="text-xs text-slate-400">{{ $intervention->created_at->format('d/m/Y H:i') }}</p>
                        </li>
                    @empty
                        <li class="px-5 py-10 text-center text-slate-500">
                            <x-icon name="check-circle" class="w-10 h-10 mx-auto mb-2 text-slate-300" />
                            Aucune intervention terminee.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
