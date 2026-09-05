@extends('layouts.app')

@section('title', 'Interventions')

@section('content')
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <x-icon name="zap" class="w-6 h-6 text-orange-500" />
                Interventions
            </h1>
            <a href="{{ route('admin.intervention.export', request()->only(['status', 'service_type', 'search'])) }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-semibold rounded-lg border border-slate-300 text-slate-700 bg-white hover:bg-slate-50">
                <x-icon name="download" class="w-4 h-4" />
                Exporter CSV
            </a>
        </div>

        <form method="GET" action="{{ route('admin.intervention.index') }}" class="card p-4 mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label for="status" class="block text-xs font-medium text-slate-500 mb-1">Statut</label>
                    <select name="status" id="status"
                            class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Tous les statuts</option>
                        @foreach(\App\Models\Intervention::STATUS_LABELS as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="service_type" class="block text-xs font-medium text-slate-500 mb-1">Service</label>
                    <select name="service_type" id="service_type"
                            class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Tous les services</option>
                        <option value="remorquage" @selected(request('service_type') === 'remorquage')>Remorquage</option>
                        <option value="depannage" @selected(request('service_type') === 'depannage')>Depannage</option>
                    </select>
                </div>
                <div>
                    <label for="search" class="block text-xs font-medium text-slate-500 mb-1">Rechercher</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Client, destination, detail..."
                           class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>
            </div>
            <div class="flex items-center gap-3 mt-3">
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700">
                    <x-icon name="filter" class="w-4 h-4" />
                    Filtrer
                </button>
                @if(request()->anyFilled(['status', 'service_type', 'search']))
                    <a href="{{ route('admin.intervention.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-md text-sm font-semibold text-slate-600 hover:text-slate-900">
                        <x-icon name="x" class="w-4 h-4" />
                        Effacer
                    </a>
                @endif
            </div>
        </form>

        <div class="card overflow-hidden mb-6">
            <ul class="divide-y divide-slate-200">
                @forelse($interventions as $intervention)
                    <li class="flex items-center">
                        <a href="{{ route('admin.intervention.show', $intervention) }}" class="flex flex-1 items-center gap-4 px-5 py-4 hover:bg-slate-50 min-w-0">
                            <div class="flex-shrink-0">
                                @if($intervention->photo)
                                    <img src="{{ asset('storage/' . $intervention->photo) }}" alt="Photo de la panne" class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                @else
                                    <div class="flex-shrink-0 p-2.5 rounded-lg bg-orange-100 text-orange-600">
                                        <x-icon name="car" class="w-5 h-5" />
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                    <span class="badge {{ $intervention->status_color }}">
                                        {{ $intervention->status_label }}
                                    </span>
                                </div>
                                <p class="flex items-center gap-1.5 text-sm text-slate-500 mt-0.5">
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
                            <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 flex-shrink-0" />
                        </a>
                        <form method="POST" action="{{ route('admin.intervention.destroy', $intervention) }}" class="pr-3 flex-shrink-0"
                              onsubmit="return confirm('Supprimer definitivement cette intervention ? Cette action est irreversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Supprimer"
                                    class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50">
                                <x-icon name="trash" class="w-4 h-4" />
                            </button>
                        </form>
                    </li>
                @empty
                    <li class="px-5 py-12 text-center text-slate-500">
                        <x-icon name="zap" class="w-12 h-12 mx-auto mb-2 text-slate-300" />
                        Aucune intervention trouvee.
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="flex justify-center">
            {{ $interventions->links() }}
        </div>
    </div>
@endsection