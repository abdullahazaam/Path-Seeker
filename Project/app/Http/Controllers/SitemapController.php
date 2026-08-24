<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Multimedia;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate and return the dynamic XML Sitemap.
     */
    public function index(): Response
    {
        $careers = Career::select('id', 'updated_at')->orderBy('id')->get();
        $multimedia = Multimedia::select('id', 'updated_at')->orderBy('id')->get();

        $staticPages = [
            [
                'loc' => url('/'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('careers.index'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            [
                'loc' => route('quiz.index'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('multimedia.index'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('resources.index'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static Pages
        foreach ($staticPages as $page) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($page['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "    <lastmod>" . $page['lastmod'] . "</lastmod>\n";
            $xml .= "    <changefreq>" . $page['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $page['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        // Dynamic Careers
        foreach ($careers as $career) {
            $lastmod = ($career->updated_at ?? now())->tz('UTC')->toAtomString();
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars(route('careers.show', $career->id), ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "    <lastmod>" . $lastmod . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
        }

        // Dynamic Multimedia
        foreach ($multimedia as $item) {
            $lastmod = ($item->updated_at ?? now())->tz('UTC')->toAtomString();
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars(route('multimedia.show', $item->id), ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "    <lastmod>" . $lastmod . "</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
