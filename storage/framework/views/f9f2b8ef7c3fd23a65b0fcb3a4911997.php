<?php $__env->startSection('title', 'Carte'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Carte en temps reel</h1>
            <span class="inline-flex items-center gap-2 text-sm text-slate-600">
                <span class="w-3 h-3 rounded-full bg-orange-500"></span>
                Professionnels
                <span class="ml-2 w-3 h-3 rounded-full bg-emerald-500"></span>
                Interventions actives
            </span>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div id="admin-map" style="height: 600px; width: 100%;" class="rounded-xl border border-slate-200"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

    <?php $__env->startPush('scripts'); ?>
        <?php
            $proData = $professionals
                ->map(fn ($p) => [
                    'name' => $p->full_name,
                    'role' => $p->role,
                    'lat' => $p->locations->last()?->lat,
                    'lng' => $p->locations->last()?->lng,
                ])
                ->filter(fn ($p) => $p['lat'] !== null && $p['lng'] !== null)
                ->values()
                ->toJson();

            $intData = $activeInterventions
                ->map(fn ($i) => [
                    'id' => $i->id,
                    'status' => $i->status,
                    'lat' => $i->client_lat ?? 14.7167,
                    'lng' => $i->client_lng ?? -17.4677,
                ])
                ->toJson();
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('admin-map').setView([14.7167, -17.4677], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(map);

            const professionals = <?php echo $proData; ?>;

            const interventions = <?php echo $intData; ?>;

            const proIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="w-6 h-6 rounded-full bg-orange-500 border-2 border-white shadow flex items-center justify-center"></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12],
            });

            for (const p of professionals) {
                L.marker([p.lat, p.lng], { icon: proIcon })
                    .addTo(map)
                    .bindPopup('<strong>' + p.name + '</strong> - ' + p.role.charAt(0).toUpperCase() + p.role.slice(1));
            }

            const intIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="w-6 h-6 rounded-full bg-emerald-500 border-2 border-white shadow flex items-center justify-center"></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12],
            });

            for (const i of interventions) {
                L.marker([i.lat, i.lng], { icon: intIcon })
                    .addTo(map)
                    .bindPopup('<strong>Intervention #' + i.id + '</strong><br>' + i.status.replace(/_/g, ' '));
            }
        });
    </script>
    <?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views/admin/map.blade.php ENDPATH**/ ?>