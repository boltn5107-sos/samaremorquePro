<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demander une intervention - SamaRemorque (sans compte)</title>
    <meta name="description" content="Demandez une assistance routiere au Senegal sans creer de compte : localisez la panne, choisissez un remorqueur ou depanneur proche, envoyez votre demande et suivez-la avec votre code de suivi.">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-900">

    
    <header class="sticky top-0 z-40 bg-slate-900 text-white shadow">
        <div class="max-w-3xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2 text-lg font-bold tracking-tight">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white overflow-hidden">
                    <img src="<?php echo e(asset('favicon.png')); ?>" alt="SamaRemorque" class="w-6 h-6 object-contain">
                </span>
                <span>SamaRemorque</span>
            </a>
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-emerald-500/20 text-emerald-300 px-3 py-1.5 rounded-full">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                Sans compte, sans inscription
            </span>
        </div>
    </header>

    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 mb-20">
        <h1 class="text-2xl font-bold text-slate-900 mb-1">Demande d'assistance</h1>
        <p class="text-sm text-slate-500 mb-6">En cas d'urgence, remplissez rapidement : votre position, le vehicule, la panne, puis envoyez. Aucun compte n'est requis.</p>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <p class="text-sm"><?php echo e($error); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="card p-4 mb-5">
            <div class="flex items-center justify-between mb-2">
                <h2 class="font-semibold text-slate-900 flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-100 text-orange-600 text-xs font-bold">1</span>
                    Ma position (GPS)
                </h2>
                <button type="button" id="locate-btn" class="btn-secondary text-xs px-3 py-2">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 4v6h-6M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                    Actualiser
                </button>
            </div>
            <p id="loc-status" class="mb-3 text-sm text-slate-500 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                Recuperation de votre position GPS...
            </p>
            <div class="map-shell" style="height: 260px;">
                <div id="map" style="height: 100%; width: 100%;"></div>
            </div>
            <div id="manual-zone" class="mt-4 hidden">
                <label class="label mb-1">Position manuelle (GPS indisponible)</label>
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
                Position utilisee : <span id="used-position-text" class="font-semibold text-slate-900"></span>
            </div>
        </div>

        
        <div class="card p-5">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-4">
                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-100 text-orange-600 text-xs font-bold">2</span>
                Vehicule, panne et contact
            </h2>

            <form method="POST" action="<?php echo e(route('guest.store')); ?>" enctype="multipart/form-data" class="space-y-4" id="intervention-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="client_lat" id="client_lat">
                <input type="hidden" name="client_lng" id="client_lng">
                <input type="hidden" name="client_address" id="client_address">
                <input type="hidden" name="manual_position" id="manual_position">
                <input type="hidden" name="selected_professional_id" id="selected_professional_id">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vehicles->isNotEmpty()): ?>
                    <div>
                        <label for="vehicle_id" class="label">Vehicule enregistre</label>
                        <select id="vehicle_id" name="vehicle_id" class="input">
                            <option value="">Selectionnez un vehicule</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->brand ?? $vehicle->type); ?> <?php echo e($vehicle->plate_number ?? ''); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <input type="hidden" id="vehicle_type_hidden" name="vehicle_type_hidden" value="">
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div>
                    <label for="vehicle_type" class="label">Type de vehicule *</label>
                    <?php $expectedVehicleType = old('vehicle_type'); ?>
                    <div class="mt-1.5 grid grid-cols-3 gap-2" id="vehicle-type-grid">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['voiture' => 'Voiture', 'moto' => 'Moto', 'camion' => 'Camion', 'bus' => 'Bus', 'autre' => 'Autre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button type="button" data-value="<?php echo e($value); ?>"
                                class="vehicle-type-btn px-3 py-2.5 rounded-lg border text-sm font-medium <?php echo e(($expectedVehicleType ?? '') === $value ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-slate-300 bg-white text-slate-700 hover:border-orange-400'); ?>">
                                <?php echo e($label); ?>

                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <input type="hidden" name="vehicle_type" id="vehicle_type" value="<?php echo e(old('vehicle_type')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['vehicle_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label for="service_type" class="label">Type d'assistance *</label>
                    <div class="mt-1.5 grid grid-cols-2 gap-2">
                        <button type="button" data-service="remorquage" id="svc-remorquage"
                            class="service-btn px-3 py-3 rounded-lg border text-sm font-semibold <?php echo e(old('service_type') === 'remorquage' ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-slate-300 bg-white text-slate-700 hover:border-orange-400'); ?>">
                            <span class="block text-base">Remorquage</span>
                            <span class="block text-xs text-slate-400 font-normal mt-0.5">Le vehicule est transporte a une destination</span>
                        </button>
                        <button type="button" data-service="depannage" id="svc-depannage"
                            class="service-btn px-3 py-3 rounded-lg border text-sm font-semibold <?php echo e(old('service_type') === 'depannage' ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-slate-300 bg-white text-slate-700 hover:border-orange-400'); ?>">
                            <span class="block text-base">Depannage sur place</span>
                            <span class="block text-xs text-slate-400 font-normal mt-0.5">Reparation directe (batterie, crevaison...)</span>
                        </button>
                    </div>
                    <input type="hidden" name="service_type" id="service_type" value="<?php echo e(old('service_type')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="card p-4">
                    <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-100 text-orange-600 text-xs font-bold">3</span>
                        Remorqueurs / Depanneurs proches
                    </h2>
                    <p class="text-xs text-slate-500 mb-3">Tries par distance. Touchez une carte pour la selectionner (optionnel).</p>

                    <div id="pros-empty" class="hidden py-6 text-center text-slate-500">
                        <p>Aucun remorqueur ou depanneur disponible pour le moment.</p>
                        <p class="text-xs mt-1">Vous pouvez tout de meme envoyer votre demande.</p>
                    </div>
                    <div id="pros-loading" class="py-6 text-center text-sm text-slate-500">Recherche des professionnels a proximite...</div>
                    <div id="pros-list" class="space-y-2"></div>
                </div>

                <div>
                    <label for="destination" class="label">Destination (si remorquage)</label>
                    <input type="text" id="destination" name="destination" value="<?php echo e(old('destination')); ?>" class="input" placeholder="Ou doit etre transporte le vehicule ?">
                    <div id="destinations-wrap" class="hidden mt-2">
                        <p class="text-xs font-medium text-slate-500 mb-1.5">Suggestions</p>
                        <div id="destinations-list" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>

                <div>
                    <label for="description" class="label">Description de la panne</label>
                    <textarea id="description" name="description" rows="3" class="input" placeholder="Decrivez brievement ce qui s'est passe"><?php echo e(old('description')); ?></textarea>
                </div>

                <div>
                    <label class="label mb-1">Photo de la panne (optionnel)</label>
                    <input type="file" id="photo" name="photo" accept="image/*" capture="environment"
                        class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <p class="mt-1 text-xs text-slate-500">La camera s'ouvrira directement sur certains appareils.</p>
                </div>
                <div id="photo-preview" class="hidden">
                    <img id="photo-preview-img" src="" alt="Apercu de la photo" class="w-40 h-40 object-cover rounded-lg border border-slate-200">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label for="client_phone" class="label">Telephone du conducteur</label>
                        <input type="tel" id="client_phone" name="client_phone" value="<?php echo e(old('client_phone')); ?>"
                               class="input" placeholder="Ex : 77 123 45 67" inputmode="tel">
                        <p class="text-xs text-slate-400 mt-1">Le professionnel vous appellera a ce numero.</p>
                    </div>
                    <div>
                        <label for="client_name" class="label">Votre prenom (optionnel)</label>
                        <input type="text" id="client_name" name="client_name" value="<?php echo e(old('client_name')); ?>" class="input" placeholder="Ex : Awa">
                    </div>
                </div>

                <div id="location-required-warning" class="hidden text-sm text-red-600 flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
                    Veuillez definir votre position (GPS ou manuelle) avant d'envoyer votre demande.
                </div>

                <button type="submit" id="submit-btn"
                        class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-bold text-white bg-orange-600 hover:bg-orange-700 active:bg-orange-800 shadow-lg shadow-orange-600/20 transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Envoyer la demande
                </button>
                <p class="text-center text-xs text-slate-400">Apres l'envoi, vous recevrez un <strong>code de suivi</strong> pour suivre votre intervention sans compte.</p>
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

                fetch('<?php echo e(route('guest.nearby')); ?>?' + params.toString(), {
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
                const sorted = pros.slice().sort((a, b) => a.distance_km - b.distance_km);
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
                    ? '<img src="' + pro.photo + '" alt="" class="pro-avatar">'
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
                    '<div class="flex flex-col gap-1 flex-shrink-0" onclick="event.stopPropagation()">',
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
                    const marker = L.marker([p.lat, p.lng], {
                        icon: p.id === pro.id ? proSelectedIcon : proIcon
                    }).addTo(proMarkers);
                    marker.bindPopup('<strong>' + p.full_name + '</strong><br><span class="text-xs">' + formatDistance(p.distance_km) + '</span>');
                    marker.on('click', function () { selectPro(p, true); });
                });

                if (window.clientPosition) {
                    polyline = L.polyline([[window.clientPosition.lat, window.clientPosition.lng], [pro.lat, pro.lng]], {
                        color: '#f97316', dashArray: '5,5', weight: 2, opacity: 0.7
                    }).addTo(map);
                }
                if (pro.suggested_destination) {
                    document.getElementById('destination').value = pro.suggested_destination;
                }
                if (!fromMap) {
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
                        b.className = 'vehicle-type-btn px-3 py-2.5 rounded-lg border text-sm font-medium border-slate-300 bg-white text-slate-700 hover:border-orange-400';
                    });
                    btn.className = 'vehicle-type-btn px-3 py-2.5 rounded-lg border text-sm font-medium border-orange-500 bg-orange-50 text-orange-700';
                    document.getElementById('vehicle_type').value = btn.dataset.value;
                });
            });

            // Choix du service
            document.querySelectorAll('.service-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.service-btn').forEach(b => {
                        b.className = 'service-btn px-3 py-3 rounded-lg border text-sm font-semibold border-slate-300 bg-white text-slate-700 hover:border-orange-400';
                    });
                    btn.className = 'service-btn px-3 py-3 rounded-lg border text-sm font-semibold border-orange-500 bg-orange-50 text-orange-700';
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
</body>
</html><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\guest\create.blade.php ENDPATH**/ ?>