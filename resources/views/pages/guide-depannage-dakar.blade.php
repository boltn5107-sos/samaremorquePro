<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide depannage Dakar - SamaRemorque | Conseils et bons reflexes en cas de panne</title>
    <meta name="description" content="Guide depannage Dakar : que faire en cas de panne, les bons reflexes, les numéros utiles et comment choisir un depanneur fiable a Dakar, Pikine et Rufisque.">
    <meta name="keywords" content="guide depannage Dakar, panne Dakar, depannage Dakar conseils, depanneur Dakar fiable, urgence Dakar, panne route Dakar, conseils depannage Senegal">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/guide-depannage-dakar') }}">
    <link rel="alternate" hreflang="fr" href="{{ url('/guide-depannage-dakar') }}">
    <link rel="alternate" hreflang="fr-SN" href="{{ url('/guide-depannage-dakar') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/guide-depannage-dakar') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="Guide depannage Dakar - SamaRemorque | Conseils et bons reflexes en cas de panne">
    <meta property="og:description" content="Guide depannage Dakar : que faire en cas de panne, les bons reflexes et comment choisir un depanneur fiable.">
    <meta property="og:url" content="{{ url('/guide-depannage-dakar') }}">
    <meta property="og:image" content="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Guide depannage Dakar - SamaRemorque | Conseils et bons reflexes en cas de panne">
    <meta name="twitter:description" content="Guide depannage Dakar : que faire en cas de panne, les bons reflexes et comment choisir un depanneur fiable.">
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
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Que faire en cas de panne a Dakar ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Mettez-vous en securite, utilisez le triangle de signalisation, puis contactez un depanneur ou un remorqueur. Vous pouvez aussi utiliser SamaRemorque pour trouver un professionnel disponible pres de vous."
                }
            },
            {
                "@type": "Question",
                "name": "Comment choisir un depanneur fiable a Dakar ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Preferez un depanneur verifie, consultez les avis, comparez les tarifs horaires et demandez un devis avant l'intervention."
                }
            }
        ]
    }
    </script>
</head>
<body class="font-sans antialiased bg-white text-slate-900">
    @include('layouts.partials.navbar')

    <main>
        <header class="bg-slate-900 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight">Guide depannage Dakar</h1>
                <p class="mt-4 text-lg text-slate-300 max-w-2xl">Les bons reflexes a avoir en cas de panne et les conseils pour choisir un depanneur fiable a Dakar, Pikine et Rufisque.</p>
            </div>
        </header>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-slate-900">Que faire en cas de panne ?</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Mettez-vous en securite</h3>
                        <p class="mt-2 text-sm text-slate-600">Garez-vous sur le cote, allumez les feux de detresse et placez le triangle de signalisation a environ 30 metres.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Appelez un professionnel</h3>
                        <p class="mt-2 text-sm text-slate-600">Contactez un depanneur ou un remorqueur. Utilisez SamaRemorque pour trouver un professionnel verifie pres de vous.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivez l'intervention</h3>
                        <p class="mt-2 text-sm text-slate-600">Suivez l'arrivee du depanneur sur la carte et soyez informe a chaque etape jusqu'a la fin de l'intervention.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-slate-900">Conseils pour choisir un depanneur</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Verifiez les credentials</h3>
                        <p class="mt-2 text-sm text-slate-600">Choisissez un depanneur verifie avec des evaluations positives et un tarif horaire clair.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Demandez un devis</h3>
                        <p class="mt-2 text-sm text-slate-600">Demandez un devis avant l'intervention pour eviter les mauvaises surprises sur le prix.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivez en temps reel</h3>
                        <p class="mt-2 text-sm text-slate-600">Utilisez une application avec suivi GPS pour voir l'arrivee du depanneur en temps reel.</p>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('guest.create') }}" class="btn-primary text-base px-8 py-3.5">Demander une assistance</a>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-900 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold">En panne a Dakar ?</h2>
                <p class="mt-3 text-slate-300 text-lg">Ne restez pas bloque. Demandez une assistance maintenant et soyez mis en relation avec un depanneur disponible.</p>
                <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base">Demander une assistance</a>
            </div>
        </section>
    </main>

    @include('layouts.partials.footer')
</body>
</html>
