@extends('admin.layout')

@section('title', 'Nómina de Socios - Panel Admin GAE AG')

@section('admin_content')

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-black text-slate-900">Nómina de Socios GAE AG</h3>
            <p class="text-xs text-slate-500">Administración de credenciales, licencias SEC y generación de QR</p>
        </div>

        <div class="flex items-center gap-3">
            <form action="{{ route('admin.members.regenerate_all_qrs') }}" method="POST" onsubmit="return confirm('¿Regenerar dinámicamente los códigos QR SEC de todos los socios?');">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all flex items-center gap-1.5">
                    <span>🔄</span>
                    <span>Regenerar Códigos QR SEC</span>
                </button>
            </form>

            <a href="{{ route('admin.members.create') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                + Registrar Nuevo Socio
            </a>
        </div>
    </div>

    <!-- Search Form -->
    <form action="{{ route('admin.members.index') }}" method="GET" class="flex gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre, licencia SEC o ciudad..." 
               class="px-4 py-2.5 rounded-xl border border-slate-300 text-xs w-full sm:w-80 focus:outline-none focus:ring-2 focus:ring-gae-blue">
        <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs">
            Buscar
        </button>
        @if($search)
            <a href="{{ route('admin.members.index') }}" class="px-4 py-2.5 rounded-xl bg-red-50 text-red-600 font-bold text-xs flex items-center">Limpiar</a>
        @endif
    </form>

    <!-- Members Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-[10px] tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3">Socio</th>
                    <th class="px-4 py-3">Licencia SEC</th>
                    <th class="px-4 py-3">Categoría / Clase</th>
                    <th class="px-4 py-3">Ubicación</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3 text-right">Acciones de Admin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($members as $m)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-3 font-bold text-slate-900 flex items-center gap-3">
                            <img src="{{ $m->photo_url }}" alt="{{ $m->full_name }}" class="w-9 h-9 rounded-full object-cover">
                            <div>
                                <a href="{{ route('admin.members.show', $m) }}" class="hover:text-gae-blue font-bold text-sm block">
                                    {{ $m->full_name }}
                                </a>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $m->email ?: 'Sin email' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $m->sec_licence ?: 'Acreditado SEC' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">{{ $m->category }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ $m->class }}</span>
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $m->city }}</td>
                        <td class="px-4 py-3">
                            @if($m->is_active)
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold text-[10px]">PÚBLICO LIVE</span>
                            @else
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-500 font-bold text-[10px]">INACTIVO</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-1">
                            <button onclick="navigator.clipboard.writeText('{{ $m->public_url }}'); alert('¡Enlace del CV Live de {{ $m->full_name }} copiado al portapapeles!');" 
                                    class="px-2.5 py-1.5 rounded bg-sky-50 hover:bg-sky-100 text-sky-700 font-bold text-[10px]" title="Copiar Enlace para enviar al socio">
                                Copiar Link Live
                            </button>
                            
                            <a href="{{ route('admin.members.show', $m) }}" class="px-2.5 py-1.5 rounded bg-slate-900 hover:bg-slate-800 text-white font-bold text-[10px]">
                                Perfil & Certs ({{ $m->certificates->count() }})
                            </a>

                            <a href="{{ route('admin.members.edit', $m) }}" class="px-2 py-1.5 rounded bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-[10px]">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-400">No se encontraron socios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pt-4">
        {{ $members->links() }}
    </div>

</div>

@endsection
