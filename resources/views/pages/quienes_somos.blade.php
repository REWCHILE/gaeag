@extends('layouts.app')

@section('title', 'Quiénes Somos & Historia Gremial (2017 - 2026) - GAE AG | Gas, Agua y Energía')
@section('meta_description', 'Recorre la historia visual interactiva de GAE AG. La idea nació en 2017 y fue fundada y legalizada el 29 de Septiembre de 2018 por Domingo Isaín Plaza Caamaño (RUT 65.173.361-8).')

@push('head')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "AboutPage",
                "@id": "{{ route('pages.quienes_somos') }}#about",
                "url": "{{ route('pages.quienes_somos') }}",
                "name": "Quiénes Somos & Historia Gremial - GAE AG",
                "description": "Historia y trayectoria de GAE AG, Asociación Gremial fundada por Domingo Isaín Plaza Caamaño.",
                "isPartOf": { "@id": "{{ url('/#website') }}" }
            },
            {
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
                        "name": "Quiénes Somos",
                        "item": "{{ route('pages.quienes_somos') }}"
                    }
                ]
            }
        ]
    }
    </script>
@endpush

@section('content')

<!-- Hero Section -->
<section class="relative bg-slate-950 text-white py-16 lg:py-24 overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gae-green/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-bold text-slate-300 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-gae-green animate-pulse"></span>
            Idea nacida en 2017 &bull; Fundada y Legalizada el 29 de Septiembre de 2018 &bull; RUT 65.173.361-8
        </div>

        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white max-w-4xl mx-auto leading-tight">
            Liderando la Excelencia y Seguridad en <span class="bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-400 bg-clip-text text-transparent">Gas, Agua y Energía</span> en Chile
        </h1>

        <p class="text-slate-300 text-sm sm:text-lg max-w-2xl mx-auto leading-relaxed font-medium">
            <strong>Asociación Gremial Profesional del Gas, Agua y Energías Renovables G.A.E A.G.</strong> dedicada a elevar el estándar técnico, ético y humano de los especialistas autorizados por la Superintendencia de Electricidad y Combustibles (SEC).
        </p>

        <div class="flex flex-wrap justify-center gap-4 pt-4">
            <a href="#linea-de-tiempo" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-black text-sm shadow-xl hover:scale-105 transition-all flex items-center gap-2">
                <span>⏳ Explorar Línea de Tiempo (2017 - 2026)</span>
            </a>
            <a href="{{ route('pages.unete') }}" class="px-8 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-slate-200 font-bold text-sm hover:bg-slate-800 transition-all">
                ⚡ Postular al Gremio
            </a>
        </div>
    </div>
</section>

