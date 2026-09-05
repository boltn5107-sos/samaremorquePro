<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialite - SamaRemorque</title>
    <meta name="description" content="Politique de confidentialite de SamaRemorque : quelles donnees sont collectees (position, photo, telephone), comment elles sont utilisees et protegees, et vos droits.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('favicon.png')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased bg-white text-slate-900">

    <nav class="bg-slate-900 text-white sticky top-0 z-40 shadow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between h-16 items-center">
                <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2 text-lg font-bold tracking-tight">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white overflow-hidden">
                        <img src="<?php echo e(asset('favicon.png')); ?>" alt="SamaRemorque" class="w-7 h-7 object-contain">
                    </span>
                    <span>SamaRemorque</span>
                </a>
                <a href="<?php echo e(url('/')); ?>" class="text-sm font-medium text-slate-300 hover:text-white">Retour a l'accueil</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
        <h1 class="text-3xl font-bold text-slate-900">Politique de confidentialite</h1>
        <p class="mt-2 text-sm text-slate-500">Derniere mise a jour : <?php echo e(now()->translatedFormat('d F Y')); ?>.</p>

        <div class="mt-8 space-y-2 text-sm text-slate-600 leading-relaxed">
            <p>
                SamaRemorque met en relation des conducteurs en panne avec des remorqueurs et depanneurs au Senegal.
                Cette politique explique quelles donnees sont collectees, pourquoi, et comment elles sont protegees.
                Vous conservez a tout moment le controle de vos donnees.
            </p>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">1. Donnees collectees</h2>
        <div class="mt-4 space-y-4 text-sm text-slate-600 leading-relaxed">
            <p>Selon votre utilisation (demande sans compte ou compte cree), nous pouvons collecter :</p>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Position GPS :</strong> uniquement lorsque vous envoyez une demande d'assistance, pour trouver les professionnels proches et pour vous localiser sur la carte.</li>
                <li><strong>Telephone et prenom :</strong> pour permettre au remorqueur ou depanneur de vous contacter (appel ou WhatsApp).</li>
                <li><strong>Photo de la panne :</strong> optionnelle, pour aider le professionnel a preparer son intervention.</li>
                <li><strong>Adresse et destination :</strong> pour situer votre panne et connaitre la destination du remorquage.</li>
                <li><strong>Donnees de compte :</strong> nom, email et mot de passe, si vous creez un compte pour conserver votre historique.</li>
                <li><strong>Code de suivi :</strong> un code unique genere automatiquement pour suivre votre intervention sans compte.</li>
            </ul>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">2. Mode de collecte et consentement</h2>
        <div class="mt-4 space-y-4 text-sm text-slate-600 leading-relaxed">
            <p>
                Nous ne collectons <strong>aucune donnee</strong> sans une action explicite de votre part. En particulier :
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Votre position n'est utilisee que lorsque vous cliquez sur <strong>"Actualiser"</strong> ou lorsque vous envoyez une demande.</li>
                <li>La camera n'est ouverte que lorsque vous choisissez d'ajouter une photo.</li>
                <li>Les notifications ne sont proposees qu'avec votre accord explicite.</li>
                <li>L'installation de l'application (PWA) sur votre appareil n'est proposee qu'apres votre consentement et reste a tout moment desinstallable.</li>
            </ul>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">3. Utilisation des donnees</h2>
        <div class="mt-4 space-y-2 text-sm text-slate-600 leading-relaxed">
            <ul class="list-disc pl-5 space-y-2">
                <li>La position permet de trouver le remorqueur ou depanneur le plus proche et de suivre son arrivee.</li>
                <li>Le telephone permet au professionnel assigne de vous joindre pendant l'intervention.</li>
                <li>La photo et la description de la panne sont transmises au professionnel pour preparer son intervention.</li>
                <li>Les notes et commentaires permettent d'afficher la reputation des professionnels.</li>
                <li>Aucune donnee n'est utilisee a des fins publicitaires ni revendue a des tiers.</li>
            </ul>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">4. Partage des donnees</h2>
        <div class="mt-4 space-y-2 text-sm text-slate-600 leading-relaxed">
            <ul class="list-disc pl-5 space-y-2">
                <li>Vos donnees d'intervention (position, photo, telephone, description) sont partagees uniquement avec le professionnel qui prend en charge votre demande.</li>
                <li>Les services de geolocalisation (OpenStreetMap / Nominatim) recoivent votre adresse uniquement pour la transformer en coordonnees, sans identifiant personnel.</li>
                <li>Nous ne partageons jamais vos donnees avec d'autres tiers, sauf obligation legale.</li>
            </ul>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">5. Conservation des donnees</h2>
        <div class="mt-4 space-y-2 text-sm text-slate-600 leading-relaxed">
            <p>Les donnees d'une intervention sont conservees aussi longtemps que necessaire au bon fonctionnement du service (historique, repartition des professionnels) et, pour les notes, tant qu'elles contribuent a la transparence des professionnels. Vous pouvez demander la suppression de vos donnees a tout moment (voir section 7).</p>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">6. Securite</h2>
        <div class="mt-4 space-y-2 text-sm text-slate-600 leading-relaxed">
            <p>Les mots de passe sont haches. Les acces sont proteges et seuls les professionnels assignes a une intervention peuvent voir les donnees necessaires. Les photos sont stockees sur des serveurs securises.</p>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">7. Vos droits</h2>
        <div class="mt-4 space-y-2 text-sm text-slate-600 leading-relaxed">
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Acces :</strong> vous pouvez consulter les donnees vous concernant depuis votre espace.</li>
                <li><strong>Rectification :</strong> vous pouvez corriger vos informations de profil a tout moment.</li>
                <li><strong>Suppression :</strong> vous pouvez demander la suppression de votre compte et de vos donnees.</li>
                <li><strong>Opposition :</strong> vous pouvez refuser le partage de votre position en utilisant la saisie manuelle.</li>
            </ul>
        </div>

        <h2 class="mt-10 text-xl font-semibold text-slate-900">8. Contact</h2>
        <div class="mt-4 text-sm text-slate-600 leading-relaxed">
            <p>Pour toute question relative a vos donnees personnelles, contactez-nous :</p>
            <p class="mt-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <a href="tel:+221774467596" class="hover:text-orange-600 font-medium">77 446 75 96</a>
            </p>
        </div>

        <div class="mt-10 pt-6 border-t border-slate-200 text-sm text-center text-slate-500">
            &copy; <?php echo e(date('Y')); ?> SamaRemorque. Tous droits reserves.
            <a href="<?php echo e(url('/')); ?>" class="ml-2 text-orange-600 hover:text-orange-700">Retour a l'accueil</a>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views/pages/confidentialite.blade.php ENDPATH**/ ?>