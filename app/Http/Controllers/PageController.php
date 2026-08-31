<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function quienesSomos()
    {
        $president = Member::where('slug', 'domingo-isain-plaza-caamano')->first()
            ?? Member::where('is_active', true)->first();

        $membersCount = Member::where('is_active', true)->count();

        return view('pages.quienes_somos', compact('president', 'membersCount'));
    }

    public function beneficios()
    {
        $faqs = Faq::where('is_published', true)->orderBy('order', 'asc')->get();
        return view('pages.beneficios', compact('faqs'));
    }

    public function unete()
    {
        return view('pages.unete');
    }

    public function sitemap()
    {
        $members = Member::where('is_active', true)->with('certificates')->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        // Static routes
        $staticRoutes = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('pages.quienes_somos'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('pages.beneficios'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('pages.unete'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ];

        foreach ($staticRoutes as $route) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($route['url']) . "</loc>\n";
            $xml .= '    <lastmod>' . date('Y-m-d') . "</lastmod>\n";
            $xml .= '    <changefreq>' . $route['changefreq'] . "</changefreq>\n";
            $xml .= '    <priority>' . $route['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        // Public members profiles with photo and certificate images for Google Image Search
        foreach ($members as $member) {
            $memberUrl = route('members.public_show', ['slug' => $member->slug]);
            $lastmod = $member->updated_at ? $member->updated_at->format('Y-m-d') : date('Y-m-d');

            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($memberUrl) . "</loc>\n";
            $xml .= '    <lastmod>' . $lastmod . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";

            if ($member->photo_url) {
                $xml .= "    <image:image>\n";
                $xml .= '      <image:loc>' . htmlspecialchars($member->photo_url) . "</image:loc>\n";
                $xml .= '      <image:title>' . htmlspecialchars($member->full_name . ' - Instalador SEC GAE AG') . "</image:title>\n";
                $xml .= "    </image:image>\n";
            }

            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    public function robots()
    {
        $filePath = public_path('robots.txt');
        if (file_exists($filePath)) {
            return response(file_get_contents($filePath), 200, ['Content-Type' => 'text/plain; charset=utf-8']);
        }

        $sitemapUrl = route('sitemap');
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\n\nSitemap: {$sitemapUrl}\n";
        return response($content, 200, ['Content-Type' => 'text/plain; charset=utf-8']);
    }

    public function llmsTxt()
    {
        $filePath = public_path('llms.txt');
        if (file_exists($filePath)) {
            return response(file_get_contents($filePath), 200, ['Content-Type' => 'text/plain; charset=utf-8']);
        }

        return response("# GAE AG\nSitio oficial de la Asociación Gremial de Profesionales del Gas, Agua y Energía.", 200, ['Content-Type' => 'text/plain; charset=utf-8']);
    }

    public function llmsFullTxt()
    {
        $filePath = public_path('llms-full.txt');
        if (file_exists($filePath)) {
            return response(file_get_contents($filePath), 200, ['Content-Type' => 'text/plain; charset=utf-8']);
        }

        return response("# GAE AG - Documentación Completa", 200, ['Content-Type' => 'text/plain; charset=utf-8']);
    }
}
