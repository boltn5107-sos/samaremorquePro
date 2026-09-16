<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Mot de passe oublie</h2>
        <p class="mt-2 text-sm text-slate-600">Entrez votre email et nous vous enverrons un lien de reset</p>
    </div>
    <form method="POST" action="<?php echo e(route('password.email')); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>
        <div>
            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" required autocomplete="email" class="input" placeholder="votre@email.com" value="<?php echo e(old('email')); ?>">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
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
            <button type="submit" class="btn-primary w-full text-base py-4">Envoyer le lien de reset</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\auth\forgot-password.blade.php ENDPATH**/ ?>