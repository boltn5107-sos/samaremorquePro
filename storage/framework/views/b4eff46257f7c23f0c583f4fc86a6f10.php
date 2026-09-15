<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depannage Dakar - SamaRemorque | Depanneur 24/7 a Dakar, Pikine, Rufisque</title>
    <meta name="description" content="Depannage a Dakar et sa region : batterie a plat, crevaison, panne moteur. SamaRemorque vous met en relation avec un depanneur verifie en quelques clics, 24/7.">
    <meta name="keywords" content="depannage Dakar, depanneur Dakar, depannage Pikine, depannage Rufisque, depannage voiture Dakar, depannage 24/7 Dakar, batterie a plat Dakar, crevaison Dakar, depannage urgent Dakar, remorqueur Dakar">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url('/depannage-dakar')); ?>">
    <link rel="alternate" hreflang="fr" href="<?php echo e(url('/depannage-dakar')); ?>">
    <link rel="alternate" hreflang="fr-SN" href="<?php echo e(url('/depannage-dakar')); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e(url('/depannage-dakar')); ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="Depannage Dakar - SamaRemorque | Depanneur 24/7 a Dakar">
    <meta property="og:description" content="Depannage a Dakar et sa region : batterie a plat, crevaison, panne moteur. Depanneur verifie 24/7.">
    <meta property="og:url" content="<?php echo e(url('/depannage-dakar')); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Depannage Dakar - SamaRemorque | Depanneur 24/7">
    <meta name="twitter:description" content="Depannage a Dakar et sa region. Depanneur verifie 24/7.">
    <meta name="twitter:image" content="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>">

    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.jpg">
    <link rel="apple-touch-icon" href="/favicon.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "SamaRemorque",
        "description": "Depannage et remorquage au Senegal",
        "url": "<?php echo e(url('/')); ?>",
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
                "name": "Quels types de depannages sont proposes a Dakar ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Depannage sur place pour batterie a plat, crevaison, probleme mecanique leger, et remorquage vers le garage de votre choix a Dakar et sa region."
                }
            },
            {
                "@type": "Question",
                "name": "Intervenez-vous a Pikine et Rufisque ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Oui, SamaRemorque couvre Dakar, Pikine et Rufisque. Vous pouvez choisir un depanneur ou remorqueur disponible pres de vous."
                }
            },
            {
                "@type": "Question",
                "name": "Comment trouver un depanneur rapidement ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Renseignez votre position, le type de panne et votre telephone. SamaRemorque vous affiche les depanneurs disponibles et vous pouvez choisir en fonction du tarif et de la distance."
                }
            }
        ]
    }
    </script>
</head>
<body class="font-sans antialiased bg-white text-slate-900">
    <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <header class="relative bg-slate-900 text-white overflow-hidden">
            <div class="absolute inset-0">
                <img src="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>" alt="Depannage et remorquage a Dakar" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 bg-orange-500/20 text-orange-300 text-xs font-semibold px-3 py-1 rounded-full">Depannage Dakar</span>
                    <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">Depannage a Dakar : un depanneur pres de vous en quelques clics</h1>
                    <p class="mt-4 text-lg text-slate-300">Batterie a plat, crevaison, panne moteur : trouvez un depanneur ou remorqueur verifie a Dakar, Pikine et Rufisque. Intervention rapide, tarif transparent, suivi en temps reel.</p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="<?php echo e(route('guest.create')); ?>" class="btn-primary text-base px-6 py-3.5">Demander une assistance</a>
                        <a href="#services" class="btn-secondary bg-white/10 text-white border-white/20 hover:bg-white/20 text-base px-6 py-3.5">Voir nos services</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-slate-900">Pourquoi choisir SamaRemorque pour votre depannage a Dakar ?</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depanneurs verifies</h3>
                        <p class="mt-2 text-sm text-slate-600">Tous les depanneurs sont valides par notre equipe. Vous consultez leur profil, leur tarif et leur evaluation.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Intervention rapide</h3>
                        <p class="mt-2 text-sm text-slate-600">Mise en relation en quelques minutes. Suivez l'arrivee du depanneur sur la carte en temps reel.</p>
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
                    <h2 class="text-3xl font-bold text-slate-900">Nos services de depannage a Dakar</h2>
                    <p class="mt-3 text-slate-600">Des interventions pour tous les types de pannes a Dakar, Pikine et Rufisque.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depannage batterie</h3>
                        <p class="mt-2 text-sm text-slate-600">Batterie a plat, probleme de demarrage : le depanneur intervient directement sur place pour vous remettre en route.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depannage crevaison</h3>
                        <p class="mt-2 text-sm text-slate-600">Cre vaison ou pneu creve : le depanneur remplace ou repere le pneu sur place pour vous permettre de continuer.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Remorquage Dakar</h3>
                        <p class="mt-2 text-sm text-slate-600">Transport securise vers le garage de votre choix. Remorqueurs disponibles pour voitures, motos et petits utilitaires.</p>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="<?php echo e(route('guest.create')); ?>" class="btn-primary text-base px-8 py-3.5">Demander un depannage</a>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-900 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold">En panne a Dakar ?</h2>
                <p class="mt-3 text-slate-300 text-lg">Ne restez pas bloque. Demandez une assistance maintenant et soyez mis en relation avec un depanneur ou remorqueur disponible.</p>
                <a href="<?php echo e(route('guest.create')); ?>" class="mt-8 inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base">Demander une assistance</a>
            </div>
        </section>
    </main>

    <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\pages\depannage-dakar.blade.php ENDPATH**/ ?>