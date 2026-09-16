@extends('layouts.guest')
@section('title', 'Verification email')
@section('content')
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Verifiez votre email</h2>
        <p class="mt-2 text-sm text-slate-600">Une lettre de verification a ete envoyee.</p>
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm animate-slide-in-right">
            Un nouveau lien de verification a ete envoye.
        </div>
    @endif
    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
        @csrf
        <button type="submit" class="btn-primary w-full text-base py-4">Renvoyer le lien de verification</button>
    </form>
</div>
@endsection