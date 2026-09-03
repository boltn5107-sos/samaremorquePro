<?php $__env->startSection('title', 'Verification email'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Verifiez votre email</h2>

            <p class="text-sm text-slate-600 mb-6">
                Avant de continuer, veuillez verifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
            </p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status') == 'verification-link-sent'): ?>
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded mb-6">
                    Un nouveau lien de verification a ete envoye.
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700">
                    Renvoyer le lien de verification
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\auth\verify-email.blade.php ENDPATH**/ ?>