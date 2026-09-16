<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Reset du mot de passe</h2>
        <p class="mt-2 text-sm text-slate-600">Choisissez votre nouveau mot de passe</p>
    </div>
    <form method="POST" action="<?php echo e(route('password.update', $token)); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="email" value="<?php echo e($email); ?>">
        <div>
            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" required autocomplete="email" class="input" value="<?php echo e($email); ?>">
        </div>
        <div>
            <label for="password" class="label">Nouveau mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="input" placeholder="Au moins 8 caracteres">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div>
            <label for="password_confirmation" class="label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input" placeholder="Confirmez">
        </div>
        <div>
            <button type="submit" class="btn-primary w-full text-base py-4">Redefinir le mot de passe</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\auth\reset-password.blade.php ENDPATH**/ ?>