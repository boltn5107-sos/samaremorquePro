@extends('layouts.guest')
@section('content')
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Reset du mot de passe</h2>
        <p class="mt-2 text-sm text-slate-600">Choisissez votre nouveau mot de passe</p>
    </div>
    <form method="POST" action="{{ route('password.update', $token) }}" class="space-y-5">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <div>
            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" required autocomplete="email" class="input" value="{{ $email }}">
        </div>
        <div>
            <label for="password" class="label">Nouveau mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="input" placeholder="Au moins 8 caracteres">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input" placeholder="Confirmez">
        </div>
        <div>
            <button type="submit" class="btn-primary w-full text-base py-4">Redefinir le mot de passe</button>
        </div>
    </form>
</div>
@endsection