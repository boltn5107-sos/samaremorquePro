@extends('layouts.app')
@section('title', 'Mes vehicules')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="absolute inset-0 hero-gradient pointer-events-none" aria-hidden="true"></div>
        <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
            <div class="mb-8">
                <h1 class="font-display text-2xl md:text-3xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-orange-100 text-orange-600">
                        <x-icon name="car" class="w-5 h-5" />
                    </span>
                    Mes vehicules
                </h1>
                <p class="mt-1.5 text-sm text-slate-500 ml-[52px]">Gerez vos vehicules enregistres pour faciliter vos demandes.</p>
            </div>

            <div class="card p-6 md:p-8 mb-8">
                <h2 class="font-display text-lg font-semibold text-slate-900 mb-5 flex items-center gap-2.5">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600">
                        <x-icon name="plus" class="w-4 h-4" />
                    </span>
                    Ajouter un vehicule
                </h2>
                <form method="POST" action="{{ route('client.vehicles.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="type" class="label">Type</label>
                            <input type="text" id="type" name="type" required class="input" placeholder="Voiture, moto...">
                        </div>
                        <div>
                            <label for="brand" class="label">Marque</label>
                            <input type="text" id="brand" name="brand" class="input" placeholder="Toyota, Peugeot...">
                        </div>
                        <div>
                            <label for="model" class="label">Modele</label>
                            <input type="text" id="model" name="model" class="input">
                        </div>
                        <div>
                            <label for="plate_number" class="label">Immatriculation</label>
                            <input type="text" id="plate_number" name="plate_number" class="input">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">
                        <x-icon name="plus" class="w-4 h-4" />
                        Ajouter le vehicule
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($vehicles as $vehicle)
                    <div class="card p-5 flex flex-col group/card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-slate-50 to-slate-100 text-slate-600 group-hover/card:from-orange-50 group-hover/card:to-orange-100 group-hover/card:text-orange-600 transition-all duration-300">
                                <x-icon name="car" class="w-6 h-6" />
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                {{ ucfirst($vehicle->type) }}
                            </span>
                        </div>
                        <h3 class="font-semibold text-slate-900">{{ $vehicle->brand ?? 'Sans marque' }} {{ $vehicle->model ?? '' }}</h3>
                        @if($vehicle->plate_number)
                            <p class="text-sm text-slate-500 flex items-center gap-1.5 mt-1">
                                <x-icon name="map-pin" class="w-3.5 h-3.5 text-slate-400" />
                                {{ $vehicle->plate_number }}
                            </p>
                        @endif
                        <div class="mt-auto pt-4">
                            <div class="h-px bg-slate-100 mb-4"></div>
                            <form method="POST" action="{{ route('client.vehicles.destroy', $vehicle) }}"
                                onsubmit="return confirm('Supprimer ce vehicule ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl text-red-600 bg-red-50 border border-red-100 hover:bg-red-100 hover:border-red-200 transition-all duration-300">
                                    <x-icon name="x" class="w-4 h-4" /> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="card p-12 text-center col-span-full border-dashed border-2 !border-slate-200">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                            <x-icon name="car" class="w-8 h-8 text-slate-300" />
                        </div>
                        <p class="font-semibold text-slate-700">Aucun vehicule enregistre</p>
                        <p class="text-sm text-slate-400 mt-1">Ajoutez votre premier vehicule ci-dessus.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
