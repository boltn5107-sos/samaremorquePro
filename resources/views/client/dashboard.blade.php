@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Bonjour, {{ Auth::user()->first_name }}</h1>
                <p class="text-sm text-slate-500">Besoin d'une remorque ou d'un depanneur ?</p>
            </div>
        </div>

        <a href="{{ route('client.intervention.create') }}" class="btn-primary w-full py-4 mb-6 text-base">
            <x-icon name="plus" class="w-5 h-5" />
            Demander une intervention
        </a>

        @if($activeIntervention)
            <div class="card p-5 mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                        <x-icon name="zap" class="w-5 h-5 text-orange-500" />
                        Intervention en cours
                    </h2>
                    <span class="badge {{ $activeIntervention->status_color }}">
                        <span class="w-2 h-2 rounded-full {{ in_array($activeIntervention->status, ['intervention_terminee', 'annulee']) ? '' : 'bg-orange-500 animate-pulse' }}"></span>
                        {{ $activeIntervention->status_label }}
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="bg-slate-50 rounded-lg p-3">
                        <p class="text-xs text-slate-500 flex items-center gap-1"><x-icon name="user" class="w-3.5 h-3.5" /> Professionnel</p>
                        <p class="font-medium text-slate-900">{{ $activeIntervention->professional?->full_name ?? 'En attente...' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-3">
                        <p class="text-xs text-slate-500 flex items-center gap-1"><x-icon name="wrench" class="w-3.5 h-3.5" /> Service</p>
                        <p class="font-medium text-slate-900">{{ ucfirst($activeIntervention->service_type) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-3 col-span-2">
                        <p class="text-xs text-slate-500 flex items-center gap-1"><x-icon name="map-pin" class="w-3.5 h-3.5" /> Destination</p>
                        <p class="font-medium text-slate-900">{{ $activeIntervention->destination }}</p>
                    </div>
                </div>
                <a href="{{ route('client.intervention.show', $activeIntervention) }}" class="btn-primary w-full mt-4">
                    <x-icon name="map" class="w-4 h-4" /> Suivre le professionnel
                </a>
            </div>
        @endif

        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Historique recent</h2>
            </div>
            <ul class="divide-y divide-slate-200">
                @forelse($recentInterventions as $intervention)
                    <li>
                        <a href="{{ route('client.intervention.show', $intervention) }}" class="flex items-center justify-between px-5 py-4 hover:bg-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 rounded-lg bg-slate-100 text-slate-600">
                                    <x-icon name="car" class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900">{{ ucfirst($intervention->service_type) }}</p>
                                    <p class="text-sm text-slate-500">{{ $intervention->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            <span class="badge {{ $intervention->status_color }}">
                                {{ $intervention->status_label }}
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="px-5 py-10 text-center text-slate-500">
                        <x-icon name="car" class="w-10 h-10 mx-auto mb-2 text-slate-300" />
                        Aucune intervention precedente.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
