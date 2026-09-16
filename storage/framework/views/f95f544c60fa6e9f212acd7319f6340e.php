<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Connexion'); ?> - <?php echo e(config('app.name')); ?></title>
    <meta name="description" content="Connectez-vous a SamaRemorque - Plateforme de remorquage et depannage routier au Senegal.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <meta name="theme-color" content="#0c1222">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.jpg')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('favicon.jpg')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <?php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = 'build/' . ($manifest['resources/css/app.css']['file'] ?? 'app.css');
        $jsFile = 'build/' . ($manifest['resources/js/app.js']['file'] ?? 'app.js');
    ?>
    <link rel="stylesheet" href="<?php echo e(asset($cssFile)); ?>">
    <script defer src="<?php echo e(asset($jsFile)); ?>"></script>
</head>
<body class="font-sans antialiased bg-night min-h-screen">
    <div class="absolute inset-0 landing-asphalt opacity-30" aria-hidden="true"></div>
    <div class="absolute inset-0 landing-mesh opacity-70" aria-hidden="true"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 0%, rgba(249,115,22,0.06) 0%, transparent 60%);" aria-hidden="true"></div>

    <div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md animate-fade-in">
            <a href="<?php echo e(url('/')); ?>" class="flex flex-col items-center group">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-xl ring-1 ring-white/15 overflow-hidden shadow-xl transition-all duration-300 group-hover:scale-105 group-hover:shadow-2xl">
                    <img src="<?php echo e(asset('favicon.jpg')); ?>" alt="<?php echo e(config('app.name')); ?>" class="w-12 h-12 object-contain">
                </span>
                <h1 class="mt-5 font-display text-center text-3xl font-bold text-white tracking-tight">
                    Sama<span class="text-accent-400">Remorque</span>
                </h1>
                <p class="mt-1.5 text-center text-sm text-white/40 font-medium tracking-wide">
                    Remorquage &amp; depannage au Senegal
                </p>
            </a>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-slide-up" style="animation-delay: 0.12s;">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/30 border border-white/10 py-8 px-5 sm:px-10 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 via-orange-400 to-amber-400 opacity-80"></div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <p class="mt-6 text-center text-xs text-white/30">
                <a href="<?php echo e(url('/')); ?>" class="hover:text-accent-400 transition-colors duration-200 inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Retour a l'accueil
                </a>
            </p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\layouts\guest.blade.php ENDPATH**/ ?>