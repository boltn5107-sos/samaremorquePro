<?php $__env->startSection('title', 'SamaRemorque'); ?>
<?php $__env->startSection('content'); ?>

<nav id="landing-nav" class="landing-nav fixed top-0 inset-x-0 z-50 text-white no-print">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 md:h-20 items-center">
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2.5 group">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/15 overflow-hidden ring-1 ring-white/20 transition-transform duration-500 group-hover:scale-105">
                    <img src="<?php echo e(asset('favicon.jpg')); ?>" alt="SamaRemorque" class="w-7 h-7 object-contain">
                </span>
                <span class="font-display text-lg font-bold tracking-tight"><?php echo e(config('app.name')); ?></span>
            </a>

            <div class="hidden md:flex items-center gap-1 text-sm font-medium">
                <a href="#fonctionnement" class="px-3 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300">Comment ça marche</a>
                <a href="#services" class="px-3 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300">Services</a>
                <a href="#professionnels" class="px-3 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300">Professionnels</a>
                <a href="#contact" class="px-3 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300">Contact</a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('profile.edit')); ?>" class="ml-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Profil</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="px-3 py-2 rounded-lg text-red-300 hover:bg-white/10 transition-all">Déconnexion</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="ml-2 px-3 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all">Connexion</a>
                    <a href="<?php echo e(route('register')); ?>" class="ml-1 inline-flex items-center bg-accent-500 hover:bg-accent-600 px-4 py-2 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-accent-500/30 active:scale-95">Inscription</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <button id="landing-menu-toggle" class="md:hidden inline-flex items-center justify-center p-2 rounded-lg hover:bg-white/10 transition-all" aria-label="Menu" aria-expanded="false">
                <svg class="w-6 h-6" id="landing-icon-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                <svg class="w-6 h-6 hidden" id="landing-icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    <div id="landing-menu" class="md:hidden max-h-0 overflow-hidden opacity-0 transition-all duration-400 border-t border-white/0 bg-night/95 backdrop-blur-xl">
        <div class="px-4 py-3 space-y-1 text-sm font-medium">
            <a href="#fonctionnement" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 transition-all">Comment ça marche</a>
            <a href="#services" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 transition-all">Services</a>
            <a href="#professionnels" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 transition-all">Professionnels</a>
            <a href="#contact" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 transition-all">Contact</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button type="submit" class="block w-full text-left px-3 py-2.5 rounded-lg hover:bg-white/10 text-red-300">Déconnexion</button></form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 transition-all">Connexion</a>
                <a href="<?php echo e(route('register')); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 text-accent-400 transition-all">Inscription</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav>


<header class="relative min-h-[100svh] flex items-end md:items-center overflow-hidden bg-night">
    <div class="absolute inset-0">
        <img
            src="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>"
            alt="Remorquage de véhicule au Sénégal"
            class="landing-hero-media w-full h-full object-cover scale-105"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-night via-night/70 to-night/30"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-night/90 via-night/50 to-transparent"></div>
        <div class="absolute inset-0 landing-hero-grain" aria-hidden="true"></div>
    </div>

    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-28 md:py-32">
        <p class="font-display text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold tracking-tight text-white leading-[0.95] hero-anim hero-anim-1">
            Sama<span class="text-accent-400">Remorque</span>
        </p>
        <h1 class="mt-5 max-w-xl text-lg sm:text-xl md:text-2xl font-medium text-white/90 leading-snug hero-anim hero-anim-2">
            Un remorqueur ou dépanneur près de vous, en quelques clics.
        </h1>
        <p class="mt-4 max-w-md text-base text-white/65 leading-relaxed hero-anim hero-anim-3">
            Assistance routière 24/7 à Dakar, Pikine, Rufisque, Saint-Louis et Thiès.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row gap-3 hero-anim hero-anim-4">
            <a href="<?php echo e(route('guest.create')); ?>" class="landing-cta-primary group">
                Demander une assistance
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
            <a href="#suivi" class="landing-cta-ghost">
                Suivre ma demande
            </a>
        </div>
    </div>

    <a href="#fonctionnement" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/40 hover:text-white/70 transition-colors hero-anim hero-anim-5" aria-label="Défiler">
        <span class="landing-scroll-cue flex flex-col items-center gap-2">
            <span class="w-px h-8 bg-gradient-to-b from-transparent via-white/50 to-white/80"></span>
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
        </span>
    </a>
