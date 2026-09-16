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
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    <?php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = 'build/' . ($manifest['resources/css/app.css']['file'] ?? 'app.css');
        $jsFile = 'build/' . ($manifest['resources/js/app.js']['file'] ?? 'app.js');
    ?>
    <link rel="stylesheet" href="<?php echo e(asset($cssFile)); ?>">
    <script defer src="<?php echo e(asset($jsFile)); ?>"></script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="font-sans antialiased bg-night-50 text-slate-900">
    <div id="app" class="min-h-screen flex flex-col">
        <?php if (! empty(trim($__env->yieldContent('hide_nav')))): ?>
        <?php else: ?>
            <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <main id="main-content" class="flex-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <?php echo e(session('status')); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        <?php echo e(session('error')); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php if (! empty(trim($__env->yieldContent('hide_footer')))): ?>
        <?php else: ?>
            <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        window.Laravel = {
            csrfToken: '<?php echo e(csrf_token()); ?>',
            userId: <?php echo e(auth()->id() ?? 'null'); ?>,
            userRole: '<?php echo e(auth()->user()?->role ?? "guest"); ?>',
            pusherKey: '<?php echo e(config("broadcasting.connections.reverb.key")); ?>',
            pusherCluster: '<?php echo e(config("broadcasting.connections.pusher.options.cluster")); ?>',
        };
    </script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
        <script>
            (function () {
                const badge = document.getElementById('unread-badge');
                if (!badge) return;
                function refresh() {
                    fetch('<?php echo e(route('notifications.unread-count')); ?>', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(r => r.json())
                        .then(data => {
                            const n = data.unread;
                            if (n > 0) {
                                badge.textContent = n > 99 ? '99+' : n;
                                badge.classList.remove('hidden');
                            } else {
                                badge.classList.add('hidden');
                            }
                        })
                        .catch(() => {});
                }
                setInterval(refresh, 15000);
            })();
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>