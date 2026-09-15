<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depanneur Dakar - SamaRemorque | Depanneur verifie a Dakar, Pikine, Rufisque</title>
    <meta name="description" content="Trouvez un depanneur verifie a Dakar, Pikine et Rufisque. Intervention rapide pour batterie a plat, crevaison, panne moteur. Tarifs transparents, suivi en temps reel 24/7.">
    <meta name="keywords" content="depanneur Dakar, depanneur Pikine, depanneur Rufisque, depanneur verifie Dakar, depanneur 24/7 Dakar, depanneur voiture Dakar, depanneur batterie Dakar, depanneur crevaison Dakar, depanneur Senegal">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url('/depanneur-dakar')); ?>">
    <link rel="alternate" hreflang="fr" href="<?php echo e(url('/depanneur-dakar')); ?>">
    <link rel="alternate" hreflang="fr-SN" href="<?php echo e(url('/depanneur-dakar')); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e(url('/depanneur-dakar')); ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="Depanneur Dakar - SamaRemorque | Depanneur verifie 24/7">
    <meta property="og:description" content="Trouvez un depanneur verifie a Dakar, Pikine et Rufisque. Intervention rapide 24/7.">
    <meta property="og:url" content="<?php echo e(url('/depanneur-dakar')); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Depanneur Dakar - SamaRemorque | Depanneur verifie 24/7">
    <meta name="twitter:description" content="Trouvez un depanneur verifie a Dakar, Pikine et Rufisque. Intervention rapide 24/7.">
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
                "name": "Comment trouver un depanneur a Dakar ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Renseignez votre position et le type de panne sur SamaRemorque. Vous etes mis en relation avec un depanneur verifie disponible en quelques minutes."
                }
            },
            {
                "@type": "Question",
                "name": "Les depanneurs sont-ils verifies ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Oui, tous les depanneurs sont verifies par notre equipe. Vous pouvez consulter leur profil, leur tarif horaire et leur evaluation avant de choisir."
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
                <img src="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>" alt="Depanneur Dakar" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 bg-orange-500/20 text-orange-300 text-xs font-semibold px-3 py-1 rounded-full">Depanneur Dakar</span>
                    <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">Trouvez un depanneur verifie a Dakar en quelques clics</h1>
                    <p class="mt-4 text-lg text-slate-300">Depannage sur place et remorquage a Dakar, Pikine et Rufisque. Intervention rapide 24/7, tarif transparent, suivi en temps reel.</p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="<?php echo e(route('guest.create')); ?>" class="btn-primary text-base px-6 py-3.5">Demander une assistance</a>
                        <a href="#services" class="btn-secondary bg-white/10 text-white border-white/20 hover:bg-white/20 text-base px-6 py-3.5">Voir nos services</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-slate-900">Pourquoi choisir SamaRemorque pour trouver un depanneur ?</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depanneurs verifies</h3>
                        <p class="mt-2 text-sm text-slate-600">Tous les depanneurs sont valides par notre equipe. Vous consultez leur profil et leur evaluation avant de choisir.</p>
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
                    <h2 class="text-3xl font-bold text-slate-900">Nos services de depannage</h2>
                    <p class="mt-3 text-slate-600">Depannage sur place et remorquage a Dakar, Pikine et Rufisque.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depannage batterie</h3>
                        <p class="mt-2 text-sm text-slate-600">Batterie a plat : le depanneur intervient directement sur place pour vous remettre en route.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Depannage crevaison</h3>
                        <p class="mt-2 text-sm text-slate-600">Cre vaison ou pneu creve : le depanneur remplace ou repere le pneu sur place.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Remorquage</h3>
                        <p class="mt-2 text-sm text-slate-600">Transport securise vers le garage de votre choix si le depannage sur place n'est pas possible.</p>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="<?php echo e(route('guest.create')); ?>" class="btn-primary text-base px-8 py-3.5">Demander une assistance</a>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-900 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold">Besoin d'un depanneur a Dakar ?</h2>
                <p class="mt-3 text-slate-300 text-lg">Demandez une assistance maintenant et soyez mis en relation avec un depanneur disponible pres de vous.</p>
                <a href="<?php echo e(route('guest.create')); ?>" class="mt-8 inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base">Demander une assistance</a>
            </div>
        </section>
    </main>

    <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\pages\depanneur-dakar.blade.php ENDPATH**/ ?>