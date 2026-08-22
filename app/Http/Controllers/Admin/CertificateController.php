<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function store(Request $request, Member $member)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuing_entity' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'certificate_number' => 'nullable|string|max:100',
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:10240',
        ]);

        $filePath = $request->file('certificate_file')->store('certificates', 'public');

        Certificate::create([
            'member_id' => $member->id,
            'title' => $validated['title'],
            'issuing_entity' => $validated['issuing_entity'],
            'issue_date' => $validated['issue_date'] ?? null,
            'expiry_date' => $validated['expiry_date'] ?? null,
            'certificate_number' => $validated['certificate_number'] ?? null,
            'file_path' => $filePath,
            'is_verified' => true,
        ]);

        return redirect()->route('admin.members.show', $member)
            ->with('success', "Certificado '{$validated['title']}' adjuntado exitosamente a {$member->full_name}.");
    }

    public function destroy(Certificate $certificate)
    {
        $member = $certificate->member;
        if ($certificate->file_path && Storage::disk('public')->exists($certificate->file_path)) {
            // Keep original demo file safe if it's the president's demo cert
            if (!str_contains($certificate->file_path, 'CERTIFICADO-SEC-DOMINGO-ISAIN-CAAMAÑO.png')) {
                Storage::disk('public')->delete($certificate->file_path);
            }
        }
        $certificate->delete();

        return redirect()->route('admin.members.show', $member)
            ->with('success', 'Certificado eliminado del perfil.');
    }
}
