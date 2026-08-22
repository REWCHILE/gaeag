<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Services\QrCodeService;
use Illuminate\Http\Request;

class MemberPublicController extends Controller
{
    public function show(string $slug, QrCodeService $qrService)
    {
        $member = Member::where('slug', $slug)
            ->where('is_active', true)
            ->with(['certificates' => function ($query) {
                $query->where('is_verified', true)->orderBy('created_at', 'desc');
            }])
            ->firstOrFail();

        // Ensure QR Code exists
        if (!$member->qr_code_path) {
            $qrPath = $qrService->generateForMemberUrl($member->public_url, $member->slug);
            $member->update(['qr_code_path' => $qrPath]);
        }

        // ProfilePage / Person Schema for SEO
        $profileSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfilePage',
            'mainEntity' => [
                '@type' => 'Person',
                'name' => $member->full_name,
                'jobTitle' => $member->title ?: "Especialista en {$member->category}",
                'description' => $member->bio,
                'image' => $member->photo_url,
                'telephone' => $member->phone,
                'email' => $member->email,
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $member->city,
                    'addressRegion' => $member->region,
                    'addressCountry' => 'CL'
                ],
                'worksFor' => [
                    '@type' => 'Organization',
                    'name' => 'Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG',
                    'url' => url('/')
                ],
                'hasCredential' => $member->certificates->map(function ($cert) {
                    return [
                        '@type' => 'EducationalOccupationalCredential',
                        'credentialCategory' => 'Certificado SEC',
                        'name' => $cert->title,
                        'recognizedBy' => [
                            '@type' => 'Organization',
                            'name' => $cert->issuing_entity
                        ],
                        'identifier' => $cert->certificate_number
                    ];
                })->toArray()
            ]
        ];

        return view('members.show', compact('member', 'profileSchema'));
    }
}
