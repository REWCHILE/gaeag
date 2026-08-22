<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Member;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $president = Member::where('slug', 'domingo-isain-plaza-caamano')->first()
            ?? Member::where('is_active', true)->first();

        $members = Member::where('is_active', true)
            ->with('certificates')
            ->orderBy('id', 'asc')
            ->get();

        $faqs = Faq::where('is_published', true)
            ->orderBy('order', 'asc')
            ->get();

        // Generate JSON-LD Schema for Organization and FAQPage
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG',
            'alternateName' => ['GAE AG', 'G.A.E. A.G.', 'Asociación Gremial del Gas Agua y Energía'],
            'url' => url('/'),
            'logo' => asset('images/GAEGAG.jpg'),
            'foundingDate' => '2017',
            'founder' => [
                '@type' => 'Person',
                'name' => 'Domingo Isaín Plaza Caamaño',
                'jobTitle' => 'Presidente y Fundador'
            ],
            'description' => 'Asociación gremial chilena fundada en 2017 para la constante profesionalización de especialistas en instalaciones de Gas, Agua y Energías Renovables.',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Santiago',
                'addressRegion' => 'Región Metropolitana',
                'addressCountry' => 'CL'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'Presidencia & Atención a Clientes',
                'email' => 'contacto@gae-ag.cl'
            ]
        ];

        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqs->map(function ($faq) {
                return [
                    '@type' => 'Question',
                    'name' => $faq->question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq->answer
                    ]
                ];
            })->toArray()
        ];

        return view('home', compact('president', 'members', 'faqs', 'organizationSchema', 'faqSchema'));
    }
}
