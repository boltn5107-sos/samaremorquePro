<?php

/*
 * Source unique des tuiles de carte.
 *
 * Leaflet est bundle par Vite (resources/js/app.js expose window.L), le
 * fournisseur de tuiles etait jusqu ici code en dur dans chaque vue. Deux
 * problemes ont ete observes :
 *
 *  - CARTO (basemaps.cartocdn.com) sert desormais une image d'erreur
 *    « API KEY REQUIRED » en HTTP 200 : sa cle API est devenue obligatoire.
 *  - Le gabarit utilisait {r} (tuiles retina). Un fournisseur qui ne les
 *    propose pas repond 400 et la carte reste grise sur les ecrans HiDPI.
 *
 * Esri World Street Map ne demande aucune cle, n'a pas de variante retina
 * (donc pas de {r}) et sert du JPEG, donc plus léger qu'une tuile PNG.
 *
 * Pour un style plus léger (~11 Ko/tuile au lieu de ~34 Ko) :
 *   MAP_TILE_URL=https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}
 *
 * Ou pour revenir sur CARTO/MapTiler, il suffit de renseigner une URL
 * contenant votre cle dans MAP_TILE_URL, sans toucher au code.
 */

return [

    'tiles' => [
        'url' => env(
            'MAP_TILE_URL',
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'
        ),

        'attribution' => env(
            'MAP_TILE_ATTRIBUTION',
            'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, USGS, USDA, NPS'
        ),

        'max_zoom' => (int) env('MAP_TILE_MAX_ZOOM', 19),
    ],

];