<!-- History & Legal Identity -->
<section class="py-20 bg-white text-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-6 space-y-6">
                <span class="px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-black uppercase tracking-wider">
                    Nuestra Historia & Fundación
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Nacidos para Proteger a la Comunidad y Dignificar el Oficio Técnico
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    La iniciativa nació en el año <strong>2017</strong> bajo el concepto de <em>Colegio Profesional del Gas, Agua y Energía GAE AG</em>, concebida por especialistas liderados por <strong>Domingo Isaín Plaza Caamaño</strong>.
                </p>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    El <strong>29 de Septiembre de 2018</strong> se constituye y legaliza formalmente ante el Ministerio de Economía y el SII la <strong>Asociación Gremial Profesional del Gas, Agua y Energías Renovables G.A.E A.G. (RUT 65.173.361-8)</strong>, consolidándose como un referente nacional de autorregulación ética, certificación permanente y respaldo técnico bajo los decretos <strong>DS 66</strong> y <strong>DS 222</strong> de la SEC.
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3.5 pt-4 border-t border-slate-100">
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col justify-center">
                        <span class="text-2xl xl:text-3xl font-black text-emerald-600 tracking-tight whitespace-nowrap">2017</span>
                        <p class="text-[11px] font-bold text-slate-600 mt-1">Origen de la Idea</p>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col justify-center">
                        <span class="text-2xl xl:text-3xl font-black text-sky-600 tracking-tight whitespace-nowrap">2018</span>
                        <p class="text-[11px] font-bold text-slate-600 mt-1">Fundación & Legalización</p>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 border border-slate-200 col-span-2 sm:col-span-1 flex flex-col justify-center min-w-0">
                        <span class="text-base sm:text-[15px] md:text-base lg:text-lg xl:text-xl font-black text-amber-600 tracking-tight whitespace-nowrap block">65.173.361-8</span>
                        <p class="text-[11px] font-bold text-slate-600 mt-1 whitespace-nowrap">RUT Oficial Gremio</p>
                    </div>
                </div>
            </div>

            <!-- Founder & Legal Identity Card -->
            <div class="lg:col-span-6 space-y-4">
                <div class="p-8 rounded-3xl bg-slate-950 text-white shadow-2xl border border-slate-800 relative overflow-hidden space-y-6">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/members/domingo-isain.webp') }}" alt="Domingo Isaín Plaza Caamaño" width="80" height="80" class="w-20 h-20 rounded-2xl object-cover border-2 border-emerald-400/50 shadow-md">
                        <div>
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 text-[11px] font-extrabold uppercase">Presidente & Fundador</span>
                            <h3 class="text-xl font-black text-white mt-1">Domingo Isaín Plaza Caamaño</h3>
                            <p class="text-xs text-slate-400 font-mono whitespace-nowrap">RUT: 12.738.961-6 &bull; Licencia SEC Clase A</p>
                        </div>
                    </div>

                    <blockquote class="text-slate-300 text-sm sm:text-base italic leading-relaxed border-l-2 border-emerald-400 pl-4">
                        "Un instalador de gas, agua o energía tiene en sus manos la vida, la seguridad y el patrimonio de las familias. Por eso nuestro gremio exige excelencia, ética y capacitación sin descanso."
                    </blockquote>

                    <!-- Official Legal Card -->
                    <div class="p-4 rounded-2xl bg-slate-900 border border-slate-800 text-[11px] space-y-2 text-slate-300">
                        <div class="flex justify-between items-start border-b border-slate-800 pb-2 gap-3">
                            <span class="text-slate-400 font-semibold shrink-0">Razón Social:</span>
                            <span class="font-bold text-white text-right leading-tight">Asociación Gremial Profesional del Gas, Agua y Energías Renovables G.A.E A.G.</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                            <span class="text-slate-400 font-semibold">RUT Gremial:</span>
                            <span class="font-mono font-bold text-emerald-400 text-xs bg-emerald-500/10 px-2.5 py-0.5 rounded-md border border-emerald-500/20 whitespace-nowrap">65.173.361-8</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                            <span class="text-slate-400 font-semibold">Constitución Legal:</span>
                            <span class="font-bold text-slate-200 whitespace-nowrap">29 de Septiembre de 2018</span>
                        </div>
                        <div class="flex justify-between items-start pt-0.5 gap-3">
                            <span class="text-slate-400 font-semibold shrink-0">Casa Matriz:</span>
                            <span class="font-bold text-slate-200 text-right">Providencia 1208 Of. 207, Providencia, Santiago</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- INTERACTIVE TIMELINE / HISTORIA ANIMADA CON SCROLL (2017 - 2026) -->
