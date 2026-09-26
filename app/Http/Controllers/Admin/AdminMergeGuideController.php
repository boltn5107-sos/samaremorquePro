<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Page de documentation interne (espace admin) : incidents de merge et
 * procedure de merge a suivre.
 *
 * Cette page est volontairement statique. Elle n'execute aucun appel a git :
 * le conteneur de production ne contient pas de depot, et une page web ne doit
 * jamais lancer de commande systeme. Elle documente ce qui a ete casse, comment
 * le diagnostiquer, et la procedure a appliquer au prochain merge.
 *
 * L'etat de deploiement est en revanche calcule a la volee, pour que la page ne
 * dise pas vert si la configuration ne l'est plus.
 */
class AdminMergeGuideController extends Controller
{
    /**
     * Incidents resolus, du plus recent au plus ancien.
     *
     * 'commit' est le correctif, 'incident' la cause d'origine. Conserve pour
     * pouvoir remonter a l'inverse depuis un symptome reencountere.
     */
    private const INCIDENTS = [
        [
            'symptom' => 'Les blocs de commandes sont invisibles : texte clair sur fond sombre, alors que le HTML est parfaitement correct.',
            'cause' => 'Tailwind ne compile que les classes qu\'il trouve dans les sources. Le bundle CSS local datait d\'avant la creation de cette page : .bg-slate-900 existait deja (utilise ailleurs dans l\'application), donc le fond etait applique, tandis que .text-slate-100, propre a cette page, n\'avait jamais ete genere. Le texte prenait la couleur par defaut, claire, sur un fond sombre.',
            'fix' => 'npm run build. public/build est dans .gitignore et .dockerignore, et le Dockerfile execute npm run build puis recopie le resultat : la production n\'etait donc pas concernee, seul l\'affichage local l\'etait. Le piege reste actif en developpement : toute vue nouvelle introduisant des classes inédites exige un build avant d\'etre lisible.',
            'file' => null,
            'commit' => null,
        ],
        [
            'symptom' => 'La carte affiche « API KEY REQUIRED » sur toutes les pages.',
            'cause' => 'CARTO (basemaps.cartocdn.com) sert desormais une image d\'erreur en HTTP 200. Sa cle API est devenue obligatoire. Le gabarit de tuiles utilisait aussi {r} (retina), qu\'un fournisseur sans tuiles @2x refuse en 400.',
            'fix' => 'Fournisseur sans cle (Esri World Street Map) et suppression du {r}. Les 10 appels L.tileLayer disperses dans 8 vues lisent desormais config/map.php, donc un changement de fournisseur ne demande plus qu\'une variable d\'environnement.',
            'file' => 'config/map.php',
            'commit' => 'abdd722',
        ],
        [
            'symptom' => 'Uncaught TypeError: this.onAdd is not a function, la carte ne s\'affiche pas.',
            'cause' => 'L.control({...}).onAdd = function () {...} assignait onAdd a un objet immediatement jete, puis un second L.control({...}).addTo(map) etait cree sans onAdd. Control.addTo appelle this.onAdd(map) directement et L.Control ne definit pas onAdd.',
            'fix' => 'Le controle est desormais conserve dans une variable, onAdd y est assigne, puis addTo est appele sur ce meme objet. Corrige sur les 3 pages concernees (admin, depanneur, remorqueur).',
            'file' => 'resources/views/depanneur/intervention-detail.blade.php',
            'commit' => 'abdd722',
        ],
        [
            'symptom' => 'Leaflet charge trois fois par page, et sa feuille de style n\'etait pas chargee du tout.',
            'cause' => 'Le bundle Vite expose deja window.L, mais le layout chargeait en plus une copie depuis le CDN, et deux vues guest en chargeaient une troisieme. Le CSS extrait par Vite dans un fichier additionnel n\'etait pas lu : le layout ne lisait que resources/css/app.css.',
            'fix' => 'Source unique : le bundle. Le layout charge aussi les CSS additionnels de l\'entree JS declarees dans le manifest, avant app.css pour conserver l\'ordre de cascade. Environ 165 Ko economises par page, et plus de dependance a un tiers pour une fonctionnalite centrale.',
            'file' => 'resources/views/layouts/app.blade.php',
            'commit' => 'abdd722',
        ],
        [
            'symptom' => 'pint --test echouait sur 80 fichiers alors que le code n\'avait pas change.',
            'cause' => 'core.autocrlf=true sans .gitattributes : le checkout reecrivait tout le projet en CRLF alors que l\'index le stocke en LF, et Pint impose LF. Le diff apres passage de Pint etait vide, donc aucun changement reel.',
            'fix' => 'Ajout de .gitattributes avec * text=auto eol=lf. Le depot est desormais identique quel que soit le poste, ce qui supprime ce faux positif et le bruit de diff.',
            'file' => '.gitattributes',
            'commit' => 'd024dda',
        ],
        [
            'symptom' => 'Menu duplique, et styles de la branche elmor perdus.',
            'cause' => 'Le merge de main dans elmor a concatene les deux versions de navbar.blade.php : 501 lignes, deux balises <nav> et deux blocs de script, dont un lien vers admin.integration',
            'fix' => 'Navbar ramenee a une seule version, en conservant le style de elmor (fond nuit, logo Wave) et le lien admin.integration venu de main. Le merge a ete refait en fast-forward et non en commit de merge.',
            'file' => 'resources/views/layouts/partials/navbar.blade.php',
            'commit' => '26ce783',
        ],
        [
            'symptom' => '161 fichiers d\'artefacts de build et d\'execution versionnes.',
            'cause' => '154 vues Blade compilees, 5 logs et bootstrap/cache/packages.php + services.php etaient suivis par git.',
            'fix' => 'De-versionnement et .gitignore dans chaque dossier runtime, pour que le dossier existe toujours dans un clone frais.',
            'file' => 'storage/framework/views/.gitignore',
            'commit' => 'db90fda',
        ],
        [
            'symptom' => 'Aucune suite de tests ne pouvait exister.',
            'cause' => 'composer.json ne declarait pas autoload-dev, et .gitignore ignorait /phpunit.xml.',
            'fix' => 'autoload-dev ajoute, phpunit.xml versionne avec SQLite en memoire, et deux incoherences de .gitignore corrigees : .dockerignore etait versionne alors meme que sa propre regle le declarait ignore, et il est necessaire au build Docker.',
            'file' => 'phpunit.xml',
            'commit' => 'c44b7b4',
        ],
        [
            'symptom' => '86 fichiers hors du formatage du projet.',
            'cause' => 'Pint etait installe mais n\'avait jamais ete execute sur la base.',
            'fix' => 'Formatage applique dans un commit isole et purement cosmetique, pour qu\'une relecture puisse l\'ignorer.',
            'file' => null,
            'commit' => 'e87c26d',
        ],
    ];

