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
        $members = Member::where('is_active', true)->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static routes
        $staticRoutes = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('pages.quienes_somos'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('pages.beneficios'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('pages.unete'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ];

        foreach ($staticRoutes as $route) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($route['url']) . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $xml .= '<changefreq>' . $route['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $route['priority'] . '</priority>';
            $xml .= '</url>';
        }

        // Public members profiles
        foreach ($members as $member) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars(route('members.public_show', ['slug' => $member->slug])) . '</loc>';
            $xml .= '<lastmod>' . ($member->updated_at ? $member->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function robots()
    {
        $sitemapUrl = route('sitemap');
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\n\nSitemap: {$sitemapUrl}\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
