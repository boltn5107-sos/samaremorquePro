<?php $__env->startSection('title', 'Detail client'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-6"><?php echo e($client->full_name); ?></h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Informations</h2>
                    <div class="flex items-center gap-3 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($client->photo): ?>
                            <img src="<?php echo e(asset('storage/' . $client->photo)); ?>" alt="" class="w-14 h-14 rounded-full object-cover bg-slate-100">
                        <?php else: ?>
                            <div class="w-14 h-14 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-semibold text-lg">
                                <?php echo e(strtoupper(substr($client->first_name, 0, 1))); ?><?php echo e(strtoupper(substr($client->last_name, 0, 1))); ?>

                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div>
                            <p class="text-lg font-semibold text-slate-900"><?php echo e($client->full_name); ?></p>
                            <p class="text-sm text-slate-500"><?php echo e($client->is_active ? 'Actif' : 'Suspendu'); ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-slate-500">Email</p>
                            <p class="text-base text-slate-900"><?php echo e($client->email); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Telephone</p>
                            <?php
                                $clPhone = preg_replace('/[^0-9]/', '', $client->phone ?? '');
                                $clWa = $clPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $clPhone) : '#';
                            ?>
                            <p class="text-base text-slate-900"><?php echo e($client->phone); ?></p>
                            <div class="flex flex-wrap gap-1.5 mt-1.5">
                                <a href="tel:<?php echo e($client->phone); ?>" class="btn-secondary px-3 py-1 text-xs">
                                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'phone','class' => 'w-3 h-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'phone','class' => 'w-3 h-3']); ?>
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
<?php endif; ?> Appeler
                                </a>
                                <a href="<?php echo e($clWa); ?>" target="_blank" rel="noopener" class="px-3 py-1 text-xs font-semibold rounded-md text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Statut</p>
                            <p class="text-base text-slate-900"><?php echo e($client->is_active ? 'Actif' : 'Suspendu'); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Inscrit le</p>
                            <p class="text-base text-slate-900"><?php echo e($client->created_at->format('d/m/Y')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Actions</h2>
                    <div class="space-y-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($client->is_active): ?>
                            <form method="POST" action="<?php echo e(route('admin.clients.suspend', $client)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                    Suspendre
                                </button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('admin.clients.reactivate', $client)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                                    Reactiver
                                </button>
                            </form>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\admin\client-detail.blade.php ENDPATH**/ ?>