<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $members = Member::with('certificates')
            ->when($search, function ($query, $search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('sec_licence', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.members.index', compact('members', 'search'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request, QrCodeService $qrService)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'rut' => 'nullable|string|max:20',
            'sec_licence' => 'nullable|string|max:100',
            'sec_qr_url' => 'nullable|url|max:500',
            'category' => 'required|string|max:100',
            'class' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['full_name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Member::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members', 'public');
        }

        $member = Member::create([
            'full_name' => $validated['full_name'],
            'slug' => $slug,
            'rut' => $validated['rut'] ?? null,
            'sec_licence' => $validated['sec_licence'] ?? null,
            'sec_qr_url' => $validated['sec_qr_url'] ?? null,
            'category' => $validated['category'],
            'class' => $validated['class'],
            'title' => $validated['title'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'city' => $validated['city'],
            'region' => $validated['region'],
            'bio' => $validated['bio'] ?? null,
            'photo_path' => $photoPath,
            'is_active' => $request->has('is_active'),
            'is_verified' => true,
        ]);

        // Generate dynamic QR code for member
        $targetQrUrl = $member->sec_qr_url ?: $member->public_url;
        $qrPath = $qrService->generateForMemberUrl($targetQrUrl, $member->slug);
        $member->update(['qr_code_path' => $qrPath]);

        return redirect()->route('admin.members.show', $member)
            ->with('success', "El socio '{$member->full_name}' fue registrado con éxito y su código QR generado.");
    }

    public function show(Member $member)
    {
        $member->load('certificates');
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member, QrCodeService $qrService)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'rut' => 'nullable|string|max:20',
            'sec_licence' => 'nullable|string|max:100',
            'sec_qr_url' => 'nullable|url|max:500',
            'category' => 'required|string|max:100',
            'class' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($member->photo_path && Storage::disk('public')->exists($member->photo_path)) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('members', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $member->update($validated);

        // Always regenerate QR code dynamically with sec_qr_url or public_url
        $targetQrUrl = $member->sec_qr_url ?: $member->public_url;
        $qrPath = $qrService->generateForMemberUrl($targetQrUrl, $member->slug);
        $member->update(['qr_code_path' => $qrPath]);

        return redirect()->route('admin.members.show', $member)
            ->with('success', "Datos de '{$member->full_name}' actualizados correctamente.");
    }

    public function regenerateAllQrs(QrCodeService $qrService)
    {
        $members = Member::all();
        $count = 0;
        foreach ($members as $member) {
            $qrService->generateSecQrCode($member);
            $count++;
        }

        return redirect()->back()->with('success', "¡Se regeneraron exitosamente los códigos QR de los {$count} socios del gremio!");
    }

    public function destroy(Member $member)
    {
        $name = $member->full_name;
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', "Socio '{$name}' eliminado del sistema.");
    }
}
