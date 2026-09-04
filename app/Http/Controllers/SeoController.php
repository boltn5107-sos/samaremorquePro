<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function sitemap()
    {
        $baseUrl = url('/');

        $urls = [
            ['loc' => $baseUrl . '/', 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => $baseUrl . '/login', 'changefreq' => 'monthly', 'priority' => '0.3'],
            ['loc' => $baseUrl . '/register', 'changefreq' => 'monthly', 'priority' => '0.5'],
        ];

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
        $baseUrl = url('/');

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
