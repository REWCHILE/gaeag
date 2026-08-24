<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use App\Models\Setting;
use App\Services\PsychologicalTestService;
use Illuminate\Http\Request;

class PsychologicalTestController extends Controller
{
    public function show($token, PsychologicalTestService $psychService)
    {
        $application = MemberApplication::where('test_token', $token)->firstOrFail();

        if ($application->psych_status === 'completed') {
            return redirect()->route('psych.completed', ['token' => $token]);
        }

        $questions = $psychService->getQuestions();

        return view('psych.test', compact('application', 'questions'));
    }

    public function submit(Request $request, $token, PsychologicalTestService $psychService)
    {
        $application = MemberApplication::where('test_token', $token)->firstOrFail();

        $validated = $request->validate([
            'answers' => 'required|array',
        ]);

        $evaluation = $psychService->evaluate($validated['answers']);

        $application->update([
            'psych_status' => 'completed',
            'psych_score_total' => $evaluation['score_total'],
            'psych_score_safety' => $evaluation['score_safety'],
            'psych_score_stress' => $evaluation['score_stress'],
            'psych_score_ethics' => $evaluation['score_ethics'],
            'psych_score_service' => $evaluation['score_service'],
            'psych_score_responsibility' => $evaluation['score_responsibility'],
            'psych_risk_level' => $evaluation['risk_level'],
            'psych_profile_summary' => $evaluation['summary'],
            'psych_answers' => [
                'recommendation' => $evaluation['recommendation'],
                'alerts' => $evaluation['alerts'],
                'answers_data' => $evaluation['detailed_answers'],
            ],
            'psych_completed_at' => now(),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('psych.completed', ['token' => $token]),
            ]);
        }

        return redirect()->route('psych.completed', ['token' => $token]);
    }

    public function completed($token)
    {
        $application = MemberApplication::where('test_token', $token)->firstOrFail();
        $adminWhatsapp = Setting::getByKey('contact_whatsapp', '56949877316');
        $adminPhone = Setting::getByKey('contact_phone', '+56 9 4987 7316');

        return view('psych.completed', compact('application', 'adminWhatsapp', 'adminPhone'));
    }
}
