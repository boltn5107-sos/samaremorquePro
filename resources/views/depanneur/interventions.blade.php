@extends('layouts.app')
@section('title', 'Mes interventions')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                <h1 class="text-3xl font-bold text-slate-900">Mes interventions</h1>
                <a href="{{ route('depanneur.intervention.incoming') }}" class="btn-primary inline-flex items-center gap-2">
                    <x-icon name="bell" class="w-4 h-4" />
                    Demandes en attente
                </a>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-slate-200">
                    @forelse($interventions as $intervention)
                        <li>
                            <a href="{{ route('depanneur.intervention.show', $intervention) }}" class="block hover:bg-slate-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-orange-600 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $intervention->status_color }}">
                                                {{ $intervention->status_label }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex sm:flex-col sm:gap-1">
                                            <p class="flex items-center gap-1.5 text-sm text-slate-500">
                                                <x-icon name="map-pin" class="w-4 h-4 text-slate-400" />
                                                {{ $intervention->destination }}
                                            </p>
                                            @if($intervention->vehicle_type)
                                                <p class="flex items-center gap-1.5 text-sm text-slate-500">
                                                    <x-icon name="car" class="w-4 h-4 text-slate-400" />
                                                    {{ ucfirst($intervention->vehicle_type) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-slate-500 sm:mt-0">
                                            <x-icon name="clock" class="w-4 h-4 text-slate-400 mr-1.5" />
                                            {{ $intervention->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-4 py-6 text-center text-slate-500">
                            <x-icon name="wrench" class="w-10 h-10 mx-auto mb-3 text-slate-300" />
                            Aucune intervention trouvee.
                        </li>
                    @endforelse
                </ul>
            </div>

            @if($interventions->hasPages())
                <div class="mt-6">
                    {{ $interventions->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection