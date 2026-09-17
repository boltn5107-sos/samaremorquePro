@extends('layouts.app')
@section('title', 'Carte')
@section('content')
    <section class="relative overflow-hidden reveal">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                        <x-icon name="map-pin" class="w-6 h-6" />
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Carte en temps reel</h1>
                        <p class="text-sm text-slate-500">Position des professionnels et interventions actives</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge bg-orange-100 text-orange-700">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                        Professionnels
                    </span>
                    <span class="badge bg-emerald-100 text-emerald-700">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Interventions actives
                    </span>
                </div>
            </div>

            <div class="card overflow-hidden">
                <div id="admin-map" style="height: 600px; width: 100%;" class="rounded-xl border border-slate-200"></div>
            </div>
        </div>
    </section>

    @push('scripts')
        @php
            $proData = $professionals
                ->map(fn ($p) => [
                    'name' => $p->full_name,
                    'role' => $p->role,
                    'lat' => $p->locations->last()?->lat,
                    'lng' => $p->locations->last()?->lng,
                ])
                ->filter(fn ($p) => $p['lat'] !== null && $p['lng'] !== null)
                ->values()
                ->toJson();

            $intData = $activeInterventions
                ->map(fn ($i) => [
                    'id' => $i->id,
                    'status' => $i->status,
                    'lat' => $i->client_lat ?? 14.7167,
                    'lng' => $i->client_lng ?? -17.4677,
                ])
                ->toJson();
        @endphp
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('admin-map').setView([14.7167, -17.4677], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(map);

            const professionals = {!! $proData !!};
            const interventions = {!! $intData !!};

            const proIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="w-6 h-6 rounded-full bg-orange-500 border-2 border-white shadow flex items-center justify-center"></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12],
            });

            for (const p of professionals) {
                L.marker([p.lat, p.lng], { icon: proIcon })
                    .addTo(map)
                    .bindPopup('<strong>' + p.name + '</strong> - ' + p.role.charAt(0).toUpperCase() + p.role.slice(1));
            }

            const intIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="w-6 h-6 rounded-full bg-emerald-500 border-2 border-white shadow flex items-center justify-center"></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12],
            });

            for (const i of interventions) {
                L.marker([i.lat, i.lng], { icon: intIcon })
                    .addTo(map)
                    .bindPopup('<strong>Intervention #' + i.id + '</strong><br>' + i.status.replace(/_/g, ' '));
            }
        });
        </script>
    @endpush
@endsection