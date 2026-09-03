@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" required
                    value="{{ old('email') }}"
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-slate-300 placeholder-slate-500 text-slate-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm">
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Mot de passe</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-slate-300 placeholder-slate-500 text-slate-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm">
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-slate-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-slate-900">Se souvenir de moi</label>
            </div>

            <div class="text-sm">
                <a href="{{ route('password.request') }}" class="font-medium text-orange-600 hover:text-orange-500">Mot de passe oublie ?</a>
            </div>
        </div>

        <div>
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Se connecter
            </button>
        </div>

        <p class="text-center text-sm text-slate-600">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-medium text-orange-600 hover:text-orange-500">S'inscrire</a>
        </p>
    </form>
@endsection
