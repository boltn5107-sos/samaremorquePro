@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="chart" class="w-6 h-6 text-orange-500" />
            Statistiques
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-indigo-100 text-indigo-600 w-fit mb-3">
                    <x-icon name="user" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_clients'] }}</p>
                <p class="text-sm text-slate-500">Total clients</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-orange-100 text-orange-600 w-fit mb-3">
                    <x-icon name="truck" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_remorqueurs'] }}</p>
                <p class="text-sm text-slate-500">Total remorqueurs</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-sky-100 text-sky-600 w-fit mb-3">
                    <x-icon name="wrench" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_depanneurs'] }}</p>
                <p class="text-sm text-slate-500">Total depanneurs</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-emerald-100 text-emerald-600 w-fit mb-3">
                    <x-icon name="zap" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_interventions'] }}</p>
                <p class="text-sm text-slate-500">Total interventions</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-amber-100 text-amber-600 w-fit mb-3">
                    <x-icon name="clock" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['interventions_this_month'] }}</p>
                <p class="text-sm text-slate-500">Interventions ce mois</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-slate-100 text-slate-600 w-fit mb-3">
                    <x-icon name="clock" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['interventions_last_month'] }}</p>
                <p class="text-sm text-slate-500">Interventions mois dernier</p>
            </div>
        </div>
    </div>
@endsection