</header>


<section id="fonctionnement" class="relative py-24 md:py-32 bg-night-50 overflow-hidden">
    <div class="absolute inset-0 landing-asphalt opacity-40" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl reveal">
            <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight">Comment ça marche</h2>
            <p class="mt-4 text-lg text-slate-600">Trois étapes pour retrouver la route.</p>
        </div>

        <ol class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['title' => 'Signalez votre panne', 'desc' => 'Position GPS, type de panne et photo — en moins d\'une minute.'],
                ['title' => 'Choisissez le pro', 'desc' => 'Remorqueur ou dépanneur proche, profil et tarifs affichés.'],
                ['title' => 'Suivez en direct', 'desc' => 'Position sur la carte et mises à jour jusqu\'à l\'arrivée.']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <li class="reveal reveal-delay-<?php echo e($index + 1); ?> relative">
                <span class="font-display text-6xl md:text-7xl font-bold text-accent-500/15 leading-none select-none">0<?php echo e($index + 1); ?></span>
                <h3 class="mt-2 font-display text-xl font-semibold text-night"><?php echo e($step['title']); ?></h3>
                <p class="mt-2 text-slate-600 leading-relaxed"><?php echo e($step['desc']); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index < 2): ?>
                    <div class="hidden md:block absolute top-8 -right-4 w-8 h-px bg-gradient-to-r from-accent-400/60 to-transparent" aria-hidden="true"></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </ol>
    </div>
</section>


<section id="suivi" class="relative py-20 md:py-28 bg-night text-white overflow-hidden">
    <div class="absolute inset-0 landing-mesh opacity-60" aria-hidden="true"></div>
    <div class="relative max-w-2xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold reveal">Déjà une demande en cours ?</h2>
        <p class="mt-4 text-white/60 text-lg reveal reveal-delay-1">Entrez votre code de suivi pour voir l'état et la position du professionnel.</p>
        <form action="#" onsubmit="event.preventDefault(); var c = document.getElementById('tracking-input').value.trim(); if (c) location.href = '/suivi/' + encodeURIComponent(c);" class="mt-10 flex flex-col sm:flex-row gap-3 reveal reveal-delay-2">
            <input type="text" id="tracking-input" placeholder="Ex : SR-AB12CD" autocomplete="off"
                   class="flex-1 rounded-xl border border-white/15 bg-white/8 px-4 py-3.5 text-center sm:text-left uppercase tracking-widest text-white placeholder-white/35 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all duration-300">
            <button type="submit" class="landing-cta-primary whitespace-nowrap !bg-white !text-night hover:!bg-night-100">
                Suivre
            </button>
        </form>
    </div>
</section>


