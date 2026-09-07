<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depannage urgence Dakar - SamaRemorque | Depanneur urgent 24/7 a Dakar</title>
    <meta name="description" content="Depannage urgence Dakar : intervention rapide 24/7 pour batterie a plat, crevaison, panne moteur. Depanneur verifie en quelques minutes a Dakar, Pikine, Rufisque.">
    <meta name="keywords" content="depannage urgence Dakar, depanneur urgent Dakar, depannage 24/7 Dakar, urgence depannage Dakar, depannage rapide Dakar, batterie a plat urgence Dakar, crevaison urgence Dakar, remorqueur urgence Dakar">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/depannage-urgence-dakar') }}">
    <link rel="alternate" hreflang="fr" href="{{ url('/depannage-urgence-dakar') }}">
    <link rel="alternate" hreflang="fr-SN" href="{{ url('/depannage-urgence-dakar') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/depannage-urgence-dakar') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="Depannage urgence Dakar - SamaRemorque | Depanneur urgent 24/7">
    <meta property="og:description" content="Depannage urgence Dakar : intervention rapide 24/7 pour batterie a plat, crevaison, panne moteur. Depanneur verifie en quelques minutes.">
    <meta property="og:url" content="{{ url('/depannage-urgence-dakar') }}">
    <meta property="og:image" content="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Depannage urgence Dakar - SamaRemorque | Depanneur urgent 24/7">
    <meta name="twitter:description" content="Depannage urgence Dakar : intervention rapide 24/7. Depanneur verifie en quelques minutes.">
    <meta name="twitter:image" content="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}">

    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.jpg">
    <link rel="apple-touch-icon" href="/favicon.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "SamaRemorque",
        "description": "Depannage urgence au Senegal",
        "url": "{{ url('/') }}",
        "telephone": "+221774467596",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Dakar",
            "addressCountry": "SN"
        },
        "openingHours": "Mo-Su 00:00-23:59",
        "areaServed": ["Dakar", "Pikine", "Rufisque"]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Comment obtenir un depanneur en urgence a Dakar ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Renseignez votre position et le type de panne sur SamaRemorque. Vous etes mis en relation avec un depanneur disponible en quelques minutes, 24/7."
                }
            },
            {
                "@type": "Question",
                "name": "Quels types de pannes sont prises en charge en urgence ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Batterie a plat, crevaison, panne moteur, probleme mecanique leger et immobilisation generale. Nous intervenons rapidement a Dakar, Pikine et Rufisque."
                }
            }
        ]
    }
    </script>
</head>
<body class="font-sans antialiased bg-white text-slate-900">
    @include('layouts.partials.navbar')

    <main>
        <header class="relative bg-slate-900 text-white overflow-hidden">
            <div class="absolute inset-0">
                <img src="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}" alt="Depannage urgence Dakar" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 bg-orange-500/20 text-orange-300 text-xs font-semibold px-3 py-1 rounded-full">Depannage urgence Dakar</span>
                    <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">Depannage urgence a Dakar : intervention rapide 24/7</h1>
                    <p class="mt-4 text-lg text-slate-300">En cas de panne a Dakar, Pikine ou Rufisque, trouvez un depanneur verifie en quelques minutes. Intervention rapide, tarif transparent, suivi en temps reel.</p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('guest.create') }}" class="btn-primary text-base px-6 py-3.5">Demander une assistance</a>
                        <a href="#services" class="btn-secondary bg-white/10 text-white border-white/20 hover:bg-white/20 text-base px-6 py-3.5">Voir nos services</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-slate-900">Depannage urgence Dakar : notre engagement</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Disponible 24/7</h3>
                        <p class="mt-2 text-sm text-slate-600">Service disponible jour et nuit, y compris les week-ends et jours feries a Dakar et sa region.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depanneurs verifies</h3>
                        <p class="mt-2 text-sm text-slate-600">Tous les depanneurs sont verifies et notes par la communaute. Vous choisissez en toute confiance.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivi en temps reel</h3>
                        <p class="mt-2 text-sm text-slate-600">Suivez l'arrivee du depanneur sur la carte et recevez les mises a jour par etat.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <h2 class="text-3xl font-bold text-slate-900">Nos services de depannage urgence</h2>
                    <p class="mt-3 text-slate-600">Interventions rapides pour tous les types de pannes a Dakar, Pikine et Rufisque.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depannage batterie</h3>
                        <p class="mt-2 text-sm text-slate-600">Batterie a plat en urgence : le depanneur intervient rapidement pour vous remettre en route.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depannage crevaison</h3>
                        <p class="mt-2 text-sm text-slate-600">Cre vaison ou pneu creve : le depanneur remplace ou repere le pneu sur place.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Remorquage urgence</h3>
                        <p class="mt-2 text-sm text-slate-600">Transport urgent vers le garage de votre choix si le depannage sur place n'est pas possible.</p>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('guest.create') }}" class="btn-primary text-base px-8 py-3.5">Demander un depannage urgent</a>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-900 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold">En urgence a Dakar ?</h2>
                <p class="mt-3 text-slate-300 text-lg">Ne restez pas bloque sur la route. Demandez une assistance maintenant et soyez mis en relation avec un depanneur disponible.</p>
                <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base">Demander une assistance</a>
            </div>
        </section>
    </main>

    @include('layouts.partials.footer')
</body>
</html>
