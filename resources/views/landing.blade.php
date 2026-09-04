<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SamaRemorque - Remorquage &amp; Depannage Routier au Senegal</title>

    {{-- SEO --}}
    <meta name="description" content="SamaRemorque : trouvez en quelques clics un remorqueur ou depanneur routier disponible pres de chez vous au Senegal. Assistance 24/7, localisation en temps reel, remorquage et depannage rapide.">
    <meta name="keywords" content="remorquage, depannage, remorqueur, depanneur, panne, vehicule, assistance routiere, Senegal, Dakar, remorque voiture, depannage 24/7, garage mobile">
    <meta name="author" content="SamaRemorque">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="SamaRemorque - Remorquage &amp; Depannage Routier au Senegal">
    <meta property="og:description" content="Trouvez rapidement un remorqueur ou un depanneur pres de vous. Localisation en temps reel, assistance 24/7 au Senegal.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}">
    <meta property="og:locale" content="fr_SN">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SamaRemorque - Remorquage &amp; Depannage Routier au Senegal">
    <meta name="twitter:description" content="Trouvez rapidement un remorqueur ou un depanneur pres de vous au Senegal.">
    <meta name="twitter:image" content="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}">

    {{-- Favicons application --}}
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Donnees structurees (Schema.org) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "SamaRemorque",
        "description": "Plateforme de remorquage et depannage routier au Senegal",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('favicon.png') }}",
        "sameAs": []
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "SamaRemorque",
        "description": "Service de remorquage et depannage routier au Senegal, remorqueurs et depanneurs disponibles 24/7.",
        "areaServed": "SN",
        "url": "{{ url('/') }}",
        "priceRange": "$$"
    }
    </script>
