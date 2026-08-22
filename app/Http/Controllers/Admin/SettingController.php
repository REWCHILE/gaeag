<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $geminiKey = Setting::getByKey('gemini_api_key', '');
        $openRouterKey = Setting::getByKey('openrouter_api_key', '');
        $groqKey = Setting::getByKey('groq_api_key', '');
        $mailDelaySeconds = Setting::getByKey('mail_delay_seconds', '30');

        return view('admin.settings.index', compact('geminiKey', 'openRouterKey', 'groqKey', 'mailDelaySeconds'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'gemini_api_key' => 'nullable|string|max:255',
            'openrouter_api_key' => 'nullable|string|max:255',
            'groq_api_key' => 'nullable|string|max:255',
            'mail_delay_seconds' => 'required|integer|min:1|max:300',
        ]);

        Setting::setByKey('gemini_api_key', $validated['gemini_api_key'], 'Llave de API de Google AI Studio Gemini (Free Tier)');
        Setting::setByKey('openrouter_api_key', $validated['openrouter_api_key'], 'Llave de API de OpenRouter (Free Models)');
        Setting::setByKey('groq_api_key', $validated['groq_api_key'], 'Llave de API de Groq Cloud (Free Tier)');
        Setting::setByKey('mail_delay_seconds', $validated['mail_delay_seconds'], 'Segundos de retardo entre envíos de correos');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Configuración de Llaves de API Gratuitas (Gemini / OpenRouter / Groq) actualizada correctamente.');
    }
}
