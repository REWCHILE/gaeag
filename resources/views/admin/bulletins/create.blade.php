@extends('admin.layout')

@section('title', 'Crear Boletín con IA - Panel Admin GAE AG')

@section('admin_content')

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 max-w-4xl mx-auto space-y-8" x-data="{
    topic: 'Actualización Normativa SEC Decreto Supremo 66 y Pruebas de Hermeticidad',
    category: 'Normativa SEC',
    title: '',
    subject: '',
    content_html: '',
    loading: false,
    generateAi() {
        this.loading = true;
        fetch('{{ route('admin.bulletins.generate_ai') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ topic: this.topic, category: this.category })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                this.title = data.title;
                this.subject = data.subject;
                this.content_html = data.content_html;
            }
            this.loading = false;
        })
        .catch(err => {
            alert('Error generando contenido con IA');
            this.loading = false;
        });
    }
}">

    <div>
        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
            Inteligencia Artificial GAE AG
        </span>
        <h3 class="text-2xl font-black text-slate-900 mt-2">Redactar Boletín Técnico Informativo</h3>
        <p class="text-xs text-slate-500">Utiliza nuestro motor de IA para generar automáticamente boletines técnicos normativos sobre Gas, Agua y Energía para los socios del gremio.</p>
    </div>

    <!-- AI Prompt Box -->
    <div class="p-6 rounded-2xl bg-slate-900 text-white space-y-4 shadow-xl">
        <h4 class="font-bold text-sm text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Asistente de Generación con IA
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div class="sm:col-span-2">
                <label class="block font-bold text-slate-300 mb-1">Tema / Tema de Normativa SEC o Agua *</label>
                <input type="text" x-model="topic" placeholder="Ej: Nuevos protocolos de hermeticidad de gas en edificios..." 
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
            </div>

            <div>
                <label class="block font-bold text-slate-300 mb-1">Categoría</label>
                <select x-model="category" class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    <option value="Normativa SEC">Normativa SEC</option>
                    <option value="Gas">Instalaciones de Gas</option>
                    <option value="Agua">Redes e Hidráulica Agua</option>
                    <option value="Energía">Energías Renovables</option>
                    <option value="Institucional">Gremial / Institucional</option>
                </select>
            </div>
        </div>

        <button type="button" @click="generateAi()" :disabled="loading" 
                class="w-full py-3 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue hover:opacity-90 text-white font-bold text-xs shadow-lg transition-all flex items-center justify-center gap-2">
            <template x-if="!loading">
                <span>✨ Generar Borrador de Boletín con IA</span>
            </template>
            <template x-if="loading">
                <span>Generando contenido con IA... Por favor espera</span>
            </template>
        </button>
    </div>

    <!-- Bulletin Form -->
    <form action="{{ route('admin.bulletins.store') }}" method="POST" class="space-y-6 text-xs border-t border-slate-100 pt-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-bold text-slate-700 mb-1">Título Interno del Boletín *</label>
                <input type="text" name="title" x-model="title" required placeholder="Ej: Boletín Técnico SEC N° 45" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Asunto del Correo Electrónico *</label>
                <input type="text" name="subject" x-model="subject" required placeholder="Ej: [GAE AG] Actualización de Normativas de Gas" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>
        </div>

        <input type="hidden" name="category" :value="category">

        <div>
            <label class="block font-bold text-slate-700 mb-1">Contenido HTML del Boletín *</label>
            <textarea name="content_html" x-model="content_html" rows="12" required 
                      class="w-full px-4 py-3 rounded-xl border border-slate-300 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-gae-blue"></textarea>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
            <h5 class="font-bold text-slate-900 mb-1">Vista Previa del HTML:</h5>
            <div class="p-4 bg-white rounded-xl border border-slate-200 overflow-x-auto" x-html="content_html"></div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
            <a href="{{ route('admin.bulletins.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Cancelar</a>
            
            <button type="submit" name="action" value="save_draft" class="px-5 py-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold">
                Guardar Borrador
            </button>

            <button type="submit" name="action" value="start_send" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold shadow-md">
                🚀 Iniciar Envíos Programados en Cola (Rate-Limited 30s)
            </button>
        </div>
    </form>

</div>

@endsection
