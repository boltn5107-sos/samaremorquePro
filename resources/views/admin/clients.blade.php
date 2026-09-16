@extends('layouts.app')
@section('title', 'Clients')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <x-icon name="user" class="w-6 h-6" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Clients</h1>
                    <p class="text-sm text-slate-500">Comptes clients et leurs interventions</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($clients as $client)
                    <div class="card overflow-hidden flex flex-col">
                        <div class="p-5 flex items-start gap-4">
                            <div class="flex-shrink-0 p-2.5 rounded-xl bg-indigo-100 text-indigo-600">
                                <x-icon name="user" class="w-5 h-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $client->full_name }}</p>
                                    <span class="badge {{ $client->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} shrink-0">
                                        {{ $client->is_active ? 'Actif' : 'Suspendu' }}
                                    </span>
                                </div>
                                <p class="flex items-center gap-1.5 text-sm text-slate-600 mt-1.5">
                                    <x-icon name="bell" class="w-3.5 h-3.5 text-slate-400" />
                                    {{ $client->email }}
                                </p>
                                @if($client->phone)
                                    <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                        <x-icon name="phone" class="w-3.5 h-3.5" />
                                        {{ $client->phone }}
                                    </p>
                                @endif
                                <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                    <x-icon name="clock" class="w-3.5 h-3.5" />
                                    Inscrit le {{ $client->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-auto border-t border-slate-100 bg-slate-50/60 px-5 py-3 flex items-center justify-between gap-3">
                            <a href="{{ route('admin.clients.show', $client) }}" class="btn-secondary">
                                Voir le profil
                                <x-icon name="chevron-right" class="w-4 h-4" />
                            </a>
                            <form method="POST" action="{{ route('admin.clients.destroy', $client) }}"
                                  onsubmit="return confirm('Supprimer definitivement ce client, ses vehicules et toutes ses interventions ? Cette action est irreversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Supprimer" class="btn-danger">
                                    <x-icon name="trash" class="w-4 h-4" />
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="sm:col-span-2 card flex flex-col items-center justify-center py-16 px-6 text-center">
                        <div class="h-16 w-16 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-4">
                            <x-icon name="user" class="w-8 h-8" />
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Aucun client trouve</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-sm">Aucun client n'est inscrit sur la plateforme pour le moment.</p>
                    </div>
                @endforelse
            </div>

            @if($clients->hasPages())
                <div class="flex justify-center mt-8">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection