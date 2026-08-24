@extends('admin.layout')

@section('title', 'Configuración de Contacto, SEO e Inteligencia Artificial - Panel Admin GAE AG')

@section('admin_content')

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 max-w-3xl mx-auto space-y-6">
    <div>
        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
            Ajustes Globales del Gremio
        </span>
        <h3 class="text-2xl font-black text-slate-900 mt-2">Configuración General de GAE AG</h3>
        <p class="text-xs text-slate-500">Administra los números de WhatsApp, teléfono de contacto directo, títulos SEO para Google y llaves de IA gratuitas.</p>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 text-xs">
        @csrf

        <!-- Contact & WhatsApp Settings -->
        <div class="p-6 rounded-2xl bg-emerald-50/70 border border-emerald-200 space-y-4">
            <div class="flex items-center gap-2">
                <span class="p-2 rounded-lg bg-emerald-600 text-white font-bold text-xs">📞 & 💬</span>
                <h4 class="font-bold text-sm text-slate-900">Canales Oficiales de Contacto y WhatsApp</h4>
            </div>
            <p class="text-slate-600 text-xs leading-relaxed">
                Estos números se reflejarán inmediatamente en los botones flotantes de toda la web, formularios de contacto y enlaces directos de WhatsApp:
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">WhatsApp de Atención Directa:</label>
                    <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $contactWhatsapp) }}" placeholder="Ej: 56949877316" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-green bg-white">
                    <span class="text-[10px] text-slate-400 mt-1 block">Formato internacional sin signos: 56949877316</span>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Teléfono de Llamadas:</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $contactPhone) }}" placeholder="Ej: +56 9 4987 7316" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-green bg-white">
                    <span class="text-[10px] text-slate-400 mt-1 block">Ejemplo: +56 9 4987 7316</span>
                </div>

                <div class="sm:col-span-2">
                    <label class="block font-bold text-slate-700 mb-1">Correo Electrónico Institucional:</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $contactEmail) }}" placeholder="contacto@gae-ag.cl" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-green bg-white">
                </div>
            </div>
        </div>

        <!-- SEO Google Settings -->
        <div class="p-6 rounded-2xl bg-sky-50/70 border border-sky-200 space-y-4">
            <div class="flex items-center gap-2">
                <span class="p-2 rounded-lg bg-sky-600 text-white font-bold text-xs">🔍 SEO</span>
                <h4 class="font-bold text-sm text-slate-900">Optimización de Posicionamiento Google (SEO)</h4>
            </div>
            <p class="text-slate-600 text-xs leading-relaxed">
                Títulos y meta descripciones indexados por Google para atraer clientes e instaladores técnicos en Chile:
            </p>

            <div class="space-y-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Título SEO Principal (Title Tag):</label>
                    <input type="text" name="site_seo_title" value="{{ old('site_seo_title', $siteSeoTitle) }}" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Meta Descripción SEO:</label>
                    <textarea name="site_meta_description" rows="3" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-300 text-xs focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">{{ old('site_meta_description', $siteMetaDescription) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Google AI Studio (Gemini 1.5 Flash Free Tier) -->
        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="p-2 rounded-lg bg-emerald-600 text-white font-bold text-xs">Google Gemini</span>
                    <h4 class="font-bold text-sm text-slate-900">Google AI Studio (Gemini 1.5 Flash - Free Tier)</h4>
                </div>
                <span class="px-2.5 py-0.5 rounded-full bg-emerald-200 text-emerald-900 font-bold text-[10px]">1,500 solicitudes/día GRATIS</span>
            </div>
            <p class="text-slate-600 text-xs leading-relaxed">
                Obtén tu API Key gratuita en <a href="https://aistudio.google.com/" target="_blank" class="text-gae-blue font-bold underline">aistudio.google.com</a>:
            </p>
            
            <input type="password" name="gemini_api_key" value="{{ old('gemini_api_key', $geminiKey) }}" placeholder="AIzaSy..." 
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-green bg-white">
        </div>

        <!-- OpenRouter Free Models -->
        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="p-2 rounded-lg bg-sky-600 text-white font-bold text-xs">OpenRouter</span>
                    <h4 class="font-bold text-sm text-slate-900">OpenRouter (Free Models Tier)</h4>
                </div>
                <span class="px-2.5 py-0.5 rounded-full bg-sky-200 text-sky-900 font-bold text-[10px]">Modelos Gratis</span>
            </div>
            <input type="password" name="openrouter_api_key" value="{{ old('openrouter_api_key', $openRouterKey) }}" placeholder="sk-or-v1-..." 
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">
        </div>

        <!-- Groq Cloud Free Tier -->
        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="p-2 rounded-lg bg-slate-900 text-white font-bold text-xs">Groq</span>
                    <h4 class="font-bold text-sm text-slate-900">Groq Cloud (Ultra-Fast Free Tier)</h4>
                </div>
                <span class="px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-800 font-bold text-[10px]">100% GRATIS</span>
            </div>
            <input type="password" name="groq_api_key" value="{{ old('groq_api_key', $groqKey) }}" placeholder="gsk_..." 
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">
        </div>

        <!-- Mail Dispatch Rate-Limiting -->
        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
            <h4 class="font-bold text-sm text-slate-900">Parámetros de Envío Seguro (Rate-Limiting)</h4>
            <p class="text-slate-500 text-xs">Segundos de retardo entre envíos de correo para evitar sobrecarga de servidor e IP spam flags:</p>
            
            <div class="w-full sm:w-48">
                <input type="number" name="mail_delay_seconds" min="1" max="300" value="{{ old('mail_delay_seconds', $mailDelaySeconds) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-bold text-slate-900 text-xs focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">
                <span class="text-[11px] text-slate-400 font-medium block mt-1">Recomendado: 30 segundos</span>
            </div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
            <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                Guardar Configuración de GAE AG
            </button>
        </div>
    </form>
</div>

@endsection
