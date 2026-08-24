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

        $contactPhone = Setting::getByKey('contact_phone', '+56 9 4987 7316');
        $contactWhatsapp = Setting::getByKey('contact_whatsapp', '56949877316');
        $contactEmail = Setting::getByKey('contact_email', 'contacto@gae-ag.cl');
        $siteSeoTitle = Setting::getByKey('site_seo_title', 'GAE AG - Asociación Gremial de Profesionales del Gas, Agua y Energía en Chile | Instaladores SEC');
        $siteMetaDescription = Setting::getByKey('site_meta_description', 'Sitio oficial de GAE AG, Asociación Gremial fundada en 2017 por Domingo Isaín Plaza Caamaño. Profesionalización, acreditación SEC y directorio de instaladores autorizados en Gas, Agua y Energía en Chile.');

        return view('admin.settings.index', compact(
            'geminiKey', 'openRouterKey', 'groqKey', 'mailDelaySeconds',
            'contactPhone', 'contactWhatsapp', 'contactEmail', 'siteSeoTitle', 'siteMetaDescription'
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_phone' => 'required|string|max:50',
            'contact_whatsapp' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'site_seo_title' => 'required|string|max:255',
            'site_meta_description' => 'required|string|max:500',
            'gemini_api_key' => 'nullable|string|max:255',
            'openrouter_api_key' => 'nullable|string|max:255',
            'groq_api_key' => 'nullable|string|max:255',
            'mail_delay_seconds' => 'required|integer|min:1|max:300',
        ]);

        Setting::setByKey('contact_phone', $validated['contact_phone'], 'Teléfono oficial de llamadas GAE AG');
        Setting::setByKey('contact_whatsapp', preg_replace('/[^0-9]/', '', $validated['contact_whatsapp']), 'Número de WhatsApp de atención oficial');
        Setting::setByKey('contact_email', $validated['contact_email'], 'Correo electrónico oficial de contacto');
        Setting::setByKey('site_seo_title', $validated['site_seo_title'], 'Título SEO principal para Google');
        Setting::setByKey('site_meta_description', $validated['site_meta_description'], 'Meta descripción SEO para motores de búsqueda');

        Setting::setByKey('gemini_api_key', $validated['gemini_api_key'], 'Llave de API de Google AI Studio Gemini (Free Tier)');
        Setting::setByKey('openrouter_api_key', $validated['openrouter_api_key'], 'Llave de API de OpenRouter (Free Models)');
        Setting::setByKey('groq_api_key', $validated['groq_api_key'], 'Llave de API de Groq Cloud (Free Tier)');
        Setting::setByKey('mail_delay_seconds', $validated['mail_delay_seconds'], 'Segundos de retardo entre envíos de correos');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Configuración de Contacto, SEO y Llaves de API actualizada correctamente.');
    }
}
