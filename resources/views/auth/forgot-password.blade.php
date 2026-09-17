@extends('layouts.guest')
@section('content')
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Mot de passe oublie</h2>
        <p class="mt-2 text-sm text-slate-600">Entrez votre email et nous vous enverrons un lien de reset</p>
    </div>
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" required autocomplete="email" class="input" placeholder="votre@email.com" value="{{ old('email') }}">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn-primary w-full text-base py-4">Envoyer le lien de reset</button>
        </div>
    </form>
</div>
@endsection