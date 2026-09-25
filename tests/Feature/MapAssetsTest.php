<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Leaflet est bundle par Vite (resources/js/app.js expose window.L).
 * Ces tests verrouillent la consolidation : une seule source, pas de CDN,
 * et un fournisseur de tuiles qui ne demande pas de cle API.
 */
class MapAssetsTest extends TestCase
{
    public function test_the_layout_serves_leaflet_from_the_build_and_not_from_a_cdn(): void
    {
        $manifestPath = public_path('build/manifest.json');

        if (! is_file($manifestPath)) {
            $this->markTestSkipped('build Vite absent : lancer `npm run build` avant.');
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);
        $html = $this->get('/contact')->getContent();

        // Vite extrait le CSS de Leaflet dans un fichier additionnel. Sans lui la
        // carte s'affiche sans style, et c'est ce qui avait conduit a charger le
        // CSS depuis le CDN en doublon.
        foreach ($manifest['resources/js/app.js']['css'] ?? [] as $css) {
            $this->assertStringContainsString(asset('build/'.$css), $html);
        }

        $this->assertStringNotContainsString('cdnjs.cloudflare.com/ajax/libs/leaflet', $html);
    }

    public function test_the_tile_provider_is_exposed_to_javascript(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('window.mapTiles = ', false);
    }

    public function test_the_configured_tile_provider_needs_no_api_key(): void
    {
        $url = config('map.tiles.url');

        $this->assertNotSame('', $url);

        // CARTO sert une image d'erreur « API KEY REQUIRED » sans cle : plus de
        // fournisseur par defaut qui exige une cle, et pas de gabarit {r} que
        // les fournisseurs sans tuiles retina refusent en 400.
        $this->assertStringNotContainsString('basemaps.cartocdn.com', $url);
        $this->assertStringNotContainsString('{r}', $url);
    }
}
