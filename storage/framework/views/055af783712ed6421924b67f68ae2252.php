<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'subtitle' => null,
    'eyebrow' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title',
    'subtitle' => null,
    'eyebrow' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<header <?php echo e($attributes->merge(['class' => 'relative overflow-hidden'])); ?>>
    
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950"></div>

    
    <div class="absolute inset-0 pointer-events-none">
        
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-orange-500/[0.07] rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-40 -right-24 w-[450px] h-[450px] bg-blue-500/[0.05] rounded-full blur-[120px]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-orange-500/[0.03] rounded-full blur-[140px]"></div>

        
        <div class="absolute inset-0 bg-grid opacity-20"></div>

        
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-orange-500/20 to-transparent"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 md:pt-28 md:pb-24">
        <div class="max-w-2xl">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($eyebrow): ?>
                <p class="inline-flex items-center gap-2 font-display text-xs sm:text-sm font-semibold tracking-widest uppercase text-orange-400 mb-5">
                    <span class="w-8 h-px bg-gradient-to-r from-orange-400 to-transparent"></span>
                    <?php echo e($eyebrow); ?>

                    <span class="w-8 h-px bg-gradient-to-l from-orange-400 to-transparent"></span>
                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white [text-shadow:0_2px_24px_rgba(0,0,0,0.35)]">
                <?php echo $title; ?>

            </h1>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
                <p class="mt-5 text-base sm:text-lg text-slate-400/90 leading-relaxed max-w-xl">
                    <?php echo $subtitle; ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($actions)): ?>
                <div class="mt-9 flex flex-col sm:flex-row gap-3">
                    <?php echo e($actions); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-slate-950/30 to-transparent pointer-events-none"></div>
</header><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\components\page-hero.blade.php ENDPATH**/ ?>