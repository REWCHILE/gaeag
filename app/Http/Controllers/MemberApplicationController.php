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

        return response()->json([
            'success' => true,
            'message' => '¡Tu postulación ha sido enviada exitosamente! El administrador revisará tu solicitud.',
            'application' => $application,
        ]);
    }
}
