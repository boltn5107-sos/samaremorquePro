@extends('layouts.app')

@section('title', 'Mes vehicules')

@section('content')
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="car" class="w-6 h-6 text-orange-500" />
            Mes vehicules
        </h1>

        <div class="card p-6 mb-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                <x-icon name="plus" class="w-5 h-5 text-orange-500" />
                Ajouter un vehicule
            </h2>
            <form method="POST" action="{{ route('client.vehicles.store') }}" class="space-y-4">
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
                <div class="card p-5 flex flex-col">
                    <div class="p-3 rounded-xl bg-slate-100 text-slate-600 w-fit mb-3">
                        <x-icon name="car" class="w-6 h-6" />
                    </div>
                    <h3 class="font-semibold text-slate-900">{{ $vehicle->brand ?? 'Sans marque' }} {{ $vehicle->model ?? '' }}</h3>
                    <p class="text-sm text-slate-500">{{ ucfirst($vehicle->type) }}</p>
                    @if($vehicle->plate_number)
                        <p class="text-sm text-slate-500 flex items-center gap-1"><x-icon name="map-pin" class="w-3.5 h-3.5" /> {{ $vehicle->plate_number }}</p>
                    @endif
                    <form method="POST" action="{{ route('client.vehicles.destroy', $vehicle) }}" class="mt-auto pt-3"
                        onsubmit="return confirm('Supprimer ce vehicule ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger w-full py-2 text-sm">
                            <x-icon name="x" class="w-4 h-4" /> Supprimer
                        </button>
                    </form>
                </div>
            @empty
                <div class="card p-10 text-center text-slate-500 col-span-full">
                    <x-icon name="car" class="w-12 h-12 mx-auto mb-2 text-slate-300" />
                    Aucun vehicule enregistre.
                </div>
            @endforelse
        </div>
    </div>
@endsection
