<?php $__env->startSection('title', 'Notifications'); ?>
<?php $__env->startSection('content'); ?>
    <section class="relative overflow-hidden reveal">
        <div class="absolute inset-0 hero-gradient pointer-events-none" aria-hidden="true"></div>
        <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="font-display text-3xl font-bold text-slate-900 tracking-tight">Notifications</h1>
                    <p class="mt-1 text-sm text-slate-500"><?php echo e($notifications->count()); ?> notification<?php echo e($notifications->count() > 1 ? 's' : ''); ?></p>
                </div>
                <form method="POST" action="<?php echo e(route('notifications.mark-all-read')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-secondary text-xs px-4 py-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Tout marquer comme lu
                    </button>
                </form>
            </div>

            <div class="bg-white shadow-card rounded-2xl border border-slate-100 overflow-hidden">
                <ul class="divide-y divide-slate-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="group transition-colors duration-300 <?php echo e(is_null($notification->read_at) ? 'bg-gradient-to-r from-orange-50/80 via-white to-white' : 'bg-white hover:bg-slate-50/60'); ?>">
                            <div class="px-5 py-4 sm:px-6">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-start gap-3 min-w-0 flex-1">
                                        <div class="flex-shrink-0 mt-0.5">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null($notification->read_at)): ?>
                                                <span class="flex h-2.5 w-2.5">
                                                    <span class="animate-ping absolute inline-flex h-2.5 w-2.5 rounded-full bg-orange-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
                                                </span>
                                            <?php else: ?>
                                                <span class="flex h-2.5 w-2.5">
                                                    <span class="inline-flex rounded-full h-2.5 w-2.5 bg-slate-300"></span>
                                                </span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-semibold <?php echo e(is_null($notification->read_at) ? 'text-orange-600' : 'text-slate-700'); ?>"><?php echo e($notification->data['title'] ?? $notification->type); ?></p>
                                            <p class="mt-0.5 text-sm text-slate-500 line-clamp-2"><?php echo e($notification->data['body'] ?? ''); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 flex items-center gap-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null($notification->read_at)): ?>
                                            <span class="px-2.5 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-700 ring-1 ring-orange-200/50">Nouveau</span>
                                        <?php else: ?>
                                            <span class="px-2.5 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-500">Lu</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-2.5 flex justify-between items-center pl-5">
                                    <p class="text-xs text-slate-400 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <?php echo e($notification->created_at->format('d/m/Y H:i')); ?>

                                    </p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null($notification->read_at)): ?>
                                        <form method="POST" action="<?php echo e(route('notifications.read', $notification)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors px-2 py-1 -mr-2 rounded-lg hover:bg-orange-50">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                Marquer comme lu
                                            </button>
                                        </form>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="px-6 py-16 text-center">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                            </div>
                            <p class="font-semibold text-slate-700">Aucune notification</p>
                            <p class="mt-1 text-sm text-slate-400">Vous etes a jour. Revenez plus tard.</p>
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="mt-6">
                <?php echo e($notifications->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\notifications\index.blade.php ENDPATH**/ ?>