@extends('layouts.app')

@section('title', 'Detail professionnel')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-6">{{ $professional->full_name }}</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Informations</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-slate-500">Email</p>
                            <p class="text-base text-slate-900">{{ $professional->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Telephone</p>
                            <p class="text-base text-slate-900">{{ $professional->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Role</p>
                            <p class="text-base text-slate-900">{{ ucfirst($professional->role) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Statut</p>
                            <p class="text-base text-slate-900">{{ $professional->is_validated ? 'Valide' : 'En attente' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Zone d'intervention</p>
                            <p class="text-base text-slate-900">{{ $professional->zone_intervention ?? 'Non definie' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Actions</h2>
                    <div class="space-y-3">
                        @if(!$professional->is_validated)
                            <form method="POST" action="{{ route('admin.professionnels.validate', $professional) }}">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                                    Valider le compte
                                </button>
                            </form>
                        @endif

                        @if($professional->is_active)
                            <form method="POST" action="{{ route('admin.professionnels.suspend', $professional) }}">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                    Suspendre
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.professionnels.reactivate', $professional) }}">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                                    Reactiver
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
