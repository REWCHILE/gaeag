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

        // Generate Comprehensive JSON-LD Schema for Organization, LocalBusiness and FAQPage
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => ['Organization', 'ProfessionalService', 'LocalBusiness'],
                    '@id' => url('/#organization'),
                    'name' => 'Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG',
                    'alternateName' => ['GAE AG', 'G.A.E. A.G.', 'Asociación Gremial del Gas Agua y Energía'],
                    'url' => url('/'),
                    'logo' => asset('images/GAEGAG.jpg'),
                    'image' => asset('images/GAEGAG.jpg'),
                    'foundingDate' => '2017-01-01',
                    'taxID' => '65.173.361-8',
                    'priceRange' => '$$',
                    'founder' => [
                        '@type' => 'Person',
                        'name' => 'Domingo Isaín Plaza Caamaño',
                        'jobTitle' => 'Presidente y Fundador'
                    ],
                    'description' => 'Asociación gremial oficial chilena fundada en 2017. Agrupa a instaladores, proyectistas y técnicos certificados por la SEC en Gas, Agua y Energías Renovables.',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Av. Providencia 1208, Oficina 207',
                        'addressLocality' => 'Providencia',
                        'addressRegion' => 'Región Metropolitana',
                        'postalCode' => '7500000',
                        'addressCountry' => 'CL'
                    ],
                    'geo' => [
                        '@type' => 'GeoCoordinates',
                        'latitude' => -33.4272,
                        'longitude' => -70.6186
                    ],
                    'openingHoursSpecification' => [
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                            'opens' => '08:30',
                            'closes' => '18:30'
                        ]
                    ],
                    'contactPoint' => [
                        '@type' => 'ContactPoint',
                        'contactType' => 'Atención al Cliente & Acreditaciones SEC',
                        'telephone' => '+56 9 4987 7316',
                        'email' => 'contacto@gae-ag.cl',
                        'areaServed' => 'CL',
                        'availableLanguage' => ['Spanish']
                    ],
                    'knowsAbout' => [
                        'Instalaciones de Gas SEC Clase 1, 2 y 3',
                        'Certificación y Regularización Sello Verde de Gas',
                        'Normativa SEC Decreto Supremo DS66 y DS222',
                        'Instalaciones Sanitarias y Redes de Agua',
                        'Sistemas de Energías Renovables y Solar Térmico'
                    ]
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/#website'),
                    'url' => url('/'),
                    'name' => 'GAE AG - Asociación Gremial del Gas, Agua y Energía',
                    'publisher' => ['@id' => url('/#organization')],
                    'inLanguage' => 'es-CL'
                ]
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
