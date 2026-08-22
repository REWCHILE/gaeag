@extends('layouts.app')

@section('title', "{$member->full_name} - CV Live & Credencial SEC | GAE AG")
@section('meta_description', "Perfil público y CV digital en vivo de {$member->full_name}, especialista en {$member->category} acreditado por GAE AG y SEC. Licencia: {$member->sec_licence}.")

@push('head')
    <!-- Inject JSON-LD Person/ProfilePage Schema -->
    <script type="application/ld+json">
        {!! json_encode($profileSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')

<div class="py-12 bg-slate-900 text-white border-b border-slate-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Avatar -->
            <div class="relative">
                <img src="{{ $member->photo_url }}" alt="{{ $member->full_name }}" class="w-36 h-36 rounded-3xl object-cover ring-4 ring-gae-green/60 shadow-2xl bg-slate-800">
                <span class="absolute -bottom-2 -right-2 p-2 rounded-xl bg-emerald-500 text-white shadow-lg" title="Verificado por SEC Chile">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </span>
            </div>

            <!-- Basic Details -->
            <div class="flex-grow text-center md:text-left space-y-3">
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-2">
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider">
                        Socio Activo GAE AG
                    </span>
                    <span class="px-3 py-1 rounded-full bg-sky-500/20 text-sky-400 text-xs font-bold uppercase tracking-wider">
                        {{ $member->class }}
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">{{ $member->full_name }}</h1>
                <p class="text-slate-300 font-semibold text-lg">{{ $member->title ?: "Especialista Certificado en {$member->category}" }}</p>
                
                <p class="text-sm text-slate-400 flex items-center justify-center md:justify-start gap-2">
                    <svg class="w-4 h-4 text-gae-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $member->city }}, {{ $member->region }} (Chile)
                </p>
            </div>

            <!-- Quick Action: Share -->
            <div class="shrink-0 flex flex-col gap-2">
                <button onclick="navigator.clipboard.writeText('{{ $member->public_url }}'); alert('¡Enlace del CV copiado!');" 
                        class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs flex items-center justify-center gap-2 border border-slate-700 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                    Compartir Perfil Live
                </button>
            </div>
        </div>

    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Main CV Details -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Technical Accreditation Card -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-xl font-black text-slate-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-gae-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    Acreditación Técnica y Registro SEC
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-xs text-slate-500 font-semibold">Licencia Acreditada SEC</p>
                        <p class="text-lg font-black text-slate-900 mt-1">{{ $member->sec_licence ?: 'Acreditación Oficial Activa' }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-xs text-slate-500 font-semibold">Categoría Principal</p>
                        <p class="text-lg font-black text-gae-green mt-1">{{ $member->category }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-xs text-slate-500 font-semibold">Clase / Nivel de Licencia</p>
                        <p class="text-lg font-black text-gae-blue mt-1">{{ $member->class }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-xs text-slate-500 font-semibold">Identificación RUT</p>
                        <p class="text-lg font-black text-slate-900 mt-1">{{ $member->rut ?: 'Verificado por Directiva' }}</p>
                    </div>
                </div>
            </div>

            <!-- Bio / Trayectoria -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-xl font-black text-slate-900">Trayectoria y Experiencia Profesional</h3>
                <p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line">
                    {{ $member->bio ?: 'Este profesional acredita trayectoria comprobada y actualización continua en normativas chilenas vigentes.' }}
                </p>
            </div>

            <!-- Verified SEC Certificates & Diplomas -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-black text-slate-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-gae-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Certificados y Licencias Oficiales SEC
                    </h3>
                    <span class="text-xs font-bold text-slate-400">{{ $member->certificates->count() }} Archivos Adjuntos</span>
                </div>

                @if($member->certificates->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($member->certificates as $cert)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col justify-between space-y-3">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-bold">VERIFICADO SEC</span>
                                        @if($cert->issue_date)
                                            <span class="text-[11px] text-slate-400 font-medium">{{ $cert->issue_date->format('Y') }}</span>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-slate-900 text-sm mt-2">{{ $cert->title }}</h4>
                                    <p class="text-xs text-slate-500 font-medium">{{ $cert->issuing_entity }}</p>
                                </div>

                                <a href="{{ $cert->file_url }}" target="_blank" class="inline-flex items-center justify-center gap-2 w-full py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Ver Documento SEC
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500 italic">No se han adjuntado documentos adicionales por la directiva.</p>
                @endif
            </div>

        </div>

        <!-- Sidebar: QR Badge & Contact -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Unique QR Code Badge -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm text-center space-y-4">
                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider">
                    Código QR Verificado SEC
                </span>

                <div class="flex justify-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    @if($member->qr_code_url)
                        <img src="{{ $member->qr_code_url }}" alt="QR SEC {{ $member->full_name }}" class="w-48 h-48 object-contain rounded-xl shadow-sm border border-slate-200">
                    @else
                        <p class="text-xs text-slate-400">Generando Código QR SEC...</p>
                    @endif
                </div>

                <p class="text-xs text-slate-500">
                    Escanea este código QR oficial SEC desde tu teléfono para verificar la validez y certificados activos de <strong>{{ $member->full_name }}</strong>.
                </p>

                @if($member->sec_qr_url)
                    <div class="p-3 rounded-xl bg-sky-50 border border-sky-200 text-[11px] text-sky-900 font-semibold space-y-1">
                        <p class="text-[10px] uppercase font-bold text-sky-600">Verificación Externa Configurada</p>
                        <p class="truncate">{{ $member->sec_qr_url }}</p>
                    </div>
                @endif

                <div class="space-y-2">
                    @if($member->sec_qr_url)
                        <a href="{{ $member->sec_qr_url }}" target="_blank" 
                           class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center justify-center gap-2 shadow-md transition-all">
                            Verificar Licencia Oficial en Sitio SEC.cl ↗
                        </a>
                    @endif

                    @if($member->qr_code_url)
                        <a href="{{ $member->qr_code_url }}" download="QR-SEC-{{ $member->slug }}.png" target="_blank" 
                           class="w-full py-2.5 rounded-xl bg-gae-blue hover:bg-gae-blue-dark text-white font-bold text-xs flex items-center justify-center gap-2 shadow-sm transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Descargar Código QR SEC (PNG)
                        </a>
                    @endif
                </div>
            </div>

            <!-- Direct Contact buttons -->
            <div class="bg-slate-900 rounded-3xl p-6 text-white shadow-xl space-y-4">
                <h4 class="font-bold text-lg text-white">Contacto Directo</h4>
                <p class="text-xs text-slate-300">Comunícate directamente con este especialista acreditado por GAE AG.</p>

                @if($member->phone)
                    <!-- WhatsApp button -->
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}?text={{ urlencode('Hola ' . $member->full_name . ', te contacto desde la plataforma oficial de GAE AG para consultar por un servicio.') }}" 
                       target="_blank" 
                       class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/20 transition-all">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        Contactar por WhatsApp
                    </a>

                    <!-- Direct Call -->
                    <a href="tel:{{ $member->phone }}" 
                       class="w-full py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs flex items-center justify-center gap-2 border border-slate-700 transition-all">
                        <svg class="w-4 h-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Llamar a {{ $member->phone }}
                    </a>
                @endif

                @if($member->email)
                    <!-- Email -->
                    <a href="mailto:{{ $member->email }}" 
                       class="w-full py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs flex items-center justify-center gap-2 border border-slate-700 transition-all">
                        <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Enviar Correo Electrónico
                    </a>
                @endif
            </div>

        </div>

    </div>
</div>

@endsection
