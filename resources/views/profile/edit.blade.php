@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="p-3 rounded-xl bg-primary text-accent-500">
                <x-icon name="user" class="w-6 h-6" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ Auth::user()->full_name }}</h1>
                <p class="text-sm text-slate-500">{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>

        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-6 flex items-center gap-2">
                <x-icon name="user" class="w-5 h-5 text-orange-500" />
                Modifier mon profil
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
    </div>
@endsection
