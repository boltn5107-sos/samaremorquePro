@extends('layouts.guest')

@section('title', 'Mot de passe oublie')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Mot de passe oublie ?</h2>
        <p class="mt-2 text-sm text-slate-600">Entrez votre email pour recevoir un lien de reinitialisation.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded">
            Un lien de reinitialisation a ete envoye a votre adresse email.
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-slate-300 placeholder-slate-500 text-slate-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Envoyer le lien
            </button>
        </div>

        <p class="text-center text-sm text-slate-600">
            <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500">Retour a la connexion</a>
        </p>
    </form>
@endsection
