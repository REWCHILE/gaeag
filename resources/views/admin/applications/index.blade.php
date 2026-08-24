@extends('admin.layout')

@section('title', 'Solicitudes de Postulación a Socio - Panel Admin GAE AG')

@section('admin_content')

<div class="space-y-8" x-data="{ newCandidateModal: false }">
    
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider">
                Filtro de Admisión & Evaluación de Especialistas
            </span>
            <h2 class="text-2xl font-black text-slate-900 mt-2">Solicitudes de Ingreso al Gremio</h2>
            <p class="text-xs text-slate-500">Revisa el informe técnico y el <strong>Test Psicológico / Ético-Laboral</strong> de cada postulante antes de aprobar su incorporación oficial a GAE AG.</p>
        </div>

        <button type="button" @click="newCandidateModal = true"
                class="px-5 py-3 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs shadow-md flex items-center gap-2 transition-all shrink-0">
            <span>+</span>
            <span>Registrar Nuevo Postulante & Enviar Test</span>
        </button>
    </div>

    <!-- Quick Modal to Register Applicant directly from Admin -->
    <div x-cloak x-show="newCandidateModal" class="relative z-50" role="dialog" aria-modal="true">
        <div x-show="newCandidateModal" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="newCandidateModal = false" 
             class="fixed inset-0 bg-slate-950/70 backdrop-blur-md"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div x-show="newCandidateModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="w-full max-w-xl bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-6 text-slate-800 text-xs">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600">Registro Administrativo</span>
                        <h3 class="text-xl font-black text-slate-900">Registrar Postulante para Test Psicológico</h3>
                    </div>
                    <button type="button" @click="newCandidateModal = false" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 text-sm font-bold">
                        ✕
                    </button>
                </div>

                <form action="{{ route('admin.applications.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nombre Completo del Profesional (*):</label>
                        <input type="text" name="full_name" required placeholder="Ej: Juan Carlos Pérez Soto" 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">RUT (*):</label>
                            <input type="text" name="rut" required placeholder="Ej: 14.892.341-2" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Teléfono / WhatsApp (*):</label>
                            <input type="text" name="phone" required placeholder="Ej: +56 9 1234 5678" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Correo Electrónico (*):</label>
                            <input type="email" name="email" required placeholder="correo@ejemplo.cl" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Licencia SEC (Opcional):</label>
                            <input type="text" name="sec_licence" placeholder="Ej: SEC-GAS-0017" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Especialidad (*):</label>
                            <select name="category" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                                <option value="Gas">Gas</option>
                                <option value="Agua">Agua</option>
                                <option value="Energía">Energía</option>
                                <option value="Gas, Agua y Energía">Integral (Gas, Agua y Energía)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Categoría SEC (*):</label>
                            <select name="class" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                                <option value="Clase B SEC">Clase B SEC</option>
                                <option value="Clase A SEC">Clase A SEC</option>
                                <option value="Clase C SEC">Clase C SEC</option>
                                <option value="Clase D SEC">Clase D SEC</option>
                                <option value="En Trámite">En Trámite</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Ciudad / Comuna (*):</label>
                            <input type="text" name="city" required value="Santiago" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Región (*):</label>
                            <input type="text" name="region" required value="Región Metropolitana de Santiago" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-medium focus:ring-2 focus:ring-gae-green outline-none">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <button type="button" @click="newCandidateModal = false" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">
                            Cancelar
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold shadow-md">
                            Guardar & Generar Enlace de Test
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-6">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Postulante / RUT</th>
                        <th class="px-4 py-3">Especialidad & Licencia</th>
                        <th class="px-4 py-3">Contacto / Ubicación</th>
                        <th class="px-4 py-3">Filtro Psicológico</th>
                        <th class="px-4 py-3">Estado Ingreso</th>
                        <th class="px-4 py-3 text-right">Acciones Directas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $app)
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $app->phone);
                            $inviteMsg = "Hola {$app->full_name}, te saludamos desde la directiva de la Asociación Gremial GAE AG. Para continuar con tu proceso de incorporación al Gremio, por favor responde tu Test Psicológico y Ético-Laboral de Admisión en el siguiente enlace seguro:\n\n"
                                       . "👉 {$app->test_url}\n\n"
                                       . "Quedamos atentos a tus resultados para la revisión final.";
                            $waInviteUrl = "https://wa.me/{$cleanPhone}?text=" . urlencode($inviteMsg);
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 py-3 font-bold text-slate-900">
                                <span class="text-sm font-bold block">{{ $app->full_name }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">RUT: {{ $app->rut }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">{{ $app->category }}</span>
                                <span class="text-slate-500 font-semibold block text-[11px] mt-0.5">{{ $app->sec_licence ?: 'Licencia SEC en acreditación' }} ({{ $app->class }})</span>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-slate-800">{{ $app->phone }}</p>
                                <p class="text-[10px] text-slate-400">{{ $app->email }}</p>
                                <p class="text-[10px] text-slate-500">{{ $app->city }}, {{ $app->region }}</p>
                            </td>
                            <td class="px-4 py-3">
                                @if($app->psych_status === 'completed')
                                    <a href="{{ route('admin.applications.psych_report', $app) }}" class="group block">
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full {{ ($app->psych_score_total ?? 0) >= 70 ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-amber-100 text-amber-800 border border-amber-300' }} font-bold text-[10px] transition-all group-hover:scale-105">
                                            <span>🧠</span>
                                            <span>Test: {{ $app->psych_score_total ?? 0 }}/100</span>
                                            <span class="text-[9px] font-black">({{ $app->psych_risk_level }})</span>
                                        </div>
                                        <span class="text-[10px] text-gae-blue font-bold block mt-0.5 group-hover:underline">Ver Informe Completo &rarr;</span>
                                    </a>
                                @else
                                    <div class="space-y-1.5">
                                        <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold text-[10px] inline-block">
                                            ⏳ Test Pendiente
                                        </span>
                                        
                                        <div class="flex items-center gap-1.5 flex-wrap">
                                            <a href="{{ $waInviteUrl }}" target="_blank" 
                                               class="px-2 py-1 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[10px] inline-flex items-center gap-1 shadow-xs">
                                                <span>📲 Enviar por WhatsApp</span>
                                            </a>
                                            <button type="button" onclick="navigator.clipboard.writeText('{{ $app->test_url }}'); alert('Enlace copiado al portapapeles: {{ $app->test_url }}');" 
                                                    class="px-2 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[10px]">
                                                📋 Copiar Link
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($app->status === 'approved')
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px]">APROBADO & SOCIO CREADO</span>
                                @elseif($app->status === 'rejected')
                                    <span class="px-2.5 py-1 rounded-full bg-red-100 text-red-800 font-bold text-[10px]">RECHAZADO</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 font-bold text-[10px] animate-pulse">PENDIENTE DE REVISIÓN</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right space-x-1">
                                <a href="{{ route('admin.applications.psych_report', $app) }}" class="px-2.5 py-1.5 rounded bg-slate-800 hover:bg-slate-900 text-white font-bold text-[10px] shadow-sm inline-flex items-center gap-1">
                                    <span>🧠</span>
                                    <span>Informe</span>
                                </a>

                                @if($app->status !== 'approved')
                                    <form action="{{ route('admin.applications.approve', $app) }}" method="POST" class="inline" onsubmit="return confirm('¿Aprobar postulación y crear perfil público de socio con QR SEC?');">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1.5 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[10px] shadow-sm">
                                            ✓ Aprobar
                                        </button>
                                    </form>
                                @endif

                                @if($app->status === 'pending')
                                    <form action="{{ route('admin.applications.reject', $app) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2 py-1.5 rounded bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-[10px]">
                                            ✕
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.applications.destroy', $app) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta solicitud?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1.5 rounded bg-red-50 hover:bg-red-100 text-red-600 font-bold text-[10px]">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">No hay postulaciones registradas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $applications->links() }}
        </div>

    </div>

</div>

@endsection
