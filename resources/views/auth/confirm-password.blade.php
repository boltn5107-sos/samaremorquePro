@extends('layouts.guest')
@section('title', 'Confirmer le mot de passe')
@section('content')
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Confirmez votre mot de passe</h2>
        <p class="mt-2 text-sm text-slate-600">Veuillez confirmer votre mot de passe avant de continuer.</p>
    </div>
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf
        <div>
            <label for="password" class="label">Mot de passe</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required autocomplete="current-password" class="input" placeholder="Votre mot de passe">
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn-primary w-full text-base py-4">Confirmer</button>
        </div>
    </form>
</div>
@endsection