<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $validated['test_token'] = Str::random(32);
        $validated['psych_status'] = 'pending';

        $application = MemberApplication::create($validated);

        return response()->json([
            'success' => true,
            'message' => '¡Paso 1 completado! A continuación debes responder el Test Psicológico y Ético-Laboral de Admisión.',
            'application' => $application,
            'test_url' => route('psych.test', ['token' => $application->test_token]),
        ]);
    }
}
