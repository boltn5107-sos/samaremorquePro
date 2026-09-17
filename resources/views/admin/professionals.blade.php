@extends('layouts.app')
@section('title', 'Professionnels')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                    <x-icon name="truck" class="w-6 h-6" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Professionnels</h1>
                    <p class="text-sm text-slate-500">Remorqueurs et depanneurs de la plateforme</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($professionals as $professional)
                    <div class="card overflow-hidden flex flex-col">
                        <div class="p-5 flex items-start gap-4">
                            <div class="flex-shrink-0 p-2.5 rounded-xl {{ $professional->role === 'remorqueur' ? 'bg-orange-100 text-orange-600' : 'bg-sky-100 text-sky-600' }}">
                                <x-icon name="{{ $professional->role === 'remorqueur' ? 'truck' : 'wrench' }}" class="w-5 h-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $professional->full_name }}</p>
                                    <span class="badge {{ $professional->is_validated ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} shrink-0">
                                        {{ $professional->is_validated ? 'Valide' : 'En attente' }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="chip {{ $professional->role === 'remorqueur' ? 'bg-orange-50 text-orange-700' : 'bg-sky-50 text-sky-700' }}">
                                        <x-icon name="{{ $professional->role === 'remorqueur' ? 'truck' : 'wrench' }}" class="w-3.5 h-3.5" />
                                        {{ ucfirst($professional->role) }}
                                    </span>
                                </div>
                                @if($professional->phone)
                                    <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-1.5">
                                        <x-icon name="phone" class="w-3.5 h-3.5" />
                                        {{ $professional->phone }}
                                    </p>
                                @endif
                                <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                    <x-icon name="clock" class="w-3.5 h-3.5" />
                                    Inscrit le {{ $professional->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-auto border-t border-slate-100 bg-slate-50/60 px-5 py-3 flex items-center justify-between gap-3">
                            <a href="{{ route('admin.professionnels.show', $professional) }}" class="btn-secondary">
                                Voir le profil
                                <x-icon name="chevron-right" class="w-4 h-4" />
                            </a>
                            <form method="POST" action="{{ route('admin.professionnels.destroy', $professional) }}"
                                  onsubmit="return confirm('Supprimer definitivement ce professionnel et toutes ses interventions ? Cette action est irreversible.')">
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
                        <div class="h-16 w-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                            <x-icon name="truck" class="w-8 h-8" />
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Aucun professionnel trouve</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-sm">Aucun professionnel n'est inscrit sur la plateforme pour le moment.</p>
                    </div>
                @endforelse
            </div>

            @if($professionals->hasPages())
                <div class="flex justify-center mt-8">
                    {{ $professionals->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection