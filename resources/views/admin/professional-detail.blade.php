@extends('layouts.app')

@section('title', 'Detail professionnel')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-6">{{ $professional->full_name }}</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Informations</h2>
                    <div class="flex items-center gap-3 mb-4">
                        @if($professional->photo)
                            <img src="{{ asset('storage/' . $professional->photo) }}" alt="" class="w-14 h-14 rounded-full object-cover bg-slate-100">
                        @else
                            <div class="w-14 h-14 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-semibold text-lg">
                                {{ strtoupper(substr($professional->first_name, 0, 1)) }}{{ strtoupper(substr($professional->last_name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-lg font-semibold text-slate-900">{{ $professional->full_name }}</p>
                            <p class="text-sm text-slate-500">{{ ucfirst($professional->role) }} &middot; {{ $professional->is_validated ? 'Valide' : 'En attente' }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-slate-500">Email</p>
                            <p class="text-base text-slate-900">{{ $professional->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Telephone</p>
                            @php
                                $proPhone = preg_replace('/[^0-9]/', '', $professional->phone ?? '');
                                $proWa = $proPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $proPhone) : '#';
                            @endphp
                            <p class="text-base text-slate-900">{{ $professional->phone }}</p>
                            <div class="flex flex-wrap gap-1.5 mt-1.5">
                                <a href="tel:{{ $professional->phone }}" class="btn-secondary px-3 py-1 text-xs">
                                    <x-icon name="phone" class="w-3 h-3" /> Appeler
                                </a>
                                <a href="{{ $proWa }}" target="_blank" rel="noopener" class="px-3 py-1 text-xs font-semibold rounded-md text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                    WhatsApp
                                </a>
                            </div>
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

                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Notation des clients</h2>
                    @if($rating['average'])
                        <div class="flex items-center gap-3">
                            <div class="flex gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($rating['average']))
                                        <x-icon name="star-filled" class="w-6 h-6 text-amber-400" />
                                    @else
                                        <x-icon name="star" class="w-6 h-6 text-slate-300" />
                                    @endif
                                @endfor
                            </div>
                            <span class="text-2xl font-bold text-slate-900">{{ $rating['average'] }}</span>
                        </div>
                        <p class="text-sm text-slate-500 mt-2">{{ $rating['count'] }} note(s) sur les interventions terminees</p>
                    @else
                        <p class="text-sm text-slate-500">Aucune notation pour le moment.</p>
                    @endif
                </div>
            </div>

            <div>
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('admin.professionnels.edit', $professional) }}"
                           class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700">
                            Editer le compte
                        </a>

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

                        <form method="POST" action="{{ route('admin.professionnels.destroy', $professional) }}"
                              onsubmit="return confirm('Supprimer definitivement ce professionnel, son profil et toutes ses interventions ? Cette action est irreversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                Supprimer definitivement
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