    /**
     * Etape de la procedure de merge, dans l'ordre ou elles doivent etre faites.
     */
    private const PROCEDURE = [
        [
            'titre' => 'Toujours travailler sur une branche dediee, jamais sur main',
            'corps' => 'main est la branche de production : elle declenche le redéploiement a chaque push. Commencer par se synchroniser, puis traeer sa branche.',
            'code' => "git checkout main\ngit pull --ff-only\ngit checkout -b elmor",
        ],
        [
            'titre' => 'Traiter les conflits de l\'integration en premier, pas a la fin',
            'corps' => 'Reprendre les conflits alors que l\'on edite le code ajoute des erreurs de second niveau. Merger d\'abord, corriger ensuite, et commiter chaque etape.',
            'code' => "git fetch origin\ngit merge origin/main",
        ],
        [
            'titre' => 'Verifier l\'absence de divergence avant de merger',
            'corps' => 'C\'est le controle qui a evite un commit de merge inutile. Si la commande affiche 0, le fast-forward est possible et le merge ne creera pas de commit.',
            'code' => 'git rev-list --count origin/elmor..origin/main',
        ],
        [
            'titre' => 'Aprs un conflit : nettoyer le cache avant de conclure',
            'corps' => 'Une vue compilee en cache peut garder l\'ancienne version et donner l\'impression que le correctif est sans effet. Verifier le fichier source, pas ce qui est servi.',
            'code' => "php artisan view:clear\nphp artisan view:cache",
        ],
        [
            'titre' => 'Verifier sur un clone frais, pas seulement en local',
            'corps' => 'Un clone revele ce qu\'un working directory masque : artefacts forgets, dossiers absents, .gitignore incoherents. C\'est ce controle qui a montre les 161 fichiers versionnes.',
            'code' => "git clone --no-hardlinks . ../clone-test\ncd ../clone-test && php artisan test",
        ],
        [
            'titre' => 'Pousser d\'abord la branche de travail, puis merger sur main',
            'corps' => 'La branche de travail garde l\'historique lisible et permet un retour arriere. Le passage sur main se fait en fast-forward quand il n\'y a pas de divergence.',
            'code' => "git push origin elmor\ngit checkout main\ngit merge --ff-only elmor\ngit push origin main",
        ],
    ];

