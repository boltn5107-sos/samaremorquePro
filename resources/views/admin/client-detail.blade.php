@extends('layouts.app')

@section('title', 'Detail client')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-6">{{ $client->full_name }}</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Informations</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-slate-500">Email</p>
                            <p class="text-base text-slate-900">{{ $client->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Telephone</p>
                            <p class="text-base text-slate-900">{{ $client->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Statut</p>
                            <p class="text-base text-slate-900">{{ $client->is_active ? 'Actif' : 'Suspendu' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Inscrit le</p>
                            <p class="text-base text-slate-900">{{ $client->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Actions</h2>
                    <div class="space-y-3">
                        @if($client->is_active)
                            <form method="POST" action="{{ route('admin.clients.suspend', $client) }}">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                    Suspendre
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.clients.reactivate', $client) }}">
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
