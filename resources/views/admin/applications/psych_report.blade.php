@extends('admin.layout')

@section('title', 'Informe Psicológico de Admisión - ' . $application->full_name)

@section('admin_content')

<div class="space-y-8 max-w-5xl mx-auto">
    
    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <a href="{{ route('admin.applications.index') }}" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs flex items-center gap-1.5 transition-all">
            &larr; Volver a Solicitudes
        </a>

        <div class="flex items-center gap-2">
            @if($application->status !== 'approved')
                <form action="{{ route('admin.applications.approve', $application) }}" method="POST" onsubmit="return confirm('¿Aprobar postulación y crear perfil público de socio con QR SEC?');">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md flex items-center gap-2">
                        <span>✓</span>
                        <span>Aprobar como Socio Oficial</span>
                    </button>
                </form>
            @endif

            @if($application->status === 'pending')
                <form action="{{ route('admin.applications.reject', $application) }}" method="POST" onsubmit="return confirm('¿Rechazar esta postulación?');">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs">
                        ✕ Rechazar
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Candidate Header Card -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-b border-slate-100 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-slate-900 to-slate-700 text-white flex items-center justify-center text-2xl font-black shadow-md">
                    {{ strtoupper(substr($application->full_name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="text-2xl font-black text-slate-900">{{ $application->full_name }}</h2>
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs">
                            {{ $application->category }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-semibold text-xs">
                            {{ $application->class ?: 'SEC' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1 font-mono">
                        RUT: {{ $application->rut }} &bull; Licencia SEC: {{ $application->sec_licence ?: 'En acreditación' }} &bull; {{ $application->city }}, {{ $application->region }}
                    </p>
                </div>
            </div>

            <!-- Global Score Gauge -->
            <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
                <div class="text-right">
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Índice Global de Aptitud</span>
                    <span class="text-2xl font-black {{ ($application->psych_score_total ?? 0) >= 80 ? 'text-emerald-600' : (($application->psych_score_total ?? 0) >= 65 ? 'text-sky-600' : 'text-amber-600') }}">
                        {{ $application->psych_score_total ?? 0 }} / 100
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center font-black text-lg text-white {{ ($application->psych_score_total ?? 0) >= 80 ? 'bg-emerald-500 shadow-emerald-200 shadow-lg' : (($application->psych_score_total ?? 0) >= 65 ? 'bg-sky-500' : 'bg-amber-500') }}">
                    {{ ($application->psych_score_total ?? 0) >= 80 ? 'A+' : (($application->psych_score_total ?? 0) >= 65 ? 'B' : 'C') }}
                </div>
            </div>
        </div>

        @if($application->psych_status !== 'completed')
            <!-- Test Not Completed Banner -->
            <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 space-y-3">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <span>⏳ El postulante aún no ha respondido el test psicológico.</span>
                </div>
                <p class="text-xs text-amber-800">
                    Puedes enviarle su enlace directo para que complete la evaluación digital paso a paso antes de tomar la decisión de ingreso:
                </p>
                <div class="flex items-center gap-2">
                    <input type="text" readonly value="{{ $application->test_url }}" 
                           class="w-full px-3 py-2 rounded-xl bg-white border border-amber-300 text-xs font-mono text-slate-700">
                    <button onclick="navigator.clipboard.writeText('{{ $application->test_url }}'); alert('Enlace copiado al portapapeles');" 
                            class="px-4 py-2 rounded-xl bg-slate-900 text-white font-bold text-xs shrink-0">
                        Copiar Enlace
                    </button>
                </div>
            </div>
        @else

            <!-- Diagnostic Executive Summary -->
            <div class="p-6 rounded-2xl bg-slate-900 text-white space-y-4 shadow-md">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-wider border border-emerald-500/30">
                        Diagnóstico Psicológico & Ético-Laboral
                    </span>
                    <span class="text-xs text-slate-400">
                        Rendido el: {{ $application->psych_completed_at ? $application->psych_completed_at->format('d/m/Y H:i') : 'Recientemente' }}
                    </span>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-emerald-300">
                        {{ $application->psych_answers['recommendation'] ?? 'Evaluación de Admisión Gremial' }}
                    </h4>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mt-2">
                        {{ $application->psych_profile_summary }}
                    </p>
                </div>

                <!-- Risk Level Badge -->
                <div class="pt-2 flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-400">Nivel de Riesgo Operativo y Conductual:</span>
                    <span class="px-3 py-1 rounded-full text-xs font-black {{ $application->psych_risk_level === 'Bajo' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40' : ($application->psych_risk_level === 'Medio-Bajo' ? 'bg-sky-500/20 text-sky-400 border border-sky-500/40' : 'bg-amber-500/20 text-amber-400 border border-amber-500/40') }}">
                        Riesgo {{ $application->psych_risk_level ?: 'Controlado' }}
                    </span>
                </div>
            </div>

            <!-- Behavioral Alerts / Warning section (Protección contra malos ratos) -->
            @if(!empty($application->psych_answers['alerts']))
                <div class="p-6 rounded-2xl bg-red-50 border border-red-200 text-red-900 space-y-2">
                    <h4 class="font-bold text-xs uppercase tracking-wider flex items-center gap-2 text-red-700">
                        <span>⚠️</span>
                        <span>Alertas Preventivas de Conducta ("Prevención de Malos Ratos"):</span>
                    </h4>
                    <ul class="list-disc list-inside space-y-1 text-xs text-red-800">
                        @foreach($application->psych_answers['alerts'] as $alert)
                            <li>{{ $alert }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center gap-2 text-xs font-bold">
                    <span>✓</span>
                    <span>No se detectaron alertas de riesgo ni conductas conflictivas. Perfil apto para contacto directo con clientes.</span>
                </div>
            @endif

            <!-- 6 Dimension Progress Bars Breakdown -->
            <div class="space-y-4">
                <h3 class="text-sm font-black uppercase tracking-wider text-slate-900">
                    Desglose de Competencias Evaluadas (6 Pilares Críticos)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    
                    <!-- Safety -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-slate-800">🛡️ Normativa SEC & Cero Riesgo</span>
                            <span class="font-black text-slate-900">{{ $application->psych_score_safety ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-emerald-500 h-full rounded-full" style="width: {{ $application->psych_score_safety ?? 0 }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 block font-medium">Apego estricto a DS66 / DS222 y resistencia a presiones comerciales.</span>
                    </div>

                    <!-- Ethics -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-slate-800">⚖️ Ética & Honestidad Comercial</span>
                            <span class="font-black text-slate-900">{{ $application->psych_score_ethics ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-sky-500 h-full rounded-full" style="width: {{ $application->psych_score_ethics ?? 0 }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 block font-medium">Cobros justos, no firmar a terceros y asunción de daños involuntarios.</span>
                    </div>

                    <!-- Service & Conflict Prevention -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-slate-800">🤝 Trato Asertivo & Clientes</span>
                            <span class="font-black text-slate-900">{{ $application->psych_score_service ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-amber-500 h-full rounded-full" style="width: {{ $application->psych_score_service ?? 0 }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 block font-medium">Prevención de conflictos ("malos ratos") y comunicación clara.</span>
                    </div>

                    <!-- Stress -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-slate-800">🧠 Control Emocional & Estrés</span>
                            <span class="font-black text-slate-900">{{ $application->psych_score_stress ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $application->psych_score_stress ?? 0 }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 block font-medium">Serenidad bajo fuga violenta, emergencias y tolerancia a frustración.</span>
                    </div>

                    <!-- Responsibility -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-slate-800">🌟 Responsabilidad & Garantías</span>
                            <span class="font-black text-slate-900">{{ $application->psych_score_responsibility ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-gae-green h-full rounded-full" style="width: {{ $application->psych_score_responsibility ?? 0 }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 block font-medium">Respuesta inmediata a post-venta y compromiso gremial.</span>
                    </div>

                    <!-- Lie Scale / Veracity -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-slate-800">🎯 Índice de Autenticidad (Lie Scale)</span>
                            <span class="font-black text-slate-900">{{ $application->psych_answers['score_lie'] ?? 85 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-purple-500 h-full rounded-full" style="width: {{ $application->psych_answers['score_lie'] ?? 85 }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 block font-medium">Control de veracidad y detección de respuestas prefabricadas.</span>
                    </div>

                </div>
            </div>

            <!-- Detailed Question-by-Question Table -->
            @if(!empty($application->psych_answers['answers_data']))
                <div class="space-y-3 pt-4 border-t border-slate-100">
                    <h3 class="text-sm font-black uppercase tracking-wider text-slate-900">
                        Detalle de las 24 Respuestas del Postulante (Escala 1 a 5)
                    </h3>
                    <div class="overflow-x-auto border border-slate-200 rounded-2xl">
                        <table class="w-full text-left text-xs text-slate-600">
                            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Escenario y Dilema Situacional Evaluado</th>
                                    <th class="px-4 py-3">Dimensión</th>
                                    <th class="px-4 py-3 text-center">Puntaje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($application->psych_answers['answers_data'] as $ans)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 py-2.5 font-mono font-bold text-slate-400">{{ $ans['question_id'] }}</td>
                                        <td class="px-4 py-2.5">
                                            @if(!empty($ans['scenario']))
                                                <span class="font-bold text-slate-900 block">{{ $ans['scenario'] }}</span>
                                            @endif
                                            <span class="text-slate-600">{{ $ans['question'] }}</span>
                                        </td>
                                        <td class="px-4 py-2.5">
                                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-semibold text-[10px]">
                                                {{ ucfirst($ans['dimension']) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2.5 text-center font-bold">
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-black {{ $ans['score'] >= 4 ? 'bg-emerald-100 text-emerald-800' : ($ans['score'] == 3 ? 'bg-slate-100 text-slate-700' : 'bg-red-100 text-red-800') }}">
                                                {{ $ans['score'] }} / 5
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        @endif

        <!-- Direct WhatsApp Action Button to Contact Applicant -->
        @php
            $msgToApplicant = "Hola {$application->full_name}, te contactamos desde la directiva de la Asociación Gremial GAE AG respecto a tu postulación:";
            $cleanPhone = preg_replace('/[^0-9]/', '', $application->phone);
            $applicantWaUrl = "https://wa.me/{$cleanPhone}?text=" . urlencode($msgToApplicant);
        @endphp
        <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ $applicantWaUrl }}" target="_blank" rel="noopener noreferrer" 
                   class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-2 shadow-sm">
                    <span>💬 Contactar al Postulante por WhatsApp</span>
                </a>
                <a href="tel:{{ $application->phone }}" 
                   class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs">
                    📞 Llamar al {{ $application->phone }}
                </a>
            </div>

            <p class="text-[11px] text-slate-400 font-semibold">
                Postulación #{{ $application->id }} &bull; Registrado el {{ $application->created_at->format('d/m/Y') }}
            </p>
        </div>

    </div>

</div>

@endsection
