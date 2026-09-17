@extends('layouts.app')
@section('title', "Demander une intervention")
@section('hide_footer')
@endsection
@section('content')

{{-- Barre flux invite --}}
<div class="bg-night text-white border-b border-white/10 no-print sticky top-0 z-40">
    <div class="max-w-3xl mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/10 backdrop-blur-sm overflow-hidden ring-1 ring-white/10">
                <img src="{{ asset('favicon.jpg') }}" alt="SamaRemorque" class="w-6 h-6 object-contain">
            </span>
            <span class="font-display font-bold tracking-tight text-[15px]">Assistance</span>
        </div>
        <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-emerald-500/15 text-emerald-300 px-3 py-1.5 rounded-full ring-1 ring-emerald-500/20">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            Sans compte
        </span>
    </div>
</div>

<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 mb-24">
    <div class="page-header animate-fade-in">
        <h1>Demande d'assistance</h1>
        <p>Position, vehicule, panne &mdash; puis envoi. Aucun compte requis.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200/80 text-red-700 rounded-2xl p-4 mb-6 animate-scale-in ring-1 ring-red-100">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <div class="space-y-0.5">
                    @foreach($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- 1. Localisation --}}
    <div class="card p-6 mb-5 animate-slide-up reveal-delay-2">
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2.5">
                <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 text-white text-xs font-bold shadow-sm shadow-orange-500/25">1</span>
                Ma position (GPS)
            </h2>
            <button type="button" id="locate-btn" class="btn-secondary text-xs px-3 py-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 4v6h-6M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                Actualiser
            </button>
        </div>
        <p id="loc-status" class="mb-3 text-sm text-slate-500 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-slate-300 animate-pulse"></span>
            Recuperation de votre position GPS...
        </p>
        <div class="map-shell" style="height: 280px;">
            <div id="map" style="height: 100%; width: 100%;"></div>
        </div>
        <div id="manual-zone" class="mt-4 hidden">
            <label for="manual-address" class="label mb-1">Position manuelle (GPS indisponible)</label>
            <div class="flex gap-2">
                <input type="text" id="manual-address" class="input flex-1" placeholder="Adresse ou lieu (ex : Route de Rufisque, Dakar)">
                <button type="button" id="manual-apply" class="btn-secondary whitespace-nowrap">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Appliquer
                </button>
            </div>
            <p class="mt-2 text-xs text-slate-500">Ou deplacez directement le marqueur sur la carte.</p>
        </div>
        <div id="used-position" class="mt-3 text-sm text-slate-600 hidden">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-100">
                <svg class="w-4 h-4 text-orange-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Position utilisee : <span id="used-position-text" class="font-semibold text-slate-900"></span></span>
            </span>
        </div>
    </div>

    {{-- 2. Vehicule, panne, photo, contact --}}
    <div class="card p-6 animate-slide-up reveal-delay-3">
        <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-5">
            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 text-white text-xs font-bold shadow-sm shadow-orange-500/25">2</span>
            Vehicule, panne et contact
        </h2>

        <form method="POST" action="{{ route('guest.store') }}" enctype="multipart/form-data" class="space-y-5" id="intervention-form">
            @csrf
            <input type="hidden" name="client_lat" id="client_lat">
            <input type="hidden" name="client_lng" id="client_lng">
            <input type="hidden" name="client_address" id="client_address">
            <input type="hidden" name="manual_position" id="manual_position">
            <input type="hidden" name="selected_professional_id" id="selected_professional_id">

            @if($vehicles->isNotEmpty())
                <div>
                    <label for="vehicle_id" class="label">Vehicule enregistre</label>
                    <select id="vehicle_id" name="vehicle_id" class="input">
                        <option value="">Selectionnez un vehicule</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->brand ?? $vehicle->type }} {{ $vehicle->plate_number ?? '' }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="vehicle_type_hidden" name="vehicle_type_hidden" value="">
                </div>
            @endif

            <div>
                @php $expectedVehicleType = old('vehicle_type'); @endphp
                <fieldset class="m-0 p-0 border-0 min-w-0">
                    <legend class="label mb-2">Type de vehicule *</legend>
                    <div class="grid grid-cols-3 gap-2.5" id="vehicle-type-grid">
                    @foreach(['voiture' => 'Voiture', 'moto' => 'Moto', 'camion' => 'Camion', 'bus' => 'Bus', 'autre' => 'Autre'] as $value => $label)
                        <button type="button" data-value="{{ $value }}"
                            class="vehicle-type-btn px-3 py-3 rounded-xl border-2 text-sm font-medium transition-all duration-200 {{ ($expectedVehicleType ?? '') === $value ? 'border-orange-500 bg-orange-50 text-orange-700 shadow-sm shadow-orange-500/10' : 'border-slate-200 bg-white text-slate-600 hover:border-orange-300 hover:bg-orange-50/30' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
                    <input type="hidden" name="vehicle_type" id="vehicle_type" value="{{ old('vehicle_type') }}">
                </fieldset>
                @error('vehicle_type')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <fieldset class="m-0 p-0 border-0 min-w-0">
                    <legend class="label mb-2">Type d'assistance *</legend>
                    <div class="grid grid-cols-2 gap-2.5">
                    <button type="button" data-service="remorquage" id="svc-remorquage"
                        class="service-btn px-4 py-4 rounded-xl border-2 text-left transition-all duration-200 {{ old('service_type') === 'remorquage' ? 'border-orange-500 bg-orange-50 text-orange-700 shadow-sm shadow-orange-500/10' : 'border-slate-200 bg-white text-slate-600 hover:border-orange-300 hover:bg-orange-50/30' }}">
                        <span class="flex items-center gap-2 text-sm font-semibold">
                            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                            Remorquage
                        </span>
                        <span class="block text-xs text-slate-400 font-normal mt-1.5 ml-7">Le vehicule est transporte a une destination</span>
                    </button>
                    <button type="button" data-service="depannage" id="svc-depannage"
                        class="service-btn px-4 py-4 rounded-xl border-2 text-left transition-all duration-200 {{ old('service_type') === 'depannage' ? 'border-orange-500 bg-orange-50 text-orange-700 shadow-sm shadow-orange-500/10' : 'border-slate-200 bg-white text-slate-600 hover:border-orange-300 hover:bg-orange-50/30' }}">
                        <span class="flex items-center gap-2 text-sm font-semibold">
                            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                            Depannage sur place
                        </span>
                        <span class="block text-xs text-slate-400 font-normal mt-1.5 ml-7">Reparation directe (batterie, crevaison...)</span>
                    </button>
                </div>
                    <input type="hidden" name="service_type" id="service_type" value="{{ old('service_type') }}">
                </fieldset>
                @error('service_type')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg> {{ $message }}</p>
                @enderror
            </div>

            {{-- 3. Professionnels proches --}}
            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-1">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 text-white text-xs font-bold shadow-sm shadow-orange-500/25">3</span>
                    Remorqueurs / Depanneurs proches
                </h2>
                <p class="text-xs text-slate-500 mb-4 ml-[38px]">Tries par distance. Touchez une carte pour la selectionner (optionnel).</p>

                <div id="pros-empty" class="hidden py-8 text-center text-slate-500">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-200/60 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <p class="font-medium text-slate-600">Aucun remorqueur ou depanneur disponible</p>
                    <p class="text-xs text-slate-400 mt-1">Vous pouvez tout de meme envoyer votre demande.</p>
                </div>
                <div id="pros-loading" class="py-8 text-center text-sm text-slate-500 flex flex-col items-center gap-3">
                    <div class="spinner"></div>
                    <span>Recherche des professionnels a proximite...</span>
                </div>
                <div id="pros-list" class="space-y-2.5"></div>
            </div>

            <div>
                <label for="destination" class="label">Destination (si remorquage)</label>
                <input type="text" id="destination" name="destination" value="{{ old('destination') }}" class="input" placeholder="Ou doit etre transporte le vehicule ?">
                <div id="destinations-wrap" class="hidden mt-2.5">
                    <p class="text-xs font-medium text-slate-500 mb-2">Suggestions</p>
                    <div id="destinations-list" class="flex flex-wrap gap-2"></div>
                </div>
            </div>

            <div>
                <label for="description" class="label">Description de la panne</label>
                <textarea id="description" name="description" rows="3" class="input" placeholder="Decrivez brievement ce qui s'est passe">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="photo" class="label mb-1.5">Photo de la panne (optionnel)</label>
                <div class="relative">
                    <input type="file" id="photo" name="photo" accept="image/*" capture="environment"
                        class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 file:ring-1 file:ring-orange-200/50 file:transition-all file:duration-200">
                </div>
                <p class="mt-1.5 text-xs text-slate-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    La camera s'ouvrira directement sur certains appareils.
                </p>
            </div>
            <div id="photo-preview" class="hidden">
                <img id="photo-preview-img" src="" alt="Apercu de la photo" class="w-40 h-40 object-cover rounded-xl border-2 border-slate-200 shadow-sm">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                <div>
                    <label for="client_phone" class="label">Telephone du conducteur</label>
                    <input type="tel" id="client_phone" name="client_phone" value="{{ old('client_phone') }}"
                           class="input" placeholder="Ex : 77 123 45 67" inputmode="tel">
                    <p class="text-xs text-slate-400 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.58 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Le professionnel vous appellera a ce numero.
                    </p>
                </div>
                <div>
                    <label for="client_name" class="label">Votre prenom (optionnel)</label>
                    <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" class="input" placeholder="Ex : Awa">
                </div>
            </div>

            <div id="location-required-warning" class="hidden text-sm text-red-600 flex items-center gap-2 bg-red-50 p-3 rounded-xl border border-red-200/80">
                <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
                Veuillez definir votre position (GPS ou manuelle) avant d'envoyer votre demande.
            </div>

            <button type="submit" id="submit-btn"
                    class="w-full inline-flex items-center justify-center gap-2.5 py-4 rounded-2xl text-base font-bold text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 active:from-orange-800 active:to-orange-700 shadow-lg shadow-orange-600/25 transition-all duration-300 hover:shadow-xl hover:shadow-orange-600/30 hover:-translate-y-0.5">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                Envoyer la demande
            </button>
            <p class="text-center text-xs text-slate-400 mt-1">Apres l'envoi, vous recevrez un <strong class="text-slate-500">code de suivi</strong> pour suivre votre intervention sans compte.</p>
        </form>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const latInput = document.getElementById('client_lat');
        const lngInput = document.getElementById('client_lng');
        const addressInput = document.getElementById('client_address');
        const manualInput = document.getElementById('manual_position');
        const locStatus = document.getElementById('loc-status');
        const usedPosBox = document.getElementById('used-position');
        const usedPosText = document.getElementById('used-position-text');
        const manualZone = document.getElementById('manual-zone');
        const warnBox = document.getElementById('location-required-warning');

        const DEFAULT_POS = { lat: 14.7167, lng: -17.4677 };
        window.clientPosition = null;
        window.selectedProId = null;
        window.prosData = [];

        const map = L.map('map').setView([DEFAULT_POS.lat, DEFAULT_POS.lng], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        const clientIcon = L.divIcon({
            className: 'custom-div-icon',
            html: '<div class="marker-dot marker-client"></div>',
            iconSize: [18, 18],
            iconAnchor: [9, 9]
        });

        let clientMarker = null;
        let proMarkers = L.layerGroup().addTo(map);
        let polyline = null;

        function setStatus(text, color) {
            locStatus.innerHTML = '<span class="w-2 h-2 rounded-full bg-' + color + '-500"></span> ' + text;
        }

        function formatDistance(km) {
            if (km === null || km === undefined || isNaN(km)) return 'N/A';
            return km < 1 ? Math.round(km * 1000) + ' m' : km.toFixed(1) + ' km';
        }

        function getServiceType() {
            return document.getElementById('service_type').value.trim();
        }

        function setPosition(lat, lng, options) {
            options = options || {};
            window.clientPosition = { lat: lat, lng: lng };
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
            usedPosBox.classList.remove('hidden');
            usedPosText.textContent = lat.toFixed(5) + ', ' + lng.toFixed(5);

            if (!clientMarker) {
                clientMarker = L.marker([lat, lng], { icon: clientIcon, draggable: true }).addTo(map)
                    .bindPopup('<strong>Votre position</strong>');
                clientMarker.on('dragend', function (e) {
                    const p = e.target.getLatLng();
                    setPosition(p.lat, p.lng, { fetch: true });
                });
            } else {
                clientMarker.setLatLng([lat, lng]);
            }
            map.setView([lat, lng], Math.max(map.getZoom(), 12));

            if (options.fetch !== false) {
                fetchNearby();
            }
            if (navigator.geolocation) {
                fetch('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + lat + '&lon=' + lng + '&countrycodes=sn', {
                    headers: { 'User-Agent': 'SamaRemorque/1.0' }
                }).then(r => r.json()).then(data => {
                    const addr = data.display_name || (data.address && (data.address.road + (data.address.city ? ', ' + data.address.city : ''))) || '';
                    if (addr) {
                        addressInput.value = addr;
                        const reverseGeocode = document.getElementById('reverse-geocode');
                        if (reverseGeocode) reverseGeocode.textContent = addr;
                        document.getElementById('used-position-text').textContent = addr;
                    }
                }).catch(() => {});
            }
        }

        function fetchNearby() {
            if (!window.clientPosition) return;
            const prosLoading = document.getElementById('pros-loading');
            const prosEmpty = document.getElementById('pros-empty');
            const prosList = document.getElementById('pros-list');
            prosLoading.classList.remove('hidden');
            prosEmpty.classList.add('hidden');
            prosList.innerHTML = '';
            proMarkers.clearLayers();
            if (polyline) { map.removeLayer(polyline); polyline = null; }

            const params = new URLSearchParams({
                lat: window.clientPosition.lat,
                lng: window.clientPosition.lng,
                radius: 100,
                freshness: 720,
            });
            const st = getServiceType();
            if (st) params.set('service_type', st);

            fetch('{{ route('guest.nearby') }}?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                prosLoading.classList.add('hidden');
                const professionals = data.professionals || data;
                window.prosData = professionals;
                sortAndRender(professionals);
                renderSuggestedDestinations(data.suggested_destinations || [], professionals);
            })
            .catch(() => {
                prosLoading.classList.add('hidden');
                prosEmpty.classList.remove('hidden');
            });
        }

        function sortAndRender(pros) {
            const prosList = document.getElementById('pros-list');
            const prosEmpty = document.getElementById('pros-empty');
            const sorted = pros.slice().sort((a, b) => (a.distance_km ?? 9999) - (b.distance_km ?? 9999));
            prosList.innerHTML = '';
            if (!sorted.length) {
                prosEmpty.classList.remove('hidden');
                return;
            }
            prosEmpty.classList.add('hidden');
            sorted.forEach(pro => renderPro(pro));
        }

        function renderPro(pro) {
            const prosList = document.getElementById('pros-list');
            const roleLabel = pro.role === 'remorqueur' ? 'Remorqueur' : 'Depanneur';
            const initials = pro.full_name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();

            const card = document.createElement('div');
            card.className = 'pro-card';
            card.dataset.proId = pro.id;
            card.style.cursor = 'pointer';

            const avatarHtml = pro.photo
                ? '<img src="' + pro.photo + '" alt="Photo de ' + pro.full_name + '" class="pro-avatar">'
                : '<div class="pro-avatar-placeholder bg-orange-100 text-orange-600">' + initials + '</div>';

            const wa = (pro.phone || '').replace(/[^0-9]/g, '');
            const waLink = wa ? 'https://wa.me/221' + wa.replace(/^221/, '') : '#';
            const phoneAvailable = (pro.phone || '').trim().length > 0;
            const btnDisabled = phoneAvailable ? '' : ' pointer-events-none opacity-50';

            card.innerHTML = [
                avatarHtml,
                '<div class="flex-1 min-w-0">',
                '  <p class="font-semibold text-slate-900 text-sm truncate">' + pro.full_name + '</p>',
                '  <p class="text-xs text-slate-500">' + roleLabel + '</p>',
                (pro.rating_avg ? '  <p class="flex items-center gap-1 mt-0.5 text-xs text-amber-500">' +
                    '<svg viewBox="0 0 24 24" class="w-3.5 h-3.5" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>' +
                    '<span class="text-slate-900 font-semibold">' + pro.rating_avg + '</span>' +
                    '<span class="text-slate-400">(' + pro.rating_count + ')</span></p>' : ''),
                '  <div class="flex items-center gap-3 mt-1 text-xs">',
                '    <span class="chip bg-orange-100 text-orange-700">' + formatDistance(pro.distance_km) + '</span>',
                pro.hourly_rate ? '<span class="text-slate-500">' + pro.hourly_rate + ' FCFA/h</span>' : '',
                '  </div>',
                '</div>',
                '<div class="flex flex-col gap-1.5 flex-shrink-0" onclick="event.stopPropagation()">',
                '  <a href="tel:' + (pro.phone || '') + '" class="btn-secondary px-2.5 py-1.5 text-xs items-center' + btnDisabled + '">Appeler</a>',
                '  <a href="' + waLink + '" target="_blank" rel="noopener" class="px-2.5 py-1.5 text-xs font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center justify-center gap-1' + btnDisabled + '">WhatsApp</a>',
                '</div>'
            ].join('');

            card.addEventListener('click', function () {
                selectPro(pro);
            });

            prosList.appendChild(card);
        }

        function renderSuggestedDestinations(nearbyDests, pros) {
            const wrap = document.getElementById('destinations-wrap');
            const list = document.getElementById('destinations-list');
            list.innerHTML = '';
            const seen = new Set();
            const dests = [];

            if (nearbyDests && nearbyDests.length) {
                nearbyDests.forEach(function (d) {
                    if (d.address && !seen.has(d.address)) {
                        seen.add(d.address);
                        dests.push(d.address);
                    }
                });
            }
            if (pros && pros.length) {
                pros.forEach(function (pro) {
                    if (pro.suggested_destination && !seen.has(pro.suggested_destination)) {
                        seen.add(pro.suggested_destination);
                        dests.push(pro.suggested_destination);
                    }
                });
            }

            if (!dests.length) {
                wrap.classList.add('hidden');
                return;
            }
            wrap.classList.remove('hidden');
            dests.slice(0, 5).forEach(function (dest) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'chip bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer';
                btn.textContent = dest;
                btn.addEventListener('click', function () {
                    document.getElementById('destination').value = dest;
                });
                list.appendChild(btn);
            });
        }

        const proIcon = L.divIcon({
            className: 'custom-div-icon',
            html: '<div class="marker-dot marker-pro"></div>',
            iconSize: [18, 18],
            iconAnchor: [9, 9]
        });
        const proSelectedIcon = L.divIcon({
            className: 'custom-div-icon',
            html: '<div class="marker-dot marker-pro-selected"></div>',
            iconSize: [18, 18],
            iconAnchor: [9, 9]
        });

        function selectPro(pro, fromMap) {
            window.selectedProId = pro.id;
            document.getElementById('selected_professional_id').value = pro.id;

            document.querySelectorAll('.pro-card').forEach(c => {
                c.classList.toggle('selected', String(c.dataset.proId) === String(pro.id));
            });

            proMarkers.clearLayers();
            window.prosData.forEach(p => {
                if (p.lat !== null && p.lng !== null) {
                    const marker = L.marker([p.lat, p.lng], {
                        icon: p.id === pro.id ? proSelectedIcon : proIcon
                    }).addTo(proMarkers);
                    marker.bindPopup('<strong>' + p.full_name + '</strong><br><span class="text-xs">' + formatDistance(p.distance_km) + '</span>');
                    marker.on('click', function () { selectPro(p, true); });
                }
            });

            if (window.clientPosition && pro.lat !== null && pro.lng !== null) {
                if (polyline) { map.removeLayer(polyline); polyline = null; }
                polyline = L.polyline([[window.clientPosition.lat, window.clientPosition.lng], [pro.lat, pro.lng]], {
                    color: '#f97316', dashArray: '5,5', weight: 2, opacity: 0.7
                }).addTo(map);
            }
            if (pro.suggested_destination) {
                document.getElementById('destination').value = pro.suggested_destination;
            }
            if (pro.lat !== null && pro.lng !== null && !fromMap) {
                map.flyTo([pro.lat, pro.lng], Math.max(map.getZoom(), 13));
            }
        }

        function locate() {
            if (!navigator.geolocation) {
                setStatus('Geolocalisation non supportee.', 'red');
                enableManual();
                return;
            }
            setStatus('Recuperation de votre position GPS...', 'orange');
            navigator.geolocation.getCurrentPosition(function (position) {
                setStatus('Position GPS obtenue.', 'emerald');
                setPosition(position.coords.latitude, position.coords.longitude, { fetch: true });
                manualZone.classList.add('hidden');
            }, function () {
                setStatus('GPS indisponible. Saisissez votre position manuellement.', 'red');
                enableManual();
                if (window.clientPosition) {
                    setPosition(window.clientPosition.lat, window.clientPosition.lng, { fetch: true });
                }
            }, { enableHighAccuracy: true, timeout: 15000, maximumAge: 60000 });
        }

        function enableManual() {
            manualZone.classList.remove('hidden');
        }

        document.getElementById('locate-btn').addEventListener('click', locate);
        document.getElementById('manual-apply').addEventListener('click', function () {
            const q = document.getElementById('manual-address').value.trim();
            if (!q) return;
            manualInput.value = q;
            setStatus('Geolocalisation de l\'adresse...', 'orange');
            fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&countrycodes=sn&q=' + encodeURIComponent(q), {
                headers: { 'User-Agent': 'SamaRemorque/1.0' }
            }).then(r => r.json()).then(results => {
                if (results && results.length) {
                    setPosition(parseFloat(results[0].lat), parseFloat(results[0].lon), { fetch: true });
                    addressInput.value = q;
                    const reverseGeocode = document.getElementById('reverse-geocode');
                    if (reverseGeocode) reverseGeocode.textContent = q;
                    document.getElementById('used-position-text').textContent = q;
                    manualZone.classList.add('hidden');
                    setStatus('Position manuelle definie.', 'emerald');
                } else {
                    setStatus('Adresse introuvable, deplacez le marqueur.', 'red');
                    window.clientPosition = window.clientPosition || { lat: DEFAULT_POS.lat, lng: DEFAULT_POS.lng };
                    setPosition(window.clientPosition.lat, window.clientPosition.lng, { fetch: true });
                }
            }).catch(() => setStatus('Geolocalisation impossible. Deplacez le marqueur.', 'red'));
        });

        // Choix du vehicule
        document.querySelectorAll('.vehicle-type-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.vehicle-type-btn').forEach(b => {
                    b.className = 'vehicle-type-btn px-3 py-3 rounded-xl border-2 text-sm font-medium transition-all duration-200 border-slate-200 bg-white text-slate-600 hover:border-orange-300 hover:bg-orange-50/30';
                });
                btn.className = 'vehicle-type-btn px-3 py-3 rounded-xl border-2 text-sm font-medium transition-all duration-200 border-orange-500 bg-orange-50 text-orange-700 shadow-sm shadow-orange-500/10';
                document.getElementById('vehicle_type').value = btn.dataset.value;
            });
        });

        // Choix du service
        document.querySelectorAll('.service-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.service-btn').forEach(b => {
                    b.className = 'service-btn px-4 py-4 rounded-xl border-2 text-left transition-all duration-200 border-slate-200 bg-white text-slate-600 hover:border-orange-300 hover:bg-orange-50/30';
                });
                btn.className = 'service-btn px-4 py-4 rounded-xl border-2 text-left transition-all duration-200 border-orange-500 bg-orange-50 text-orange-700 shadow-sm shadow-orange-500/10';
                document.getElementById('service_type').value = btn.dataset.service;
                if (window.clientPosition) fetchNearby();
            });
        });

        document.getElementById('intervention-form').addEventListener('submit', function (e) {
            if (!latInput.value || !lngInput.value) {
                e.preventDefault();
                warnBox.classList.remove('hidden');
                document.getElementById('loc-status').scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
        });

        document.getElementById('photo').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;
            document.getElementById('photo-preview-img').src = URL.createObjectURL(file);
            document.getElementById('photo-preview').classList.remove('hidden');
        });

        locate();
    });
</script>
@endsection
