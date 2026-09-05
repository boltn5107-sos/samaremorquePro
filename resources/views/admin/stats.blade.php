@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="chart" class="w-6 h-6 text-orange-500" />
            Statistiques
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-indigo-100 text-indigo-600 w-fit mb-3">
                    <x-icon name="user" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_clients'] }}</p>
                <p class="text-sm text-slate-500">Total clients</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-orange-100 text-orange-600 w-fit mb-3">
                    <x-icon name="truck" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_remorqueurs'] }}</p>
                <p class="text-sm text-slate-500">Total remorqueurs</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-sky-100 text-sky-600 w-fit mb-3">
                    <x-icon name="wrench" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_depanneurs'] }}</p>
                <p class="text-sm text-slate-500">Total depanneurs</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-emerald-100 text-emerald-600 w-fit mb-3">
                    <x-icon name="zap" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_interventions'] }}</p>
                <p class="text-sm text-slate-500">Total interventions</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-amber-100 text-amber-600 w-fit mb-3">
                    <x-icon name="clock" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['interventions_this_month'] }}</p>
                <p class="text-sm text-slate-500">Interventions ce mois</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-slate-100 text-slate-600 w-fit mb-3">
                    <x-icon name="clock" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['interventions_last_month'] }}</p>
                <p class="text-sm text-slate-500">Interventions mois dernier</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-emerald-100 text-emerald-600 w-fit mb-3">
                    <x-icon name="check" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['completed_interventions'] }}</p>
                <p class="text-sm text-slate-500">Interventions terminees</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-red-100 text-red-600 w-fit mb-3">
                    <x-icon name="x" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['cancelled_interventions'] }}</p>
                <p class="text-sm text-slate-500">Interventions annulees</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-amber-100 text-amber-600 w-fit mb-3">
                    <x-icon name="star" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['avg_rating'] ? number_format($stats['avg_rating'], 1) : '-' }}</p>
                <p class="text-sm text-slate-500">Note moyenne ({{ $stats['total_ratings'] }} note(s))</p>
            </div>
            <div class="card p-5 sm:col-span-2 lg:col-span-2">
                <div class="p-3 rounded-lg bg-emerald-100 text-emerald-600 w-fit mb-3">
                    <x-icon name="chart" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ number_format($revenueEstimate, 0, ',', ' ') }} FCFA</p>
                <p class="text-sm text-slate-500">Estimation chiffre d'affaires (interventions terminees)</p>
            </div>
            <div class="card p-5">
                <div class="p-3 rounded-lg bg-indigo-100 text-indigo-600 w-fit mb-3">
                    <x-icon name="shield" class="w-5 h-5" />
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['validated_professionals'] }}</p>
                <p class="text-sm text-slate-500">Professionnels valides ({{ $stats['total_professionals'] }} total)</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Repartition par statut</h2>
                @php
                    $totalStatus = $statusBreakdown->sum();
                @endphp
                @if($totalStatus > 0)
                    @foreach(\App\Models\Intervention::STATUS_LABELS as $status => $label)
                        @php
                            $count = $statusBreakdown->get($status, 0);
                            $pct = $totalStatus > 0 ? round($count / $totalStatus * 100, 1) : 0;
                        @endphp
                        <div class="mb-3">
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="text-slate-600">{{ $label }}</span>
                                <span class="text-slate-400">{{ $count }} ({{ $pct }}%)</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5">
                                <div class="h-2.5 rounded-full {{ in_array($status, ['intervention_terminee']) ? 'bg-emerald-500' : (in_array($status, ['annulee']) ? 'bg-red-500' : 'bg-orange-400') }}"
                                     style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-slate-500">Aucune intervention enregistree.</p>
                @endif
            </div>

            <div class="card p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Evolution sur 6 mois</h2>
                @php
                    $maxMonth = $monthlyTrend->max('total') ?: 1;
                @endphp
                <div class="flex items-end gap-3 h-48">
                    @foreach($monthlyTrend as $month)
                        <div class="flex-1 flex flex-col items-center gap-1 h-full justify-end">
                            <span class="text-xs text-slate-500">{{ $month['total'] }}</span>
                            <div title="{{ $month['label'] }} : {{ $month['total'] }} intervention(s), {{ $month['completed'] }} terminee(s)"
                                 class="w-full rounded-t-md {{ $month['total'] > 0 ? 'bg-orange-400' : '' }}"
                                 style="height: {{ round($month['total'] / $maxMonth * 100) }}%"></div>
                            <span class="text-[10px] text-slate-400 whitespace-nowrap">{{ $month['label'] }}</span>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-slate-400 mt-3">Nombre d'interventions creees par mois (6 derniers mois).</p>
            </div>
        </div>

        <div class="card p-6 mt-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Top 10 professionnels (interventions terminees)</h2>
            @forelse($topProfessionals as $index => $professional)
                <a href="{{ route('admin.professionnels.show', $professional) }}"
                   class="flex items-center gap-4 py-2.5 border-b border-slate-100 last:border-0 hover:bg-slate-50 rounded-md px-2">
                    @if($professional->photo)
                        <img src="{{ asset('storage/' . $professional->photo) }}" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-100">
                    @else
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $professional->role === 'remorqueur' ? 'bg-orange-100 text-orange-600' : 'bg-sky-100 text-sky-600' }} font-semibold text-sm">
                            {{ strtoupper(substr($professional->first_name, 0, 1)) }}{{ strtoupper(substr($professional->last_name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $professional->full_name }}</p>
                        <p class="text-xs text-slate-400">{{ ucfirst($professional->role) }} @if($professional->hourly_rate) &middot; {{ number_format($professional->hourly_rate, 0, ',', ' ') }} FCFA/h @endif</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-lg font-bold text-slate-900">{{ $professional->interventions_as_professional_count }}</p>
                        <p class="text-xs text-slate-400 flex items-center gap-1 justify-end">
                            <x-icon name="star" class="w-3 h-3 text-amber-400" />
                            {{ $professional->avg_rating ? number_format($professional->avg_rating, 1) : '-' }} ({{ $professional->total_ratings }})
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-sm text-slate-500">Aucun professionnel pour le moment.</p>
            @endforelse
        </div>
    </div>
@endsection