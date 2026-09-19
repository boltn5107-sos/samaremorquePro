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
                    <dd class="font-mono text-xs bg-slate-50 rounded-lg p-2 mt-1"><?php echo e(route('payment.wave.webhook')); ?></dd>
                </div>
            </dl>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Le modele retenu — La commission est payee par le professionnel</h2>

            <div class="bg-orange-50 border-l-4 border-orange-400 rounded-r-xl p-4 text-sm text-slate-700">
                <p class="font-semibold mb-1">Principe central : la plateforme ne passe jamais par la caisse du client.</p>
                <p>Le client paie le professionnel <strong>sur place</strong> (cash ou Wave P2P), comme dans son habitude. La plateforme se remunere par une <strong>commission fixe</strong> payee par le professionnel sur chaque intervention terminee et validee.</p>
            </div>

            <h3 class="font-semibold text-slate-900 mt-6 mb-2">1. Le parcours complet (V1)</h3>
            <ol class="list-decimal list-inside space-y-2 text-sm text-slate-700">
                <li>Le client en panne cree sa demande (option GPS ou position manuelle).</li>
                <li>Le professionnel accepte l'intervention et intervient.</li>
                <li>Le professionnel renseigne le <strong>prix de la course</strong> dans l'app a la fin de l'intervention.</li>
                <li>Le <strong>client confirme ou conteste ce prix</strong> : c'est la <em>trace du contrat</em> (preuve que l'intervention a bien eu lieu et pour quel montant).</li>
                <li>Des la confirmation, une <strong>commission fixe</strong> (ex. 750 FCFA) est ajoutee au <strong>solde dû</strong> du professionnel.</li>
                <li>Le professionnel paie son solde via <strong>Wave Checkout</strong> : une notification arrive sur <strong>SON</strong> telephone, il valide avec son code PIN, et l'argent est verse au compte Wave Business SamaRemorque.</li>
                <li>Le webhook Wave confirme le paiement, le solde baisse, la trace est conservee dans la table <code class="bg-slate-100 px-1.5 py-0.5 rounded">payments</code>.</li>
            </ol>

            <h3 class="font-semibold text-slate-900 mt-6 mb-2">2. Pourquoi pas de trace de paiement du client ?</h3>
            <p class="text-sm text-slate-700">Ce sont <strong>deux contrats distincts</strong> :</p>
            <div class="mt-2 bg-slate-50 rounded-xl p-4 font-mono text-xs text-slate-700 space-y-1">
                <div>Client ──paiement cash/Wave──▶ Pro <span class="text-slate-400">(contrat n°1 : la course, reglee sur place)</span></div>
                <div>Pro ────commission Wave─────▶ Plateforme <span class="text-slate-400">(contrat n°2 : due des que l'intervention est terminee + validee)</span></div>
            </div>
            <p class="mt-3 text-sm text-slate-700">
                La commission est declenchee par <strong>l'evenement "intervention terminee + prix valide par le client"</strong>, pas par un recu de paiement.
                Si l'on voulait une vraie trace bancaire cote client, il faudrait faire payer le client via l'app (modele "VTC"), ce qui impose la friction client
                et l'accord <em>payout</em> Wave. Ici on evite ces deux freins.
            </p>

            <h3 class="font-semibold text-slate-900 mt-6 mb-2">3. Le solde dû et le blocage (motivation au paiement)</h3>
            <p class="text-sm text-slate-700 mb-3">Wave ne permet pas le prelevement automatique : le professionnel doit valider chaque paiement. Pour qu'il paie, on met en place :</p>
            <ul class="list-disc list-inside space-y-2 text-sm text-slate-700">
                <li>Un <strong>solde de commissions dues</strong> affiche sur le dashboard du professionnel ("Vous devez : 2 250 FCFA").</li>
                <li>Un <strong>seuil de blocage</strong> (ex. 3 commissions = 2 250 FCFA) : au-dela, le professionnel ne recoit plus de nouvelles demandes tant qu'il n'a pas regularise une partie de son solde.</li>
                <li>Un bouton <strong>"Payer mes commissions"</strong> qui lance un checkout Wave restreint au numero du professionnel.</li>
                <li>(Evolution) Un <strong>porte-monnaie prepaye</strong> pour lisser les paiements des pros reguliers.</li>
            </ul>

            <h3 class="font-semibold text-slate-900 mt-6 mb-2">4. Table de donnees</h3>
            <p class="text-sm text-slate-700 mb-2">Le modele s'appuie sur la table <code class="bg-slate-100 px-1.5 py-0.5 rounded">payments</code> (deja existante) :</p>
            <table class="w-full border border-slate-200 rounded-xl overflow-hidden text-xs">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Champ</th>
                        <th class="px-3 py-2 text-left">Role</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">payable_type / payable_id</td>
                        <td class="px-3 py-2">Intervention (ou pro) associee au paiement (polymorphique).</td>
                    </tr>
                    <tr class="border-t border-slate-100 bg-slate-50">
                        <td class="px-3 py-2 font-mono">user_id</td>
                        <td class="px-3 py-2">Le payeur : ici le professionnel (remorqueur / depanneur).</td>
                    </tr>
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">provider = 'wave'</td>
                        <td class="px-3 py-2">Canal de paiement (Wave, bientot Orange Money...).</td>
                    </tr>
                    <tr class="border-t border-slate-100 bg-slate-50">
                        <td class="px-3 py-2 font-mono">checkout_id / transaction_id</td>
                        <td class="px-3 py-2">Identifiants de session Wave pour retrouver/verifier un paiement.</td>
                    </tr>
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">client_reference</td>
                        <td class="px-3 py-2">Reference metier (ex. COM-1-XXXX pour une commission).</td>
                    </tr>
                    <tr class="border-t border-slate-100 bg-slate-50">
                        <td class="px-3 py-2 font-mono">amount / currency</td>
                        <td class="px-3 py-2">Montant de la commission (XOF, entier).</td>
                    </tr>
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">status</td>
                        <td class="px-3 py-2">pending / processing / paid / failed / cancelled / expired / refunded.</td>
                    </tr>
                    <tr class="border-t border-slate-100 bg-slate-50">
                        <td class="px-3 py-2 font-mono">raw_payload</td>
                        <td class="px-3 py-2">JSON recu de Wave (trace complete du checkout).</td>
                    </tr>
                </tbody>
            </table>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 1 — Creer un compte Wave Business</h2>
            <ol class="list-decimal list-inside space-y-3 text-sm text-slate-700">
                <li>Rendez-vous sur <strong>business.wave.com</strong> et creez un compte Wave Business (SamaRemorque SARL ou equivalent).</li>
                <li>Completez la verification KYC (pieces d'identite, RNE, KBIS). La validation prend 24 a 72h.</li>
                <li>Une fois valide, activez les <strong>paiements Wave Money</strong> dans le tableau de bord.</li>
                <li>Parametrez votre <strong>compte marchand</strong> : numero Wave recolteur, compte bancaire de virement.</li>
            </ol>
            <p class="mt-3 text-xs text-slate-500">
                <strong>Note :</strong> ce modele ne necessite <strong>pas</strong> la souscription au produit <em>payout</em> (verseements sortants).
                On encaisse des commissions, on ne reverse jamais d'argent vers un tiers.
            </p>
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
                <li>Ajoutez l'URL : <code class="bg-slate-100 px-2 py-0.5 rounded"><?php echo e(route('payment.wave.webhook')); ?></code></li>
                <li>Selectionnez l'evenement <code class="bg-slate-100 px-2 py-0.5 rounded">checkout.completed</code>.</li>
                <li>Collez le <strong>Webhook signing secret</strong> dans <code class="bg-slate-100 px-2 py-0.5 rounded">WAVE_WEBHOOK_SECRET</code> dans .env.</li>
            </ol>
            <p class="mt-3 text-xs text-slate-500">Le webhook recoit un POST unique quand le professionnel valide son paiement Wave. La signature est verifiee avant traitement dans <code class="bg-slate-100 px-2 py-0.5 rounded">WaveWebhookController</code>.</p>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Etape 5 — Tester en sandbox</h2>
            <ol class="list-decimal list-inside space-y-3 text-sm text-slate-700">
                <li>Installez l'application <strong>Wave</strong> sur un telephone test (compte sandbox separe).</li>
                <li>Creez une intervention, terminez-la, validez le prix cote client : une commission est ajoutee au solde du professionnel.</li>
                <li>Depuis le dashboard pro, lancez <strong>"Payer mes commissions"</strong>.</li>
                <li>Validez le paiement sur le telephone Wave sandbox.</li>
                <li>Verifiez que le <strong>webhook</strong> passe le paiement en <code class="bg-slate-100 px-2 py-0.5 rounded">paid</code> et que le solde du pro diminue.</li>
            </ol>
        </div>

        
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Code concerne — mise en place prevue en V1</h2>
            <table class="w-full border border-slate-200 rounded-xl overflow-hidden text-xs">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Composant</th>
                        <th class="px-3 py-2 text-left">Statut</th>
                        <th class="px-3 py-2 text-left">Role</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">app/Services/WavePaymentService.php</td>
                        <td class="px-3 py-2 text-emerald-600 font-semibold">Prêt</td>
                        <td class="px-3 py-2">Client HTTP Wave (checkout, verification, refund, signature webhook).</td>
                    </tr>
                    <tr class="border-t border-slate-100 bg-slate-50">
                        <td class="px-3 py-2 font-mono">app/Models/Payment.php</td>
                        <td class="px-3 py-2 text-emerald-600 font-semibold">Prêt</td>
                        <td class="px-3 py-2">Trace de chaque paiement (morph + user + statuts).</td>
                    </tr>
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">app/Http/Controllers/Payment/*</td>
                        <td class="px-3 py-2 text-amber-600 font-semibold">En cours</td>
                        <td class="px-3 py-2">Checkout initie par le <strong>pro</strong> + webhook de confirmation.</td>
                    </tr>
                    <tr class="border-t border-slate-100 bg-slate-50">
                        <td class="px-3 py-2 font-mono">commission du solde pro</td>
                        <td class="px-3 py-2 text-red-600 font-semibold">A construire</td>
                        <td class="px-3 py-2">Colonne solde / montant commission, prix valide par le client, seuil de blocage dans InterventionMatchingService.</td>
                    </tr>
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 font-mono">bouton "Payer" dashboard pro</td>
                        <td class="px-3 py-2 text-red-600 font-semibold">A construire</td>
                        <td class="px-3 py-2">Parcours UI pro : solde dû + lancer le checkout Wave.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\samaRemorque\senegal-towing\resources\views/admin/integration.blade.php ENDPATH**/ ?>