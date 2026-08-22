@extends('admin.layout')

@section('title', 'Dashboard Administrativo - GAE AG')

@section('admin_content')

<!-- Stat Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total de Socios Registrados</p>
        <p class="text-3xl font-black text-slate-900">{{ $totalMembers }}</p>
        <p class="text-xs text-emerald-600 font-medium">100% con QR Digital generado</p>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Socios Activos</p>
        <p class="text-3xl font-black text-gae-green">{{ $activeMembers }}</p>
        <p class="text-xs text-slate-400 font-medium">Perfiles públicos en vivo</p>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Certificados SEC Verificados</p>
        <p class="text-3xl font-black text-gae-blue">{{ $totalCertificates }}</p>
        <p class="text-xs text-slate-400 font-medium">Archivos subidos por Admin</p>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">FAQs SEO Publicadas</p>
        <p class="text-3xl font-black text-gae-amber">{{ $totalFaqs }}</p>
        <p class="text-xs text-slate-400 font-medium">Optimizadas para Google</p>
    </div>

</div>

<!-- Recent Members Table -->
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900">Socios Recientes del Gremio</h3>
            <p class="text-xs text-slate-500">Últimos profesionales registrados en la plataforma oficial de GAE AG</p>
        </div>

        <a href="{{ route('admin.members.create') }}" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
            + Registrar Nuevo Socio SEC
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-[10px] tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3">Profesional</th>
                    <th class="px-4 py-3">Licencia SEC</th>
                    <th class="px-4 py-3">Especialidad / Clase</th>
                    <th class="px-4 py-3">Ciudad</th>
                    <th class="px-4 py-3">Certificados</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($recentMembers as $m)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-3 font-bold text-slate-900 flex items-center gap-3">
                            <img src="{{ $m->photo_url }}" alt="{{ $m->full_name }}" class="w-8 h-8 rounded-full object-cover">
                            <div>
                                <p class="leading-tight">{{ $m->full_name }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">{{ $m->email ?: 'Sin email registrado' }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3 font-semibold text-slate-700">{{ $m->sec_licence ?: 'Acreditado SEC' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold text-[10px]">{{ $m->category }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ $m->class }}</span>
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $m->city }}</td>
                        <td class="px-4 py-3 font-bold text-gae-blue">{{ $m->certificates->count() }} certs</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.members.show', $m) }}" class="px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-[10px]">
                                Gestionar & Subir Certs
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ $m->public_url }}'); alert('¡Enlace del socio {{ $m->full_name }} copiado al portapapeles!');" 
                                    class="px-2.5 py-1 rounded bg-sky-50 hover:bg-sky-100 text-sky-700 font-bold text-[10px]" title="Copiar enlace del CV Live">
                                Copiar Link
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
