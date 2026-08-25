@extends('admin.layout')

@section('title', 'Grilla y Calendario de Contenidos IA con Cron Automático - Panel Admin GAE AG')

@section('admin_content')

<div class="space-y-8" x-data="{ schedulingModal: false, activeItem: null, scheduleDate: '', scheduleTime: '09:00' }">
    
    <!-- Top Action Bar -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                    Orquestador de Contenidos & Cron Automático
                </span>
                <span class="px-3 py-1 rounded-full bg-slate-900 text-slate-200 text-xs font-bold font-mono">
                    🇨🇱 Hora Oficial Chile: {{ $currentTimeChile }}
                </span>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mt-2">Planificador y Despacho Automatizado</h2>
            <p class="text-xs text-slate-500">Programa temas por día y hora exacta (Chile). El sistema y el Cron los redactarán y enviarán por correo a los socios automáticamente.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.content_grid.run_cron') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-extrabold text-xs shadow-md transition-all flex items-center gap-1.5" title="Revisar y enviar inmediatamente los contenidos que estén en la hora programada">
                    <span>⚡</span>
                    <span>Ejecutar Cron Manual Ahora</span>
                </button>
            </form>

            <form action="{{ route('admin.content_grid.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="frequency" value="semanal">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-gae-green hover:bg-gae-green-dark text-white font-bold text-xs shadow-md transition-all">
                    + Generar Semana IA (4 Temas)
                </button>
            </form>

            <form action="{{ route('admin.content_grid.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="frequency" value="mensual">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                    + Generar Mes IA (8 Temas)
                </button>
            </form>
        </div>
    </div>

    <!-- Server Cron Info Tip Banner -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-950 text-white rounded-3xl p-5 border border-slate-800 shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-4 text-xs">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold shrink-0">
                ⏰
            </div>
            <div>
                <p class="font-bold text-slate-200">Activación del Cron de Servidor para envíos 100% automáticos:</p>
                <p class="text-slate-400 font-mono text-[11px] mt-0.5 select-all">* * * * * cd /home/instalgaschile/web/gae-ag.cl/public_html && php artisan schedule:run >> /dev/null 2>&1</p>
            </div>
        </div>
        <span class="px-3 py-1.5 rounded-xl bg-emerald-500/20 text-emerald-400 font-bold text-[11px] shrink-0 border border-emerald-500/30">
            Zona Horaria: America/Santiago
        </span>
    </div>

    <!-- Scheduling Modal (Date & Time Picker Chile) -->
    <div x-cloak x-show="schedulingModal" class="relative z-50" role="dialog" aria-modal="true">
        <div x-show="schedulingModal" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="schedulingModal = false" 
             class="fixed inset-0 bg-slate-950/70 backdrop-blur-md"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
            <div x-show="schedulingModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="w-full max-w-lg bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-6 text-slate-800 text-xs">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600">Orquestador de Envíos</span>
                        <h3 class="text-lg font-black text-slate-900">Programar Fecha y Hora de Envío</h3>
                    </div>
                    <button type="button" @click="schedulingModal = false" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 font-bold">
                        ✕
                    </button>
                </div>

                <template x-if="activeItem">
                    <form :action="'/admin/grilla-contenido/' + activeItem.id + '/programar'" method="POST" class="space-y-4">
                        @csrf

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] font-black uppercase text-slate-400 block" x-text="activeItem.category"></span>
                            <h4 class="font-bold text-slate-900 text-sm mt-0.5" x-text="activeItem.topic"></h4>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Día de Envío (*):</label>
                                <input type="date" name="scheduled_date" x-model="scheduleDate" required
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-bold text-slate-800 focus:ring-2 focus:ring-gae-green outline-none">
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Hora de Envío (Chile) (*):</label>
                                <input type="time" name="scheduled_time" x-model="scheduleTime" required
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-bold text-slate-800 focus:ring-2 focus:ring-gae-green outline-none">
                            </div>
                        </div>

                        <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-[11px] leading-relaxed">
                            💡 <strong>Automatización Total:</strong> Al programar este tema, el Cron lo tomará a la hora indicada, generará el boletín con Inteligencia Artificial si aún no está redactado y lo despachará por correo a todos los socios activos.
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="button" @click="schedulingModal = false" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">
                                Cancelar
                            </button>
                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold shadow-md">
                                ✓ Aprobar & Programar Envío
                            </button>
                        </div>
                    </form>
                </template>

            </div>
        </div>
    </div>

    <!-- Content Grid Calendar View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($gridItems as $item)
            @php
                $targetDateTime = $item->scheduled_at ?: ($item->scheduled_date ? \Carbon\Carbon::parse($item->scheduled_date->format('Y-m-d') . ' 09:00:00', 'America/Santiago') : null);
                $dateFormatted = $targetDateTime ? $targetDateTime->format('d/m/Y') : 'Sin fecha';
                $timeFormatted = $targetDateTime ? $targetDateTime->format('H:i') : '09:00';
            @endphp
            <div class="bg-white rounded-3xl p-6 border {{ $item->status === 'scheduled' ? 'border-emerald-400 ring-2 ring-emerald-400/20' : 'border-slate-200' }} shadow-sm flex flex-col justify-between space-y-4 hover:shadow-lg transition-all">
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <span class="px-2.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px] uppercase">{{ $item->category }}</span>
                        
                        <div class="text-[11px] font-bold text-slate-500 font-mono">
                            📅 {{ $dateFormatted }} <span class="text-emerald-600 font-black">⏰ {{ $timeFormatted }}</span>
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-900 text-sm leading-snug">{{ $item->topic }}</h4>
                    
                    <div>
                        @if($item->status === 'sent')
                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px] inline-flex items-center gap-1">
                                <span>✓</span> <span>DESPACHADO POR CRON</span>
                            </span>
                        @elseif($item->status === 'scheduled')
                            <span class="px-2.5 py-1 rounded-full bg-sky-100 text-sky-800 font-bold text-[10px] inline-flex items-center gap-1 animate-pulse">
                                <span>⏰</span> <span>PROGRAMADO PARA {{ $dateFormatted }} {{ $timeFormatted }}</span>
                            </span>
                        @elseif($item->status === 'generated')
                            <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 font-bold text-[10px]">
                                📝 BOLETÍN REDACTADO (Borrador)
                            </span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">
                                💡 IDEA PLANIFICADA
                            </span>
                        @endif
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                    
                    <!-- Button to open Scheduling Modal -->
                    <button type="button" 
                            @click="activeItem = {{ json_encode($item) }}; scheduleDate = '{{ $targetDateTime ? $targetDateTime->format('Y-m-d') : now('America/Santiago')->toDateString() }}'; scheduleTime = '{{ $timeFormatted }}'; schedulingModal = true;"
                            class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm flex items-center justify-center gap-1.5 transition-all">
                        <span>📅</span>
                        <span>{{ $item->status === 'scheduled' ? 'Modificar Día / Hora' : 'Aceptar & Programar Hora' }}</span>
                    </button>

                    <!-- Pre-generate bulletin with IA if desired -->
                    @if($item->bulletin)
                        <a href="{{ route('admin.bulletins.show', $item->bulletin) }}" class="w-full py-2 rounded-xl bg-sky-50 hover:bg-sky-100 text-sky-800 font-bold text-xs text-center transition-all">
                            Ver Boletín Creado &rarr;
                        </a>
                    @else
                        <form action="{{ route('admin.content_grid.convert', $item) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all text-center">
                                ⚡ Redactar Borrador IA Ahora
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.content_grid.destroy', $item) }}" method="POST" onsubmit="return confirm('¿Quitar este tema de la grilla?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-1.5 rounded-lg bg-red-50 text-red-600 font-bold text-[10px] hover:bg-red-100">
                            Eliminar de la Grilla
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl p-12 text-center text-slate-400 space-y-4 border border-slate-200">
                <p class="text-base font-bold text-slate-600">No hay temas generados en la grilla de contenidos aún.</p>
                <p class="text-xs text-slate-500">Haz clic en <strong>Generar Semana IA</strong> o <strong>Generar Mes IA</strong> para que la Inteligencia Artificial sugiera temas normativos sobre Gas, Agua y Energía.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