<section id="services" class="relative py-24 md:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl reveal">
            <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight">Nos interventions</h2>
            <p class="mt-4 text-lg text-slate-600">Depannage sur place, remorquage sécurisé, suivi GPS.</p>
        </div>

        <div class="mt-14 divide-y divide-slate-200 border-y border-slate-200">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['title' => 'Dépannage sur place', 'desc' => 'Batterie à plat, crevaison, panne légère : intervention directement sur votre position.'],
                ['title' => 'Remorquage de véhicule', 'desc' => 'Transport vers le garage de votre choix. Voitures, motos et petits utilitaires.'],
                ['title' => 'Suivi en temps réel', 'desc' => 'Carte live et notifications à chaque étape de l\'intervention.']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="group py-8 md:py-10 flex flex-col md:flex-row md:items-baseline gap-3 md:gap-12 reveal reveal-delay-<?php echo e($index + 1); ?>">
                <span class="font-display text-sm font-semibold text-accent-500 tracking-widest uppercase shrink-0 w-12">0<?php echo e($index + 1); ?></span>
                <h3 class="font-display text-2xl md:text-3xl font-semibold text-night group-hover:text-accent-600 transition-colors duration-300 md:w-80 shrink-0"><?php echo e($service['title']); ?></h3>
                <p class="text-slate-600 leading-relaxed max-w-xl"><?php echo e($service['desc']); ?></p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div class="mt-12 reveal">
            <a href="<?php echo e(route('guest.create')); ?>" class="landing-cta-primary !inline-flex">Demander une assistance</a>
        </div>
    </div>
</section>


<section id="zones" class="relative py-20 md:py-28 bg-night-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl reveal">
            <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight">Zones couvertes</h2>
            <p class="mt-4 text-lg text-slate-600">Disponible dans les principales villes du Sénégal.</p>
        </div>
        <div class="mt-12 flex flex-wrap gap-3 reveal reveal-delay-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['Dakar', 'Pikine', 'Rufisque', 'Saint-Louis', 'Thiès']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ville): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <a href="<?php echo e(route('guest.create')); ?>" class="landing-zone-chip"><?php echo e($ville); ?></a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>


<section id="avantages" class="relative py-24 md:py-32 bg-night text-white overflow-hidden">
    <div class="absolute inset-0 landing-mesh opacity-40" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="reveal order-2 lg:order-1">
                <h2 class="font-display text-3xl md:text-5xl font-bold tracking-tight leading-tight">Des pros vérifiés, près de vous</h2>
                <p class="mt-5 text-lg text-white/65 leading-relaxed">Remorqueurs et dépanneurs validés, tarifs affichés, suivi GPS — à Dakar et dans les grandes villes.</p>
                <ul class="mt-10 space-y-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                        'Professionnels validés et notés',
                        'Tarifs visibles avant de choisir',
                        'Localisation et suivi en direct'
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="flex items-start gap-3 text-white/85">
                        <span class="mt-1 flex-shrink-0 w-5 h-5 rounded-full bg-accent-500/20 text-accent-400 flex items-center justify-center">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        <?php echo e($item); ?>

                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
                <a href="<?php echo e(route('guest.create')); ?>" class="landing-cta-primary mt-10 !inline-flex">Demander une assistance</a>
            </div>
            <div class="reveal reveal-delay-2 order-1 lg:order-2">
                <div class="landing-media-frame">
                    <img src="<?php echo e(asset('images/depanneur_en_action.jpg')); ?>" alt="Dépanneur en intervention au Sénégal" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>


<section id="client" class="relative py-24 md:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="reveal">
                <div class="landing-media-frame landing-media-frame--light">
                    <img src="<?php echo e(asset('images/Une_cliente_qui_utilise_l_application.jpg')); ?>" alt="Client utilisant SamaRemorque" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="reveal reveal-delay-2">
                <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight leading-tight">Simple. Accessible. Immédiat.</h2>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed">Pas d'installation compliquée : SamaRemorque fonctionne dans votre navigateur, même hors ligne en PWA.</p>
                <ul class="mt-8 space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                        'GPS automatique pour trouver les pros proches',
                        'Suivi live du remorqueur ou dépanneur',
                        'Tarifs horaires affichés clairement'
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="flex items-start gap-3 text-slate-700">
                        <span class="mt-0.5 flex-shrink-0 w-5 h-5 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        <?php echo e($item); ?>

                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>


