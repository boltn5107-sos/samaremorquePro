@extends('layouts.guest')
@section('title', 'Connexion')
@section('content')
<div class="relative overflow-hidden">
    {{-- Habillage décoratif --}}
    <div class="pointer-events-none absolute -top-24 -right-24 w-72 h-72 rounded-full bg-gradient-to-br from-accent-200/50 via-accent-100/30 to-transparent blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-28 -left-28 w-80 h-80 rounded-full bg-gradient-to-tr from-sky-100/70 to-transparent blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 landing-asphalt opacity-40" aria-hidden="true"></div>

    <div class="relative space-y-7">
        {{-- En-tête --}}
        <div class="text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent-50 border border-accent-100 text-[11px] font-bold uppercase tracking-widest text-accent-600">
                <x-icon name="zap" class="w-3 h-3" />
                Espace membre
            </span>
            <h2 class="mt-4 font-display text-2xl font-bold text-night">Connexion</h2>
            <p class="mt-1.5 text-sm text-slate-500">Accédez à votre espace SamaRemorque</p>
        </div>

        {{-- Points dégradés décoratifs --}}
        <div class="flex items-center justify-center gap-1.5" aria-hidden="true">
            <span class="w-1.5 h-1.5 rounded-full bg-accent-400"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-accent-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-accent-200"></span>
        </div>

        @if(session('status'))
            <div class="flex items-start gap-2.5 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm">
                <x-icon name="check-circle" class="w-4 h-4 mt-0.5 shrink-0" />
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="label">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="user" class="w-4 h-4" />
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="votre@email.com" class="input pl-10 @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="label">Mot de passe</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="shield" class="w-4 h-4" />
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe" class="input pl-10 @error('password') border-red-500 @enderror">
                </div>
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between gap-2">
                <label class="flex items-center text-sm text-slate-600 cursor-pointer select-none">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-slate-300 text-accent-600 shadow-sm focus:ring-accent-500 mr-2 w-4 h-4">
                    Se souvenir de moi
                </label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-accent text-sm">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit" class="btn-primary w-full text-base py-3.5 group">
                Se connecter
                <x-icon name="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" />
            </button>
        </form>

        {{-- Pied de page --}}
        <div class="border-t border-slate-100 pt-5">
            <p class="text-center text-sm text-slate-600">
                Pas de compte ? <a href="{{ route('register') }}" class="link-accent">Créer un compte</a>
            </p>
        </div>
    </div>
</div>
@endsection