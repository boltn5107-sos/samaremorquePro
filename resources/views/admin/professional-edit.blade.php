@extends('layouts.app')

@section('title', 'Editer professionnel')

@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('admin.professionnels.show', $professional) }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-900 mb-4">
            <x-icon name="chevron-left" class="w-4 h-4" />
            Retour au profil
        </a>

        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="edit" class="w-6 h-6 text-orange-500" />
            Editer {{ $professional->full_name }}
        </h1>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                @foreach($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.professionnels.update', $professional) }}" class="card p-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-slate-700 mb-1">Prenom</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $professional->first_name) }}" required
                           class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-slate-700 mb-1">Nom</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $professional->last_name) }}" required
                           class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Telephone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $professional->phone) }}" required
                       class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label for="zone_intervention" class="block text-sm font-medium text-slate-700 mb-1">Zone d'intervention</label>
                <input type="text" id="zone_intervention" name="zone_intervention" value="{{ old('zone_intervention', $professional->zone_intervention) }}"
                       placeholder="Ex : Dakar, Pikine, Guédiawaye..."
                       class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-slate-700 mb-1">Bio / description</label>
                <textarea id="bio" name="bio" rows="3"
                          class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">{{ old('bio', $professional->bio) }}</textarea>
            </div>

            @php
                $profile = $professional->isRemorqueur()
                    ? $professional->remorqueurProfile
                    : $professional->depanneurProfile;
            @endphp
            <div>
                <label for="hourly_rate" class="block text-sm font-medium text-slate-700 mb-1">Tarif horaire (FCFA/h)</label>
                <input type="number" id="hourly_rate" name="hourly_rate" min="0" step="500"
                       value="{{ old('hourly_rate', $profile?->hourly_rate) }}"
                       placeholder="Ex : 15000"
                       class="w-full rounded-md border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                <p class="text-xs text-slate-400 mt-1">Ce tarif est utilise pour estimer le chiffre d'affaires et affiche au client.</p>
            </div>

            <button type="submit"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700">
                <x-icon name="check" class="w-4 h-4" />
                Enregistrer les modifications
            </button>
        </form>
    </div>
@endsection