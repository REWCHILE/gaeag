<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberApplication;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberApplicationController extends Controller
{
    public function index()
    {
        $applications = MemberApplication::orderBy('id', 'desc')->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function approve(MemberApplication $application, QrCodeService $qrService)
    {
        if ($application->status === 'approved') {
            return redirect()->back()->with('error', 'Esta postulación ya fue aprobada.');
        }

        $slug = Str::slug($application->full_name);

        // Check for existing slug collision
        if (Member::where('slug', $slug)->exists()) {
            $slug .= '-' . rand(10, 99);
        }

        // Create active Member profile
        $member = Member::create([
            'slug' => $slug,
            'full_name' => $application->full_name,
            'rut' => $application->rut,
            'sec_licence' => $application->sec_licence ?: 'SEC-GAS-AGUA-' . rand(1000, 9999),
            'category' => $application->category,
            'class' => $application->class ?: 'Clase B SEC',
            'title' => 'Instalador Acreditado GAE AG',
            'phone' => $application->phone,
            'email' => $application->email,
            'city' => $application->city,
            'region' => $application->region,
            'bio' => $application->bio ?: "Especialista acreditado en {$application->category} incorporado a la nómina de GAE AG.",
            'is_active' => true,
            'is_verified' => true,
        ]);

        // Generate official SEC QR code for the new member
        $qrPath = $qrService->generateSecQrCode($member);
        $member->update(['qr_code_path' => $qrPath]);

        $application->update(['status' => 'approved']);

        return redirect()->route('admin.members.show', $member)
            ->with('success', "¡Postulación de {$member->full_name} aprobada con éxito! Se ha creado su perfil público y generado su credencial QR SEC.");
    }

    public function reject(MemberApplication $application)
    {
        $application->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Postulación rechazada.');
    }

    public function destroy(MemberApplication $application)
    {
        $application->delete();
        return redirect()->back()->with('success', 'Solicitud eliminada.');
    }
}
