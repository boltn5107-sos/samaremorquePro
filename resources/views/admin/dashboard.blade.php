@extends('layouts.app')
@section('title', 'Tableau de bord admin')
@section('content')
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50 via-white to-indigo-50 -z-10"></div>
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 text-white shadow-lg shadow-orange-200">
                        <x-icon name="shield" class="w-6 h-6" />
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Bonjour, {{ Auth::user()->name ?? 'Admin' }}</h1>
                        <p class="text-sm text-slate-500">Voici un apercu de votre activite aujourd'hui</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="group relative bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-400 to-orange-600"></div>
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-orange-100 to-orange-50 text-orange-600 group-hover:scale-105 transition-transform">
                            <x-icon name="zap" class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Aujourd'hui</p>
                            <p class="text-2xl font-bold text-slate-900">{{ $todayInterventions }}</p>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-sky-400 to-sky-600"></div>
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-sky-100 to-sky-50 text-sky-600 group-hover:scale-105 transition-transform">
                            <x-icon name="clock" class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">En cours</p>
                            <p class="text-2xl font-bold text-slate-900">{{ $activeInterventions }}</p>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600 group-hover:scale-105 transition-transform">
                            <x-icon name="check-circle" class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Terminees</p>
                            <p class="text-2xl font-bold text-slate-900">{{ $completedInterventions }}</p>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-400 to-indigo-600"></div>
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-indigo-100 to-indigo-50 text-indigo-600 group-hover:scale-105 transition-transform">
                            <x-icon name="user" class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Disponibles</p>
                            <p class="text-2xl font-bold text-slate-900">{{ $availableProfessionals }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-slate-900">Actions rapides</h2>
                        <div class="p-1.5 rounded-lg bg-slate-50 text-slate-400">
                            <x-icon name="arrow-right" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="{{ route('admin.intervention.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-orange-200 hover:bg-orange-50/50 transition-all duration-200">
                                <div class="flex-shrink-0 p-2.5 rounded-lg bg-orange-100 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                    <x-icon name="wrench" class="w-5 h-5" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-900">Interventions</p>
                                    <p class="text-xs text-slate-500">Suivre et gerer les interventions</p>
                                </div>
                                <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-orange-500 transition-colors" />
                            </a>

                            <a href="{{ route('admin.professionnels.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 transition-all duration-200">
                                <div class="flex-shrink-0 p-2.5 rounded-lg bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                    <x-icon name="user" class="w-5 h-5" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-900">Professionnels</p>
                                    <p class="text-xs text-slate-500">Gestion des professionnels</p>
                                </div>
                                <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-indigo-500 transition-colors" />
                            </a>

                            <a href="{{ route('admin.clients.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/50 transition-all duration-200">
                                <div class="flex-shrink-0 p-2.5 rounded-lg bg-sky-100 text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-colors">
                                    <x-icon name="car" class="w-5 h-5" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-900">Clients</p>
                                    <p class="text-xs text-slate-500">Gestion des clients</p>
                                </div>
                                <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-sky-500 transition-colors" />
                            </a>

                            <a href="{{ route('admin.map') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/50 transition-all duration-200">
                                <div class="flex-shrink-0 p-2.5 rounded-lg bg-emerald-100 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <x-icon name="map" class="w-5 h-5" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-900">Carte temps reel</p>
                                    <p class="text-xs text-slate-500">Localisation en direct</p>
                                </div>
                                <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-emerald-500 transition-colors" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="text-lg font-semibold text-slate-900">Statistiques</h2>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex-1 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center mb-4">
                                <x-icon name="chart" class="w-8 h-8 text-indigo-600" />
                            </div>
                            <p class="text-sm text-slate-600 mb-1">Performance globale</p>
                            <p class="text-xs text-slate-400 mb-5">Consultez les details de votre activite</p>
                            <a href="{{ route('admin.stats') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-sm font-semibold hover:from-indigo-700 hover:to-violet-700 transition-all shadow-md shadow-indigo-200 hover:shadow-lg">
                                <x-icon name="chart" class="w-4 h-4" />
                                Voir les stats
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-semibold text-slate-900">Activite recente</h2>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-700">Temps reel</span>
                    </div>
                    <div class="p-1.5 rounded-lg bg-slate-50 text-slate-400">
                        <x-icon name="bell" class="w-4 h-4" />
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                            <x-icon name="refresh" class="w-6 h-6 text-slate-400" />
                        </div>
                        <p class="text-sm font-medium text-slate-900 mb-1">Aucune activite recente</p>
                        <p class="text-xs text-slate-500 max-w-xs">Les dernieres actions sur la plateforme apparaitront ici en temps reel.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
