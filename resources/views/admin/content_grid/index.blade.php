@extends('admin.layout')

@section('title', 'Grilla de Contenido Semanal/Mensual IA - Panel Admin GAE AG')

@section('admin_content')

<div class="space-y-8">
    
    <!-- Top Action Bar -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                Calendario de Contenidos IA
            </span>
            <h2 class="text-2xl font-black text-slate-900 mt-2">Grilla de Contenido Semanal & Mensual</h2>
            <p class="text-xs text-slate-500">Planificación inteligente de temas variados sobre Gas, Agua y Energía para envíos periódicos a la nómina de socios.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.content_grid.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="frequency" value="semanal">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-gae-green hover:bg-gae-green-dark text-white font-bold text-xs shadow-md transition-all">
                    + Generar Grilla Semanal IA (4 Temas)
                </button>
            </form>

            <form action="{{ route('admin.content_grid.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="frequency" value="mensual">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-gae-blue hover:bg-gae-blue-dark text-white font-bold text-xs shadow-md transition-all">
                    + Generar Grilla Mensual IA (8 Temas)
                </button>
            </form>
        </div>
    </div>

    <!-- Content Grid Calendar View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($gridItems as $item)
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-lg transition-all">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px] uppercase">{{ $item->category }}</span>
                        <span class="text-[11px] font-bold text-slate-400">📅 {{ $item->scheduled_date ? $item->scheduled_date->format('d/m/Y') : 'Programado' }}</span>
                    </div>

                    <h4 class="font-bold text-slate-900 text-sm leading-snug">{{ $item->topic }}</h4>
                    
                    <div class="text-[11px]">
                        @if($item->status === 'generated')
                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold">BOLETÍN GENERADO</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 font-bold">PLANIFICADO</span>
                        @endif
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                    @if($item->status === 'planned')
                        <form action="{{ route('admin.content_grid.convert', $item) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm transition-all text-center">
                                ⚡ Convertir en Boletín & Redactar
                            </button>
                        </form>
                    @elseif($item->bulletin)
                        <a href="{{ route('admin.bulletins.show', $item->bulletin) }}" class="w-full py-2.5 rounded-xl bg-gae-blue text-white font-bold text-xs text-center transition-all">
                            Ver Boletín Creado &rarr;
                        </a>
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
                <p class="text-xs text-slate-500">Haz clic en <strong>Generar Grilla Semanal</strong> o <strong>Mensual</strong> para que la Inteligencia Artificial sugiera temas normativos diversos sobre Gas, Agua y Energía.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
