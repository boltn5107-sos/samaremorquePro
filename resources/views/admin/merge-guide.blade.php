@extends('layouts.app')

@section('title', 'Guide de merge et incidents resolus')

@section('content')
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-8">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">Guide de merge et incidents resolus</h1>
            <p class="text-sm text-slate-500 mt-1">
                Ce qui a cassé lors du dernier merge de <code class="bg-slate-100 px-1.5 py-0.5 rounded">main</code> dans
                <code class="bg-slate-100 px-1.5 py-0.5 rounded">elmor</code>, comment le diagnostiquer, et la procédure à appliquer au prochain merge.
            </p>
        </div>

        {{-- Etat reel, calcule a la volee : la page ne doit pas annoncer un etat healthy si ce n'est pas le cas --}}
        @unless ($deploiement['build_present'])
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 text-sm">
                <p class="font-semibold">Build Vite absent</p>
                <p class="mt-1">
                    Le fichier <code class="bg-red-100 px-1 py-0.5 rounded">public/build/manifest.json</code> est introuvable :
                    la feuille de style Leaflet et le bundle JavaScript ne seront pas servis, et les cartes ne s'afficheront pas.
                    Lancer <code class="bg-red-100 px-1 py-0.5 rounded">npm run build</code> puis <code class="bg-red-100 px-1 py-0.5 rounded">php artisan view:clear</code>.
                </p>
            </div>
        @endunless

        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Déploiement actuel</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-slate-500">Bundle JavaScript (contient Leaflet)</dt>
                    <dd class="font-mono text-xs bg-slate-50 rounded-lg p-2 mt-1 break-all">
                        {{ $deploiement['js_asset'] ?? 'absent — lancer npm run build' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500">Feuille de style Leaflet (fichier additionnel Vite)</dt>
                    <dd class="font-mono text-xs bg-slate-50 rounded-lg p-2 mt-1 break-all">
                        {{ $deploiement['leaflet_css'] ?? 'absent — lancer npm run build' }}
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-slate-500">Fournisseur de tuiles (défini dans <code>config/map.php</code>)</dt>
                    <dd class="font-mono text-xs bg-slate-50 rounded-lg p-2 mt-1 break-all">{{ $deploiement['tile_provider'] }}</dd>
                </div>
            </dl>
            <p class="text-xs text-slate-500 mt-3">
                Ces trois valeurs sont lues à la volée. Si le build disparaît, cette page le signale au lieu d'afficher un état rassurant.
            </p>
        </div>

        {{-- 1. Les incidents --}}
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-1">1. Les incidents résolus</h2>
            <p class="text-sm text-slate-500 mb-4">
                Classés du plus récent au plus ancien. Le symptôme est ce que l'on voit dans le navigateur, la cause est ce qu'il a fallu trouver.
            </p>

            <div class="space-y-4">
                @foreach ($incidents as $incident)
                    <div class="card p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <x-icon name="check-circle" class="w-4 h-4" />
                            </span>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-semibold text-slate-900">{{ $incident['symptom'] }}</h3>

                                <dl class="mt-3 space-y-2 text-sm">
                                    <div>
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-rose-600">Cause</dt>
                                        <dd class="text-slate-700 mt-0.5">{{ $incident['cause'] }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Correctif</dt>
                                        <dd class="text-slate-700 mt-0.5">{{ $incident['fix'] }}</dd>
                                    </div>
                                </dl>

                                <div class="mt-3 flex flex-wrap items-center gap-2 text-xs">
                                    @if ($incident['commit'])
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-mono">{{ $incident['commit'] }}</span>
                                    @endif
                                    @if ($incident['file'])
                                        <span class="px-2 py-0.5 rounded bg-slate-50 text-slate-500 font-mono break-all">{{ $incident['file'] }}</span>
                                    @endif
                                    @unless ($incident['commit'] || $incident['file'])
                                        <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700">pas encore versionne</span>
                                    @endunless
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 2. La procedure --}}
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-1">2. La procédure pour le prochain merge</h2>
            <p class="text-sm text-slate-500 mb-4">
                Dans l'ordre. Chaque étape a une raison d'être : les étapes ne sont pas décoratives, chacune évite un piège précis.
            </p>

            <ol class="space-y-4">
                @foreach ($procedure as $index => $etape)
                    <li class="card p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-900 text-white text-xs font-bold flex items-center justify-center">
                                {{ $index + 1 }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-semibold text-slate-900">{{ $etape['titre'] }}</h3>
                                <p class="text-sm text-slate-600 mt-1">{{ $etape['corps'] }}</p>
                                <pre class="mt-3 bg-slate-900 text-slate-100 rounded-xl p-4 text-xs overflow-x-auto leading-relaxed"><code>{{ $etape['code'] }}</code></pre>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        {{-- 3. Les pieges --}}
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-1">3. Les pièges récurrents</h2>
            <p class="text-sm text-slate-500 mb-4">
                Chacun a manifestations un symptôme reconnaissable, et une vérification qui prend quelques secondes.
            </p>

            <div class="card divide-y divide-slate-100">
                @foreach ($pieges as $piege)
                    <div class="p-5">
                        <h3 class="font-semibold text-slate-900 flex items-start gap-2">
                            <x-icon name="alert-triangle" class="w-4 h-4 text-amber-500 mt-0.5 flex-shrink-0" />
                            {{ $piege['piege'] }}
                        </h3>
                        <p class="text-sm text-slate-600 mt-2 ml-6">{{ $piege['symptom'] }}</p>
                        <div class="mt-2 ml-6 bg-slate-50 rounded-lg px-3 py-2">
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Vérification</span>
                            <code class="block font-mono text-xs text-slate-700 mt-1 break-all">{{ $piege['verif'] }}</code>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 4. Le rappel qui evite le plus de temps perdu --}}
        <div class="bg-orange-50 border-l-4 border-orange-400 rounded-r-xl p-5 text-sm text-slate-700">
            <p class="font-semibold mb-1">Un merge peut réussir sans erreur et produire un fichier dupliqué.</p>
            <p>
                Git résout un conflit en concaténant les deux versions quand il le peut, et n'affiche rien si les deux blocs
                n'ont aucun mot en commun. Un menu apparaît donc en double, ou une seconde balise <code class="bg-orange-100 px-1 py-0.5 rounded">&lt;nav&gt;</code>,
                sans qu'aucune erreur ne le signale. Après tout merge, compter les éléments qui ne doivent exister qu'une fois
                vaut mieux que de croire le message « merge successful ».
            </p>
        </div>

    </div>
@endsection