<section id="avis" class="relative py-24 md:py-32 bg-night-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl reveal">
            <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight">Ils nous font confiance</h2>
            <p class="mt-4 text-lg text-slate-600">Conducteurs et professionnels au Sénégal.</p>
        </div>
        <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['text' => 'Panne sur la nationale, dépanneur trouvé en 5 minutes. Intervention rapide et prix annoncés.', 'author' => 'Aminata', 'location' => 'Dakar'],
                ['text' => 'En tant que remorqueur, je reçois des demandes claires et locales. J\'accepte selon mon planning.', 'author' => 'Mor Cissé', 'location' => 'Dakar'],
                ['text' => 'Suivi en temps réel, pas de surprise sur le tarif. Je recommande pour Dakar et Pikine.', 'author' => 'Ousmane', 'location' => 'Pikine']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <blockquote class="reveal reveal-delay-<?php echo e($index + 1); ?>">
                <p class="font-display text-xl md:text-2xl font-medium text-night leading-snug">« <?php echo e($review['text']); ?> »</p>
                <footer class="mt-6 text-sm text-slate-500">
                    <span class="font-semibold text-night"><?php echo e($review['author']); ?></span> — <?php echo e($review['location']); ?>

                </footer>
            </blockquote>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>


<section id="professionnels" class="relative py-24 md:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="reveal">
                <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight leading-tight">Remorqueur ou dépanneur ?</h2>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed">Rejoignez SamaRemorque et recevez des demandes ciblées près de vous — vous décidez d'accepter ou non.</p>
                <ul class="mt-8 space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                        'Demandes ciblées selon votre zone',
                        'Liberté d\'accepter ou de refuser',
                        'Profil et tarifs visibles par les clients'
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="flex items-start gap-3 text-slate-700">
                        <span class="mt-0.5 flex-shrink-0 w-5 h-5 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        <?php echo e($item); ?>

                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
                <a href="<?php echo e(route('register')); ?>" class="landing-cta-primary mt-10 !inline-flex">Devenir professionnel</a>
            </div>
            <div class="reveal reveal-delay-2">
                <div class="landing-media-frame landing-media-frame--light">
                    <img src="<?php echo e(asset('images/clients_qui_utilise_l_application3.jpg')); ?>" alt="Professionnels SamaRemorque" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>


<section id="faq" class="relative py-24 md:py-32 bg-night-50 overflow-hidden">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal">
            <h2 class="font-display text-3xl md:text-5xl font-bold text-night tracking-tight">Questions fréquentes</h2>
            <p class="mt-4 text-lg text-slate-600">Avant d'envoyer une demande d'assistance.</p>
        </div>
        <div class="mt-12 space-y-2" id="faq-list">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['q' => 'Comment fonctionne SamaRemorque ?', 'a' => 'Vous saisissez votre position, le type de panne et votre numéro. Nous vous proposons les remorqueurs et dépanneurs disponibles près de vous.'],
                ['q' => 'Dans quelles zones intervenez-vous ?', 'a' => 'Principalement Dakar et sa région, ainsi que Saint-Louis et Thiès. D\'autres zones s\'ajoutent régulièrement.'],
                ['q' => 'Faut-il créer un compte ?', 'a' => 'Non. Vous pouvez envoyer une demande sans compte et suivre l\'intervention avec un code de suivi.'],
                ['q' => 'Quels types de pannes sont pris en charge ?', 'a' => 'Remorquage, dépannage sur place, crevaison, batterie à plat, panne moteur et immobilisation générale.'],
                ['q' => 'Comment sont sélectionnés les professionnels ?', 'a' => 'Tous les remorqueurs et dépanneurs sont validés par l\'équipe SamaRemorque, avec profil et évaluations.']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="faq-item reveal reveal-delay-<?php echo e(($index % 3) + 1); ?>" data-faq>
                <button type="button" class="faq-trigger w-full flex items-center justify-between gap-4 py-5 text-left group" aria-expanded="false">
                    <span class="font-display text-lg md:text-xl font-semibold text-night group-hover:text-accent-600 transition-colors"><?php echo e($faq['q']); ?></span>
                    <span class="faq-icon flex-shrink-0 w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-night transition-transform duration-400">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                    </span>
                </button>
                <div class="faq-panel overflow-hidden max-h-0 opacity-0 transition-all duration-400 ease-out">
                    <p class="pb-5 pr-12 text-slate-600 leading-relaxed"><?php echo e($faq['a']); ?></p>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>


