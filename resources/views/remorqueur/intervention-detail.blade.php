@extends('layouts.app')

@section('title', 'Suivi intervention')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <x-icon name="truck" class="w-6 h-6 text-orange-500" />
                Suivi de l'intervention
            </h1>
            <span class="badge {{ $intervention->status_color }}">
                <span class="w-2 h-2 rounded-full {{ in_array($intervention->status, ['intervention_terminee', 'annulee']) ? '' : 'bg-orange-500 animate-pulse' }}"></span>
                {{ $intervention->status_label }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="card p-4">
                    <h2 class="text-lg font-semibold text-slate-900 mb-3 flex items-center gap-2">
                        <x-icon name="map-pin" class="w-5 h-5 text-orange-500" />
                        Point de prise en charge
                    </h2>
                    <div id="map" style="height: 400px; width: 100%;" class="rounded-lg border border-slate-200"></div>
                </div>

                @if($intervention->status !== 'intervention_terminee' && $intervention->status !== 'annulee')
                    <div class="card p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                            <x-icon name="refresh" class="w-5 h-5 text-orange-500" />
                            Mettre a jour le statut
                        </h2>
                        <form method="POST" action="{{ route('remorqueur.intervention.status', $intervention) }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="status" class="label">Statut</label>
                                <select id="status" name="status" required class="input">
                                    <option value="remorqueur_en_route" {{ $intervention->status === 'remorqueur_en_route' ? 'selected' : '' }}>En route</option>
                                    <option value="arrivee_sur_place" {{ $intervention->status === 'arrivee_sur_place' ? 'selected' : '' }}>Arrive sur place</option>
                                    <option value="vehicule_pris_en_charge" {{ $intervention->status === 'vehicule_pris_en_charge' ? 'selected' : '' }}>Vehicule pris en charge</option>
                                    <option value="intervention_terminee" {{ $intervention->status === 'intervention_terminee' ? 'selected' : '' }}>Intervention terminee</option>
                                </select>
                            </div>
                            <div>
                                <label for="note" class="label">Note</label>
                                <textarea id="note" name="note" rows="3" class="input"></textarea>
                            </div>
                            <button type="submit" class="btn-primary w-full">
                                <x-icon name="check" class="w-4 h-4" />
                                Mettre a jour
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <x-icon name="user" class="w-5 h-5 text-orange-500" />
                        Client
                    </h2>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2.5 rounded-lg bg-slate-100 text-slate-600">
                            <x-icon name="user" class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $intervention->client->full_name }}</p>
                            <p class="flex items-center gap-1 text-sm text-slate-500">
                                <x-icon name="phone" class="w-3.5 h-3.5" />
                                {{ $intervention->client->phone }}
                            </p>
                        </div>
                    </div>
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="map-pin" class="w-4 h-4" /> Destination</dt>
                            <dd class="font-medium text-slate-900">{{ $intervention->destination }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="car" class="w-4 h-4" /> Vehicule</dt>
                            <dd class="font-medium text-slate-900">{{ ucfirst($intervention->vehicle_type) }}</dd>
                        </div>
                        @if($intervention->description)
                            <div>
                                <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="alert-triangle" class="w-4 h-4" /> Description</dt>
                                <dd class="font-medium text-slate-700">{{ $intervention->description }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <x-icon name="clock" class="w-5 h-5 text-orange-500" />
                        Historique
                    </h2>
                    <ol class="space-y-4">
                        @foreach($intervention->statuses as $status)
                            <li class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-orange-600"></div>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-px flex-1 bg-slate-200"></div>
                                    @endif
                                </div>
                                <div class="pb-4">
                                    <p class="text-sm font-semibold text-slate-900">{{ $status->status_label }}</p>
                                    <p class="text-xs text-slate-500">{{ $status->created_at->format('d/m/Y H:i') }}</p>
                                    @if($status->note)
                                        <p class="text-sm text-slate-600 mt-1">{{ $status->note }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const lat = {{ $intervention->client_lat ?? 14.7167 }};
                const lng = {{ $intervention->client_lng ?? -17.4677 }};

                const map = L.map('map').setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(map);

                const clientIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div class="marker-dot marker-client"></div>',
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                L.marker([lat, lng], { icon: clientIcon }).addTo(map)
                    .bindPopup('<strong>Point de prise en charge</strong>')
                    .openPopup();
            });
        </script>
    @endpush
@endsection
