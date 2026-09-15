<?php $__env->startSection('title', 'Integration Wave & Business Model'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-8">
        <h1 class="text-2xl font-bold text-slate-900">Integration Wave & Business Model</h1>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etat de la configuration Wave</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-slate-500">Environnement</dt>
                    <dd class="font-semibold <?php echo e($wave['environment'] === 'sandbox' ? 'text-amber-600' : 'text-emerald-600'); ?>"><?php echo e(ucfirst($wave['environment'])); ?></dd>
                </div>
                <div>
                    <dt class="text-slate-500">Cle API Sandbox</dt>
                    <dd class="font-semibold <?php echo e(str_contains($wave['sandbox_key'], 'vide') ? 'text-red-600' : 'text-emerald-600'); ?>"><?php echo e($wave['sandbox_key']); ?></dd>
                </div>
                <div>
                    <dt class="text-slate-500">Cle API Production</dt>
                    <dd class="font-semibold <?php echo e(str_contains($wave['production_key'], 'vide') ? 'text-red-600' : 'text-emerald-600'); ?>"><?php echo e($wave['production_key']); ?></dd>
                </div>
                <div>
                    <dt class="text-slate-500">Webhook Secret</dt>
                    <dd class="font-semibold <?php echo e(str_contains($wave['webhook_secret'], 'vide') ? 'text-red-600' : 'text-emerald-600'); ?>"><?php echo e($wave['webhook_secret']); ?></dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-slate-500">Webhook URL (a declarer dans Wave Dev Portal)</dt>
                    <dd class="font-mono text-xs bg-slate-50 rounded-lg p-2 mt-1"><?php echo e(url('/webhook/wave')); ?></dd>
                </div>
            </dl>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 1 — Creer un compte Wave Business</h2>
            <ol class="list-decimal list-inside space-y-3 text-sm text-slate-700">
                <li>Rendez-vous sur <strong>business.wave.com</strong> et creez un compte Wave Business (SamaRemorque SARL ou equivalent).</li>
                <li>Completez la verification KYC (pieces d'identite, RNE, KBIS). La validation prend 24 a 72h.</li>
                <li>Une fois valide, activez les <strong>paiements Wave Money</strong> dans le tableau de bord.</li>
                <li>Parametrez votre <strong>compte marchand</strong> : numero Wave recolteur, compte bancaire de virement.</li>
            </ol>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 2 — Creer les cles API (Dev Portal)</h2>
            <ol class="list-decimal list-inside space-y-3 text-sm text-slate-700">
                <li>Connectez-vous au <strong>Dev Portal</strong> : <code class="bg-slate-100 px-2 py-0.5 rounded">business.wave.com/dev-portal</code></li>
                <li>Cliquez sur <strong>New API key</strong>.</li>
                <li>Creez une cle <strong>Sandbox</strong> (pour les tests). Copiez-la immediatement.</li>
                <li>Creez une cle <strong>Production</strong> (pour la mise en ligne reelle). Copiez-la immediatement.</li>
                <li>Creez un <strong>Webhook signing secret</strong> et copiez-le.</li>
            </ol>
            <p class="mt-3 text-xs text-slate-500">Les cles ne sont affichees qu'une seule fois. Conservez-les dans un gestionnaire de mots de passe.</p>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 3 — Parametrer les variables .env</h2>
            <p class="text-sm text-slate-600 mb-4">Ajoutez ces lignes dans votre fichier <code class="bg-slate-100 px-2 py-0.5 rounded">.env</code> :</p>
            <pre class="bg-slate-900 text-emerald-300 text-xs rounded-xl p-5 overflow-x-auto"><code>WAVE_ENVIRONMENT=sandbox
WAVE_API_KEY_SANDBOX=&lt;cle_sandbox&gt;
WAVE_API_SIGNING_SECRET_SANDBOX=&lt;secret_sandbox&gt;
WAVE_API_KEY=&lt;cle_production&gt;
WAVE_API_SIGNING_SECRET=&lt;secret_production&gt;
WAVE_SUCCESS_URL=https://samaRemorque.sn/paiement/succes
WAVE_ERROR_URL=https://samaRemorque.sn/paiement/erreur
WAVE_WEBHOOK_SECRET=&lt;webhook_secret&gt;</code></pre>
            <p class="mt-3 text-sm text-slate-600">Passez <code class="bg-slate-100 px-2 py-0.5 rounded">WAVE_ENVIRONMENT</code> a <code class="bg-slate-100 px-2 py-0.5 rounded">production</code> une fois les tests termines.</p>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 4 — Enregistrer l'URL Webhook</h2>
            <ol class="list-decimal list-inside space-y-3 text-sm text-slate-700">
                <li>Dans le Dev Portal, allez dans <strong>Webhooks</strong>.</li>
                <li>Ajoutez l'URL : <code class="bg-slate-100 px-2 py-0.5 rounded"><?php echo e(url('/webhook/wave')); ?></code></li>
                <li>Selectionnez l'evenement <code class="bg-slate-100 px-2 py-0.5 rounded">checkout.completed</code>.</li>
                <li>Collez le <strong>Webhook signing secret</strong> dans <code class="bg-slate-100 px-2 py-0.5 rounded">WAVE_WEBHOOK_SECRET</code> dans .env.</li>
            </ol>
            <p class="mt-3 text-xs text-slate-500">Le webhook recoit un POST unique quand un client valide son paiement Wave. La signature est verifiee avant traitement.</p>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 5 — Tester en sandbox</h2>
            <ol class="list-decimal list-inside space-y-3 text-sm text-slate-700">
                <li>Installez l'application <strong>Wave</strong> sur un telephone test (compte sandbox separé).</li>
                <li>Sur le site, creez une intervention puis accedez a la page de paiement.</li>
                <li>Entrez un montant et le numero Wave du telephone sandbox.</li>
                <li>Vous serez redirige vers Wave pour confirmer le paiement.</li>
                <li>Apres confirmation, le webhook met a jour le statut dans la base automatiquement.</li>
            </ol>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Business Model — Marche Senegalais</h2>

            <div class="space-y-6 text-sm text-slate-700">
                <div>
                    <h3 class="font-semibold text-slate-900 mb-2">1. Sources de revenus</h3>
                    <div class="bg-slate-50 rounded-xl p-4 space-y-3">
                        <div>
                            <p class="font-semibold">Commission sur chaque intervention (10-15 %)</p>
                            <p>Apres chaque mission completee, SamaRemorque preleve 10-15 % sur le tarif facture au client. Pour une intervention moyenne a Dakar (10 000 - 15 000 FCFA), la commission est de 1 000 a 2 250 FCFA.</p>
                        </div>
                        <div>
                            <p class="font-semibold">Abonnement mensuel professionnel (10 000 - 25 000 FCFA/mois)</p>
                            <p>Acces a des fonctionnalites avancees : reception prioritaire des demandes, statistiques detaillees, badge de professionnalisme, promotion dans les resultats de recherche.</p>
                        </div>
                        <div>
                            <p class="font-semibold">Frais de mise en relation (500 - 1 000 FCFA/demande)</p>
                            <p>Pour les demandes acceptees via la selection automatique ou les demandes ciblees, un petit frais de service est preleve sur le cote du client.</p>
                        </div>
                        <div>
                            <p class="font-semibold">Publicites locales / partenariats</p>
                            <p>Partenariats avec les garages, assurances automobiles (AON, Colina, SAAR) et fournisseurs de pieces auto. Possibilite de montrer des offres ciblees aux professionnels.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold text-slate-900 mb-2">2. Estimation des revenus (annee 1-2)</h3>
                    <table class="w-full border border-slate-200 rounded-xl overflow-hidden text-xs">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-3 py-2 text-left">Hypothese</th>
                                <th class="px-3 py-2 text-right">Conservateur</th>
                                <th class="px-3 py-2 text-right">Realiste</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2">Interventions / mois</td>
                                <td class="px-3 py-2 text-right">100</td>
                                <td class="px-3 py-2 text-right">300</td>
                            </tr>
                            <tr class="border-t border-slate-100 bg-slate-50">
                                <td class="px-3 py-2">Tarif moyen</td>
                                <td class="px-3 py-2 text-right">10 000 FCFA</td>
                                <td class="px-3 py-2 text-right">12 000 FCFA</td>
                            </tr>
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2">Commission (12 %)</td>
                                <td class="px-3 py-2 text-right">1 200 FCFA</td>
                                <td class="px-3 py-2 text-right">1 440 FCFA</td>
                            </tr>
                            <tr class="border-t border-slate-100 bg-slate-50">
                                <td class="px-3 py-2">Revenus commission / mois</td>
                                <td class="px-3 py-2 text-right font-bold">120 000 FCFA</td>
                                <td class="px-3 py-2 text-right font-bold">432 000 FCFA</td>
                            </tr>
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2">Abonnements (x20 pros)</td>
                                <td class="px-3 py-2 text-right">200 000 FCFA</td>
                                <td class="px-3 py-2 text-right">500 000 FCFA</td>
                            </tr>
                            <tr class="border-t border-slate-200 bg-orange-50">
                                <td class="px-3 py-2 font-bold">Total mensuel</td>
                                <td class="px-3 py-2 text-right font-bold">320 000 FCFA</td>
                                <td class="px-3 py-2 text-right font-bold">932 000 FCFA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <h3 class="font-semibold text-slate-900 mb-2">3. Couts principaux (CFA/mois)</h3>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Hebergement serveur + base de donnees : 50 000 - 100 000 FCFA</li>
                        <li>SMS (Twilio) : 15 000 - 40 000 FCFA</li>
                        <li>Frais Wave / mobile money : 1-2 % des transactions</li>
                        <li>Support client (2 agents) : 150 000 - 200 000 FCFA</li>
                        <li>Marketing digital : 50 000 - 100 000 FCFA</li>
                    </ul>
                    <p class="mt-2">Cout mensuel estime : <strong>300 000 - 450 000 FCFA</strong></p>
                </div>

                <div>
                    <h3 class="font-semibold text-slate-900 mb-2">4. Objectifs de lancement (6 premiers mois)</h3>
                    <ol class="list-decimal list-inside space-y-2">
                        <li><strong>Mois 1-2 :</strong> Recruter 30 professionnels verifies a Dakar (Pikine, Guiey, Grand Dakar, Rufisque).</li>
                        <li><strong>Mois 3-4 :</strong> Atteindre 200 interventions / mois dans la region de Dakar.</li>
                        <li><strong>Mois 5-6 :</strong> S'etendre a Thiès et Saint-Louis. Lancer l'abonnement pro premium.</li>
                    </ol>
                </div>

                <div>
                    <h3 class="font-semibold text-slate-900 mb-2">5. Avantages concurrentiels au Senegal</h3>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Pas de concurrence directe : aucun acteur dedie au remorquage / depannage sur mobile au Senegal.</li>
                        <li>Paiement Wave (non disponible chez les concurrents informels).</li>
                        <li>Suivi GPS en temps reel : differentiateur majeur pour la confiance client.</li>
                        <li>Couverture nationale progressive (14 regions) : reseau de professionnels a forte densite.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views\admin\integration.blade.php ENDPATH**/ ?>