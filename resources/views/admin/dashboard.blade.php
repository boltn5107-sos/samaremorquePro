@extends('layouts.app')

@section('title', 'Tableau de bord admin')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">Tableau de bord Administrateur</h1>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="card p-5">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-orange-100 text-orange-600">
                        <x-icon name="zap" class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Interventions aujourd'hui</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $todayInterventions }}</p>
                    </div>
                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-sky-100 text-sky-600">
                        <x-icon name="clock" class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">En cours</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $activeInterventions }}</p>
                    </div>
                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-emerald-100 text-emerald-600">
                        <x-icon name="check-circle" class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Terminees</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $completedInterventions }}</p>
                    </div>
                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-indigo-100 text-indigo-600">
                        <x-icon name="user" class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Professionnels disponibles</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $availableProfessionals }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Actions rapides</h2>
                <div class="space-y-3">
                    <a href="{{ route('admin.intervention.index') }}" class="flex items-center justify-between w-full text-center py-2.5 px-4 rounded-lg text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700">
                        <span class="mx-auto">Voir les interventions</span>
                        <x-icon name="chevron-right" class="w-4 h-4" />
                    </a>
                    <a href="{{ route('admin.professionnels.index') }}" class="flex items-center justify-between w-full text-center py-2.5 px-4 rounded-lg text-sm font-semibold text-white bg-slate-600 hover:bg-slate-700">
                        <span class="mx-auto">Gerer les professionnels</span>
                        <x-icon name="chevron-right" class="w-4 h-4" />
                    </a>
                    <a href="{{ route('admin.clients.index') }}" class="flex items-center justify-between w-full text-center py-2.5 px-4 rounded-lg text-sm font-semibold text-white bg-slate-600 hover:bg-slate-700">
                        <span class="mx-auto">Gerer les clients</span>
                        <x-icon name="chevron-right" class="w-4 h-4" />
                    </a>
                    <a href="{{ route('admin.map') }}" class="flex items-center justify-between w-full text-center py-2.5 px-4 rounded-lg text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800">
                        <span class="mx-auto">Carte en temps reel</span>
                        <x-icon name="map" class="w-4 h-4" />
                    </a>
                </div>
            </div>

            <div class="card p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Statistiques</h2>
                <a href="{{ route('admin.stats') }}" class="text-orange-600 hover:text-orange-500 font-medium">Voir les statistiques detaillees</a>
            </div>
        </div>
    </div>
@endsection
