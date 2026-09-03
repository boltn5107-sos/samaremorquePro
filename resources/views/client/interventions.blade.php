@extends('layouts.app')

@section('title', 'Mes interventions')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-6">Mes interventions</h1>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-slate-200">
                @forelse($interventions as $intervention)
                    <li>
                        <a href="{{ route('client.intervention.show', $intervention) }}" class="block hover:bg-slate-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-orange-600 truncate">{{ ucfirst($intervention->service_type) }}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $intervention->status_color }}">
                                            {{ $intervention->status_label }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm text-slate-500">
                                            {{ $intervention->destination }}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-slate-500 sm:mt-0">
                                        {{ $intervention->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-6 text-center text-slate-500">Aucune intervention trouvee.</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-6">
            {{ $interventions->links() }}
        </div>
    </div>
@endsection
