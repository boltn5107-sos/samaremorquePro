@extends('layouts.app')
@section('title', 'Interventions')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                        <x-icon name="zap" class="w-6 h-6" />
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Interventions</h1>
                        <p class="text-sm text-slate-500">Suivi et gestion des demandes d'assistance</p>
                    </div>
                </div>
                <a href="{{ route('admin.intervention.export', request()->only(['status', 'service_type', 'search'])) }}"
                   class="btn-secondary">
                    <x-icon name="download" class="w-4 h-4" />
                    Exporter CSV
                </a>
            </div>

            <form method="GET" action="{{ route('admin.intervention.index') }}" class="card p-5 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="status" class="block text-xs font-medium text-slate-500 mb-1.5">Statut</label>
                        <select name="status" id="status"
                                class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                            <option value="">Tous les statuts</option>
                            @foreach(\App\Models\Intervention::STATUS_LABELS as $value => $label)
                                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="service_type" class="block text-xs font-medium text-slate-500 mb-1.5">Service</label>
                        <select name="service_type" id="service_type"
                                class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                            <option value="">Tous les services</option>
                            <option value="remorquage" @selected(request('service_type') === 'remorquage')>Remorquage</option>
                            <option value="depannage" @selected(request('service_type') === 'depannage')>Depannage</option>
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-xs font-medium text-slate-500 mb-1.5">Rechercher</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Client, destination, detail..."
                               class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-4">
                    <button type="submit" class="btn-primary">
                        <x-icon name="filter" class="w-4 h-4" />
                        Filtrer
                    </button>
                    @if(request()->anyFilled(['status', 'service_type', 'search']))
                        <a href="{{ route('admin.intervention.index') }}" class="btn-secondary">
                            <x-icon name="x" class="w-4 h-4" />
                            Effacer
                        </a>
                    @endif
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($interventions as $intervention)
                    <div class="card overflow-hidden flex flex-col">
                        <div class="p-5 flex items-start gap-4">
                            <div class="flex-shrink-0">
                                @if($intervention->photo)
                                    <img src="{{ asset('storage/' . $intervention->photo) }}" alt="Photo de la panne" class="w-12 h-12 rounded-xl object-cover border border-slate-200">
                                @else
                                    <div class="flex-shrink-0 h-12 w-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                                        <x-icon name="car" class="w-6 h-6" />
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                    <span class="badge {{ $intervention->status_color }} shrink-0">
                                        {{ $intervention->status_label }}
                                    </span>
                                </div>
                                <p class="flex items-center gap-1.5 text-sm text-slate-600 mt-1.5">
                                    <x-icon name="user" class="w-3.5 h-3.5 text-slate-400" />
                                    {{ $intervention->client_name }}
                                </p>
                                @if($intervention->client_phone)
                                    <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                        <x-icon name="phone" class="w-3.5 h-3.5" />
                                        {{ $intervention->client_phone }}
                                    </p>
                                @endif
                                @if($intervention->isGuest())
                                    <p class="flex items-center gap-1.5 text-xs text-orange-600 font-medium mt-0.5">
                                        <x-icon name="zap" class="w-3.5 h-3.5" />
                                        Sans compte - {{ $intervention->tracking_code }}
                                    </p>
                                @endif
                                <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                    <x-icon name="clock" class="w-3.5 h-3.5" />
                                    {{ $intervention->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-auto border-t border-slate-100 bg-slate-50/60 px-5 py-3 flex items-center justify-between gap-3">
                            <a href="{{ route('admin.intervention.show', $intervention) }}" class="btn-primary">
                                Voir le detail
                                <x-icon name="chevron-right" class="w-4 h-4" />
                            </a>
                            <form method="POST" action="{{ route('admin.intervention.destroy', $intervention) }}"
                                  onsubmit="return confirm('Supprimer definitivement cette intervention ? Cette action est irreversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Supprimer" class="btn-danger">
                                    <x-icon name="trash" class="w-4 h-4" />
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="sm:col-span-2 card flex flex-col items-center justify-center py-16 px-6 text-center">
                        <div class="h-16 w-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                            <x-icon name="zap" class="w-8 h-8" />
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Aucune intervention trouvee</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-sm">Aucune intervention ne correspond a vos criteres pour le moment.</p>
                        @if(request()->anyFilled(['status', 'service_type', 'search']))
                            <a href="{{ route('admin.intervention.index') }}" class="btn-secondary mt-5">
                                <x-icon name="x" class="w-4 h-4" />
                                Effacer les filtres
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            @if($interventions->hasPages())
                <div class="flex justify-center mt-8">
                    {{ $interventions->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection