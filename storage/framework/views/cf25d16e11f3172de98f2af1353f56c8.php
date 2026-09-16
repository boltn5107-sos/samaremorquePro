<?php $__env->startSection('title', 'Verification email'); ?>
<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Verifiez votre email</h2>
        <p class="mt-2 text-sm text-slate-600">Une lettre de verification a ete envoyee.</p>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status') == 'verification-link-sent'): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm animate-slide-in-right">
            Un nouveau lien de verification a ete envoye.
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn-primary w-full text-base py-4">Renvoyer le lien de verification</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\auth\verify-email.blade.php ENDPATH**/ ?>