<?php $__env->startSection('title', 'À propos'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['title' => 'À propos de SamaRemorque','subtitle' => 'Une plateforme sénégalaise conçue pour rendre l\'assistance routière plus simple et plus transparente.','eyebrow' => 'Notre histoire']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'À propos de SamaRemorque','subtitle' => 'Une plateforme sénégalaise conçue pour rendre l\'assistance routière plus simple et plus transparente.','eyebrow' => 'Notre histoire']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

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

<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Notre mission</h2>
                <p class="mt-5 text-slate-600 leading-relaxed text-lg">En cas de panne, il est souvent difficile de trouver rapidement un professionnel de confiance, au bon prix et près de soi.</p>
                <p class="mt-4 text-slate-600 leading-relaxed">SamaRemorque connecte les conducteurs avec des remorqueurs et dépanneurs vérifiés, disponibles en temps réel — une assistance plus humaine, transparente et accessible au Sénégal.</p>
            </div>
            <div class="landing-media-frame landing-media-frame--light">
                <img src="<?php echo e(asset('images/remorque_qui_transporte_un_vehicule.jpg')); ?>" alt="SamaRemorque" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="py-20 md:py-28 bg-night-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Nos engagements</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                ['title' => 'Professionnels vérifiés', 'desc' => 'Chaque remorqueur et dépanneur est validé par notre équipe.'],
                ['title' => 'Transparence', 'desc' => 'Les tarifs sont affichés. Pas de surprise.'],
                ['title' => 'Suivi en temps réel', 'desc' => 'Suivez l\'arrivée du professionnel sur la carte.']
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div>
                <span class="font-display text-5xl font-bold text-accent-500/20">0<?php echo e($index + 1); ?></span>
                <h3 class="mt-2 font-display text-xl font-semibold text-night"><?php echo e($item['title']); ?></h3>
                <p class="mt-2 text-slate-600 leading-relaxed"><?php echo e($item['desc']); ?></p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>

<section class="py-20 md:py-28 bg-night text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold tracking-tight">Prêt à essayer ?</h2>
        <p class="mt-4 text-white/65 text-lg">Demandez une assistance ou inscrivez-vous en tant que professionnel.</p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
            <a href="<?php echo e(route('guest.create')); ?>" class="landing-cta-primary">Demander une assistance</a>
            <a href="<?php echo e(route('register')); ?>" class="landing-cta-ghost">Devenir professionnel</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\pages\a-propos.blade.php ENDPATH**/ ?>