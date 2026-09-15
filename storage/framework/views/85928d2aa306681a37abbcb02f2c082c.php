<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?> - <?php echo e(config('app.name')); ?></title>

    
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'SamaRemorque - Plateforme de remorquage et depannage routier au Senegal. Trouvez rapidement un remorqueur ou un depanneur pres de vous a Dakar et partout au Senegal.'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'remorquage Dakar, depannage routier Senegal, remorqueur Dakar, depanneur Senegal, assistance routiere 24/7, remorque voiture, depannage voiture, remorquage pas cher, depannage urgent, Dakar, Pikine, Rufisque, Saint-Louis, Thiès'); ?>">
    <meta name="author" content="SamaRemorque">
    <meta name="robots" content="<?php echo $__env->yieldContent('robots', 'index, follow'); ?>">
    <meta name="geo.region" content="SN">
    <meta name="geo.placename" content="Dakar">
    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', 'Service de remorquage et depannage routier au Senegal. Trouvez un remorqueur ou depanneur proche de vous.'); ?>">
    <meta property="og:url" content="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('favicon.jpg')); ?>">
    <meta property="og:locale" content="fr_SN">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta_description', 'Service de remorquage et depannage routier au Senegal.'); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('favicon.png')); ?>">

    

    
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
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
  "description": "Plateforme de remorquage et depannage routier au Senegal",
  "url": "https://samaremorquepro.onrender.com",
  "telephone": "+221774467596",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Dakar",
    "addressCountry": "SN"
  },
  "openingHours": "Mo-Su 00:00-23:59",
  "areaServed": [
    "Dakar",
    "Pikine",
    "Rufisque",
    "Saint-Louis",
    "Thiès"
  ]
}
</script>
<meta name="google-site-verification" content="5RZr_MjxvRBL_yoqOzX9gERC8ey1btQ61t2Og1WhVKY" />
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        <?php echo e(session('error')); ?>

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

    <script>
    (function () {
        if (!navigator.geolocation) return;
        if (sessionStorage.getItem('sr-gps-prompted')) return;

        navigator.geolocation.getCurrentPosition(
            function () { sessionStorage.setItem('sr-gps-asked', '1'); },
            function () {
                if (sessionStorage.getItem('sr-gps-asked')) return;
                if (document.getElementById('sr-gps-banner')) return;

                var banner = document.createElement('div');
                banner.id = 'sr-gps-banner';
                banner.className = 'fixed top-16 inset-x-0 z-50 p-3 sm:p-4';
                banner.style.paddingTop = 'env(safe-area-inset-top)';
                banner.innerHTML =
                    '<div class="max-w-lg mx-auto bg-orange-600 text-white rounded-2xl shadow-2xl p-4 flex items-center gap-3">' +
                        '<svg class="w-8 h-8 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/></svg>' +
                        '<div class="flex-1">' +
                            '<p class="font-semibold text-sm">Activez votre GPS</p>' +
                            '<p class="text-xs text-orange-100 mt-0.5">La localisation est necessaire pour trouver les professionnels pres de vous.</p>' +
                        '</div>' +
                        '<button id="sr-gps-activate" class="bg-white text-orange-700 text-xs font-bold px-3 py-2 rounded-lg whitespace-nowrap hover:bg-orange-50">Activer</button>' +
                        '<button id="sr-gps-dismiss" class="text-orange-200 hover:text-white p-1" aria-label="Fermer">' +
                            '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>' +
                        '</button>' +
                    '</div>';

                document.body.appendChild(banner);

                document.getElementById('sr-gps-activate').addEventListener('click', function () {
                    navigator.geolocation.getCurrentPosition(
                        function () { banner.remove(); sessionStorage.setItem('sr-gps-asked', '1'); },
                        function () { banner.remove(); sessionStorage.setItem('sr-gps-prompted', '1'); }
                    );
                });

                document.getElementById('sr-gps-dismiss').addEventListener('click', function () {
                    banner.remove();
                    sessionStorage.setItem('sr-gps-prompted', '1');
                });

                sessionStorage.setItem('sr-gps-prompted', '1');
            },
            { enableHighAccuracy: false, timeout: 5000, maximumAge: 60000 }
        );
    })();
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\layouts\app.blade.php ENDPATH**/ ?>