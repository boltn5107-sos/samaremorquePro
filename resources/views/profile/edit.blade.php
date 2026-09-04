@extends('layouts.app')

@section('title', 'Mon profil')

@php
    $roleLabel = match (Auth::user()->role) {
        'client' => 'Client',
        'remorqueur' => 'Remorqueur',
        'depanneur' => 'Depanneur',
        'admin' => 'Admin',
        default => ucfirst(Auth::user()->role),
    };
@endphp

@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mb-16">
        <div class="flex items-center gap-4 mb-6">
            <div class="relative">
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="" class="w-20 h-20 rounded-full object-cover bg-slate-100 border-2 border-orange-200">
                @else
                    <div class="w-20 h-20 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-bold text-2xl">
                        {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ Auth::user()->full_name }}</h1>
                <span class="inline-flex items-center gap-1.5 text-sm font-medium text-orange-700 bg-orange-50 px-3 py-1 rounded-full">
                    <x-icon name="user" class="w-4 h-4" />
                    {{ $roleLabel }}
                </span>
            </div>
        </div>

        <div class="space-y-6">

            {{-- Photo de profil --}}
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <x-icon name="camera" class="w-5 h-5 text-orange-500" />
                    Photo de profil
                </h2>
                <form method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    @csrf
                    <input type="file" id="photo" name="photo" accept="image/*" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <button type="submit" class="btn-primary whitespace-nowrap">
                        <x-icon name="upload" class="w-4 h-4" />
                        Changer la photo
                    </button>
                </form>
            </div>

            {{-- Informations personnelles --}}
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <x-icon name="user" class="w-5 h-5 text-orange-500" />
                    Informations personnelles
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="label">Prenom</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" required class="input">
                            @error('first_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="label">Nom</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" required class="input">
                            @error('last_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="label">Email</label>
                        <input type="email" id="email" value="{{ Auth::user()->email }}" disabled class="input bg-slate-100">
                    </div>

                    <div>
                        <label for="phone" class="label">Telephone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required class="input">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(Auth::user()->isRemorqueur() || Auth::user()->isDepanneur())
                        <div>
                            <label for="zone_intervention" class="label">Zone d'intervention</label>
                            <input type="text" id="zone_intervention" name="zone_intervention" value="{{ old('zone_intervention', Auth::user()->zone_intervention) }}" class="input">
                        </div>

                        <div>
                            <label for="professional_info" class="label">Informations professionnelles</label>
                            <textarea id="professional_info" name="professional_info" rows="2" class="input">{{ old('professional_info', Auth::user()->professional_info) }}</textarea>
                        </div>

                        <div>
                            <label for="bio" class="label">Biographie</label>
                            <textarea id="bio" name="bio" rows="3" class="input">{{ old('bio', Auth::user()->bio) }}</textarea>
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary">
                            <x-icon name="check" class="w-4 h-4" />
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>

            @if(Auth::user()->isRemorqueur())
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <x-icon name="truck" class="w-5 h-5 text-orange-500" />
                        Ma remorque
                    </h2>
                    <form method="POST" action="{{ route('profile.remorque') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="type" class="label">Type de remorque</label>
                                <input type="text" id="type" name="type" value="{{ old('type', $remorque->type ?? 'plateau') }}" required class="input">
                            </div>
                            <div>
                                <label for="capacity" class="label">Capacite</label>
                                <input type="text" id="capacity" name="capacity" value="{{ old('capacity', $remorque->capacity ?? '') }}" class="input">
                            </div>
                            <div>
                                <label for="immatriculation" class="label">Immatriculation</label>
                                <input type="text" id="immatriculation" name="immatriculation" value="{{ old('immatriculation', $remorque->immatriculation ?? '') }}" class="input">
                            </div>
                        </div>
                        <div>
                            <label for="informations" class="label">Informations</label>
                            <textarea id="informations" name="informations" rows="2" class="input">{{ old('informations', $remorque->informations ?? '') }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn-primary">
                                <x-icon name="check" class="w-4 h-4" />
                                Enregistrer la remorque
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            @if(Auth::user()->isDepanneur())
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <x-icon name="wrench" class="w-5 h-5 text-orange-500" />
                        Mes services
                    </h2>
                    <form method="POST" action="{{ route('profile.services') }}" class="space-y-4">
                        @csrf
                        <p class="text-sm text-slate-500">Selectionnez les services que vous proposez :</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @forelse($services as $service)
                                <label class="flex items-center gap-2 p-3 rounded-lg border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}" class="rounded text-orange-500" {{ $assignedServices->contains($service->id) ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-slate-700">{{ $service->name }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-slate-500">Aucun service disponible.</p>
                            @endforelse
                        </div>
                        @if($services->isNotEmpty())
                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary">
                                    <x-icon name="check" class="w-4 h-4" />
                                    Enregistrer les services
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            @endif

            {{-- Suppression du compte --}}
            <div class="card p-6 border-red-200">
                <h2 class="text-lg font-semibold text-slate-900 mb-2 flex items-center gap-2">
                    <x-icon name="alert-triangle" class="w-5 h-5 text-red-500" />
                    Zone dangereuse
                </h2>
                <p class="text-sm text-slate-500 mb-4">La suppression de votre compte est definitive et irreversible.</p>
                <form method="POST" action="{{ route('profile.destroy') }}"
                    onsubmit="return confirm('Etes-vous sur de vouloir supprimer votre compte ?')">
                    @csrf
                    @method('DELETE')
                    <label for="password" class="label">Confirmez avec votre mot de passe</label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="password" id="password" name="password" required class="input flex-1" placeholder="Votre mot de passe">
                        <button type="submit" class="btn-danger whitespace-nowrap">
                            <x-icon name="trash" class="w-4 h-4" />
                            Supprimer mon compte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
