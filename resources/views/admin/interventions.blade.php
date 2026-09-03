@extends('layouts.app')

@section('title', 'Interventions')

@section('content')
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="zap" class="w-6 h-6 text-orange-500" />
            Interventions
        </h1>

        <div class="card overflow-hidden mb-6">
            <ul class="divide-y divide-slate-200">
                @forelse($interventions as $intervention)
                    <li>
                        <a href="{{ route('admin.intervention.show', $intervention) }}" class="flex items-center gap-4 px-5 py-4 hover:bg-slate-50">
                            <div class="flex-shrink-0 p-2.5 rounded-lg bg-orange-100 text-orange-600">
                                <x-icon name="car" class="w-5 h-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                    <span class="badge {{ $intervention->status_color }}">
                                        {{ $intervention->status_label }}
                                    </span>
                                </div>
                                <p class="flex items-center gap-1.5 text-sm text-slate-500 mt-0.5">
                                    <x-icon name="user" class="w-3.5 h-3.5 text-slate-400" />
                                    {{ $intervention->client->full_name }}
                                </p>
                                <p class="flex items-center gap-1.5 text-xs text-slate-400 mt-0.5">
                                    <x-icon name="clock" class="w-3.5 h-3.5" />
                                    {{ $intervention->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <x-icon name="chevron-right" class="w-4 h-4 text-slate-300 flex-shrink-0" />
                        </a>
                    </li>
                @empty
                    <li class="px-5 py-12 text-center text-slate-500">
                        <x-icon name="zap" class="w-12 h-12 mx-auto mb-2 text-slate-300" />
                        Aucune intervention trouvee.
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="flex justify-center">
            {{ $interventions->links() }}
        </div>
    </div>
@endsection