<section id="linea-de-tiempo" class="py-24 bg-slate-950 text-white relative overflow-hidden"
         x-data="{
            activeYear: 2017,
            milestones: [
                {
                    year: 2017,
                    icon: '💡',
                    tag: 'Origen de la Iniciativa',
                    title: 'Nacimiento de la Idea: Colegio Profesional GAE AG',
                    desc: 'La idea nace en 2017 concebida por Domingo Isaín Plaza Caamaño, proyectando la creación de un colegio gremial y red de apoyo técnico que agrupe a los especialistas en Gas, Agua y Energía para dignificar la profesión y defender la seguridad comunitaria.',
                    color: 'emerald'
                },
                {
                    year: 2018,
                    icon: '🏛️',
                    tag: 'Fundación & Legalización',
                    title: 'Fundación Oficial de GAE A.G. (29 Septiembre 2018)',
                    desc: 'El 29 de Septiembre de 2018 se constituye y legaliza formalmente la Asociación Gremial Profesional del Gas, Agua y Energías Renovables G.A.E A.G. (RUT 65.173.361-8) ante el Ministerio de Economía y el SII, con sede matriz en Providencia 1208 Of. 207, Santiago.',
                    color: 'sky'
                },
                {
                    year: 2019,
                    icon: '📐',
                    tag: 'Normativa SEC DS66',
                    title: 'Capacitación en Reglamento de Gas DS 66',
                    desc: 'Jornadas intensivas de instrucción técnica sobre el Decreto Supremo 66 de la SEC para regularización de Sellos Verdes en edificios, condominios y casas particulares.',
                    color: 'amber'
                },
                {
                    year: 2020,
                    icon: '🛡️',
                    tag: 'Resiliencia & Servicio Crítico',
                    title: 'Servicios de Emergencia en Pandemia',
                    desc: 'Los especialistas de GAE AG son acreditados como personal esencial para atender fugas de gas críticas y emergencias de agua potable en centros de salud y hogares durante la crisis sanitaria.',
                    color: 'emerald'
                },
                {
                    year: 2021,
                    icon: '☀️',
                    tag: 'Transición Energética',
                    title: 'Integración de Energías Renovables',
                    desc: 'Se formaliza la división de Energía Solar Térmica y Fotovoltaica, capacitando a los socios en eficiencia energética, sustentabilidad ambiental y nuevas tecnologías.',
                    color: 'amber'
                },
                {
                    year: 2022,
                    icon: '🔍',
                    tag: 'Prevención Comunitaria',
                    title: 'Campaña Nacional Sello Verde Seguro',
                    desc: 'Operativos técnicos de inspección y corrección de sellos rojos/amarillos en condominios, previniendo intoxicaciones por monóxido de carbono e incendios.',
                    color: 'sky'
                },
                {
                    year: 2023,
                    icon: '🔬',
                    tag: 'Tecnología de Punta',
                    title: 'Detección No Destructiva & Sellado Polimérico',
                    desc: 'Adopción pionera de tecnología no destructiva para sellado de fugas interiores en redes de gas y manometría digital calibrada de alta precisión.',
                    color: 'emerald'
                },
                {
                    year: 2024,
                    icon: '🤝',
                    tag: 'Actualización DS 222',
                    title: 'Nueva Normativa SEC & Cobertura Nacional',
                    desc: 'Actualización técnica permanente en el Decreto Supremo 222 y consolidación de redes de apoyo y proyectos conjuntos entre instaladores de todas las regiones de Chile.',
                    color: 'sky'
                },
                {
                    year: 2025,
                    icon: '📱',
                    tag: 'Transformación Digital',
                    title: 'Directorio Digital con Credencial QR SEC',
                    desc: 'Lanzamiento de la plataforma pública interactiva donde cada socio cuenta con su ficha web y código QR dinámico verificable al instante por los clientes.',
                    color: 'amber'
                },
                {
                    year: 2026,
                    icon: '🧠',
                    tag: 'Presente & Admisión de Excelencia',
                    title: 'Filtro Psicológico y Ético de Admisión',
                    desc: 'GAE AG se posiciona como el gremio más confiable de Chile incorporando un test psicológico y de competencias humanas para proteger a los clientes de malos ratos y garantizar excelencia total.',
                    color: 'emerald'
                }
            ],
            selectYear(yr) {
                this.activeYear = yr;
                const el = document.getElementById('milestone-' + yr);
                if(el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
         }">

    <!-- Ambient Glowing Blurs -->
    <div class="absolute top-1/4 -left-40 w-96 h-96 bg-gae-green/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 -right-40 w-96 h-96 bg-gae-blue/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-12">
        
        <!-- Section Header -->
        <div class="text-center space-y-4 max-w-3xl mx-auto">
            <span class="px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-wider border border-emerald-500/30">
                Viaje Histórico Interactivo
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                La Historia de GAE AG Año a Año <br>
                <span class="bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-400 bg-clip-text text-transparent">(2017 &rarr; 2026)</span>
            </h2>
            <p class="text-slate-400 text-xs sm:text-base leading-relaxed">
                Haz scroll o presiona los años para recorrer los hitos que forjaron la asociación gremial más respetada de instaladores en Chile.
            </p>
        </div>

        <!-- Interactive Year Selector Pills (Sticky / Horizontal Scroll) -->
        <div class="sticky top-24 z-30 bg-slate-900/90 backdrop-blur-md p-3 rounded-2xl border border-slate-800 shadow-2xl flex items-center justify-between gap-1 overflow-x-auto">
            <template x-for="item in milestones" :key="item.year">
                <button type="button" @click="selectYear(item.year)"
                        class="px-3 sm:px-4 py-2 rounded-xl text-xs font-black transition-all flex items-center gap-1.5 shrink-0"
                        :class="activeYear === item.year ? 'bg-gradient-to-r from-gae-green to-gae-blue text-white shadow-lg scale-105' : 'text-slate-400 hover:text-white hover:bg-slate-800'">
                    <span x-text="item.icon"></span>
                    <span x-text="item.year"></span>
                </button>
            </template>
        </div>

        <!-- Vertical Timeline Path with Interactive Glowing Nodes -->
        <div class="relative pt-6">
            
            <!-- Central Glowing Line -->
            <div class="absolute left-4 sm:left-1/2 top-8 bottom-8 w-1 bg-gradient-to-b from-emerald-500 via-sky-500 to-amber-400 -translate-x-1/2 rounded-full opacity-40"></div>

            <!-- Milestones List -->
            <div class="space-y-12 sm:space-y-16">
                <template x-for="(item, index) in milestones" :key="item.year">
                    <div :id="'milestone-' + item.year" 
                         class="relative flex flex-col sm:flex-row items-start sm:items-center gap-6 sm:gap-12 transition-all duration-300"
                         :class="index % 2 === 0 ? 'sm:flex-row-reverse' : ''"
                         x-intersect.half="activeYear = item.year">
                        
                        <!-- Center Node Badge Icon -->
                        <div class="absolute left-4 sm:left-1/2 -translate-x-1/2 w-12 h-12 rounded-2xl flex items-center justify-center text-xl font-black shadow-2xl z-20 border-2 transition-transform duration-300 cursor-pointer"
                             :class="activeYear === item.year ? 'bg-gradient-to-tr from-emerald-500 to-sky-500 border-white text-white scale-125 shadow-emerald-500/50' : 'bg-slate-900 border-slate-700 text-slate-300 hover:scale-110'"
                             @click="selectYear(item.year)">
                            <span x-text="item.icon"></span>
                        </div>

                        <!-- Card Content (Left or Right) -->
                        <div class="w-full sm:w-1/2 pl-14 sm:pl-0">
                            <div class="p-6 sm:p-8 rounded-3xl border transition-all duration-300 space-y-3"
                                 :class="activeYear === item.year ? 'bg-slate-900 border-emerald-500/60 shadow-2xl shadow-emerald-500/10 scale-[1.02]' : 'bg-slate-900/60 border-slate-800 hover:border-slate-700'">
                                
                                <div class="flex items-center justify-between flex-wrap gap-2">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider"
                                          :class="{
                                              'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30': item.color === 'emerald',
                                              'bg-sky-500/20 text-sky-400 border border-sky-500/30': item.color === 'sky',
                                              'bg-amber-500/20 text-amber-400 border border-amber-500/30': item.color === 'amber'
                                          }"
                                          x-text="item.tag"></span>

                                    <span class="text-2xl font-black tracking-tight"
                                          :class="activeYear === item.year ? 'text-emerald-400' : 'text-slate-500'"
                                          x-text="item.year"></span>
                                </div>

                                <h3 class="text-xl sm:text-2xl font-black text-white" x-text="item.title"></h3>
                                
                                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal" x-text="item.desc"></p>

                                <div class="pt-2 flex items-center gap-2 text-[11px] font-bold text-slate-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    <span>Hito Oficial GAE AG</span>
                                </div>
                            </div>
                        </div>

                        <!-- Empty Balance Column on the other side for Desktop -->
                        <div class="hidden sm:block sm:w-1/2"></div>

                    </div>
                </template>
            </div>

        </div>

    </div>
