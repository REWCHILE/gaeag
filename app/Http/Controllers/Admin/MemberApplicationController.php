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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'rut' => 'required|string|max:20',
            'sec_licence' => 'nullable|string|max:50',
            'category' => 'required|string|max:100',
            'class' => 'nullable|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'bio' => 'nullable|string|max:1000',
        ]);

        $validated['test_token'] = Str::random(32);
        $validated['psych_status'] = 'pending';
        $validated['status'] = 'pending';

        $application = MemberApplication::create($validated);

        return redirect()->route('admin.applications.index')
            ->with('success', "Postulante {$application->full_name} registrado. Enlace de Test Psicológico generado con éxito.");
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

    public function psychReport(MemberApplication $application)
    {
        return view('admin.applications.psych_report', compact('application'));
    }

    public function generateTestToken(MemberApplication $application)
    {
        if (!$application->test_token) {
            $application->update([
                'test_token' => Str::random(32),
                'psych_status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Enlace de Test Psicológico generado: ' . $application->test_url);
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
