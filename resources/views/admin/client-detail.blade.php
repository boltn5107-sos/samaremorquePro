@extends('layouts.app')
@section('title', 'Detail client')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <x-icon name="user" class="w-6 h-6" />
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">{{ $client->full_name }}</h1>
                        <p class="text-sm text-slate-500">Detail du compte client</p>
                    </div>
                </div>
                <a href="{{ route('admin.clients.index') }}" class="btn-secondary">
                    <x-icon name="chevron-left" class="w-4 h-4" />
                    Retour
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="card p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-5 flex items-center gap-2">
                            <div class="p-2 rounded-lg bg-indigo-100 text-indigo-600 w-fit">
                                <x-icon name="user" class="w-4 h-4" />
                            </div>
                            Informations
                        </h2>
                        <div class="flex items-center gap-4 mb-6 p-4 rounded-xl bg-slate-50 border border-slate-100">
                            @if($client->photo)
                                <img src="{{ asset('storage/' . $client->photo) }}" alt="" class="w-16 h-16 rounded-full object-cover bg-slate-100">
                            @else
                                <div class="w-16 h-16 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-bold text-xl">
                                    {{ strtoupper(substr($client->first_name, 0, 1)) }}{{ strtoupper(substr($client->last_name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="text-lg font-bold text-slate-900">{{ $client->full_name }}</p>
                                <span class="badge {{ $client->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} mt-1">
                                    {{ $client->is_active ? 'Actif' : 'Suspendu' }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Email</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $client->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Telephone</p>
                                @php
                                    $clPhone = preg_replace('/[^0-9]/', '', $client->phone ?? '');
                                    $clWa = $clPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $clPhone) : '#';
                                @endphp
                                <p class="text-sm font-semibold text-slate-900">{{ $client->phone }}</p>
                                <div class="flex flex-wrap gap-1.5 mt-2">
                                    <a href="tel:{{ $client->phone }}" class="btn-secondary px-3 py-1 text-xs">
                                        <x-icon name="phone" class="w-3 h-3" /> Appeler
                                    </a>
                                    <a href="{{ $clWa }}" target="_blank" rel="noopener" class="px-3 py-1 text-xs font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                        WhatsApp
                                    </a>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Statut</p>
                                <span class="badge {{ $client->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $client->is_active ? 'Actif' : 'Suspendu' }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Inscrit le</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $client->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="card p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                            <div class="p-2 rounded-lg bg-orange-100 text-orange-600 w-fit">
                                <x-icon name="check" class="w-4 h-4" />
                            </div>
                            Actions
                        </h2>
                        <div class="space-y-3">
                            @if($client->is_active)
                                <form method="POST" action="{{ route('admin.clients.suspend', $client) }}">
                                    @csrf
                                    <button type="submit" class="btn-danger w-full">
                                        <x-icon name="x" class="w-4 h-4" />
                                        Suspendre
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.clients.reactivate', $client) }}">
                                    @csrf
                                    <button type="submit" class="btn-primary w-full">
                                        <x-icon name="check" class="w-4 h-4" />
                                        Reactiver
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection