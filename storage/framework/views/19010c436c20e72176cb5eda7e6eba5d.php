<?php $__env->startSection('title', 'Editer professionnel'); ?>
<?php $__env->startSection('content'); ?>
    <section class="relative overflow-hidden reveal">
        <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <a href="<?php echo e(route('admin.professionnels.show', $professional)); ?>" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-900 mb-5">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-left','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-left','class' => 'w-4 h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                Retour au profil
            </a>

            <div class="flex items-center gap-3 mb-6">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'edit','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'edit','class' => 'w-6 h-6']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Editer <?php echo e($professional->full_name); ?></h1>
                    <p class="text-sm text-slate-500">Modifier les informations du compte professionnel</p>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-5">
                    <div class="flex items-start gap-2">
                        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'alert-triangle','class' => 'w-5 h-5 text-red-600 flex-shrink-0 mt-0.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'alert-triangle','class' => 'w-5 h-5 text-red-600 flex-shrink-0 mt-0.5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                        <div>
                            <p class="text-sm font-semibold text-red-700 mb-1">Veuillez corriger les erreurs suivantes :</p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <p class="text-sm text-red-600"><?php echo e($error); ?></p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.professionnels.update', $professional)); ?>" class="card p-6 space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-slate-700 mb-1.5">Prenom</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo e(old('first_name', $professional->first_name)); ?>" required
                               class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-slate-700 mb-1.5">Nom</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo e(old('last_name', $professional->last_name)); ?>" required
                               class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Telephone</label>
                    <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', $professional->phone)); ?>" required
                           class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>

                <div>
                    <label for="zone_intervention" class="block text-sm font-medium text-slate-700 mb-1.5">Zone d'intervention</label>
                    <input type="text" id="zone_intervention" name="zone_intervention" value="<?php echo e(old('zone_intervention', $professional->zone_intervention)); ?>"
                           placeholder="Ex : Dakar, Pikine, Guediawaye..."
                           class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-slate-700 mb-1.5">Bio / description</label>
                    <textarea id="bio" name="bio" rows="3"
                              class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500"><?php echo e(old('bio', $professional->bio)); ?></textarea>
                </div>

                <?php
                    $profile = $professional->isRemorqueur()
                        ? $professional->remorqueurProfile
                        : $professional->depanneurProfile;
                ?>
                <div>
                    <label for="hourly_rate" class="block text-sm font-medium text-slate-700 mb-1.5">Tarif horaire (FCFA/h)</label>
                    <input type="number" id="hourly_rate" name="hourly_rate" min="0" step="500"
                           value="<?php echo e(old('hourly_rate', $profile?->hourly_rate)); ?>"
                           placeholder="Ex : 15000"
                           class="w-full rounded-xl border-slate-300 text-sm focus:ring-orange-500 focus:border-orange-500">
                    <p class="text-xs text-slate-400 mt-1.5">Ce tarif est utilise pour estimer le chiffre d'affaires et affiche au client.</p>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <button type="submit" class="btn-primary">
                        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                        Enregistrer les modifications
                    </button>
                    <a href="<?php echo e(route('admin.professionnels.show', $professional)); ?>" class="btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\admin\professional-edit.blade.php ENDPATH**/ ?>