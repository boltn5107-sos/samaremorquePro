@extends('layouts.app')
@section('title', 'Mes interventions')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2.5">
                    <x-icon name="truck" class="w-6 h-6 text-orange-500" />
                    Mes interventions
                </h1>
                <span class="text-sm text-slate-500">{{ $interventions->total() }} intervention(s)</span>
            </div>

            @forelse($interventions as $intervention)
                <a href="{{ route('remorqueur.intervention.show', $intervention) }}"
                   class="card p-5 mb-4 flex flex-col sm:flex-row sm:items-center gap-4">
                    <span class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
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
                        <p class="flex items-center gap-1.5 text-sm text-slate-500 mt-1.5">
                            <x-icon name="map-pin" class="w-4 h-4 text-slate-400" />
                            <span class="truncate">{{ $intervention->destination }}</span>
                        </p>
                    </div>

                    <div class="flex items-center gap-1.5 text-sm text-slate-500 flex-shrink-0">
                        <x-icon name="clock" class="w-4 h-4 text-slate-400" />
                        {{ $intervention->created_at->format('d/m/Y H:i') }}
                    </div>

                    <x-icon name="chevron-right" class="w-5 h-5 text-slate-300 flex-shrink-0" />
                </a>
            @empty
                <div class="card p-12 text-center text-slate-500">
                    <x-icon name="truck" class="w-12 h-12 mx-auto mb-3 text-slate-300" />
                    <p class="font-medium text-slate-700">Aucune intervention trouvee</p>
                    <p class="text-sm mt-1">Vos interventions acceptees apparaitront ici.</p>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $interventions->links() }}
            </div>
        </div>
    </section>
@endsection