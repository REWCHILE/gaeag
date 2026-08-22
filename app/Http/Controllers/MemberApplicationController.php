<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use Illuminate\Http\Request;

class MemberApplicationController extends Controller
{
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

        $application = MemberApplication::create($validated);

        // Build pre-formatted WhatsApp message for GAE AG Direct Attention
        $waMessage = "¡Hola GAE AG! Deseo postular como Socio del Gremio:\n\n" .
            "👤 Nombre: {$application->full_name}\n" .
            "🆔 RUT: {$application->rut}\n" .
            "📜 Licencia SEC: " . ($application->sec_licence ?: 'En trámite / Acreditado') . "\n" .
            "🛠️ Especialidad: {$application->category} ({$application->class})\n" .
            "📍 Ubicación: {$application->city}, {$application->region}\n" .
            "📞 Teléfono: {$application->phone}\n" .
            "✉️ Email: {$application->email}";

        $whatsappUrl = "https://wa.me/56912345678?text=" . urlencode($waMessage);

        return response()->json([
            'success' => true,
            'message' => '¡Tu postulación ha sido enviada exitosamente! El administrador revisará tu solicitud.',
            'whatsapp_url' => $whatsappUrl,
        ]);
    }
}
