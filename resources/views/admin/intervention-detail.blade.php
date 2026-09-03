@extends('layouts.app')

@section('title', 'Detail intervention')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <x-icon name="zap" class="w-6 h-6 text-orange-500" />
                Detail intervention #{{ $intervention->id }}
            </h1>
            <span class="badge {{ $intervention->status_color }}">
                <span class="w-2 h-2 rounded-full {{ in_array($intervention->status, ['intervention_terminee', 'annulee']) ? '' : 'bg-orange-500 animate-pulse' }}"></span>
                {{ $intervention->status_label }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="card p-4">
                    <h2 class="text-lg font-semibold text-slate-900 mb-3 flex items-center gap-2">
                        <x-icon name="map-pin" class="w-5 h-5 text-orange-500" />
                        Carte
                    </h2>
                    <div id="map" style="height: 420px; width: 100%;" class="rounded-lg border border-slate-200"></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <x-icon name="user" class="w-5 h-5 text-orange-500" />
                        Informations
                    </h2>
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="user" class="w-4 h-4" /> Client</dt>
                            <dd class="font-medium text-slate-900">{{ $intervention->client->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="truck" class="w-4 h-4" /> Professionnel</dt>
                            <dd class="font-medium text-slate-900">{{ $intervention->professional?->full_name ?? 'Non assigne' }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="wrench" class="w-4 h-4" /> Service</dt>
                            <dd class="font-medium text-slate-900">{{ ucfirst($intervention->service_type) }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="car" class="w-4 h-4" /> Vehicule</dt>
                            <dd class="font-medium text-slate-900">{{ ucfirst($intervention->vehicle_type) }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="map-pin" class="w-4 h-4" /> Destination</dt>
                            <dd class="font-medium text-slate-900">{{ $intervention->destination }}</dd>
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

                const map = L.map('map').setView([lat, lng], 14);

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
                    .bindPopup('<strong>Client</strong>')
                    .openPopup();

                @if($intervention->professional && $intervention->professional->locations->isNotEmpty())
                    const proLast = @json([$intervention->professional->locations->last()->lat, $intervention->professional->locations->last()->lng]);
                    const proIcon = L.divIcon({
                        className: 'custom-div-icon',
                        html: '<div class="marker-dot marker-pro"></div>',
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    });
                    L.marker(proLast, { icon: proIcon }).addTo(map)
                        .bindPopup('<strong>{{ $intervention->professional->full_name }}</strong>');
                @endif
            });
        </script>
    @endpush
@endsection
