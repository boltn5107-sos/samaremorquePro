<?php $__env->startSection('title', 'Confirmer le mot de passe'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Confirmez votre mot de passe</h2>

            <p class="text-sm text-slate-600 mb-6">
                Veuillez confirmer votre mot de passe avant de continuer.
            </p>

            <form method="POST" action="<?php echo e(route('password.confirm')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Mot de passe</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-slate-300 placeholder-slate-500 text-slate-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\auth\confirm-password.blade.php ENDPATH**/ ?>