</section>

<!-- Mission, Vision & Values -->
<section class="py-20 bg-slate-100 text-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center space-y-4 max-w-2xl mx-auto">
            <span class="px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-black uppercase tracking-wider">
                Nuestros Pilares Estratégicos
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900">
                Misión, Visión y Compromiso Ético
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Misión -->
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-emerald-500/30">
                    🎯
                </div>
                <h3 class="text-xl font-black text-slate-900">Nuestra Misión</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Profesionalizar de manera continua a los instaladores de gas, agua y energía en todo Chile, promoviendo el cumplimiento estricto de las normativas de seguridad, la ética comercial y la protección del consumidor.
                </p>
            </div>

            <!-- Visión -->
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-sky-500 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-sky-500/30">
                    🔭
                </div>
                <h3 class="text-xl font-black text-slate-900">Nuestra Visión</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Ser la asociación gremial referente en el ámbito de las instalaciones de servicios básicos y energías sustentables en Chile, reconocida por la SEC, empresas del rubro y la ciudadanía por su sello de calidad indiscutible.
                </p>
            </div>

            <!-- Valores -->
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-amber-500/30">
                    ⚖️
                </div>
                <h3 class="text-xl font-black text-slate-900">Valores Innegociables</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Cero tolerancia a la negligencia técnica, honestidad absoluta en presupuestos y cobros, empatía y trato cordial al cliente, y solidaridad gremial para el crecimiento conjunto de nuestros socios.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to action footer -->
<section class="py-16 bg-slate-950 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <h2 class="text-2xl sm:text-4xl font-black">
            ¿Eres Instalador Autorizado SEC o Profesional del Rubro?
        </h2>
        <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto">
            Únete hoy a GAE AG, supera nuestro test de admisión y sé parte de la red oficial de especialistas acreditados en todo Chile.
        </p>
        <a href="{{ route('pages.unete') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-black text-sm shadow-xl hover:scale-105 transition-all">
            <span>⚡ Iniciar Postulación y Test de Admisión</span>
        </a>
    </div>
</section>

@endsection

@push('scripts')
    <script defer src="{{ asset('js/alpine-intersect.min.js') }}"></script>
@endpush
