@extends('admin.layout')

@section('title', "Detalle Boletín: {$bulletin->title} - Panel Admin GAE AG")

@section('admin_content')

<div class="space-y-8">
    
    <!-- Top Summary & Control Bar -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase">{{ $bulletin->category }}</span>
                @if($bulletin->status === 'sent')
                    <span class="px-2.5 py-0.5 rounded bg-emerald-500 text-white text-[10px] font-bold uppercase">ENVÍO COMPLETO</span>
                @elseif($bulletin->status === 'sending')
                    <span class="px-2.5 py-0.5 rounded bg-sky-500 text-white text-[10px] font-bold uppercase animate-pulse">EN COLA DE ENVÍO</span>
                @else
                    <span class="px-2.5 py-0.5 rounded bg-slate-300 text-slate-800 text-[10px] font-bold uppercase">BORRADOR</span>
                @endif
            </div>
            <h2 class="text-2xl font-black text-slate-900">{{ $bulletin->title }}</h2>
            <p class="text-xs text-slate-500 font-medium">Asunto: <strong>{{ $bulletin->subject }}</strong></p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if($bulletin->status !== 'sent')
                <!-- Schedule form inline -->
                <form action="{{ route('admin.bulletins.schedule', $bulletin) }}" method="POST" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-2xl border border-slate-200">
                    @csrf
                    <input type="date" name="scheduled_date" value="{{ $bulletin->scheduled_at ? $bulletin->scheduled_at->format('Y-m-d') : now('America/Santiago')->toDateString() }}" required class="px-3 py-1.5 rounded-xl border border-slate-300 text-xs font-bold">
                    <input type="time" name="scheduled_time" value="{{ $bulletin->scheduled_at ? $bulletin->scheduled_at->format('H:i') : '09:00' }}" required class="px-3 py-1.5 rounded-xl border border-slate-300 text-xs font-bold">
                    <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm">
                        📅 Programar por Cron
                    </button>
                </form>

                <form action="{{ route('admin.bulletins.process_sends', $bulletin) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gae-green hover:bg-gae-green-dark text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                        <span>⚡ Enviar Ahora</span>
                    </button>
                </form>
            @endif

            <form action="{{ route('admin.bulletins.destroy', $bulletin) }}" method="POST" onsubmit="return confirm('¿Eliminar este boletín?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <!-- Progress Meter -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-3">
        <div class="flex justify-between items-center text-xs font-bold">
            <span class="text-slate-700">Progreso de Entregas a Socios</span>
            <span class="text-gae-blue">{{ $bulletin->sent_count }} de {{ $bulletin->total_recipients }} socios ({{ $bulletin->progress_percentage }}%)</span>
        </div>
        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden border border-slate-200">
            <div class="bg-gradient-to-r from-gae-green to-gae-blue h-3 rounded-full transition-all duration-500" style="width: {{ $bulletin->progress_percentage }}%"></div>
        </div>
    </div>

    <!-- Content & Dispatch Log Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Live HTML Bulletin Preview -->
        <div class="lg:col-span-7 space-y-4">
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
                <h4 class="font-bold text-sm text-slate-900">Vista Previa del Contenido Enviado</h4>
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 max-h-[600px] overflow-y-auto">
                    {!! $bulletin->content_html !!}
                </div>
            </div>
        </div>

        <!-- Log Table per Member -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
                <h4 class="font-bold text-sm text-slate-900">Registro de Entregas por Socio ({{ $sends->total() }})</h4>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-[10px] border-b border-slate-200">
                            <tr>
                                <th class="px-3 py-2">Socio / Email</th>
                                <th class="px-3 py-2">Estado</th>
                                <th class="px-3 py-2 text-right">Fecha Envió</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($sends as $s)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-3 py-2.5">
                                        <p class="font-bold text-slate-900 leading-tight">{{ $s->member->full_name ?? 'Socio GAE AG' }}</p>
                                        <p class="text-[10px] text-slate-400 font-mono">{{ $s->email }}</p>
                                    </td>
                                    <td class="px-3 py-2.5">
                                        @if($s->status === 'sent')
                                            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[9px]">ENTREGADO</span>
                                        @elseif($s->status === 'failed')
                                            <span class="px-2 py-0.5 rounded bg-red-100 text-red-800 font-bold text-[9px]">FALLIDO</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 font-bold text-[9px]">PENDIENTE</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2.5 text-right font-medium text-slate-400">
                                        {{ $s->sent_at ? $s->sent_at->format('H:i:s') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-3 py-4 text-center text-slate-400 italic">No hay registros de envío generados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pt-2">
                    {{ $sends->links() }}
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
