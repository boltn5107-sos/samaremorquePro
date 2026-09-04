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
                            @php
                                $clPhone = preg_replace('/[^0-9]/', '', $intervention->client->phone ?? '');
                                $clWa = $clPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $clPhone) : '#';
                            @endphp
                            <dd class="mt-1 flex flex-wrap gap-1.5">
                                <a href="tel:{{ $intervention->client->phone }}" class="btn-secondary px-3 py-1 text-xs">
                                    <x-icon name="phone" class="w-3 h-3" /> {{ $intervention->client->phone }}
                                </a>
                                <a href="{{ $clWa }}" target="_blank" rel="noopener" class="px-3 py-1 text-xs font-semibold rounded-md text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                    WhatsApp
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="truck" class="w-4 h-4" /> {{ $intervention->professional ? ($intervention->professional->isRemorqueur() ? 'Remorqueur' : 'Depanneur') : 'Remorqueur / Depanneur' }}</dt>
                            <dd class="font-medium text-slate-900">{{ $intervention->professional?->full_name ?? 'Non assigne' }}</dd>
                            @if($intervention->professional)
                                @php
                                    $proPhone = preg_replace('/[^0-9]/', '', $intervention->professional->phone ?? '');
                                    $proWa = $proPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $proPhone) : '#';
                                @endphp
                                <dd class="mt-1 flex flex-wrap gap-1.5">
                                    <a href="tel:{{ $intervention->professional->phone }}" class="btn-secondary px-3 py-1 text-xs">
                                        <x-icon name="phone" class="w-3 h-3" /> {{ $intervention->professional->phone }}
                                    </a>
                                    <a href="{{ $proWa }}" target="_blank" rel="noopener" class="px-3 py-1 text-xs font-semibold rounded-md text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                        WhatsApp
                                    </a>
                                </dd>
                            @endif
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
                        @if($intervention->photo)
                            <div>
                                <dt class="text-slate-500 flex items-center gap-1.5"><x-icon name="camera" class="w-4 h-4" /> Photo de la panne</dt>
                                <a href="{{ asset('storage/' . $intervention->photo) }}" target="_blank" rel="noopener">
                                    <img src="{{ asset('storage/' . $intervention->photo) }}" alt="Photo de la panne" class="mt-1 w-full max-w-xs rounded-lg border border-slate-200">
                                </a>
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

                    const trainPoints = [[lat, lng], proLast];
                    L.polyline(trainPoints, { color: '#f97316', weight: 3, opacity: 0.8 }).addTo(map);

                    function haversineKm(a1, b1, a2, b2) {
                        const R = 6371;
                        const dLat = (a2 - a1) * Math.PI / 180;
                        const dLng = (b2 - b1) * Math.PI / 180;
                        const aa = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                            Math.cos(a1 * Math.PI / 180) * Math.cos(a2 * Math.PI / 180) *
                            Math.sin(dLng / 2) * Math.sin(dLng / 2);
                        return R * 2 * Math.atan2(Math.sqrt(aa), Math.sqrt(1 - aa));
                    }
                    const adminDist = haversineKm(lat, lng, proLast[0], proLast[1]);
                    const adminDistText = adminDist < 1 ? Math.round(adminDist * 1000) + ' m' : adminDist.toFixed(1) + ' km';
                    L.control({ position: 'topright' }).onAdd = function () {
                        const div = L.DomUtil.create('div', 'leaflet-bar');
                        div.style.padding = '6px 10px';
                        div.style.backgroundColor = 'white';
                        div.style.fontWeight = '600';
                        div.style.fontSize = '13px';
                        div.innerHTML = 'Distance: ' + adminDistText;
                        return div;
                    }.bind(this);
                    L.control({ position: 'topright' }).addTo(map);
                @endif
            });
        </script>
    @endpush
@endsection