<section class="relative py-16 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-xl font-semibold text-night reveal">Services par ville</h2>
        <div class="mt-6 flex flex-wrap gap-x-6 gap-y-3 text-sm reveal reveal-delay-1">
            <a href="<?php echo e(route('seo.depannage-dakar')); ?>" class="text-slate-600 hover:text-accent-600 transition-colors">Dépannage Dakar</a>
            <a href="<?php echo e(route('seo.remorquage-dakar')); ?>" class="text-slate-600 hover:text-accent-600 transition-colors">Remorquage Dakar</a>
            <a href="<?php echo e(route('seo.depannage-urgence-dakar')); ?>" class="text-slate-600 hover:text-accent-600 transition-colors">Dépannage urgence</a>
            <a href="<?php echo e(route('seo.depanneur-dakar')); ?>" class="text-slate-600 hover:text-accent-600 transition-colors">Dépanneur Dakar</a>
            <a href="<?php echo e(route('seo.remorquage-senegal')); ?>" class="text-slate-600 hover:text-accent-600 transition-colors">Remorquage Sénégal</a>
            <a href="<?php echo e(route('guest.create')); ?>" class="text-accent-600 font-semibold hover:text-accent-700 transition-colors">Demander assistance →</a>
        </div>
    </div>
</section>


<section class="relative py-24 md:py-32 overflow-hidden landing-cta-band">
    <div class="absolute inset-0 landing-cta-glow" aria-hidden="true"></div>
    <div class="relative max-w-3xl mx-auto px-4 sm:px-6 text-center reveal">
        <h2 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight">En panne maintenant ?</h2>
        <p class="mt-4 text-lg text-white/80">Trouvez un remorqueur ou dépanneur en quelques clics.</p>
        <a href="<?php echo e(route('guest.create')); ?>" class="mt-10 inline-flex items-center justify-center gap-2 bg-white text-night hover:bg-night-100 font-semibold px-8 py-4 rounded-xl text-lg transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] shadow-xl shadow-black/20">
            Demander une assistance
        </a>
    </div>
</section>


