@extends('admin.layout')

@section('title', "Administrar: {$member->full_name} - Panel Admin GAE AG")

@section('admin_content')

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Member Summary & Quick Actions -->
    <div class="lg:col-span-5 space-y-6">
        
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center gap-4">
                <img src="{{ $member->photo_url }}" alt="{{ $member->full_name }}" class="w-20 h-20 rounded-2xl object-cover ring-2 ring-slate-200">
                <div>
                    <h3 class="text-xl font-black text-slate-900">{{ $member->full_name }}</h3>
                    <p class="text-xs font-bold text-gae-blue">{{ $member->title ?: $member->category }}</p>
                    <p class="text-xs text-slate-500">{{ $member->city }}, {{ $member->region }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 space-y-2 text-xs">
                <div class="flex justify-between py-1 border-b border-slate-50">
                    <span class="text-slate-500 font-semibold">Licencia SEC:</span>
                    <span class="font-bold text-slate-900">{{ $member->sec_licence ?: 'Acreditado SEC' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-50">
                    <span class="text-slate-500 font-semibold">Clase:</span>
                    <span class="font-bold text-gae-green">{{ $member->class }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-50">
                    <span class="text-slate-500 font-semibold">Teléfono:</span>
                    <span class="font-bold text-slate-900">{{ $member->phone ?: 'No registrado' }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-500 font-semibold">Email:</span>
                    <span class="font-bold text-slate-900">{{ $member->email ?: 'No registrado' }}</span>
                </div>
            </div>

            <!-- Share & Live Link Actions -->
            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                <button onclick="navigator.clipboard.writeText('{{ $member->public_url }}'); alert('¡Enlace copiado al portapapeles! Puedes enviarlo directamente al socio.');" 
                        class="w-full py-2.5 rounded-xl bg-sky-50 hover:bg-sky-100 text-sky-800 font-bold text-xs flex items-center justify-center gap-2 border border-sky-200 transition-all">
                    <svg class="w-4 h-4 text-gae-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Copiar Enlace CV Live para Socio
                </button>

                <a href="{{ $member->public_url }}" target="_blank" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs text-center transition-all">
                    Ver Página Pública CV Live &rarr;
                </a>

                <a href="{{ route('admin.members.edit', $member) }}" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs text-center transition-all">
                    Editar Datos del Perfil
                </a>
            </div>
        </div>

        <!-- QR Code Preview & Download -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm text-center space-y-3">
            <h4 class="font-bold text-sm text-slate-900 uppercase tracking-wider">Código QR Oficial SEC del Socio</h4>
            
            <div class="flex justify-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                @if($member->qr_code_url)
                    <img src="{{ $member->qr_code_url }}" alt="QR SEC {{ $member->full_name }}" class="w-40 h-40 object-contain rounded-xl border border-slate-200 shadow-sm">
                @else
                    <p class="text-xs text-slate-400">QR no generado.</p>
                @endif
            </div>

            @if($member->qr_code_url)
                <a href="{{ $member->qr_code_url }}" download="QR-SEC-{{ $member->slug }}.png" target="_blank" 
                   class="w-full py-2 rounded-xl bg-gae-blue hover:bg-gae-blue-dark text-white font-bold text-xs block transition-all shadow-sm">
                    Descargar Código QR SEC (PNG)
                </a>
            @endif
        </div>

        <!-- Danger Zone -->
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 space-y-2">
            <p class="text-xs font-bold text-red-800">Eliminar Socio del Gremio</p>
            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar a este socio y todos sus certificados?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs">
                    Eliminar Perfil Permanentemente
                </button>
            </form>
        </div>

    </div>

    <!-- Right Side: Certificates & Upload Form -->
    <div class="lg:col-span-7 space-y-8">
        
        <!-- Upload Certificate Form (Only Admin) -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
            <div>
                <h4 class="text-lg font-black text-slate-900">Adjuntar Nuevo Certificado SEC o Diploma</h4>
                <p class="text-xs text-slate-500">Solo el administrador puede subir certificados verificados para este socio.</p>
            </div>

            <form action="{{ route('admin.certificates.store', $member) }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Título del Certificado / Documento *</label>
                    <input type="text" name="title" required placeholder="Ej: Licencia de Instalador de Gas Autorizado SEC Clase A" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Entidad Emisora *</label>
                        <input type="text" name="issuing_entity" required value="Superintendencia de Electricidad y Combustibles SEC" 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Número de Registro / Certificado</label>
                        <input type="text" name="certificate_number" placeholder="Ej: SEC-774129-GAE" 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Fecha de Emisión</label>
                        <input type="date" name="issue_date" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Archivo de Certificado (PDF / Imagen) *</label>
                        <input type="file" name="certificate_file" required accept=".pdf,.png,.jpg,.jpeg,.webp" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700">
                    </div>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-gae-green hover:bg-gae-green-dark text-white font-bold text-xs shadow-md transition-all">
                    Subir y Acreditar Certificado Oficial SEC
                </button>
            </form>
        </div>

        <!-- List of Attached Certificates -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
            <h4 class="text-lg font-black text-slate-900">Certificados Adjuntos en el Perfil ({{ $member->certificates->count() }})</h4>

            @forelse($member->certificates as $cert)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-bold">Acreditación SEC</span>
                            <span class="text-slate-400">{{ $cert->certificate_number }}</span>
                        </div>
                        <h5 class="font-bold text-slate-900 text-sm">{{ $cert->title }}</h5>
                        <p class="text-slate-500 font-medium">{{ $cert->issuing_entity }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ $cert->file_url }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white font-bold text-[10px]">
                            Ver Documento
                        </a>

                        <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" onsubmit="return confirm('¿Eliminar este certificado?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 font-bold text-[10px]">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-400 italic">No hay certificados adjuntos para este socio aún.</p>
            @endforelse
        </div>

    </div>

</div>

@endsection
