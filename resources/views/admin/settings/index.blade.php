@extends('admin.layout')

@section('title', 'Configuración de Llaves de API IA Gratuitas - Panel Admin GAE AG')

@section('admin_content')

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 max-w-3xl mx-auto space-y-6">
    <div>
        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
            100% Capas Gratuitas (Free Tiers)
        </span>
        <h3 class="text-2xl font-black text-slate-900 mt-2">Configuración Administrable de Inteligencia Artificial</h3>
        <p class="text-xs text-slate-500">Puedes obtener y configurar llaves de API <strong>100% gratuitas</strong> para potenciar el motor de generación de boletines y la grilla de contenidos sin ningún costo.</p>
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

        <!-- Google AI Studio (Gemini 1.5 Flash Free Tier) -->
        <div class="p-6 rounded-2xl bg-emerald-50/60 border border-emerald-200 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="p-2 rounded-lg bg-emerald-600 text-white font-bold text-xs">Google Gemini</span>
                    <h4 class="font-bold text-sm text-slate-900">Google AI Studio (Gemini 1.5 Flash - Free Tier)</h4>
                </div>
                <span class="px-2.5 py-0.5 rounded-full bg-emerald-200 text-emerald-900 font-bold text-[10px]">1,500 solicitudes/día GRATIS</span>
            </div>
            <p class="text-slate-600 text-xs leading-relaxed">
                Obtén tu API Key 100% gratuita ingresando con tu cuenta de Google en <a href="https://aistudio.google.com/" target="_blank" class="text-gae-blue font-bold underline">aistudio.google.com</a> y haciendo clic en <em>"Get API key"</em>:
            </p>
            
            <input type="password" name="gemini_api_key" value="{{ old('gemini_api_key', $geminiKey) }}" placeholder="AIzaSy..." 
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-green bg-white">
        </div>

        <!-- OpenRouter Free Models -->
        <div class="p-6 rounded-2xl bg-sky-50/60 border border-sky-200 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="p-2 rounded-lg bg-sky-600 text-white font-bold text-xs">OpenRouter</span>
                    <h4 class="font-bold text-sm text-slate-900">OpenRouter (Free Models Tier)</h4>
                </div>
                <span class="px-2.5 py-0.5 rounded-full bg-sky-200 text-sky-900 font-bold text-[10px]">Modelos Gratis (Gemini/Llama/DeepSeek)</span>
            </div>
            <p class="text-slate-600 text-xs leading-relaxed">
                Registra tu cuenta gratis en <a href="https://openrouter.ai/keys" target="_blank" class="text-gae-blue font-bold underline">openrouter.ai/keys</a> para acceder a modelos gratuitos de Gemini, Llama 3 y DeepSeek sin costo:
            </p>
            
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
            <p class="text-slate-600 text-xs leading-relaxed">
                Obtén tu API key ultra rápida y gratuita en <a href="https://console.groq.com/keys" target="_blank" class="text-gae-blue font-bold underline">console.groq.com/keys</a>:
            </p>
            
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
                Guardar Llaves de API Administrables
            </button>
        </div>
    </form>
</div>

@endsection