<footer id="contact" class="relative bg-night text-slate-400 overflow-hidden no-print">
    <div class="absolute inset-0 landing-asphalt opacity-20" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/10 overflow-hidden">
                        <img src="<?php echo e(asset('favicon.jpg')); ?>" alt="SamaRemorque" class="w-6 h-6 object-contain">
                    </span>
                    <span class="font-display text-white font-bold text-lg">SamaRemorque</span>
                </div>
                <p class="text-sm leading-relaxed">Mise en relation entre conducteurs et remorqueurs/dépanneurs vérifiés. Assistance 24/7 au Sénégal.</p>
            </div>
            <div>
                <h4 class="font-display text-white font-semibold mb-4">Contact</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="tel:+221774467596" class="hover:text-accent-400 transition-colors">77 446 75 96</a></li>
                    <li><a href="tel:+221708981888" class="hover:text-accent-400 transition-colors">70 898 18 88</a></li>
                    <li>
                        <a href="https://wa.me/221774467596" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-medium px-4 py-2 rounded-lg transition-all text-sm">WhatsApp</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="font-display text-white font-semibold mb-4">Services</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="<?php echo e(route('guest.create')); ?>" class="hover:text-accent-400 transition-colors">Demander une assistance</a></li>
                    <li><a href="#suivi" class="hover:text-accent-400 transition-colors">Suivre une demande</a></li>
                    <li><a href="<?php echo e(route('seo.depannage-dakar')); ?>" class="hover:text-accent-400 transition-colors">Dépannage Dakar</a></li>
                    <li><a href="<?php echo e(route('seo.remorquage-dakar')); ?>" class="hover:text-accent-400 transition-colors">Remorquage Dakar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-display text-white font-semibold mb-4">Ressources</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="<?php echo e(route('about')); ?>" class="hover:text-accent-400 transition-colors">À propos</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>" class="hover:text-accent-400 transition-colors">Contact</a></li>
                    <li><a href="<?php echo e(route('privacy')); ?>" class="hover:text-accent-400 transition-colors">Confidentialité</a></li>
                    <li><a href="<?php echo e(route('seo.guide-depannage-dakar')); ?>" class="hover:text-accent-400 transition-colors">Guide dépannage</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-white/10 text-center text-sm">
            <p>&copy; <?php echo e(date('Y')); ?> <span class="text-accent-400 font-semibold">SamaRemorque</span>. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.documentElement.classList.add('js-anim');
    const nav = document.getElementById('landing-nav');
    const toggle = document.getElementById('landing-menu-toggle');
    const menu = document.getElementById('landing-menu');
    const iconOpen = document.getElementById('landing-icon-open');
    const iconClose = document.getElementById('landing-icon-close');
    const progress = document.getElementById('scroll-progress');

    // Mobile menu
    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            const open = menu.classList.contains('is-open');
            if (open) {
                menu.classList.remove('is-open');
                menu.style.maxHeight = '0';
                menu.style.opacity = '0';
                menu.style.borderColor = 'transparent';
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                menu.classList.add('is-open');
                menu.style.maxHeight = menu.scrollHeight + 'px';
                menu.style.opacity = '1';
                menu.style.borderColor = 'rgba(255,255,255,0.1)';
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'true');
            }
        });
        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('is-open');
                menu.style.maxHeight = '0px';
                menu.style.opacity = '0';
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            });
        });
    }

    // Nav + scroll progress
    function onScroll() {
        if (nav) nav.classList.toggle('is-scrolled', window.scrollY > 40);
        if (progress) {
            const doc = document.documentElement;
            const max = doc.scrollHeight - doc.clientHeight;
            progress.style.width = max > 0 ? ((doc.scrollTop / max) * 100) + '%' : '0%';
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Smooth anchors
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const id = this.getAttribute('href');
            if (!id || id === '#') return;
            const target = document.querySelector(id);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('visible'); });
    }

    // FAQ accordion
    document.querySelectorAll('[data-faq]').forEach(function (item) {
        const btn = item.querySelector('.faq-trigger');
        const panel = item.querySelector('.faq-panel');
        const icon = item.querySelector('.faq-icon');
        if (!btn || !panel) return;
        btn.addEventListener('click', function () {
            const open = item.classList.contains('is-open');
            document.querySelectorAll('[data-faq].is-open').forEach(function (other) {
                if (other === item) return;
                other.classList.remove('is-open');
                other.querySelector('.faq-trigger').setAttribute('aria-expanded', 'false');
                other.querySelector('.faq-panel').style.maxHeight = '0px';
                other.querySelector('.faq-panel').style.opacity = '0';
                const oi = other.querySelector('.faq-icon');
                if (oi) oi.style.transform = '';
            });
            if (open) {
                item.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
                panel.style.maxHeight = '0px';
                panel.style.opacity = '0';
                if (icon) icon.style.transform = '';
            } else {
                item.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
                panel.style.maxHeight = panel.scrollHeight + 'px';
                panel.style.opacity = '1';
                if (icon) icon.style.transform = 'rotate(45deg)';
            }
        });
    });

    // Subtle parallax on hero image
    const heroMedia = document.querySelector('.landing-hero-media');
    if (heroMedia && window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
        window.addEventListener('scroll', function () {
            const y = Math.min(window.scrollY, 600);
            heroMedia.style.transform = 'scale(1.05) translateY(' + (y * 0.18) + 'px)';
        }, { passive: true });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\landing.blade.php ENDPATH**/ ?>