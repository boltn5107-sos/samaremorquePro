<?php $__env->startSection('title', 'Suivi intervention <?php echo e($intervention->tracking_code); ?> - SamaRemorque'); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $isFinished = in_array($intervention->status, ['intervention_terminee', 'annulee']);
        $pro = $intervention->professional;
        $proPhone = preg_replace('/[^0-9]/', '', $pro?->phone ?? '');
        $whatsapp = $proPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $proPhone) : '#';
        $flash = session('status');
    ?>

    
    <section class="relative overflow-hidden sticky top-0 z-40 bg-night text-white border-b border-white/10 no-print">
        <div class="max-w-3xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2.5 text-lg font-bold tracking-tight group">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/10 backdrop-blur-sm overflow-hidden ring-1 ring-white/10 transition-transform duration-300 group-hover:scale-105">
                    <img src="<?php echo e(asset('favicon.jpg')); ?>" alt="SamaRemorque" class="w-6 h-6 object-contain">
                </span>
                <span class="font-display">SamaRemorque</span>
            </a>
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-emerald-500/15 text-emerald-300 px-3 py-1.5 rounded-full ring-1 ring-emerald-500/20">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Suivi sans compte
            </span>
        </div>
    </section>

    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 pb-24 relative">
        <div class="absolute inset-0 hero-gradient pointer-events-none" aria-hidden="true"></div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($flash === 'intervention-created'): ?>
            <div class="card p-5 mb-6 bg-gradient-to-r from-emerald-50 to-emerald-50/50 border border-emerald-200/80 text-emerald-800 animate-scale-in ring-1 ring-emerald-100">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold">Demande envoyee !</p>
                        <p class="text-sm mt-1 text-emerald-700">Conservez votre <strong>code de suivi</strong> ci-dessous pour retrouver votre intervention sans compte.</p>
                    </div>
                </div>
            </div>
        <?php elseif($flash === 'intervention-cancelled'): ?>
            <div class="card p-5 mb-6 bg-gradient-to-r from-red-50 to-red-50/50 border border-red-200/80 text-red-700 animate-scale-in ring-1 ring-red-100">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold">Intervention annulee.</p>
                        <p class="text-sm mt-1 text-red-600">Votre demande a bien ete annulee. Vous pouvez en faire une nouvelle a tout moment.</p>
                    </div>
                </div>
            </div>
        <?php elseif($flash === 'intervention-rated'): ?>
            <div class="card p-5 mb-6 bg-gradient-to-r from-emerald-50 to-emerald-50/50 border border-emerald-200/80 text-emerald-800 animate-scale-in ring-1 ring-emerald-100">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold">Merci pour votre note !</p>
                        <p class="text-sm mt-1 text-emerald-700">Votre avis aidera les autres conducteurs.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <section class="card p-6 mb-6 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white to-orange-50/30 pointer-events-none"></div>
            <div class="relative">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Code de suivi</p>
                <p id="tracking-code" class="mt-2 font-display text-3xl md:text-4xl font-extrabold text-slate-900 tracking-wider"><?php echo e($intervention->tracking_code); ?></p>
                <button type="button" id="copy-code" class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors px-3 py-1.5 rounded-lg hover:bg-orange-50">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Copier le code
                </button>
                <p class="mt-2 text-xs text-slate-400">Utilisez ce code a tout moment pour retrouver cette page.</p>
            </div>
        </section>

        
        <section class="card p-5 mb-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-slate-900">Statut de l'intervention</h2>
                <span class="badge <?php echo e($intervention->status_color); ?>">
                    <span class="w-2 h-2 rounded-full <?php echo e($isFinished ? '' : 'bg-orange-500 animate-pulse'); ?>"></span>
                    <?php echo e($intervention->status_label); ?>

                </span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isFinished): ?>
                <div class="mt-3 flex items-center gap-2 p-3 rounded-xl bg-orange-50/60 border border-orange-100">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
                    </span>
                    <p class="text-xs text-orange-700 font-medium">Suivi en direct : la page se met a jour automatiquement.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>

        
        <section class="card p-5 mb-6">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-3">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </span>
                Carte en temps reel
            </h2>
            <div class="map-shell">
                <div id="map" style="height: 340px; width: 100%;"></div>
            </div>
        </section>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pro): ?>
            <section class="card p-6 mb-6">
                <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-4">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </span>
                    <?php echo e($pro->isRemorqueur() ? 'Remorqueur' : 'Depanneur'); ?> assigne
                </h2>
                <div class="flex items-center gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pro->photo): ?>
                        <img src="<?php echo e(asset('storage/' . $pro->photo)); ?>" alt="" class="w-14 h-14 rounded-xl object-cover bg-slate-100 ring-2 ring-slate-100">
                    <?php else: ?>
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-gradient-to-br from-orange-100 to-orange-200 text-orange-600 font-bold text-lg ring-2 ring-orange-100"><?php echo e(strtoupper(substr($pro->first_name, 0, 1))); ?><?php echo e(strtoupper(substr($pro->last_name, 0, 1))); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="min-w-0">
                        <p class="font-semibold text-slate-900"><?php echo e($pro->full_name); ?></p>
                        <p class="text-sm text-slate-500 flex items-center gap-1.5 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <?php echo e($pro->phone); ?>

                        </p>
                    </div>
                </div>
                <div class="flex gap-3 mt-5">
                    <a href="tel:<?php echo e($pro->phone); ?>" class="btn-secondary flex-1 text-sm py-2.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.58 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Appeler
                    </a>
                    <a href="<?php echo e($whatsapp); ?>" target="_blank" rel="noopener" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 transition-all duration-300 hover:-translate-y-0.5 shadow-sm shadow-emerald-600/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </section>
        <?php elseif(!$isFinished): ?>
            <section class="card p-6 mb-6">
                <div class="text-center py-6">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-orange-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-500 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.22-8.56"/></svg>
                    </div>
                    <p class="font-semibold text-slate-900">En attente d'un remorqueur ou depanneur...</p>
                    <p class="text-sm text-slate-500 mt-1.5 max-w-xs mx-auto">Des qu'un professionnel accepte, il apparait ici. Vous pouvez egalement suivre son arrivee sur la carte.</p>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <section class="card p-6 mb-6">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-4">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                </span>
                Informations de la demande
            </h2>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between gap-3 py-2.5 border-b border-slate-100 last:border-0">
                    <dt class="text-slate-500">Service</dt>
                    <dd class="font-medium text-slate-900 text-right"><?php echo e(ucfirst($intervention->service_type)); ?></dd>
                </div>
                <div class="flex justify-between gap-3 py-2.5 border-b border-slate-100 last:border-0">
                    <dt class="text-slate-500">Vehicule</dt>
                    <dd class="font-medium text-slate-900 text-right"><?php echo e(ucfirst($intervention->vehicle_type ?? 'Non renseigne')); ?></dd>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->client_address): ?>
                    <div class="flex justify-between gap-3 py-2.5 border-b border-slate-100 last:border-0">
                        <dt class="text-slate-500">Position du client</dt>
                        <dd class="font-medium text-slate-900 text-right"><?php echo e($intervention->client_address); ?></dd>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->destination): ?>
                    <div class="flex justify-between gap-3 py-2.5 border-b border-slate-100 last:border-0">
                        <dt class="text-slate-500">Destination</dt>
                        <dd class="font-medium text-slate-900 text-right"><?php echo e($intervention->destination); ?></dd>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->description): ?>
                    <div class="flex justify-between gap-3 py-2.5 border-b border-slate-100 last:border-0">
                        <dt class="text-slate-500 shrink-0">Description</dt>
                        <dd class="font-medium text-slate-700 text-right"><?php echo e($intervention->description); ?></dd>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->photo): ?>
                    <div class="py-2.5">
                        <dt class="text-slate-500 mb-2">Photo de la panne</dt>
                        <a href="<?php echo e(asset('storage/' . $intervention->photo)); ?>" target="_blank" rel="noopener">
                            <img src="<?php echo e(asset('storage/' . $intervention->photo)); ?>" alt="Photo de la panne" class="w-full max-w-xs rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </dl>
        </section>

        
        <section class="card p-6 mb-6">
            <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </span>
                Historique de l'intervention
            </h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->statuses->isNotEmpty()): ?>
                <ol class="space-y-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $intervention->statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="flex-shrink-0 h-9 w-9 rounded-full <?php echo e($loop->last ? 'bg-gradient-to-br from-orange-500 to-orange-600 shadow-sm shadow-orange-500/25' : 'bg-orange-100'); ?> flex items-center justify-center">
                                    <div class="h-2.5 w-2.5 rounded-full <?php echo e($loop->last ? 'bg-white' : 'bg-orange-500'); ?>"></div>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>
                                    <div class="w-px flex-1 bg-gradient-to-b from-orange-200 to-slate-200"></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="pb-6 pt-1">
                                <p class="text-sm font-semibold text-slate-900"><?php echo e($intervention->statusLabelFor($status->status)); ?></p>
                                <p class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <?php echo e($status->created_at->format('d/m/Y H:i')); ?>

                                </p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status->note): ?>
                                    <p class="text-sm text-slate-600 mt-1.5 pl-0.5"><?php echo e($status->note); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ol>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Aucune mise a jour pour le moment.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isFinished): ?>
            <form method="POST" action="<?php echo e(route('guest.cancel', $intervention->tracking_code)); ?>"
                  onsubmit="return confirm('Annuler cette intervention ?')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-xl text-sm font-semibold text-red-600 bg-red-50 border border-red-200/80 hover:bg-red-100 hover:border-red-300 transition-all duration-300">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    Annuler l'intervention
                </button>
            </form>
        <?php elseif($intervention->status === 'intervention_terminee'): ?>
            <section class="card p-6 mb-6">
                <h2 class="font-semibold text-slate-900 flex items-center gap-2.5 mb-2">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-600">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </span>
                    Noter le professionnel
                </h2>
                <p class="text-sm text-slate-600 mb-5 ml-[42px]">Merci de noter votre experience avec <?php echo e($pro ? $pro->full_name : 'le professionnel'); ?>.</p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->hasBeenRated()): ?>
                    <div class="text-center py-4">
                        <div class="flex justify-center gap-1.5 mb-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($i <= $intervention->rating): ?>
                                    <svg class="w-8 h-8 text-orange-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <?php else: ?>
                                    <svg class="w-8 h-8 text-slate-200" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->rating_comment): ?>
                            <p class="text-sm text-slate-600 italic max-w-sm mx-auto">"<?php echo e($intervention->rating_comment); ?>"</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <p class="text-xs text-slate-400 mt-3">Note envoyee le <?php echo e($intervention->rated_at->format('d/m/Y H:i')); ?></p>
                    </div>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('guest.rate', $intervention->tracking_code)); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="flex justify-center gap-2.5 mb-5" id="rating-stars">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button type="button" data-value="<?php echo e($i); ?>" class="rating-star text-slate-200 hover:text-orange-400 transition-all duration-200 hover:scale-110" aria-label="<?php echo e($i); ?> etoiles">
                                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0">
                        <div>
                            <label for="rating_comment" class="label">Commentaire (optionnel)</label>
                            <textarea id="rating_comment" name="rating_comment" rows="2" class="input"></textarea>
                        </div>
                        <button type="submit" id="rating-submit" class="w-full mt-4 inline-flex items-center justify-center gap-2 py-3.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-orange-600/20 transition-all duration-300 hover:shadow-xl disabled:hover:shadow-lg disabled:hover:translate-y-0 hover:-translate-y-0.5" disabled>
                            Envoyer la note
                        </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intervention->isGuest()): ?>
            <section class="relative overflow-hidden rounded-2xl border border-orange-200/80 bg-gradient-to-br from-orange-50 via-orange-50/50 to-white p-6 mb-6 ring-1 ring-orange-100">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 text-white flex items-center justify-center shadow-sm shadow-orange-500/25">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Conservez l'historique de vos interventions</h3>
                        <p class="text-sm text-slate-600 mt-1 leading-relaxed">Creez un compte gratuit : cette intervention sera liee a votre compte et vous la retrouverez dans votre espace, avec toutes les suivantes.</p>
                        <a href="<?php echo e(route('register', ['tracking' => $intervention->tracking_code])); ?>" class="inline-flex items-center gap-1.5 mt-4 btn-primary text-sm">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                            Creer mon compte (gratuit)
                        </a>
                        <p class="text-xs text-slate-500 mt-3">
                            Vos donnees sont protegees. Consultez notre
                            <a href="<?php echo e(route('privacy')); ?>" class="underline hover:text-orange-600 transition-colors">politique de confidentialite</a>.
                        </p>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <p class="text-center text-xs text-slate-400 mb-8">
            <a href="<?php echo e(url('/')); ?>" class="hover:text-orange-600 transition-colors inline-flex items-center gap-1">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour a l'accueil
            </a>
        </p>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lat = <?php echo e($intervention->client_lat ?? 14.7167); ?>;
            const lng = <?php echo e($intervention->client_lng ?? -17.4677); ?>;
            const hasPro = <?php echo e($pro ? 'true' : 'false'); ?>;
            const isFinished = <?php echo e($isFinished ? 'true' : 'false'); ?>;
            let proCardReloaded = hasPro;
            const statusUrl = '<?php echo e(route('guest.status', $intervention->tracking_code)); ?>';
            const positionUrl = '<?php echo e(route('guest.pro-position', $intervention->tracking_code)); ?>';

            const map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            const clientIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="marker-dot marker-client"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });
            L.marker([lat, lng], { icon: clientIcon }).addTo(map)
                .bindPopup('<strong>Point de prise en charge</strong>')
                .openPopup();

            const proIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="marker-dot marker-pro"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });

            let proMarker = null;
            let routeLine = null;

            function updateProPosition(point) {
                if (!proMarker) {
                    proMarker = L.marker([point.lat, point.lng], { icon: proIcon }).addTo(map)
                        .bindPopup('<strong><?php echo e($pro ? $pro->full_name : 'Professionnel'); ?></strong>');
                } else {
                    proMarker.setLatLng([point.lat, point.lng]);
                }
                if (!routeLine) {
                    routeLine = L.polyline([[lat, lng], [point.lat, point.lng]], {
                        color: '#f97316', weight: 3, opacity: 0.8
                    }).addTo(map);
                } else {
                    routeLine.setLatLngs([[lat, lng], [point.lat, point.lng]]);
                }
            }

            <?php if($pro && $pro->locations->isNotEmpty()): ?>
                const proLocations = <?php echo $pro->locations->map(fn ($l) => [$l->lat, $l->lng])->values()->toJson(); ?>;
                const proLatest = proLocations[proLocations.length - 1];
                proMarker = L.marker(proLatest, { icon: proIcon }).addTo(map)
                    .bindPopup('<strong><?php echo e($pro->full_name); ?></strong>');
                if (proLocations.length > 1) {
                    routeLine = L.polyline(proLocations, { color: '#f97316', weight: 3, opacity: 0.8 }).addTo(map);
                }
            <?php endif; ?>

            if (hasPro && !isFinished) {
                setInterval(function () {
                    fetch(positionUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            if (data && data.lat) updateProPosition(data);
                        })
                        .catch(function () {});

                    fetch(statusUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            if (data && data.is_finished) {
                                location.reload();
                                return;
                            }
                            if (data && data.professional && !proCardReloaded) {
                                proCardReloaded = true;
                                location.reload();
                                return;
                            }
                            if (data && data.status_label) {
                                const badge = document.querySelector('.badge');
                                if (badge) badge.textContent = data.status_label;
                            }
                        })
                        .catch(function () {});
                }, 8000);
            }

            const copyBtn = document.getElementById('copy-code');
            if (copyBtn) {
                copyBtn.addEventListener('click', function () {
                    const code = document.getElementById('tracking-code').textContent.trim();
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(code).then(function () {
                            copyBtn.textContent = 'Code copie !';
                            setTimeout(function () { copyBtn.textContent = 'Copier le code'; }, 2000);
                        });
                    } else {
                        const ta = document.createElement('textarea');
                        ta.value = code;
                        document.body.appendChild(ta);
                        ta.select();
                        document.execCommand('copy');
                        document.body.removeChild(ta);
                        copyBtn.textContent = 'Code copie !';
                        setTimeout(function () { copyBtn.textContent = 'Copier le code'; }, 2000);
                    }
                });
            }

            const starContainer = document.getElementById('rating-stars');
            const ratingInput = document.getElementById('rating');
            const ratingSubmit = document.getElementById('rating-submit');
            if (starContainer && ratingInput && ratingSubmit) {
                let selected = 0;
                const starButtons = starContainer.querySelectorAll('.rating-star');
                function paint(value) {
                    starButtons.forEach(function (btn, idx) {
                        const icon = btn.querySelector('svg');
                        if (icon) {
                            icon.setAttribute('fill', idx < value ? 'currentColor' : 'none');
                            btn.classList.toggle('text-orange-400', idx < value);
                            btn.classList.toggle('text-slate-300', idx >= value);
                        }
                    });
                }
                starButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        selected = parseInt(btn.getAttribute('data-value'), 10);
                        ratingInput.value = selected;
                        paint(selected);
                        ratingSubmit.disabled = false;
                    });
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\resources\views\guest\track.blade.php ENDPATH**/ ?>