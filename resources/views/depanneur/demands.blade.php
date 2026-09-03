@extends('layouts.app')

@section('title', 'Demandes depanneur')

@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="bell" class="w-6 h-6 text-orange-500" />
            Demandes de depannage
        </h1>

        @if($interventions->isEmpty())
            <div class="card p-12 text-center text-slate-500">
                <x-icon name="bell" class="w-12 h-12 mx-auto mb-3 text-slate-300" />
                <p class="font-medium text-slate-700">Aucune demande disponible</p>
                <p class="text-sm mt-1">Les nouvelles demandes apparaitront ici.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($interventions as $intervention)
                    <div class="card p-5">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 p-3 rounded-xl bg-orange-100 text-orange-600">
                                    <x-icon name="wrench" class="w-6 h-6" />
                                </div>
                                <div class="space-y-1">
                                    <p class="font-semibold text-slate-900">{{ ucfirst($intervention->service_type) }}</p>
                                    <p class="flex items-center gap-1.5 text-sm text-slate-500">
                                        <x-icon name="map-pin" class="w-4 h-4 text-slate-400" />
                                        {{ $intervention->destination }}
                                    </p>
                                    <p class="flex items-center gap-1.5 text-sm text-slate-500">
                                        <x-icon name="user" class="w-4 h-4 text-slate-400" />
                                        {{ $intervention->client->full_name }}
                                    </p>
                                    <p class="flex items-center gap-1.5 text-xs text-slate-400">
                                        <x-icon name="clock" class="w-3.5 h-3.5" />
                                        {{ $intervention->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2 sm:flex-col">
                                <form method="POST" action="{{ route('depanneur.intervention.accept', $intervention) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="btn-primary w-full py-2 text-sm">
                                        <x-icon name="check" class="w-4 h-4" />
                                        Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('depanneur.intervention.reject', $intervention) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="btn-secondary w-full py-2 text-sm">
                                        <x-icon name="x" class="w-4 h-4" />
                                        Refuser
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
