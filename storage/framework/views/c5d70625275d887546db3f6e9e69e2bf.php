<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos de SamaRemorque - Plateforme de remorquage et depannage au Senegal</title>
    <meta name="description" content="SamaRemorque est une plateforme senegalaise de mise en relation entre conducteurs et remorqueurs ou depanneurs verifies. Decouvrez notre mission, notre equipe et nos engagements.">
    <meta name="keywords" content="a propos SamaRemorque, plateforme remorquage Senegal, depannage Senegal, equipe SamaRemorque, mission SamaRemorque, remorqueur Senegal, depanneur Senegal">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url('/a-propos')); ?>">
    <link rel="alternate" hreflang="fr" href="<?php echo e(url('/a-propos')); ?>">
    <link rel="alternate" hreflang="fr-SN" href="<?php echo e(url('/a-propos')); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e(url('/a-propos')); ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SamaRemorque">
    <meta property="og:title" content="A propos de SamaRemorque - Plateforme de remorquage et depannage au Senegal">
    <meta property="og:description" content="SamaRemorque est une plateforme senegalaise de mise en relation entre conducteurs et remorqueurs ou depanneurs verifies.">
    <meta property="og:url" content="<?php echo e(url('/a-propos')); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="A propos de SamaRemorque - Plateforme de remorquage et depannage au Senegal">
    <meta name="twitter:description" content="SamaRemorque est une plateforme senegalaise de mise en relation entre conducteurs et remorqueurs ou depanneurs verifies.">
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
        "@type": "Organization",
        "name": "SamaRemorque",
        "description": "Plateforme de remorquage et depannage routier au Senegal",
        "url": "<?php echo e(url('/')); ?>",
        "logo": "<?php echo e(asset('favicon.jpg')); ?>",
        "sameAs": []
    }
    </script>
</head>
<body class="font-sans antialiased bg-white text-slate-900">
    <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <header class="bg-slate-900 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight">A propos de SamaRemorque</h1>
                <p class="mt-4 text-lg text-slate-300 max-w-2xl">Une plateforme senegalaise concue pour rendre l'assistance routiere plus simple, plus rapide et plus transparente pour les conducteurs comme pour les professionnels.</p>
            </div>
        </header>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900">Notre mission</h2>
                        <p class="mt-4 text-slate-600">SamaRemorque est nee d'un constat simple : en cas de panne, il est souvent difficile de trouver rapidement un professionnel de confiance, au bon prix et pres de soi.</p>
                        <p class="mt-4 text-slate-600">Notre mission est de connecter les conducteurs en panne avec des remorqueurs et depanneurs verifies, disponibles en temps reel, et de simplifier chaque etape : localisation, choix, mise en relation et suivi.</p>
                        <p class="mt-4 text-slate-600">Nous croyons a une assistance routiere plus humaine, plus transparente et plus accessible a tous au Senegal.</p>
                    </div>
                    <div>
                        <img src="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>" alt="Remorqueur au Senegal" class="rounded-2xl shadow-lg object-cover w-full">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-slate-900 text-center">Nos engagements</h2>
                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Professionnels verifies</h3>
                        <p class="mt-2 text-sm text-slate-600">Chaque remorqueur et depanneur est verifie par notre equipe. Vous consultez leur profil, leur tarif et leur evaluation.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Transparence</h3>
                        <p class="mt-2 text-sm text-slate-600">Les tarifs sont affiches. Pas de surprise. Vous savez combien coutera l'intervention avant de choisir.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivi en temps reel</h3>
                        <p class="mt-2 text-sm text-slate-600">Suivez l'arrivee du professionnel sur la carte et soyez informe a chaque etape de l'intervention.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-slate-900 text-center">Pourquoi les professionnels nous font confiance</h2>
                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Demandes ciblees</h3>
                        <p class="mt-2 text-sm text-slate-600">Recevez des demandes d'intervention localisees et adaptees a votre zone et vos services.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Liberte d'acceptation</h3>
                        <p class="mt-2 text-sm text-slate-600">Vous restez libre d'accepter ou de refuser les demandes selon votre disponibilite.</p>
                    </div>
                    <div class="card p-8 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Visibilite</h3>
                        <p class="mt-2 text-sm text-slate-600">Votre profil et vos tarifs sont visibles par les clients pour attirer plus de demandes.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-900 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold">Pret a essayer SamaRemorque ?</h2>
                <p class="mt-3 text-slate-300 text-lg">Demandez une assistance maintenant ou inscrivez-vous en tant que professionnel.</p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                    <a href="<?php echo e(route('guest.create')); ?>" class="btn-primary text-base px-6 py-3.5">Demander une assistance</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn-secondary bg-white/10 text-white border-white/20 hover:bg-white/20 text-base px-6 py-3.5">Devenir professionnel</a>
                </div>
            </div>
        </section>
    </main>

    <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\pages\a-propos.blade.php ENDPATH**/ ?>