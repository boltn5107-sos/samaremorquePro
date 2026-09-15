<?php $__env->startSection('title', 'Paiement par Wave'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8 mb-20">
        <h1 class="text-2xl font-bold text-slate-900 mb-1">Paiement par Wave</h1>
        <p class="text-sm text-slate-500 mb-6">Reglez votre intervention en toute securite avec Wave Money.</p>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                <p class="text-sm"><?php echo e(session('error')); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="card p-5 mb-6">
            <h2 class="font-semibold text-slate-900">Intervention #<?php echo e($intervention->tracking_code); ?></h2>
            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-slate-500">Type de service</dt>
                    <dd class="font-medium text-slate-900"><?php echo e(ucfirst($intervention->service_type)); ?></dd>
                </div>
                <div>
                    <dt class="text-slate-500">Statut</dt>
                    <dd><span class="badge <?php echo e($intervention->status_color); ?>"><?php echo e($intervention->status_label); ?></span></dd>
                </div>
                <div>
                    <dt class="text-slate-500">Destination</dt>
                    <dd class="font-medium text-slate-900"><?php echo e($intervention->destination ?? 'Non renseignee'); ?></dd>
                </div>
                <div>
                    <dt class="text-slate-500">Date</dt>
                    <dd class="font-medium text-slate-900"><?php echo e($intervention->created_at->format('d/m/Y H:i')); ?></dd>
                </div>
            </dl>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment && $payment->status === 'pending'): ?>
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6 text-sm text-amber-800">
                Un paiement est deja en cours (reference <?php echo e($payment->client_reference); ?>).
                Verifiez votre application Wave pour finaliser le paiement, ou relancez une demande.
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('payment.wave.store', $intervention)); ?>" class="card p-5 space-y-4">
            <?php echo csrf_field(); ?>

            <div>
                <label for="amount" class="label">Montant (FCFA) *</label>
                <input type="number" id="amount" name="amount" required min="100" step="1"
                       value="<?php echo e($intervention->professional?->hourly_rate ?? ''); ?>"
                       class="input" placeholder="Ex : 15000" inputmode="numeric">
                <p class="mt-1 text-xs text-slate-500">Devise : XOF (Franc CFA). Le tarif horaire du professionnel peut vous servir de reference.</p>
            </div>

            <div>
                <label for="phone" class="label">Numero Wave pour le paiement (optionnel)</label>
                <input type="tel" id="phone" name="phone" class="input" placeholder="Ex : 77 123 45 67" inputmode="tel">
                <p class="mt-1 text-xs text-slate-500">Si renseigne, seul ce numero pourra payer. Par defaut, un lien de paiement vous sera envoye.</p>
            </div>

            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-bold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-600/20 transition-colors">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Payer avec Wave
            </button>
            <p class="text-center text-xs text-slate-400">Vous serez redirige vers Wave pour confirmer le paiement depuis votre telephone.</p>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\payment\pay.blade.php ENDPATH**/ ?>