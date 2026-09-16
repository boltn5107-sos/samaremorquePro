<?php $__env->startSection('title', 'Confirmer le mot de passe'); ?>
<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Confirmez votre mot de passe</h2>
        <p class="mt-2 text-sm text-slate-600">Veuillez confirmer votre mot de passe avant de continuer.</p>
    </div>
    <form method="POST" action="<?php echo e(route('password.confirm')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <div>
            <label for="password" class="label">Mot de passe</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required autocomplete="current-password" class="input" placeholder="Votre mot de passe">
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
            <button type="submit" class="btn-primary w-full text-base py-4">Confirmer</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\auth\confirm-password.blade.php ENDPATH**/ ?>