    /**
     * Pieges recurrants, avec le symptome qui les revele.
     */
    private const PIEGES = [
        [
            'piege' => 'Un fichier qui cree deux fois le meme element dans la page',
            'symptom' => 'Menu, barre de navigation ou bloc de script duplique. Un merge qui « marche » sans erreur peut produire un fichier contenant les deux versions du meme fichier.',
            'verif' => 'Compter l\'occurrence : findstr /s /c:"<nav id=\\"main-nav\\"" resources\\views\\layouts\\partials\\navbar.blade.php',
        ],
        [
            'piege' => 'Un .gitignore qui contredit le depot',
            'symptom' => 'Un fichier est versionne alors que sa regle d\'ignore leDeclare. .dockerignore etait precisely dans ce cas, et sa regle etait donc inoperante.',
            'verif' => 'git check-ignore -v <fichier> pour un fichier non suivi, ou git ls-files pour un fichier suivi.',
        ],
        [
            'piege' => 'Des artefacts d\'execution dans le depot',
            'symptom' => 'Vues compilees, logs et caches versionnes : des diffs enormes sans rapport avec le code, et un risque de fuite de donnees via les logs.',
            'verif' => 'git ls-files storage/framework/views storage/logs bootstrap/cache ne doit rien retourner.',
        ],
        [
            'piege' => 'Une dependance a un tiers pour une fonctionnalite centrale',
            'symptom' => 'La carte s\'affiche chez un utilisateur et pas chez l\'autre, selon que le CDN est joignable ou bloque. Aucune erreur PHP n\'est levee, ce qui la rend tres difficile a diagnostiquer.',
            'verif' => 'Chercher les <script src> vers un CDN dans les vues, et les comparer aux imports du bundle.',
        ],
        [
            'piege' => 'Un test qui n\'a jamais echoue',
            'symptom' => 'Un test passe mais ne prouve rien s\'il n\'a pas ete eprouve. Chaque test de non-regression doit d\'abord reproduire le bug, sinon il ne sera pas cale sur le bon symptome.',
            'verif' => 'Reintroduire volontairement le bug, constater l\'echec, puis restaurer.',
        ],
    ];

    public function index()
    {
        /*
         * Etat reel calcule a la volee. Si le build Vite est absent, la page
         * affiche un avertissement plutot que d'annoncer un etat healthy : une
         * documentation qui ment est pire qu'une documentation absente.
         */
        $manifestPath = public_path('build/manifest.json');
        $manifest = is_file($manifestPath) ? (json_decode(file_get_contents($manifestPath), true) ?: []) : null;

        $deploiement = [
            'build_present' => $manifest !== null,
            'js_asset' => isset($manifest['resources/js/app.js']['file'])
                ? 'build/'.$manifest['resources/js/app.js']['file']
                : null,
            'leaflet_css' => isset($manifest['resources/js/app.js']['css'][0])
                ? 'build/'.$manifest['resources/js/app.js']['css'][0]
                : null,
            'tile_provider' => config('map.tiles.url'),
        ];

        return view('admin.merge-guide', [
            'incidents' => self::INCIDENTS,
            'procedure' => self::PROCEDURE,
            'pieges' => self::PIEGES,
            'deploiement' => $deploiement,
        ]);
    }
}
