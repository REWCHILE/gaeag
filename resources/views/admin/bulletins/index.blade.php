@extends('admin.layout')

@section('title', 'Boletines & Mailer IA - Panel Admin GAE AG')

@section('admin_content')

<div class="space-y-8">
    
    <!-- Header & Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Boletines Emitidos</p>
            <p class="text-3xl font-black text-slate-900">{{ $totalBulletins }}</p>
            <p class="text-xs text-emerald-600 font-semibold">Generación asistida por IA</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Correos Entregados</p>
            <p class="text-3xl font-black text-gae-blue">{{ $totalSentEmails }}</p>
            <p class="text-xs text-slate-400 font-medium">Envíos seguros en cola</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Socios Destinatarios</p>
            <p class="text-3xl font-black text-gae-amber">{{ $activeMembersWithEmail }}</p>
            <p class="text-xs text-slate-400 font-medium">Con correo electrónico activo</p>
        </div>
    </div>

    <!-- Table of Bulletins -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-xl font-black text-slate-900">Historial de Boletines Informativos</h3>
                <p class="text-xs text-slate-500">Comunicaciones técnicas enviadas a los profesionales del gremio</p>
            </div>

            <a href="{{ route('admin.bulletins.create') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                <span>⚡ Redactar Nuevo Boletín con IA</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-[10px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Boletín / Título</th>
                        <th class="px-4 py-3">Categoría</th>
                        <th class="px-4 py-3">Estado de Envío</th>
                        <th class="px-4 py-3">Progreso de Entregas</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bulletins as $b)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 py-3 font-bold text-slate-900">
                                <a href="{{ route('admin.bulletins.show', $b) }}" class="hover:text-gae-blue font-bold text-sm block">
                                    {{ $b->title }}
                                </a>
                                <span class="text-[10px] text-slate-400 font-normal block">{{ $b->subject }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">{{ $b->category }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($b->status === 'sent')
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px]">ENVIADO COMPLETO</span>
                                @elseif($b->status === 'sending')
                                    <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 font-bold text-[10px] animate-pulse">EN COLA DE ENVÍO</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 font-bold text-[10px]">BORRADOR</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="w-32 bg-slate-100 rounded-full h-2 overflow-hidden border border-slate-200">
                                    <div class="bg-gae-green h-2 rounded-full" style="width: {{ $b->progress_percentage }}%"></div>
                                </div>
                                <span class="text-[10px] text-slate-500 font-semibold">{{ $b->sent_count }} de {{ $b->total_recipients }} socios ({{ $b->progress_percentage }}%)</span>
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-500">{{ $b->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-right space-x-1">
                                <a href="{{ route('admin.bulletins.show', $b) }}" class="px-3 py-1.5 rounded bg-slate-900 hover:bg-slate-800 text-white font-bold text-[10px]">
                                    Ver Detalle & Envíos
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">No hay boletines creados aún. ¡Genera el primero con Inteligencia Artificial!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $bulletins->links() }}
        </div>

    </div>

</div>

@endsection
