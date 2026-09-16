<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?> - <?php echo e(config('app.name')); ?></title>

    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'SamaRemorque - Plateforme de remorquage et depannage routier au Senegal. Trouvez rapidement un remorqueur ou un depanneur pres de vous a Dakar et partout au Senegal.'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'remorquage Dakar, depannage routier Senegal, remorqueur Dakar, depanneur Senegal, assistance routiere 24/7'); ?>">
    <meta name="author" content="SamaRemorque">
    <meta name="robots" content="<?php echo $__env->yieldContent('robots', 'index, follow'); ?>">
    <meta name="geo.region" content="SN">
    <meta name="geo.placename" content="Dakar">
    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', 'Service de remorquage et depannage routier au Senegal.'); ?>">
    <meta property="og:url" content="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('favicon.jpg')); ?>">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta_description', 'Service de remorquage et depannage routier au Senegal.'); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('favicon.png')); ?>">

    <meta name="theme-color" content="#0c1222">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.jpg">
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
<body class="font-sans antialiased bg-night text-slate-900 landing-page">
    <div id="scroll-progress" aria-hidden="true"></div>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views/layouts/landing.blade.php ENDPATH**/ ?>