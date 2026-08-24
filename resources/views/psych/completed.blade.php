@extends('layouts.app')

@section('title', 'Evaluación Psicológica Completada - GAE AG')

@section('content')

<section class="py-16 bg-slate-950 text-white min-h-[85vh] flex items-center justify-center relative overflow-hidden">
    
    <!-- Glowing Background Accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-green/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-8">
        
        <!-- Big Animated Checkmark Icon -->
        <div class="inline-flex p-6 rounded-full bg-emerald-500/20 text-emerald-400 border-2 border-emerald-500/40 shadow-2xl shadow-emerald-500/30 animate-bounce">
            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="space-y-4">
            <span class="px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-wider border border-emerald-500/30">
                Filtro de Admisión Registrado Exitosamente
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                ¡Gracias, {{ $application->full_name }}!
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-lg mx-auto">
                Tu información técnica y tu <strong>Test Psicológico y Ético-Laboral de Admisión</strong> han sido registrados en nuestro sistema. El Administrador y la Comisión de Admisión de <strong>GAE AG</strong> analizarán tus resultados para la acreditación oficial.
            </p>
        </div>

        <!-- Summary Card -->
        <div class="p-6 rounded-3xl bg-slate-900/90 border border-slate-800 text-left space-y-3 text-xs sm:text-sm text-slate-300 backdrop-blur-md">
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-400 font-semibold">Postulante:</span>
                <span class="font-bold text-white">{{ $application->full_name }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-400 font-semibold">RUT:</span>
                <span class="font-mono text-white">{{ $application->rut }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-400 font-semibold">Especialidad:</span>
                <span class="font-bold text-emerald-400">{{ $application->category }} ({{ $application->class ?: 'SEC' }})</span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-400 font-semibold">Estado de Evaluación:</span>
                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 font-black text-[11px] border border-emerald-500/30">
                    ✓ Test Completado & Enviado al Admin
                </span>
            </div>
            <div class="flex justify-between pt-1">
                <span class="text-slate-400 font-semibold">Fecha de Registro:</span>
                <span class="text-slate-300">{{ now()->format('d/m/Y H:i') }}</span>
            </div>
        </div>

        <!-- Direct WhatsApp Action to Admin -->
        @php
            $waMsg = "Hola Administrador de GAE AG, he completado mi postulación y el Test Psicológico de Admisión:\n\n"
                   . "• Nombre: {$application->full_name}\n"
                   . "• RUT: {$application->rut}\n"
                   . "• Especialidad: {$application->category} ({$application->class})\n"
                   . "• Ciudad: {$application->city}, {$application->region}\n\n"
                   . "Quedo atento a la revisión de mi informe para incorporarme al Gremio.";
            $waUrl = "https://wa.me/{$adminWhatsapp}?text=" . urlencode($waMsg);
        @endphp

        <div class="flex flex-col sm:flex-row gap-4 justify-center pt-2">
            <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
               class="px-8 py-4 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-sm shadow-2xl shadow-emerald-500/30 hover:scale-105 transition-all flex items-center justify-center gap-2 min-h-[52px]">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.175 4.287-1.124zm11.383-6.183c-.309-.154-1.826-.901-2.109-1.004-.284-.103-.491-.154-.698.154-.207.309-.801 1.004-.982 1.211-.181.207-.362.232-.67.077-.309-.154-1.306-.481-2.488-1.535-.919-.82-1.54-1.833-1.721-2.142-.181-.309-.019-.476.135-.63.139-.138.309-.362.464-.542.155-.181.207-.309.31-.516.103-.207.052-.387-.026-.542-.078-.154-.698-1.681-.957-2.301-.252-.603-.509-.522-.698-.531-.18-.009-.387-.009-.595-.009-.207 0-.542.078-.826.387-.284.309-1.085 1.061-1.085 2.589 0 1.528 1.112 3.004 1.267 3.211.155.207 2.189 3.342 5.304 4.686.741.32 1.319.511 1.77.654.743.236 1.419.203 1.953.123.596-.089 1.826-.746 2.084-1.467.258-.721.258-1.339.181-1.467-.078-.128-.284-.206-.593-.361z"/>
                </svg>
                <span>Avisar al Administrador por WhatsApp</span>
            </a>

            <a href="{{ route('home') }}" 
               class="px-6 py-4 rounded-2xl bg-slate-900 hover:bg-slate-800 text-slate-300 font-bold text-sm border border-slate-700 transition-all flex items-center justify-center min-h-[52px]">
                Volver al Sitio Principal
            </a>
        </div>

    </div>
</section>

@endsection
