@extends('layouts.app')

@section('title', 'Beneficios de Pertenecer a GAE AG - Asociación Gremial de Profesionales del Gas, Agua y Energía')
@section('meta_description', 'Descubre los 10 beneficios exclusivos de colegiarte en GAE AG: respaldo gremial, derivación de clientes, perfil digital con QR SEC, asesoría técnica y convenios comerciales.')

@push('head')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Inicio",
                "item": "{{ route('home') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Beneficios Socios",
                "item": "{{ route('pages.beneficios') }}"
            }
        ]
    }
    </script>
@endpush

@section('content')

<!-- Hero Section -->
<section class="relative bg-slate-950 text-white py-16 lg:py-24 overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-green/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        <span class="px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-wider border border-emerald-500/30">
            Propuesta de Valor para Especialistas
        </span>

        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white max-w-4xl mx-auto leading-tight">
            10 Razones para Pertenecer a la Asociación Gremial <span class="bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-400 bg-clip-text text-transparent">GAE AG</span>
        </h1>

        <p class="text-slate-300 text-sm sm:text-lg max-w-2xl mx-auto leading-relaxed font-medium">
            Potencia tu carrera técnica, accede a más y mejores clientes, y cuenta con el respaldo de una comunidad profesional líder en Gas, Agua y Energía en Chile.
        </p>

        <div class="pt-4">
            <a href="{{ route('pages.unete') }}" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-black text-sm shadow-xl hover:scale-105 transition-all inline-flex items-center gap-2">
                <span>⚡ Postular y Rendir Test de Admisión</span>
            </a>
        </div>
    </div>
</section>

<!-- 10 Core Benefits Grid -->
<section class="py-20 bg-white text-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center space-y-4 max-w-2xl mx-auto">
            <span class="px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-black uppercase tracking-wider">
                Respaldo Integral
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900">
                Todo lo que GAE AG Hace por tu Desarrollo Profesional
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- 1. Perfil Digital QR -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-emerald-50/40 hover:border-emerald-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform">
                    📱
                </div>
                <h3 class="text-lg font-black text-slate-900">1. Perfil Público & Credencial QR SEC</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Tu propia ficha web oficial en <code class="text-emerald-700 font-mono text-xs">gae-ag.cl/profesionales/tu-nombre</code> con código QR dinámico que tus clientes pueden escanear al instante para validar tu licencia SEC.
                </p>
            </div>

            <!-- 2. Derivación de Clientes -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-sky-50/40 hover:border-sky-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-sky-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-sky-500/20 group-hover:scale-110 transition-transform">
                    🚀
                </div>
                <h3 class="text-lg font-black text-slate-900">2. Derivación de Clientes y Obras</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Aparece en los primeros resultados de búsqueda de Google y recibe solicitudes directas de particulares, condominios y empresas que buscan instaladores autorizados en tu comuna.
                </p>
            </div>

            <!-- 3. Actualización Normativa -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-amber-50/40 hover:border-amber-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform">
                    📚
                </div>
                <h3 class="text-lg font-black text-slate-900">3. Actualización Técnica DS66 / DS222</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Boletines técnicos periódicos, análisis de circulares de la SEC, protocolos de seguridad para Sello Verde y novedades normativas para estar siempre un paso adelante.
                </p>
            </div>

            <!-- 4. Respaldo Jurídico y Gremial -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-slate-100 hover:border-slate-400 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-slate-900/20 group-hover:scale-110 transition-transform">
                    🛡️
                </div>
                <h3 class="text-lg font-black text-slate-900">4. Respaldo Institucional y Jurídico</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Orientación gremial ante controversias contractuales, fiscalizaciones o reclamos injustificados de clientes. No estás solo, tienes un gremio detrás.
                </p>
            </div>

            <!-- 5. Convenios Comerciales -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-emerald-50/40 hover:border-emerald-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-700 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-emerald-700/20 group-hover:scale-110 transition-transform">
                    🏷️
                </div>
                <h3 class="text-lg font-black text-slate-900">5. Convenios en Materiales y Equipos</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Precios preferenciales y descuentos gremiales en distribuidores de tuberías de cobre, multicapa, artefactos de gas, bombas y manómetros calibrados.
                </p>
            </div>

            <!-- 6. Bolsa de Proyectos -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-sky-50/40 hover:border-sky-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-sky-700 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-sky-700/20 group-hover:scale-110 transition-transform">
                    💼
                </div>
                <h3 class="text-lg font-black text-slate-900">6. Red de Subcontratación y Alianzas</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Si te adjudicas un proyecto de gran envergadura o en otra región, puedes asociarte con colegas acreditados de GAE AG con la seguridad de mantener el mismo estándar.
                </p>
            </div>

            <!-- 7. Sello de Confianza -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-amber-50/40 hover:border-amber-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-amber-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-amber-600/20 group-hover:scale-110 transition-transform">
                    🏅
                </div>
                <h3 class="text-lg font-black text-slate-900">7. Sello de Confianza GAE AG</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Distintivo oficial para usar en tus presupuestos, vehículos y tarjetas de presentación que te diferencia radicalmente de la competencia informal.
                </p>
            </div>

            <!-- 8. Capacitación en Energías Renovables -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-emerald-50/40 hover:border-emerald-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-teal-600/20 group-hover:scale-110 transition-transform">
                    ☀️
                </div>
                <h3 class="text-lg font-black text-slate-900">8. Formación en Energías Renovables</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Aprende sobre energía solar térmica, colectores termosolares y fotovoltaica para ampliar tus líneas de negocio hacia la transición energética sustentable.
                </p>
            </div>

            <!-- 9. Certificado de Afiliación Anual -->
            <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4 hover:bg-sky-50/40 hover:border-sky-300 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                    📜
                </div>
                <h3 class="text-lg font-black text-slate-900">9. Certificado Oficial de Afiliación</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Certificado emitido por el Directorio de GAE AG para presentar ante administraciones de edificios, constructoras y licitaciones públicas.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- Admission Process Timeline -->
<section class="py-20 bg-slate-950 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center space-y-4 max-w-2xl mx-auto">
            <span class="px-3.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-wider border border-emerald-500/30">
                Proceso de Ingreso
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-white">
                ¿Cómo es el Proceso de Admisión en 2 Pasos?
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            
            <div class="p-8 rounded-3xl bg-slate-900 border border-slate-800 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-gae-blue text-white font-black flex items-center justify-center text-base">1</span>
                    <h3 class="text-xl font-black text-white">Paso 1: Postulación Técnica</h3>
                </div>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Ingresas tus datos de contacto, RUT, número de licencia SEC (o certificado de competencia laboral), especialidad (Gas, Agua o Energía) y comuna de residencia.
                </p>
            </div>

            <div class="p-8 rounded-3xl bg-slate-900 border border-emerald-500/40 space-y-4 shadow-xl">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-emerald-500 text-slate-950 font-black flex items-center justify-center text-base">2</span>
                    <h3 class="text-xl font-black text-white">Paso 2: Test Psicológico Digital</h3>
                </div>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Completas nuestra evaluación digital interactiva de 20 preguntas que mide seguridad operativa SEC, control de estrés, ética y buen trato al cliente. El resultado llega directamente al administrador para la aprobación final.
                </p>
            </div>

        </div>

        <div class="text-center pt-6">
            <a href="{{ route('pages.unete') }}" class="px-10 py-4 rounded-2xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-black text-sm shadow-xl hover:scale-105 transition-all inline-flex items-center gap-2">
                <span>⚡ Comenzar mi Postulación al Gremio</span>
            </a>
        </div>
    </div>
</section>

@endsection
