<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remorquage Dakar - SamaRemorque | Remorqueur 24/7 a Dakar, Pikine, Rufisque</title>
    <meta name="description" content="Remorquage a Dakar et sa region : transport securise de votre vehicule vers le garage de votre choix. Remorqueurs verifies, tarifs transparents, suivi en temps reel 24/7.">
    <meta name="keywords" content="remorquage Dakar, remorqueur Dakar, remorquage Pikine, remorquage Rufisque, remorquage voiture Dakar, remorquage 24/7 Dakar, transport vehicule Dakar, remorquage pas cher Dakar, remorqueur Senegal">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/remorquage-dakar') }}">
    <link rel="alternate" hreflang="fr" href="{{ url('/remorquage-dakar') }}">
    <link rel="alternate" hreflang="fr-SN" href="{{ url('/remorquage-dakar') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/remorquage-dakar') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="Remorquage Dakar - SamaRemorque | Remorqueur 24/7">
    <meta property="og:description" content="Remorquage a Dakar et sa region. Transport securise vers le garage de votre choix. Remorqueurs verifies 24/7.">
    <meta property="og:url" content="{{ url('/remorquage-dakar') }}">
    <meta property="og:image" content="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Remorquage Dakar - SamaRemorque | Remorqueur 24/7">
    <meta name="twitter:description" content="Remorquage a Dakar et sa region. Transport securise vers le garage de votre choix.">
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
        "description": "Remorquage et depannage au Senegal",
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
                "name": "Quels types de remorquage proposez-vous ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Remorquage de voitures, motos, camions, petits utilitaires et conteneurs vers le garage de votre choix. Transport securise par des remorqueurs verifies."
                }
            },
            {
                "@type": "Question",
                "name": "Quel est le tarif du remorquage a Dakar ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Les tarifs varient selon la distance et le type de vehicule. Les tarifs horaires sont affiches sur les profils des remorqueurs pour plus de transparence."
                }
            },
            {
                "@type": "Question",
                "name": "Comment suivre mon remorquage en temps reel ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Apres avoir choisi un remorqueur, suivez son arrivee sur la carte en temps reel depuis votre page de suivi d'intervention."
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
                <img src="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}" alt="Remorquage a Dakar" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 bg-orange-500/20 text-orange-300 text-xs font-semibold px-3 py-1 rounded-full">Remorquage Dakar</span>
                    <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">Remorquage a Dakar : transport securise vers votre garage</h1>
                    <p class="mt-4 text-lg text-slate-300">Trouvez un remorqueur verifie a Dakar, Pikine et Rufisque. Suivi en temps reel, tarifs transparents, intervention 24/7.</p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('guest.create') }}" class="btn-primary text-base px-6 py-3.5">Demander un remorquage</a>
                        <a href="#services" class="btn-secondary bg-white/10 text-white border-white/20 hover:bg-white/20 text-base px-6 py-3.5">Voir nos services</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-slate-900">Pourquoi choisir SamaRemorque pour votre remorquage ?</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Remorqueurs verifies</h3>
                        <p class="mt-2 text-sm text-slate-600">Tous les remorqueurs sont valides par notre equipe. Vous consultez leur profil et leur evaluation avant de choisir.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Transport securise</h3>
                        <p class="mt-2 text-sm text-slate-600">Remorquage securise vers le garage de votre choix. Suivi en temps reel de l'arrivee du remorqueur.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Tarifs transparents</h3>
                        <p class="mt-2 text-sm text-slate-600">Les tarifs horaires sont affiches. Pas de surprise, vous connaissez le cout avant de choisir.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <h2 class="text-3xl font-bold text-slate-900">Nos services de remorquage</h2>
                    <p class="mt-3 text-slate-600">Transport securise pour voitures, motos et petits utilitaires a Dakar et sa region.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Remorquage voiture</h3>
                        <p class="mt-2 text-sm text-slate-600">Transport securise de votre voiture vers le garage de votre choix a Dakar et sa region.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Remorquage moto</h3>
                        <p class="mt-2 text-sm text-slate-600">Remorqueurs equipes pour le transport de motos et scooters en toute securite.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivi en temps reel</h3>
                        <p class="mt-2 text-sm text-slate-600">Suivez l'arrivee du remorqueur sur la carte et soyez informe a chaque etape de l'intervention.</p>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('guest.create') }}" class="btn-primary text-base px-8 py-3.5">Demander un remorquage</a>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-900 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold">Besoin d'un remorqueur a Dakar ?</h2>
                <p class="mt-3 text-slate-300 text-lg">Demandez une assistance maintenant et soyez mis en relation avec un remorqueur disponible pres de vous.</p>
                <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base">Demander un remorquage</a>
            </div>
        </section>
    </main>

    @include('layouts.partials.footer')
</body>
</html>
