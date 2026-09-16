@extends('layouts.guest')
@section('title', 'Inscription')
@section('content')
<div class="relative overflow-hidden">
    {{-- Habillage décoratif --}}
    <div class="pointer-events-none absolute -top-24 -right-24 w-72 h-72 rounded-full bg-gradient-to-br from-accent-200/50 via-accent-100/30 to-transparent blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-28 -left-28 w-80 h-80 rounded-full bg-gradient-to-tr from-sky-100/70 to-transparent blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 landing-asphalt opacity-40" aria-hidden="true"></div>

    <div class="relative space-y-6">
        {{-- En-tête --}}
        <div class="text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent-50 border border-accent-100 text-[11px] font-bold uppercase tracking-widest text-accent-600">
                <x-icon name="plus" class="w-3 h-3" />
                Rejoindre la plateforme
            </span>
            <h2 class="mt-4 font-display text-2xl font-bold text-night">Créer un compte</h2>
            <p class="mt-1.5 text-sm text-slate-500">Inscrivez-vous en quelques secondes sur SamaRemorque</p>
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

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="first_name" class="label">Prénom</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <x-icon name="user" class="w-4 h-4" />
                        </span>
                        <input id="first_name" type="text" name="first_name" required autocomplete="given-name" placeholder="Prénom" value="{{ old('first_name') }}" class="input pl-10 @error('first_name') border-red-500 @enderror">
                    </div>
                    @error('first_name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="last_name" class="label">Nom</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <x-icon name="user" class="w-4 h-4" />
                        </span>
                        <input id="last_name" type="text" name="last_name" required autocomplete="family-name" placeholder="Nom" value="{{ old('last_name') }}" class="input pl-10 @error('last_name') border-red-500 @enderror">
                    </div>
                    @error('last_name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="email" class="label">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="user" class="w-4 h-4" />
                    </span>
                    <input id="email" type="email" name="email" required autocomplete="email" placeholder="votre@email.com" value="{{ old('email') }}" class="input pl-10 @error('email') border-red-500 @enderror">
                </div>
                @error('email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone" class="label">Téléphone</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="phone" class="w-4 h-4" />
                    </span>
                    <input id="phone" type="tel" name="phone" required autocomplete="tel" placeholder="77 XXX XX XX" value="{{ old('phone') }}" class="input pl-10 @error('phone') border-red-500 @enderror">
                </div>
                @error('phone')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="role" class="label">Je suis</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="car" class="w-4 h-4" />
                    </span>
                    <select id="role" name="role" required class="input pl-10 @error('role') border-red-500 @enderror">
                        <option value="client" @selected(old('role') === 'client')>Conducteur</option>
                        <option value="remorqueur" @selected(old('role') === 'remorqueur')>Remorqueur</option>
                        <option value="depanneur" @selected(old('role') === 'depanneur')>Dépanneur</option>
                    </select>
                </div>
                @error('role')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="label">Mot de passe</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="shield" class="w-4 h-4" />
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Au moins 8 caractères" class="input pl-10 @error('password') border-red-500 @enderror">
                </div>
                @error('password')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="label">Confirmer le mot de passe</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <x-icon name="shield" class="w-4 h-4" />
                    </span>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez" class="input pl-10">
                </div>
            </div>

            <label class="flex items-start gap-2.5 cursor-pointer select-none">
                <input type="checkbox" name="terms" required class="rounded border-slate-300 text-accent-600 shadow-sm focus:ring-accent-500 mt-0.5 w-4 h-4">
                <span class="text-sm text-slate-600">
                    J'accepte les <a href="{{ route('privacy') }}" class="link-accent">conditions d'utilisation</a>
                </span>
            </label>
            @error('terms')<p class="text-sm text-red-600">{{ $message }}</p>@enderror

            <button type="submit" class="btn-primary w-full text-base py-3.5 group">
                Créer mon compte
                <x-icon name="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" />
            </button>
        </form>

        <div class="border-t border-slate-100 pt-5">
            <p class="text-center text-sm text-slate-600">
                Déjà inscrit ? <a href="{{ route('login') }}" class="link-accent">Se connecter</a>
            </p>
        </div>
    </div>
</div>
@endsection