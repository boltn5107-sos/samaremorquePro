@extends('layouts.app')

@section('title', 'Professionnels')

@section('content')
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="truck" class="w-6 h-6 text-orange-500" />
            Professionnels
        </h1>

        <div class="card overflow-hidden mb-6">
            <ul class="divide-y divide-slate-200">
                @forelse($professionals as $professional)
                    <li>
                        <a href="{{ route('admin.professionnels.show', $professional) }}" class="flex items-center gap-4 px-5 py-4 hover:bg-slate-50">
                            <div class="flex-shrink-0 p-2.5 rounded-lg {{ $professional->role === 'remorqueur' ? 'bg-orange-100 text-orange-600' : 'bg-sky-100 text-sky-600' }}">
                                <x-icon name="{{ $professional->role === 'remorqueur' ? 'truck' : 'wrench' }}" class="w-5 h-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ $professional->full_name }}</p>
                                    <span class="badge {{ $professional->is_validated ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $professional->is_validated ? 'Valide' : 'En attente' }}
                                    </span>
                                </div>
                                <p class="flex items-center gap-1.5 text-sm text-slate-500 mt-0.5">
                                    <x-icon name="user" class="w-3.5 h-3.5 text-slate-400" />
                                    {{ ucfirst($professional->role) }}
                                </p>
                                <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                    <x-icon name="clock" class="w-3.5 h-3.5" />
                                    Inscrit le {{ $professional->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 flex-shrink-0" />
                        </a>
                    </li>
                @empty
                    <li class="px-5 py-12 text-center text-slate-500">
                        <x-icon name="truck" class="w-12 h-12 mx-auto mb-2 text-slate-300" />
                        Aucun professionnel trouve.
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="flex justify-center">
            {{ $professionals->links() }}
        </div>
    </div>
@endsection
