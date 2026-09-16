@extends('layouts.app')
@section('title', 'Mes interventions')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 flex items-center gap-2.5">
                        <x-icon name="dashboard" class="w-7 h-7 text-orange-500" />
                        Mes interventions
                    </h1>
                    <p class="mt-1.5 text-sm text-slate-500">
                        {{ $interventions->total() }} intervention(s) au total
                    </p>
                </div>
                <a href="{{ route('client.intervention.create') }}" class="btn-primary flex-shrink-0">
                    <x-icon name="plus" class="w-4 h-4" />
                    Nouvelle intervention
                </a>
            </div>

            @forelse($interventions as $intervention)
                <a href="{{ route('client.intervention.show', $intervention) }}"
                   class="card p-5 mb-4 flex flex-col sm:flex-row sm:items-center gap-4 group">
                    <span class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                        <x-icon name="{{ $intervention->service_type === 'depannage' ? 'wrench' : 'truck' }}" class="w-6 h-6" />
                    </span>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-semibold text-slate-900">{{ ucfirst($intervention->service_type) }}</p>
                            <span class="badge {{ $intervention->status_color }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ in_array($intervention->status, ['intervention_terminee', 'annulee']) ? 'bg-current' : 'bg-orange-500 animate-pulse' }}"></span>
                                {{ $intervention->status_label }}
                            </span>
                        </div>
                        <p class="flex items-center gap-1.5 text-sm text-slate-500 mt-1.5 truncate">
                            <x-icon name="map-pin" class="w-4 h-4 text-slate-400 flex-shrink-0" />
                            <span class="truncate">{{ $intervention->destination }}</span>
                        </p>
                    </div>

                    <div class="flex flex-col items-start sm:items-end gap-1 text-sm text-slate-500 flex-shrink-0">
                        <span class="font-mono text-xs text-slate-400">
                            Code : {{ $intervention->tracking_code }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <x-icon name="clock" class="w-4 h-4 text-slate-400" />
                            {{ $intervention->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>

                    <x-icon name="chevron-right" class="w-5 h-5 text-slate-300 flex-shrink-0 group-hover:text-orange-500 group-hover:translate-x-0.5 transition-all" />
                </a>
            @empty
                <div class="card p-12 sm:p-16 text-center">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                        <x-icon name="truck" class="w-8 h-8" />
                    </div>
                    <p class="font-semibold text-slate-800">Aucune intervention pour le moment</p>
                    <p class="text-sm text-slate-500 mt-1.5 mb-6">
                        Besoin d'un remorqueur ou d'un depanneur ? Creez votre premiere intervention en quelques clics.
                    </p>
                    <a href="{{ route('client.intervention.create') }}" class="btn-primary">
                        <x-icon name="plus" class="w-4 h-4" />
                        Nouvelle intervention
                    </a>
                </div>
            @endforelse

            @if($interventions->hasPages())
                <div class="mt-8">
                    {{ $interventions->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection