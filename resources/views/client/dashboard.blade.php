@extends('layouts.app')
@section('title', 'Tableau de bord')

@php
    $totalInterventions = $recentInterventions->count();
    $activeCount = $recentInterventions->filter(fn($i) => !in_array($i->status, ['intervention_terminee', 'annulee']))->count();
    $completedCount = $recentInterventions->filter(fn($i) => $i->status === 'intervention_terminee')->count();
    $ratedInterventions = $recentInterventions->filter(fn($i) => $i->rating !== null);
    $avgRating = $ratedInterventions->count() > 0
        ? round($ratedInterventions->avg('rating'), 1)
        : null;
    $userName = auth()->user()->first_name;
    $today = now()->translatedFormat('l j F Y');
@endphp

@section('content')
<div class="page-shell">

    {{-- Welcome Header --}}
    <div class="mb-8 animate-slide-up">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-display font-bold text-slate-900 tracking-tight">
                    Bonjour, {{ $userName }} &#128075;
                </h1>
                <p class="mt-1.5 text-sm md:text-base text-slate-500">{{ $today }}</p>
            </div>
            <a href="{{ route('client.intervention.create') }}" class="btn-primary shrink-0">
                <x-icon name="plus" class="w-5 h-5" />
                Nouvelle demande
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @php
            $stats = [
                [
                    'label' => 'Total',
                    'value' => $totalInterventions,
                    'icon' => 'file-text',
                    'color' => 'bg-slate-100 text-slate-600',
                ],
                [
                    'label' => 'En cours',
                    'value' => $activeCount,
                    'icon' => 'loader',
                    'color' => 'bg-orange-100 text-orange-600',
                ],
                [
                    'label' => 'Terminees',
                    'value' => $completedCount,
                    'icon' => 'check-circle',
                    'color' => 'bg-emerald-100 text-emerald-600',
                ],
                [
                    'label' => 'Note moyenne',
                    'value' => $avgRating !== null ? number_format($avgRating, 1, ',', '.') : '—',
                    'icon' => 'star',
                    'color' => 'bg-amber-100 text-amber-600',
                ],
            ];
        @endphp

        @foreach($stats as $index => $stat)
        <div class="stat-card animate-slide-up animation-delay-{{ ($index + 1) }}00">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl {{ $stat['color'] }} flex items-center justify-center shrink-0">
                    <x-icon :name="$stat['icon']" class="w-5 h-5" />
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">{{ $stat['label'] }}</p>
                    <p class="text-2xl md:text-3xl font-bold text-slate-900 tabular-nums">{{ $stat['value'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Active Intervention --}}
    @if($activeIntervention)
    <div class="mb-8 animate-slide-up animation-delay-200">
        <div class="relative overflow-hidden rounded-2xl border border-orange-200 bg-gradient-to-br from-orange-50 via-white to-orange-50/50 p-5 md:p-7 shadow-md">
            <div class="absolute top-0 right-0 w-40 h-40 bg-orange-500/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl pointer-events-none"></div>

            <div class="relative">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center shrink-0">
                            <x-icon :name="$activeIntervention->service_type === 'remorquage' ? 'truck' : 'wrench'" class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">
                                {{ $activeIntervention->service_type === 'remorquage' ? 'Remorquage' : 'Depannage' }}
                            </p>
                            <p class="text-lg font-bold text-slate-900">Intervention en cours</p>
                        </div>
                    </div>
                    <span class="badge {{ $activeIntervention->status_color }} shrink-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                        {{ $activeIntervention->status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    @if($activeIntervention->destination)
                    <div class="flex items-start gap-2.5">
                        <x-icon name="map-pin" class="w-4 h-4 text-orange-500 mt-0.5 shrink-0" />
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500 font-medium">Destination</p>
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ $activeIntervention->destination }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-start gap-2.5">
                        <x-icon name="file-text" class="w-4 h-4 text-orange-500 mt-0.5 shrink-0" />
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500 font-medium">Code de suivi</p>
                            <p class="text-sm font-semibold text-slate-800 font-mono">{{ $activeIntervention->tracking_code }}</p>
                        </div>
                    </div>

                    @if($activeIntervention->professional)
                    <div class="flex items-start gap-2.5">
                        <x-icon name="user" class="w-4 h-4 text-orange-500 mt-0.5 shrink-0" />
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500 font-medium">Professionnel</p>
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ $activeIntervention->professional->full_name }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                @if($activeIntervention->description)
                <p class="text-sm text-slate-600 bg-white/80 rounded-xl px-4 py-3 mb-6 border border-slate-100">
                    {{ Str::limit($activeIntervention->description, 150) }}
                </p>
                @endif

                <a href="{{ route('client.intervention.show', $activeIntervention) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/25 active:scale-[0.98]">
                    <x-icon name="eye" class="w-4 h-4" />
                    Voir les details
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            </div>
        </div>
    </div>
    @else
    {{-- No Active Intervention CTA --}}
    <div class="mb-8 animate-slide-up animation-delay-200">
        <div class="relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-white p-8 md:p-10 text-center">
            <div class="w-16 h-16 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mx-auto mb-4">
                <x-icon name="truck" class="w-8 h-8" />
            </div>
            <h3 class="text-lg font-display font-bold text-slate-900">Besoin d'assistance ?</h3>
            <p class="mt-2 text-sm text-slate-500 max-w-sm mx-auto">
                Vous n'avez aucune intervention en cours. Creez une demande pour obtenir l'aide d'un professionnel pres de vous.
            </p>
            <a href="{{ route('client.intervention.create') }}" class="btn-primary mt-6 inline-flex">
                <x-icon name="plus" class="w-5 h-5" />
                Creer une demande
            </a>
        </div>
    </div>
    @endif

    {{-- Recent Interventions --}}
    <div class="animate-slide-up animation-delay-300">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg md:text-xl font-display font-bold text-slate-900 tracking-tight">
                Interventions recentes
            </h2>
            @if($totalInterventions > 0)
            <a href="{{ route('client.intervention.index') }}"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-orange-600 hover:text-orange-700 transition-colors">
                Tout voir
                <x-icon name="chevron-right" class="w-4 h-4" />
            </a>
            @endif
        </div>

        @if($totalInterventions > 0)
        <div class="space-y-3">
            @foreach($recentInterventions as $intervention)
            <a href="{{ route('client.intervention.show', $intervention) }}"
               class="group block bg-white rounded-2xl border border-slate-100 p-4 md:p-5 transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/5 hover:border-orange-200 hover:-translate-y-0.5">
                <div class="flex items-center gap-4">
                    {{-- Icon --}}
                    <div class="w-11 h-11 rounded-xl bg-slate-100 group-hover:bg-orange-100 text-slate-500 group-hover:text-orange-600 flex items-center justify-center shrink-0 transition-colors duration-300">
                        <x-icon :name="$intervention->service_type === 'remorquage' ? 'truck' : 'wrench'" class="w-5 h-5" />
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-sm text-slate-900 truncate">
                                {{ $intervention->service_type === 'remorquage' ? 'Remorquage' : 'Depannage' }}
                            </span>
                            <span class="badge {{ $intervention->status_color }} text-[11px] shrink-0">
                                {{ $intervention->status_label }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            @if($intervention->destination)
                            <span class="flex items-center gap-1 truncate">
                                <x-icon name="map-pin" class="w-3 h-3 shrink-0" />
                                {{ Str::limit($intervention->destination, 40) }}
                            </span>
                            <span class="text-slate-300">·</span>
                            @endif
                            <span class="flex items-center gap-1">
                                <x-icon name="clock" class="w-3 h-3 shrink-0" />
                                {{ $intervention->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>

                    {{-- Chevron --}}
                    <x-icon name="chevron-right" class="w-5 h-5 text-slate-300 group-hover:text-orange-500 shrink-0 transition-colors duration-300" />
                </div>
            </a>
            @endforeach
        </div>
        @else
        {{-- Empty State --}}
        <div class="empty-state">
            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                <x-icon name="file-text" class="w-7 h-7" />
            </div>
            <h3>Aucune intervention</h3>
            <p>Vous n'avez pas encore effectue d'intervention. Commencez par en creer une nouvelle.</p>
            <a href="{{ route('client.intervention.create') }}" class="btn-primary mt-4 inline-flex">
                <x-icon name="plus" class="w-5 h-5" />
                Commencer
            </a>
        </div>
        @endif
    </div>

</div>
@endsection
