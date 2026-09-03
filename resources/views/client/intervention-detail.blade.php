@extends('layouts.app')

@section('title', 'Suivi intervention')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <x-icon name="map" class="w-6 h-6 text-orange-500" />
                Suivi de l'intervention
            </h1>
            <span class="badge {{ $intervention->status_color }}">
                <span class="w-2 h-2 rounded-full {{ in_array($intervention->status, ['intervention_terminee', 'annulee']) ? '' : 'bg-orange-500 animate-pulse' }}"></span>
                {{ $intervention->status_label }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="card p-4 mb-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-3 flex items-center gap-2">
                        <x-icon name="map-pin" class="w-5 h-5 text-orange-500" />
                        Carte en temps reel
                    </h2>
                    <div id="map" style="height: 420px; width: 100%;" class="rounded-lg border border-slate-200"></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <x-icon name="zap" class="w-5 h-5 text-orange-500" />
                        Informations
                    </h2>
                    <dl class="space-y-4 text-sm">
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
                        @if($intervention->professional)
                            <div class="pt-3 border-t border-slate-200">
                                <dt class="text-slate-500 flex items-center gap-1.5 mb-2"><x-icon name="truck" class="w-4 h-4" /> Professionnel</dt>
                                <dd class="flex items-center gap-3">
                                    @if($intervention->professional->photo)
                                        <img src="{{ asset('storage/' . $intervention->professional->photo) }}" alt="" class="w-12 h-12 rounded-full object-cover bg-slate-100">
                                    @else
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-semibold">{{ strtoupper(substr($intervention->professional->first_name, 0, 1)) }}{{ strtoupper(substr($intervention->professional->last_name, 0, 1)) }}</div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $intervention->professional->full_name }}</p>
                                        <p class="flex items-center gap-1 text-slate-500">
                                            <x-icon name="phone" class="w-3.5 h-3.5" />
                                            {{ $intervention->professional->phone }}
                                        </p>
                                    </div>
                                </dd>
                                @php
                                    $proPhone = preg_replace('/[^0-9]/', '', $intervention->professional->phone ?? '');
                                    $whatsapp = $proPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $proPhone) : '#';
                                @endphp
                                <div class="flex gap-2 mt-3">
                                    <a href="tel:{{ $intervention->professional->phone }}" class="btn-secondary flex-1 text-sm py-2">
                                        <x-icon name="phone" class="w-4 h-4" />
                                        Appeler
                                    </a>
                                    <a href="{{ $whatsapp }}" target="_blank" rel="noopener" class="px-4 py-2 text-sm font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                        WhatsApp
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="pt-3 border-t border-slate-200 text-slate-500 flex items-center gap-2">
                                <x-icon name="clock" class="w-4 h-4" />
                                En attente d'un professionnel...
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

                @if($intervention->status !== 'intervention_terminee')
                    <form method="POST" action="{{ route('client.intervention.cancel', $intervention) }}"
                        onsubmit="return confirm('Annuler cette intervention ?')">
                        @csrf
                        <button type="submit" class="btn-danger w-full">
                            <x-icon name="x" class="w-4 h-4" />
                            Annuler l'intervention
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        @php
            $proLocationsJson = $intervention->professional && $intervention->professional->locations->isNotEmpty()
                ? $intervention->professional->locations->map(fn ($l) => [$l->lat, $l->lng])->values()->toJson()
                : 'null';
        @endphp
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const lat = {{ $intervention->client_lat ?? 14.7167 }};
                const lng = {{ $intervention->client_lng ?? -17.4677 }};
                const hasPro = {{ $intervention->professional ? 'true' : 'false' }};
                const hasActiveStatus = {{ (!in_array($intervention->status, ['intervention_terminee', 'annulee'])) ? 'true' : 'false' }};
                const positionUrl = '{{ $intervention->professional ? route('client.intervention.professional-position', $intervention) : '#' }}';

                const map = L.map('map').setView([lat, lng], 13);

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

                const proIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div class="marker-dot marker-pro"></div>',
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                let proMarker = null;
                let routeLine = null;
                @if($intervention->professional && $intervention->professional->locations->isNotEmpty())
                    const proLocations = {!! $proLocationsJson !!};
                    const proLatest = proLocations[proLocations.length - 1];
                    proMarker = L.marker(proLatest, { icon: proIcon }).addTo(map)
                        .bindPopup('<strong>{{ $intervention->professional->full_name }}</strong>');
                    if (proLocations.length > 1) {
                        routeLine = L.polyline(proLocations, { color: '#f97316', weight: 3, opacity: 0.8 }).addTo(map);
                    }
                @endif

                function updateProPosition(point) {
                    if (!proMarker) {
                        proMarker = L.marker([point.lat, point.lng], { icon: proIcon }).addTo(map)
                            .bindPopup('<strong>{{ $intervention->professional ? $intervention->professional->full_name : 'Professionnel' }}</strong>');
                    } else {
                        proMarker.setLatLng([point.lat, point.lng]);
                    }
                    if (!routeLine) {
                        routeLine = L.polyline([[lat, lng], [point.lat, point.lng]], {
                            color: '#f97316', weight: 3, opacity: 0.8
                        }).addTo(map);
                    } else {
                        routeLine.setLatLngs([[lat, lng], [point.lat, point.lng]]);
                    }
                }

                if (hasPro && hasActiveStatus && positionUrl !== '#') {
                    setInterval(function () {
                        fetch(positionUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                            .then(function (r) { return r.json(); })
                            .then(function (data) {
                                if (data && data.lat) {
                                    updateProPosition(data);
                                }
                            })
                            .catch(function () {});
                    }, 8000);
                }
            });
        </script>
    @endpush
@endsection
