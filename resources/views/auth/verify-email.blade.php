@extends('layouts.app')

@section('title', 'Verification email')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Verifiez votre email</h2>

            <p class="text-sm text-slate-600 mb-6">
                Avant de continuer, veuillez verifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded mb-6">
                    Un nouveau lien de verification a ete envoye.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700">
                    Renvoyer le lien de verification
                </button>
            </form>
        </div>
    </div>
@endsection
