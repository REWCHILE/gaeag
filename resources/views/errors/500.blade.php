@extends('layouts.app')

@section('title', '500 - Error del Servidor | GAE AG')
@section('meta_description', 'Ha ocurrido un error temporal en el servidor. Por favor intenta recargar la página o contáctanos directamente.')

@section('content')
<section class="py-24 bg-slate-950 text-white min-h-[70vh] flex items-center justify-center relative overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-2xl mx-auto px-4 text-center relative z-10 space-y-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-bold text-rose-400">
            <span class="w-2 h-2 rounded-full bg-rose-400 animate-ping"></span>
            Error 500 &bull; Interrupción Temporal
        </div>

        <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white">
            Servicio Momentáneamente No Disponible
        </h1>

        <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
            Estamos realizando ajustes técnicos en el servidor. Por favor recarga la página o contáctanos por WhatsApp si necesitas asistencia inmediata.
        </p>

        <div class="flex flex-wrap justify-center gap-4 pt-4">
            <a href="{{ route('home') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-bold text-sm shadow-xl hover:scale-105 transition-all flex items-center gap-2">
                Recargar Inicio
            </a>
            <a href="https://wa.me/{{ \App\Models\Setting::getByKey('contact_whatsapp', '56949877316') }}" target="_blank" class="px-6 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-sm hover:bg-emerald-500 transition-all flex items-center gap-2">
                Soporte por WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
