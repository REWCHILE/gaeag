@extends('layouts.app')

@section('title', '404 - Página no encontrada | GAE AG')
@section('meta_description', 'La página solicitada no existe o ha sido movida. Explora el Directorio Oficial de Socios de GAE AG o regresa a la página de inicio.')

@section('content')
<section class="py-24 bg-slate-950 text-white min-h-[70vh] flex items-center justify-center relative overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gae-green/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-2xl mx-auto px-4 text-center relative z-10 space-y-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-bold text-amber-400">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
            Error 404 &bull; Enlace no encontrado
        </div>

        <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white">
            Página No Encontrada
        </h1>

        <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
            La página que buscas no existe, cambió de dirección o fue reestructurada dentro de nuestra plataforma oficial.
        </p>

        <div class="flex flex-wrap justify-center gap-4 pt-4">
            <a href="{{ route('home') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-bold text-sm shadow-xl hover:scale-105 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Volver al Inicio
            </a>
            <a href="{{ route('home') }}#profesionales" class="px-6 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-slate-200 font-bold text-sm hover:bg-slate-800 transition-all flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Buscar Instalador SEC
            </a>
        </div>
    </div>
</section>
@endsection
