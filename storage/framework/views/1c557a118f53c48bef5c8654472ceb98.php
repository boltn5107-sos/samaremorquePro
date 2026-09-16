<?php $__env->startSection('title', 'Remorquage Dakar - SamaRemorque | Remorqueur 24/7 a Dakar, Pikine, Rufisque'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['title' => 'Remorquage à Dakar : transport sécurisé vers votre garage','subtitle' => 'Trouvez un remorqueur vérifié à Dakar, Pikine et Rufisque. Suivi en temps réel, tarifs transparents, intervention 24/7.','eyebrow' => 'Remorquage Dakar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Remorquage à Dakar : transport sécurisé vers votre garage','subtitle' => 'Trouvez un remorqueur vérifié à Dakar, Pikine et Rufisque. Suivi en temps réel, tarifs transparents, intervention 24/7.','eyebrow' => 'Remorquage Dakar']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

     <?php $__env->slot('actions', null, []); ?> 
        <a href="<?php echo e(route('guest.create')); ?>" class="landing-cta-primary">Demander un remorquage</a>
        <a href="#services" class="landing-cta-ghost">Voir nos services</a>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9d931d4f11b4d2850df99e991db1dca)): ?>
<?php $attributes = $__attributesOriginala9d931d4f11b4d2850df99e991db1dca; ?>
<?php unset($__attributesOriginala9d931d4f11b4d2850df99e991db1dca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9d931d4f11b4d2850df99e991db1dca)): ?>
<?php $component = $__componentOriginala9d931d4f11b4d2850df99e991db1dca; ?>
<?php unset($__componentOriginala9d931d4f11b4d2850df99e991db1dca); ?>
<?php endif; ?>

<section class="py-20 md:py-28 bg-night-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Pourquoi choisir SamaRemorque pour votre remorquage ?</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['title' => 'Remorqueurs vérifiés', 'desc' => 'Tous les remorqueurs sont validés par notre équipe. Vous consultez leur profil et leur évaluation avant de choisir.'],
                ['title' => 'Transport sécurisé', 'desc' => 'Remorquage sécurisé vers le garage de votre choix. Suivi en temps réel de l\'arrivée du remorqueur.'],
                ['title' => 'Tarifs transparents', 'desc' => 'Les tarifs horaires sont affichés. Pas de surprise, vous connaissez le coût avant de choisir.']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div>
                <span class="font-display text-5xl font-bold text-accent-500/20">0<?php echo e($i + 1); ?></span>
                <h3 class="mt-2 font-display text-xl font-semibold text-night"><?php echo e($item['title']); ?></h3>
                <p class="mt-2 text-slate-600 leading-relaxed"><?php echo e($item['desc']); ?></p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>

<section id="services" class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Nos services de remorquage</h2>
        <p class="mt-3 text-lg text-slate-500 max-w-2xl">Transport sécurisé pour voitures, motos et petits utilitaires à Dakar et sa région.</p>
        <div class="mt-12 divide-y divide-slate-200 border-y border-slate-200">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['title' => 'Remorquage voiture', 'desc' => 'Transport sécurisé de votre voiture vers le garage de votre choix à Dakar et sa région.'],
                ['title' => 'Remorquage moto', 'desc' => 'Remorqueurs équipés pour le transport de motos et scooters en toute sécurité.'],
                ['title' => 'Suivi en temps réel', 'desc' => 'Suivez l\'arrivée du remorqueur sur la carte et soyez informé à chaque étape de l\'intervention.']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="py-8 md:py-10 flex flex-col md:flex-row md:items-baseline gap-3 md:gap-12">
                <span class="font-display text-sm font-semibold text-accent-500 tracking-widest uppercase w-12">0<?php echo e($i + 1); ?></span>
                <h3 class="font-display text-2xl font-semibold text-night md:w-72 shrink-0"><?php echo e($service['title']); ?></h3>
                <p class="text-slate-600 leading-relaxed max-w-xl"><?php echo e($service['desc']); ?></p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <div class="mt-12">
            <a href="<?php echo e(route('guest.create')); ?>" class="landing-cta-primary !inline-flex">Demander un remorquage</a>
        </div>
    </div>
</section>

<section class="landing-cta-band relative py-20 md:py-28 overflow-hidden">
    <div class="relative max-w-3xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white tracking-tight">Besoin d'un remorqueur à Dakar ?</h2>
        <p class="mt-4 text-lg text-white/80">Demandez une assistance maintenant et soyez mis en relation avec un remorqueur disponible près de vous.</p>
        <a href="<?php echo e(route('guest.create')); ?>" class="mt-8 inline-flex items-center justify-center gap-2 bg-white text-night hover:bg-night-100 font-semibold px-8 py-4 rounded-xl text-lg transition-all hover:scale-[1.02]">Demander un remorquage</a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\pages\remorquage-dakar.blade.php ENDPATH**/ ?>