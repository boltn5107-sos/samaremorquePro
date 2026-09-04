<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?> - <?php echo e(config('app.name')); ?></title>

    
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'SamaRemorque - Plateforme de remorquage et depannage routier au Senegal. Trouvez rapidement un remorqueur ou un depanneur pres de vous.'); ?>">
    <meta name="keywords" content="remorquage, depannage, remorqueur, depanneur, panne, vehicule, Senegal, Dakar, assistance routiere, remorque voiture">
    <meta name="author" content="SamaRemorque">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', 'Service de remorquage et depannage routier au Senegal. Trouvez un remorqueur ou depanneur proche de vous.'); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('favicon.png')); ?>">
    <meta property="og:locale" content="fr_SN">

    
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta_description', 'Service de remorquage et depannage routier au Senegal.'); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('favicon.png')); ?>">

    
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div id="app">
        <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded">
                        <?php echo e(session('status')); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views/layouts/app.blade.php ENDPATH**/ ?>