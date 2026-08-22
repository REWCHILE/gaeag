@extends('admin.layout')

@section('title', 'Solicitudes de Postulación a Socio - Panel Admin GAE AG')

@section('admin_content')

<div class="space-y-8">
    
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider">
                Postulaciones de Especialistas
            </span>
            <h2 class="text-2xl font-black text-slate-900 mt-2">Solicitudes de Ingreso al Gremio</h2>
            <p class="text-xs text-slate-500">Revisa, aprueba o gestiona las postulaciones enviadas por instaladores de Gas, Agua y Energía.</p>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-6">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Postulante / RUT</th>
                        <th class="px-4 py-3">Especialidad & Licencia SEC</th>
                        <th class="px-4 py-3">Contacto / Ubicación</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Fecha Solicitud</th>
                        <th class="px-4 py-3 text-right">Acciones Directas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $app)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 py-3 font-bold text-slate-900">
                                <span class="text-sm font-bold block">{{ $app->full_name }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">RUT: {{ $app->rut }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">{{ $app->category }}</span>
                                <span class="text-slate-500 font-semibold block text-[11px] mt-0.5">{{ $app->sec_licence ?: 'Licencia SEC no ingresada' }} ({{ $app->class }})</span>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-slate-800">{{ $app->phone }}</p>
                                <p class="text-[10px] text-slate-400">{{ $app->email }}</p>
                                <p class="text-[10px] text-slate-500">{{ $app->city }}, {{ $app->region }}</p>
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
                            <td class="px-4 py-3 font-medium text-slate-400">{{ $app->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-right space-x-1">
                                @if($app->status !== 'approved')
                                    <form action="{{ route('admin.applications.approve', $app) }}" method="POST" class="inline" onsubmit="return confirm('¿Aprobar postulación y crear perfil público de socio con QR SEC?');">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[10px] shadow-sm">
                                            ✓ Aprobar & Crear Perfil QR
                                        </button>
                                    </form>
                                @endif

                                @if($app->status === 'pending')
                                    <form action="{{ route('admin.applications.reject', $app) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1.5 rounded bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-[10px]">
                                            ✕ Rechazar
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
