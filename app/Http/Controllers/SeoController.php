<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SeoController extends Controller
{
    public function sitemap()
    {
        $baseUrl = rtrim(url('/'), '/');

        $static = [
            ['loc' => $baseUrl . '/', 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => $baseUrl . '/demande', 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/depannage-dakar', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/remorquage-dakar', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/depannage-urgence-dakar', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/remorquage-senegal', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/depanneur-dakar', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/a-propos', 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => $baseUrl . '/contact', 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => $baseUrl . '/guide-depannage-dakar', 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => $baseUrl . '/confidentialite', 'changefreq' => 'monthly', 'priority' => '0.4'],
            ['loc' => $baseUrl . '/login', 'changefreq' => 'monthly', 'priority' => '0.3'],
            ['loc' => $baseUrl . '/register', 'changefreq' => 'monthly', 'priority' => '0.5'],
        ];

        $urls = $static;

        if (class_exists(\App\Models\Intervention::class)) {
            try {
                \App\Models\Intervention::query()->where('status', '!=', 'brouillon')->orderByDesc('id')->limit(200)->chunk(200, function ($items) use ($baseUrl, &$urls) {
                    foreach ($items as $item) {
                        $urls[] = [
                            'loc' => $baseUrl . '/suivi/' . $item->tracking_code,
                            'changefreq' => 'weekly',
                            'priority' => '0.6',
                        ];
                    }
                });
            } catch (\Throwable $e) {
                // Ignore sitemap population errors to keep the route safe
            }
        }

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . e($url['loc']) . "</loc>\n";
            $xml .= "    <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $url['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>\n";

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $baseUrl = rtrim(url('/'), '/');

        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "Disallow: /forgot-password\n";
        $content .= "Disallow: /reset-password\n";
        $content .= "Disallow: /profile\n";
        $content .= "Disallow: /client\n";
        $content .= "Disallow: /remorqueur\n";
        $content .= "Disallow: /depanneur\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /notifications\n";
        $content .= "\n";
        $content .= "Sitemap: " . $baseUrl . "/sitemap.xml\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
