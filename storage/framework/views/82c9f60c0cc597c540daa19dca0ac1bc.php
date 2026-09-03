<?php $__env->startSection('title', 'Demande d\'intervention'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mb-16">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'plus','class' => 'w-6 h-6 text-orange-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus','class' => 'w-6 h-6 text-orange-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
            Nouvelle demande d'intervention
        </h1>

        
        <div class="card p-4 mb-6">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin','class' => 'w-5 h-5 text-orange-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin','class' => 'w-5 h-5 text-orange-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                    Ma position
                </h2>
                <button type="button" id="locate-btn" class="btn-secondary text-xs px-3 py-2">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'refresh','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'refresh','class' => 'w-4 h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                    Actualiser
                </button>
            </div>

            <div id="loc-status" class="mb-3 text-sm text-slate-500 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                Recuperation de votre position GPS...
            </div>

            <div class="map-shell" style="height: 300px;">
                <div id="map" style="height: 100%; width: 100%;"></div>
            </div>

            <div id="manual-zone" class="mt-4 hidden">
                <label class="label mb-1">Position manuelle (GPS indisponible)</label>
                <div class="flex gap-2">
                    <input type="text" id="manual-address" class="input flex-1" placeholder="Adresse ou lieu (ex : Route de Rufisque, Dakar)">
                    <button type="button" id="manual-apply" class="btn-secondary whitespace-nowrap">
                        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin','class' => 'w-4 h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                        Appliquer
                    </button>
                </div>
                <p class="mt-2 text-xs text-slate-500">Ou deplacez directement le marqueur sur la carte.</p>
            </div>

            <div id="used-position" class="mt-3 text-sm text-slate-600 hidden">
                Position utilisee : <span id="used-position-text" class="font-semibold text-slate-900"></span>
            </div>
            <div id="reverse-geocode" class="mt-1 text-xs text-slate-500"></div>
        </div>

        
        <div class="card p-4 mb-6">
            <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2 mb-1">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'truck','class' => 'w-5 h-5 text-orange-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'truck','class' => 'w-5 h-5 text-orange-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                Professionnels disponibles a proximite
            </h2>
            <p class="text-xs text-slate-500 mb-3">Tries par distance croissante - le plus proche en premier.</p>

            <div id="pros-empty" class="hidden py-6 text-center text-slate-500">
                <p>Aucun professionnel disponible pour le moment.</p>
                <p class="text-xs mt-1">Vous pouvez tout de meme envoyer votre demande.</p>
            </div>

            <div id="pros-loading" class="py-6 text-center text-sm text-slate-500">Recherche des professionnels...</div>

            <div id="pros-list" class="space-y-2"></div>
        </div>

        <div class="card p-6">
            <form method="POST" action="<?php echo e(route('client.intervention.store')); ?>" enctype="multipart/form-data" class="space-y-5" id="intervention-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="client_lat" id="client_lat">
                <input type="hidden" name="client_lng" id="client_lng">
                <input type="hidden" name="client_address" id="client_address">
                <input type="hidden" name="manual_position" id="manual_position">
                <input type="hidden" name="selected_professional_id" id="selected_professional_id">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vehicles->isNotEmpty()): ?>
                    <div>
                        <label for="vehicle_id" class="label">Vehicule enregistre</label>
                        <select id="vehicle_id" name="vehicle_id" class="input">
                            <option value="">Selectionnez un vehicule</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->brand ?? $vehicle->type); ?> <?php echo e($vehicle->plate_number ?? ''); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div>
                    <label for="vehicle_type" class="label">Type de vehicule</label>
                    <select id="vehicle_type" name="vehicle_type" required class="input">
                        <option value="">Selectionnez un type</option>
                        <option value="voiture">Voiture</option>
                        <option value="moto">Moto</option>
                        <option value="camion">Camion</option>
                        <option value="bus">Bus</option>
                        <option value="autre">Autre</option>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['vehicle_type'];
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
                    <label for="service_type" class="label">Type de service</label>
                    <select id="service_type" name="service_type" required class="input">
                        <option value="">Selectionnez un service</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($service->name); ?>"><?php echo e($service->name); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['service_type'];
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
                    <label for="destination" class="label">Destination</label>
                    <input type="text" id="destination" name="destination" value="<?php echo e(old('destination')); ?>" required class="input" placeholder="Ou doit etre transporte le vehicule ?">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['destination'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div id="destinations-wrap" class="hidden mt-2">
                        <p class="text-xs font-medium text-slate-500 mb-1.5">Destinations suggerees (proches du lieu de la panne)</p>
                        <div id="destinations-list" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>

                <div>
                    <label for="description" class="label">Description de la panne</label>
                    <textarea id="description" name="description" rows="3" class="input" placeholder="Decrivez brievement la panne"><?php echo e(old('description')); ?></textarea>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
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
                    <label class="label mb-1">Photo de la panne</label>
                    <input type="file" id="photo" name="photo" accept="image/*" capture="environment"
                        class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <p class="mt-1 text-xs text-slate-500">La camera du telephone s'ouvrira directement sur certains appareils.</p>
                </div>

                <div id="photo-preview" class="hidden">
                    <img id="photo-preview-img" src="" alt="Apercu de la photo" class="w-40 h-40 object-cover rounded-lg border border-slate-200">
                </div>

                <div id="location-required-warning" class="hidden text-sm text-red-600 flex items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'alert-triangle','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'alert-triangle','class' => 'w-4 h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                    Veuillez definir votre position (GPS ou manuelle) avant de demander une intervention.
                </div>

                <button type="submit" id="submit-btn" class="btn-primary w-full py-3.5 text-base">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'zap','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'zap','class' => 'w-5 h-5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                    Demander une intervention
                </button>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const latInput = document.getElementById('client_lat');
                const lngInput = document.getElementById('client_lng');
                const addressInput = document.getElementById('client_address');
                const manualInput = document.getElementById('manual_position');
                const locStatus = document.getElementById('loc-status');
                const usedPosBox = document.getElementById('used-position');
                const usedPosText = document.getElementById('used-position-text');
                const reverseGeocode = document.getElementById('reverse-geocode');
                const manualZone = document.getElementById('manual-zone');
                const warnBox = document.getElementById('location-required-warning');
                const serviceSelect = document.getElementById('service_type');

                const DEFAULT_POS = { lat: 14.7167, lng: -17.4677 };

                window.clientPosition = null;
                window.selectedProId = null;
                window.prosData = [];

                const map = L.map('map').setView([DEFAULT_POS.lat, DEFAULT_POS.lng], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(map);

                const clientIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div class="marker-dot marker-client"></div>',
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });

                let clientMarker = null;
                let proMarkers = L.layerGroup().addTo(map);
                let polyline = null;

                function setStatus(text, color) {
                    locStatus.innerHTML = '<span class="w-2 h-2 rounded-full bg-' + color + '-500"></span> ' + text;
                }

                function formatDistance(km) {
                    return km < 1 ? Math.round(km * 1000) + ' m' : km.toFixed(1) + ' km';
                }

                function computeDistance(lat1, lng1, lat2, lng2) {
                    const R = 6371;
                    const dLat = (lat2 - lat1) * Math.PI / 180;
                    const dLng = (lng2 - lng1) * Math.PI / 180;
                    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                        Math.sin(dLng / 2) * Math.sin(dLng / 2);
                    return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                }

                function setPosition(lat, lng, options) {
                    options = options || {};
                    window.clientPosition = { lat: lat, lng: lng };
                    latInput.value = lat.toFixed(6);
                    lngInput.value = lng.toFixed(6);
                    usedPosBox.classList.remove('hidden');
                    usedPosText.textContent = lat.toFixed(5) + ', ' + lng.toFixed(5);

                    if (!clientMarker) {
                        clientMarker = L.marker([lat, lng], { icon: clientIcon, draggable: true }).addTo(map)
                            .bindPopup('<strong>Votre position</strong>');
                        clientMarker.on('dragend', function (e) {
                            const p = e.target.getLatLng();
                            setPosition(p.lat, p.lng, { fetch: true });
                        });
                    } else {
                        clientMarker.setLatLng([lat, lng]);
                    }

                    map.setView([lat, lng], Math.max(map.getZoom(), 12));

                    if (options.fetch !== false) {
                        fetchNearby();
                    }

                    if (navigator.geolocation) {
                        fetch('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + lat + '&lon=' + lng + '&countrycodes=sn', {
                            headers: { 'User-Agent': 'SamaRemorque/1.0' }
                        }).then(r => r.json()).then(data => {
                            const addr = data.display_name || (data.address && (data.address.road + (data.address.city ? ', ' + data.address.city : ''))) || '';
                            if (addr) {
                                addressInput.value = addr;
                                reverseGeocode.textContent = addr;
                            }
                        }).catch(() => {});
                    }
                }

                function fetchNearby() {
                    if (!window.clientPosition) return;
                    const prosLoading = document.getElementById('pros-loading');
                    const prosEmpty = document.getElementById('pros-empty');
                    const prosList = document.getElementById('pros-list');
                    prosLoading.classList.remove('hidden');
                    prosEmpty.classList.add('hidden');
                    prosList.innerHTML = '';
                    proMarkers.clearLayers();
                    if (polyline) { map.removeLayer(polyline); polyline = null; }

                    const params = new URLSearchParams({
                        lat: window.clientPosition.lat,
                        lng: window.clientPosition.lng,
                        radius: 100,
                        freshness: 5,
                    });
                    const st = serviceSelect ? serviceSelect.value.trim() : '';
                    if (st) params.set('service_type', st);

                    fetch('<?php echo e(route('client.intervention.nearby')); ?>?' + params.toString(), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        prosLoading.classList.add('hidden');
                        window.prosData = data;
                        sortAndRender(data);
                        renderSuggestedDestinations(data);
                    })
                    .catch(() => {
                        prosLoading.classList.add('hidden');
                        prosEmpty.classList.remove('hidden');
                    });
                }

                function sortAndRender(pros) {
                    const prosList = document.getElementById('pros-list');
                    const prosEmpty = document.getElementById('pros-empty');
                    const sorted = pros.slice().sort((a, b) => a.distance_km - b.distance_km);
                    prosList.innerHTML = '';
                    window.sortedPros = sorted;

                    if (!sorted.length) {
                        prosEmpty.classList.remove('hidden');
                        return;
                    }

                    prosEmpty.classList.add('hidden');

                    sorted.forEach(pro => renderPro(pro));
                }

                function renderPro(pro) {
                    const prosList = document.getElementById('pros-list');
                    const roleLabel = pro.role === 'remorqueur' ? 'Remorqueur' : 'Depanneur';
                    const initials = pro.full_name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();

                    const card = document.createElement('div');
                    card.className = 'pro-card';
                    card.dataset.proId = pro.id;
                    card.style.cursor = 'pointer';

                    const avatarHtml = pro.photo
                        ? '<img src="' + pro.photo + '" alt="" class="pro-avatar">'
                        : '<div class="pro-avatar-placeholder bg-orange-100 text-orange-600">' + initials + '</div>';

                    const wa = (pro.phone || '').replace(/[^0-9]/g, '');
                    const waLink = wa ? 'https://wa.me/221' + wa.replace(/^221/, '') : '#';

                    card.innerHTML = [
                        avatarHtml,
                        '<div class="flex-1 min-w-0">',
                        '  <p class="font-semibold text-slate-900 text-sm truncate">' + pro.full_name + '</p>',
                        '  <p class="text-xs text-slate-500">' + roleLabel + '</p>',
                        '  <div class="flex items-center gap-3 mt-1 text-xs">',
                        '    <span class="chip bg-orange-100 text-orange-700">' + formatDistance(pro.distance_km) + '</span>',
                        pro.hourly_rate ? '<span class="text-slate-500">' + pro.hourly_rate + ' FCFA/h</span>' : '',
                        '  </div>',
                        '</div>',
                        '<div class="flex flex-col gap-1 flex-shrink-0" onclick="event.stopPropagation()">',
                        '  <a href="tel:' + (pro.phone || '') + '" class="btn-secondary px-2.5 py-1.5 text-xs items-center">Appeler</a>',
                        '  <a href="' + waLink + '" target="_blank" rel="noopener" class="px-2.5 py-1.5 text-xs font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center justify-center gap-1">WhatsApp</a>',
                        '</div>'
                    ].join('');

                    card.addEventListener('click', function () {
                        selectPro(pro);
                    });

                    prosList.appendChild(card);
                }

                function renderSuggestedDestinations(pros) {
                    const wrap = document.getElementById('destinations-wrap');
                    const list = document.getElementById('destinations-list');
                    list.innerHTML = '';
                    const seen = new Set();
                    const dests = [];
                    pros.forEach(pro => {
                        const d = pro.suggested_destination;
                        if (d && !seen.has(d)) {
                            seen.add(d);
                            dests.push(d);
                        }
                    });
                    if (!dests.length) {
                        wrap.classList.add('hidden');
                        return;
                    }
                    wrap.classList.remove('hidden');
                    dests.slice(0, 5).forEach(dest => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'chip bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer';
                        btn.textContent = dest;
                        btn.addEventListener('click', function () {
                            document.getElementById('destination').value = dest;
                        });
                        list.appendChild(btn);
                    });
                }

                const proIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div class="marker-dot marker-pro"></div>',
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });
                const proSelectedIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div class="marker-dot marker-pro-selected"></div>',
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });

                function selectPro(pro, fromMap) {
                    window.selectedProId = pro.id;
                    document.getElementById('selected_professional_id').value = pro.id;

                    const cards = document.querySelectorAll('.pro-card');
                    cards.forEach(c => {
                        c.classList.toggle('selected', String(c.dataset.proId) === String(pro.id));
                    });
                    proMarkers.clearLayers();
                    window.prosData.forEach(p => {
                        const marker = L.marker([p.lat, p.lng], {
                            icon: p.id === pro.id ? proSelectedIcon : proIcon
                        }).addTo(proMarkers);

                        marker.bindPopup(
                            '<strong>' + p.full_name + '</strong><br>' +
                            '<span class="text-xs">' + formatDistance(p.distance_km) + '</span>'
                        );

                        marker.on('click', function () {
                            selectPro(p, true);
                        });
                    });

                    if (window.clientPosition) {
                        polyline = L.polyline([[window.clientPosition.lat, window.clientPosition.lng], [pro.lat, pro.lng]], {
                            color: '#f97316', dashArray: '5,5', weight: 2, opacity: 0.7
                        }).addTo(map);
                    }

                    if (pro.suggested_destination) {
                        document.getElementById('destination').value = pro.suggested_destination;
                    }

                    if (!fromMap) {
                        map.flyTo([pro.lat, pro.lng], Math.max(map.getZoom(), 13));
                    }
                }

                function locate() {
                    if (!navigator.geolocation) {
                        setStatus('Geolocalisation non supportee.', 'red');
                        enableManual();
                        return;
                    }

                    setStatus('Recuperation de votre position GPS...', 'orange');
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        setStatus('Position GPS obtenue.', 'emerald');
                        setPosition(lat, lng, { fetch: true });
                        manualZone.classList.add('hidden');
                    }, function (err) {
                        setStatus('GPS indisponible. Saisissez votre position manuellement.', 'red');
                        enableManual();
                        if (window.clientPosition) {
                            setPosition(window.clientPosition.lat, window.clientPosition.lng, { fetch: true });
                        }
                    }, { enableHighAccuracy: true, timeout: 15000, maximumAge: 60000 });
                }

                function enableManual() {
                    manualZone.classList.remove('hidden');
                }

                document.getElementById('locate-btn').addEventListener('click', locate);

                document.getElementById('manual-apply').addEventListener('click', function () {
                    const q = document.getElementById('manual-address').value.trim();
                    if (!q) return;
                    manualInput.value = q;
                    setStatus('Geolocalisation de l\'adresse...', 'orange');
                    fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&countrycodes=sn&q=' + encodeURIComponent(q), {
                        headers: { 'User-Agent': 'SamaRemorque/1.0' }
                    }).then(r => r.json()).then(results => {
                        if (results && results.length) {
                            const lat = parseFloat(results[0].lat);
                            const lng = parseFloat(results[0].lon);
                            setPosition(lat, lng, { fetch: true });
                            addressInput.value = q;
                            reverseGeocode.textContent = q;
                            manualZone.classList.add('hidden');
                            setStatus('Position manuelle definie.', 'emerald');
                        } else {
                            setStatus('Adresse introuvable, deplacez le marqueur.', 'red');
                            window.clientPosition = window.clientPosition || { lat: DEFAULT_POS.lat, lng: DEFAULT_POS.lng };
                            setPosition(window.clientPosition.lat, window.clientPosition.lng, { fetch: true });
                        }
                    }).catch(() => {
                        setStatus('Geolocalisation impossible. Deplacez le marqueur.', 'red');
                    });
                });

                if (serviceSelect) {
                    serviceSelect.addEventListener('change', function () {
                        if (window.clientPosition) fetchNearby();
                    });
                }

                document.getElementById('intervention-form').addEventListener('submit', function (e) {
                    if (!latInput.value || !lngInput.value) {
                        e.preventDefault();
                        warnBox.classList.remove('hidden');
                        document.getElementById('loc-status').scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }
                });

                document.getElementById('photo').addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    const preview = document.getElementById('photo-preview');
                    const img = document.getElementById('photo-preview-img');
                    img.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                });

                locate();
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\client\intervention-create.blade.php ENDPATH**/ ?>