</head>
<body class="font-sans antialiased bg-white text-slate-900">

    {{-- Navigation publique --}}
    <nav class="bg-slate-900 text-white sticky top-0 z-40 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-lg font-bold tracking-tight">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white overflow-hidden">
                        <img src="{{ asset('favicon.png') }}" alt="SamaRemorque" class="w-7 h-7 object-contain">
                    </span>
                    <span>SamaRemorque</span>
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="#fonctionnement" class="hover:text-orange-400">Comment ca marche</a>
                    <a href="#avantages" class="hover:text-orange-400">Avantages</a>
                    <a href="#professionnels" class="hover:text-orange-400">Devenir remorqueur</a>
                    <a href="#contact" class="hover:text-orange-400">Contact</a>
                    <a href="{{ route('login') }}" class="hover:text-orange-400">Connexion</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-1.5 bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg font-semibold">
                        Inscription
                    </a>
                </div>
                <button id="landing-menu-toggle" class="md:hidden inline-flex items-center justify-center p-2 rounded-md hover:bg-slate-800 focus:outline-none" aria-label="Menu">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                </button>
            </div>
        </div>
        <div id="landing-menu" class="hidden md:hidden border-t border-slate-700">
            <div class="px-4 py-3 space-y-1 text-sm font-medium">
                <a href="#fonctionnement" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">Comment ca marche</a>
                <a href="#avantages" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">Avantages</a>
                <a href="#professionnels" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">Devenir remorqueur</a>
                <a href="#contact" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">Contact</a>
                <a href="{{ route('login') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">Connexion</a>
                <a href="{{ route('register') }}" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800 text-orange-400">Inscription</a>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <header class="relative bg-slate-900 text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}"
                 alt="Remorque transportant un vehicule au Senegal"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-1.5 bg-orange-500/20 text-orange-300 text-xs font-semibold px-3 py-1 rounded-full">
                    Remorquage &amp; Depannage 24/7 - Senegal
                </span>
                <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                    Une panne ? Un remorqueur ou depanneur pres de vous, en quelques clics.
                </h1>
                <p class="mt-4 text-lg text-slate-300">
                    SamaRemorque connecte les conducteurs en panne aux remorqueurs et depanneurs disponibles en temps reel. Localisation, tarifs, suivi : tout est simplifie.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('register') }}" class="btn-primary text-base px-6 py-3.5">
                        Demander une intervention
                    </a>
                    <a href="#fonctionnement" class="btn-secondary bg-white/10 text-white border-white/20 hover:bg-white/20 text-base px-6 py-3.5">
                        Decouvrir comment ca marche
                    </a>
                </div>
                <div class="mt-10 grid grid-cols-3 gap-6 max-w-md">
                    <div>
                        <p class="text-3xl font-bold text-orange-400">24/7</p>
                        <p class="text-xs text-slate-400 mt-1">Assistance continue</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-orange-400">+100</p>
                        <p class="text-xs text-slate-400 mt-1">Professionnels partenaires</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-orange-400">-5min</p>
                        <p class="text-xs text-slate-400 mt-1">Duree moyenne de mise en relation</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Fonctionnement --}}
    <section id="fonctionnement" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-3xl font-bold text-slate-900">Comment ca marche ?</h2>
                <p class="mt-3 text-slate-600">En 3 etapes simples, retrouvez la route en toute securite.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Signalez votre panne</h3>
                    <p class="mt-2 text-sm text-slate-600">Indiquez votre position GPS ou manuelle, le type de panne et votre destination. Ajoutez une photo pour faciliter l'intervention.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Choisissez votre professionnel</h3>
                    <p class="mt-2 text-sm text-slate-600">Selectionnez le remorqueur ou depanneur le plus proche parmi ceux disponibles. Consultez ses tarifs et son profil.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivez en temps reel</h3>
                    <p class="mt-2 text-sm text-slate-600">Suivez l'arrivee de votre professionnel sur la carte et soyez informe a chaque etape de l'intervention.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Client utilisant l'application --}}
    <section id="client" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('images/Une_cliente_qui_utilise_l_application.jpg') }}"
                         alt="Une cliente utilisant l'application SamaRemorque"
                         class="rounded-2xl shadow-lg object-cover w-full">
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Une application simple et accessible</h2>
                    <p class="mt-4 text-slate-600">
                        SamaRemorque est concue pour les conducteurs au Senegal. Aucune installation compliquee : l'application fonctionne directement depuis votre navigateur, meme en PWA.
                    </p>
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <span class="text-sm text-slate-700">Localisation GPS automatique pour trouver les professionnels les plus proches.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <span class="text-sm text-slate-700">Suivi en temps reel du remorqueur ou du depanneur sur la carte.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <span class="text-sm text-slate-700">Tarifs horaires affiches pour choisir en toute transparence.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Professionnels pour notres --}}
    <section id="avantages" class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-3xl font-bold">Des professionnels a votre service</h2>
                    <p class="mt-4 text-slate-300">
                        Nos remorqueurs et depanneurs sont validates par l'administrateur, suivis en temps reel et disponibles partout au Senegal, surtout dans les grandes agglomerations comme Dakar.
                    </p>
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-xl p-5 border border-white/10">
                            <p class="text-3xl font-bold text-orange-400">100%</p>
                            <p class="text-sm text-slate-300 mt-1">Professionnels valides</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-5 border border-white/10">
                            <p class="text-3xl font-bold text-orange-400">Reel</p>
                            <p class="text-sm text-slate-300 mt-1">Suivi GPS geolocalise</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-5 border border-white/10">
                            <p class="text-3xl font-bold text-orange-400">Simple</p>
                            <p class="text-sm text-slate-300 mt-1">Contact direct par appel ou WhatsApp</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-5 border border-white/10">
                            <p class="text-3xl font-bold text-orange-400">Rapide</p>
                            <p class="text-sm text-slate-300 mt-1">Mise en relation en quelques minutes</p>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="{{ asset('images/depanneur_en_action.jpg') }}"
                         alt="Depanneur en action intervenant sur un vehicule"
                         class="rounded-2xl shadow-lg object-cover w-full">
                </div>
            </div>
        </div>
    </section>

    {{-- Devenir professionnel --}}
    <section id="professionnels" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('images/clients_qui_utilise_l_application2.jpg') }}"
                         alt="Clients utilisant l'application SamaRemorque"
                         class="rounded-2xl shadow-lg object-cover w-full">
                </div>
                <div>
                    <span class="inline-flex bg-orange-100 text-orange-700 text-xs font-semibold px-3 py-1 rounded-full">Pour les professionnels</span>
                    <h2 class="mt-4 text-3xl font-bold text-slate-900">Remorqueur ou depanneur ? Rejoignez SamaRemorque</h2>
                    <p class="mt-4 text-slate-600">
                        Developpez votre activite et recevez directement les demandes d'intervention des clients selectionnant votre service. Vous etaient remorqueurs et depanneurs, c'est vous qui vous deplacez vers le client.
                    </p>
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <span class="text-sm text-slate-700">Recevez les demandes ciblees des clients qui vous selectionnent.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <span class="text-sm text-slate-700">Accepter ou refuser les demandes en toute liberte.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <span class="text-sm text-slate-700">Affichage de votre profil et de vos tarifs pour attirer les clients.</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-primary mt-8">
                        Devenir remorqueur / depanneur
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Appel a l'action final --}}
    <section class="py-16 bg-orange-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900">En panne maintenant ?</h2>
            <p class="mt-3 text-slate-600 text-lg">Ne restez pas bloque sur la route. Trouvez un remorqueur ou depanneur des maintenant.</p>
            <a href="{{ route('register') }}" class="btn-primary mt-8 text-base px-8 py-3.5">
                Demander une intervention
            </a>
        </div>
    </section>

    {{-- Pied de page --}}
    <footer id="contact" class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white overflow-hidden">
                            <img src="{{ asset('favicon.png') }}" alt="SamaRemorque" class="w-6 h-6 object-contain">
                        </span>
                        <h3 class="text-white font-bold text-lg">SamaRemorque</h3>
                    </div>
                    <p class="mt-3 text-sm">Plateforme de remorquage et depannage routier au Senegal.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Navigation</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#fonctionnement" class="hover:text-orange-400">Comment ca marche</a></li>
                        <li><a href="#avantages" class="hover:text-orange-400">Avantages</a></li>
                        <li><a href="#professionnels" class="hover:text-orange-400">Devenir remorqueur</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Compte</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('login') }}" class="hover:text-orange-400">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-orange-400">Inscription</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t border-slate-800 text-sm text-center">
                &copy; {{ date('Y') }} SamaRemorque. Tous droits reserves.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('landing-menu-toggle');
            const menu = document.getElementById('landing-menu');
            if (toggle && menu) {
                toggle.addEventListener('click', function () {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
