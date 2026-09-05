<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi intervention {{ $intervention->tracking_code }} - SamaRemorque</title>
    <meta name="description" content="Suivez sans compte votre demande d'assistance routiere au Senegal avec votre code de suivi : position du remorqueur ou depanneur en temps reel et etapes de l'intervention.">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-900">

    @php
        $isFinished = in_array($intervention->status, ['intervention_terminee', 'annulee']);
        $pro = $intervention->professional;
        $proPhone = preg_replace('/[^0-9]/', '', $pro?->phone ?? '');
        $whatsapp = $proPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $proPhone) : '#';
        $flash = session('status');
    @endphp

    {{-- Barre superieure --}}
    <header class="sticky top-0 z-40 bg-slate-900 text-white shadow">
        <div class="max-w-3xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-lg font-bold tracking-tight">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white overflow-hidden">
                    <img src="{{ asset('favicon.png') }}" alt="SamaRemorque" class="w-6 h-6 object-contain">
                </span>
                <span>SamaRemorque</span>
            </a>
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-emerald-500/20 text-emerald-300 px-3 py-1.5 rounded-full">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Suivi sans compte
            </span>
        </div>
    </header>

    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 pb-20">

        @if($flash === 'intervention-created')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg p-4 mb-5">
                <p class="font-semibold">Demande envoyee !</p>
                <p class="text-sm mt-1">Conservez votre <strong>code de suivi</strong> ci-dessous pour retrouver votre intervention sans compte.</p>
            </div>
        @elseif($flash === 'intervention-cancelled')
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-5">
                <p class="font-semibold">Intervention annulee.</p>
                <p class="text-sm mt-1">Votre demande a bien ete annulee. Vous pouvez en faire une nouvelle a tout moment.</p>
            </div>
        @elseif($flash === 'intervention-rated')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg p-4 mb-5">
                <p class="font-semibold">Merci pour votre note !</p>
                <p class="text-sm mt-1">Votre avis aidera les autres conducteurs.</p>
            </div>
        @endif

        {{-- Code de suivi --}}
        <div class="card p-5 mb-5 text-center">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Code de suivi</p>
            <p id="tracking-code" class="mt-1 text-3xl font-extrabold text-slate-900 tracking-wider">{{ $intervention->tracking_code }}</p>
            <button type="button" id="copy-code" class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-700">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                Copier le code
            </button>
            <p class="mt-2 text-xs text-slate-400">Utilisez ce code a tout moment pour retrouver cette page.</p>
        </div>

        {{-- Statut actuel --}}
        <div class="card p-5 mb-5">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-slate-900">Statut de l'intervention</h2>
                <span class="badge {{ $intervention->status_color }}">
                    <span class="w-2 h-2 rounded-full {{ $isFinished ? '' : 'bg-orange-500 animate-pulse' }}"></span>
                    {{ $intervention->status_label }}
                </span>
            </div>
            @if(!$isFinished)
                <p class="mt-2 text-xs text-slate-500 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                    Suivi en direct : la page se met a jour automatiquement.
                </p>
            @endif
        </div>

        {{-- Carte en temps reel --}}
        <div class="card p-4 mb-5">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-3">
                <svg class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Carte en temps reel
            </h2>
            <div class="map-shell">
                <div id="map" style="height: 320px; width: 100%;"></div>
            </div>
        </div>

        {{-- Professionnel assigne --}}
        @if($pro)
            <div class="card p-5 mb-5">
                <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    {{ $pro->isRemorqueur() ? 'Remorqueur' : 'Depanneur' }} assigne
                </h2>
                <div class="flex items-center gap-3">
                    @if($pro->photo)
                        <img src="{{ asset('storage/' . $pro->photo) }}" alt="" class="w-14 h-14 rounded-full object-cover bg-slate-100">
                    @else
                        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-semibold text-lg">{{ strtoupper(substr($pro->first_name, 0, 1)) }}{{ strtoupper(substr($pro->last_name, 0, 1)) }}</div>
                    @endif
                    <div class="min-w-0">
                        <p class="font-semibold text-slate-900">{{ $pro->full_name }}</p>
                        <p class="text-sm text-slate-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            {{ $pro->phone }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="tel:{{ $pro->phone }}" class="btn-secondary flex-1 text-sm py-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Appeler
                    </a>
                    <a href="{{ $whatsapp }}" target="_blank" rel="noopener" class="px-4 py-2.5 text-sm font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        @elseif(!$isFinished)
            <div class="card p-5 mb-5">
                <div class="text-center py-4">
                    <div class="w-12 h-12 mx-auto rounded-full bg-orange-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-500 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.22-8.56"/></svg>
                    </div>
                    <p class="mt-3 font-semibold text-slate-900">En attente d'un remorqueur ou depanneur...</p>
                    <p class="text-sm text-slate-500 mt-1">Dès qu'un professionnel accepte, il apparait ici. Vous pouvez egalement suivre son arrivee sur la carte.</p>
                </div>
            </div>
        @endif

        {{-- Informations --}}
        <div class="card p-5 mb-5">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-3">
                <svg class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                Informations de la demande
            </h2>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between gap-3">
                    <dt class="text-slate-500">Service</dt>
                    <dd class="font-medium text-slate-900 text-right">{{ ucfirst($intervention->service_type) }}</dd>
                </div>
                <div class="flex justify-between gap-3">
                    <dt class="text-slate-500">Vehicule</dt>
                    <dd class="font-medium text-slate-900 text-right">{{ ucfirst($intervention->vehicle_type ?? 'Non renseigne') }}</dd>
                </div>
                @if($intervention->client_address)
                    <div class="flex justify-between gap-3">
                        <dt class="text-slate-500">Position du client</dt>
                        <dd class="font-medium text-slate-900 text-right">{{ $intervention->client_address }}</dd>
                    </div>
                @endif
                @if($intervention->destination)
                    <div class="flex justify-between gap-3">
                        <dt class="text-slate-500">Destination</dt>
                        <dd class="font-medium text-slate-900 text-right">{{ $intervention->destination }}</dd>
                    </div>
                @endif
                @if($intervention->description)
                    <div class="flex justify-between gap-3">
                        <dt class="text-slate-500 shrink-0">Description</dt>
                        <dd class="font-medium text-slate-700 text-right">{{ $intervention->description }}</dd>
                    </div>
                @endif
                @if($intervention->photo)
                    <div>
                        <dt class="text-slate-500 mb-2">Photo de la panne</dt>
                        <a href="{{ asset('storage/' . $intervention->photo) }}" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $intervention->photo) }}" alt="Photo de la panne" class="w-full max-w-xs rounded-lg border border-slate-200">
                        </a>
                    </div>
                @endif
            </dl>
        </div>

        {{-- Historique --}}
        <div class="card p-5 mb-5">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                Historique de l'intervention
            </h2>
            @if($intervention->statuses->isNotEmpty())
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
                                <p class="text-sm font-semibold text-slate-900">{{ $intervention->statusLabelFor($status->status) }}</p>
                                <p class="text-xs text-slate-500">{{ $status->created_at->format('d/m/Y H:i') }}</p>
                                @if($status->note)
                                    <p class="text-sm text-slate-600 mt-1">{{ $status->note }}</p>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            @else
                <p class="text-sm text-slate-500">Aucune mise a jour pour le moment.</p>
            @endif
        </div>

        {{-- Notation (intervention terminee) --}}
        @if(!$isFinished)
            <form method="POST" action="{{ route('guest.cancel', $intervention->tracking_code) }}"
                  onsubmit="return confirm('Annuler cette intervention ?')">
                @csrf
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-lg text-sm font-semibold text-red-600 bg-red-50 border border-red-200 hover:bg-red-100">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    Annuler l'intervention
                </button>
            </form>
        @elseif($intervention->status === 'intervention_terminee')
            <div class="card p-5 mb-5">
                <h2 class="font-semibold text-slate-900 flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-orange-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Noter le professionnel
                </h2>
                <p class="text-sm text-slate-600 mb-4">Merci de noter votre experience avec {{ $pro ? $pro->full_name : 'le professionnel' }}.</p>

                @if($intervention->hasBeenRated())
                    <div class="text-center">
                        <div class="flex justify-center gap-1 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $intervention->rating)
                                    <svg class="w-7 h-7 text-orange-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @else
                                    <svg class="w-7 h-7 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @endif
                            @endfor
                        </div>
                        @if($intervention->rating_comment)
                            <p class="text-sm text-slate-600 italic">"{{ $intervention->rating_comment }}"</p>
                        @endif
                        <p class="text-xs text-slate-400 mt-2">Note envoyee le {{ $intervention->rated_at->format('d/m/Y H:i') }}</p>
                    </div>
                @else
                    <form method="POST" action="{{ route('guest.rate', $intervention->tracking_code) }}">
                        @csrf
                        <div class="flex justify-center gap-2 mb-4" id="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-value="{{ $i }}" class="rating-star text-slate-300 hover:text-orange-400 transition-colors" aria-label="{{ $i }} etoiles">
                                    <svg class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0">
                        <div>
                            <label for="rating_comment" class="label">Commentaire (optionnel)</label>
                            <textarea id="rating_comment" name="rating_comment" rows="2" class="input"></textarea>
                        </div>
                        <button type="submit" id="rating-submit" class="w-full mt-3 inline-flex items-center justify-center gap-2 py-3 rounded-lg text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Envoyer la note
                        </button>
                        @error('rating')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </form>
                @endif
            </div>
        @endif

        {{-- Creer un compte pour conserver l'historique --}}
        @if($intervention->isGuest())
            <div class="border border-orange-200 bg-orange-50 rounded-2xl p-5 mb-5">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Conservez l'historique de vos interventions</h3>
                        <p class="text-sm text-slate-600 mt-1">Creez un compte gratuit : cette intervention sera liee a votre compte et vous la retrouverez dans votre espace, avec toutes les suivantes.</p>
                        <a href="{{ route('register', ['tracking' => $intervention->tracking_code]) }}" class="inline-flex items-center gap-1.5 mt-4 btn-primary text-sm">
                            Creer mon compte (gratuit)
                        </a>
                        <p class="text-xs text-slate-500 mt-3">
                            Vos donnees sont protegees. Consultez notre
                            <a href="{{ route('privacy') }}" class="underline hover:text-orange-600">politique de confidentialite</a>.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <p class="text-center text-xs text-slate-400 mb-8">
            <a href="{{ url('/') }}" class="hover:text-orange-600">Retour a l'accueil</a>
        </p>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lat = {{ $intervention->client_lat ?? 14.7167 }};
            const lng = {{ $intervention->client_lng ?? -17.4677 }};
            const hasPro = {{ $pro ? 'true' : 'false' }};
            const isFinished = {{ $isFinished ? 'true' : 'false' }};
            let proCardReloaded = hasPro;
            const statusUrl = '{{ route('guest.status', $intervention->tracking_code) }}';
            const positionUrl = '{{ route('guest.pro-position', $intervention->tracking_code) }}';

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

            function updateProPosition(point) {
                if (!proMarker) {
                    proMarker = L.marker([point.lat, point.lng], { icon: proIcon }).addTo(map)
                        .bindPopup('<strong>{{ $pro ? $pro->full_name : 'Professionnel' }}</strong>');
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

            @if($pro && $pro->locations->isNotEmpty())
                const proLocations = {!! $pro->locations->map(fn ($l) => [$l->lat, $l->lng])->values()->toJson() !!};
                const proLatest = proLocations[proLocations.length - 1];
                proMarker = L.marker(proLatest, { icon: proIcon }).addTo(map)
                    .bindPopup('<strong>{{ $pro->full_name }}</strong>');
                if (proLocations.length > 1) {
                    routeLine = L.polyline(proLocations, { color: '#f97316', weight: 3, opacity: 0.8 }).addTo(map);
                }
            @endif

            if (hasPro && !isFinished) {
                setInterval(function () {
                    fetch(positionUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            if (data && data.lat) updateProPosition(data);
                        })
                        .catch(function () {});

                    fetch(statusUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            if (data && data.is_finished) {
                                location.reload();
                                return;
                            }
                            if (data && data.professional && !proCardReloaded) {
                                proCardReloaded = true;
                                location.reload();
                                return;
                            }
                            if (data && data.status_label) {
                                const badge = document.querySelector('.badge');
                                if (badge) badge.textContent = data.status_label;
                            }
                        })
                        .catch(function () {});
                }, 8000);
            }

            const copyBtn = document.getElementById('copy-code');
            if (copyBtn) {
                copyBtn.addEventListener('click', function () {
                    const code = document.getElementById('tracking-code').textContent.trim();
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(code).then(function () {
                            copyBtn.textContent = 'Code copie !';
                            setTimeout(function () { copyBtn.textContent = 'Copier le code'; }, 2000);
                        });
                    } else {
                        const ta = document.createElement('textarea');
                        ta.value = code;
                        document.body.appendChild(ta);
                        ta.select();
                        document.execCommand('copy');
                        document.body.removeChild(ta);
                        copyBtn.textContent = 'Code copie !';
                        setTimeout(function () { copyBtn.textContent = 'Copier le code'; }, 2000);
                    }
                });
            }

            const starContainer = document.getElementById('rating-stars');
            const ratingInput = document.getElementById('rating');
            const ratingSubmit = document.getElementById('rating-submit');
            if (starContainer && ratingInput && ratingSubmit) {
                let selected = 0;
                const starButtons = starContainer.querySelectorAll('.rating-star');
                function paint(value) {
                    starButtons.forEach(function (btn, idx) {
                        const icon = btn.querySelector('svg');
                        if (icon) {
                            icon.setAttribute('fill', idx < value ? 'currentColor' : 'none');
                            btn.classList.toggle('text-orange-400', idx < value);
                            btn.classList.toggle('text-slate-300', idx >= value);
                        }
                    });
                }
                starButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        selected = parseInt(btn.getAttribute('data-value'), 10);
                        ratingInput.value = selected;
                        paint(selected);
                        ratingSubmit.disabled = false;
                    });
                });
            }
        });
    </script>
</body>
</html>