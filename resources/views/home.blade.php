@extends('layouts.app')

@section('title', 'GAE AG - Asociación Gremial de Profesionales del Gas Agua y Energía')
@section('meta_description', 'Sitio oficial de GAE AG, la Asociación Gremial fundada en 2017 por Domingo Isaín Plaza Caamaño. Profesionalización constante de especialistas e instaladores en Gas, Agua y Energía con acreditación SEC.')

@push('head')
    <!-- Preload Responsive Hero LCP Image -->
    <link rel="preload" as="image" href="{{ asset('images/slider/hero_gas_mobile.webp') }}" type="image/webp" media="(max-width: 640px)" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('images/slider/hero_gas.webp') }}" type="image/webp" media="(min-width: 641px)" fetchpriority="high">

    <!-- Inject JSON-LD Schema -->
    <script type="application/ld+json">
        {!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    <script type="application/ld+json">
        {!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')

<!-- Hero Section with Bright Human Background Slider Carousel & 2026 Instant SEC Verification Widget -->
<section class="relative overflow-hidden bg-slate-950 text-white pt-12 pb-20 lg:pt-20 lg:pb-28" x-data="secVerificationApp">
    
    <!-- Hero Background Image Slider Carousel (Vibrant, Clear & Human) -->
    <div class="absolute inset-0 z-0 pointer-events-none" x-data="{ currentSlide: 0 }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % 3 }, 6000)">
        <!-- Slide 1: Gas SEC Technician (LCP - Immediate Paint with Strict Picture) -->
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-85 overflow-hidden"
             :class="{ 'opacity-85 scale-105': currentSlide === 0, 'opacity-0 scale-100': currentSlide !== 0 }"
             style="transition: opacity 1.5s ease-in-out, transform 8s ease-out;">
            <picture>
                <source media="(max-width: 640px)" srcset="{{ asset('images/slider/hero_gas_mobile.webp') }}">
                <source media="(min-width: 641px)" srcset="{{ asset('images/slider/hero_gas.webp') }}">
                <img src="{{ asset('images/slider/hero_gas_mobile.webp') }}"
                     alt="Profesionales Gas SEC Acreditados"
                     fetchpriority="high"
                     loading="eager"
                     width="720"
                     height="401"
                     class="w-full h-full object-cover">
            </picture>
        </div>

        <!-- Slide 2: Agua & Sanitario Engineer (Deferred strictly until slide 2 triggers) -->
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 overflow-hidden"
             :class="{ 'opacity-85 scale-105': currentSlide === 1, 'opacity-0 scale-100': currentSlide !== 1 }"
             style="transition: opacity 1.5s ease-in-out, transform 8s ease-out;">
            <template x-if="currentSlide === 1 || currentSlide === 2">
                <picture>
                    <source media="(max-width: 640px)" srcset="{{ asset('images/slider/hero_water_mobile.webp') }}">
                    <source media="(min-width: 641px)" srcset="{{ asset('images/slider/hero_water.webp') }}">
                    <img src="{{ asset('images/slider/hero_water_mobile.webp') }}"
                         alt="Ingeniería y Servicios Sanitarios"
                         loading="lazy"
                         width="720"
                         height="401"
                         class="w-full h-full object-cover">
                </picture>
            </template>
        </div>

        <!-- Slide 3: Energías Renovables Specialist (Deferred strictly until slide 3 triggers) -->
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 overflow-hidden"
             :class="{ 'opacity-85 scale-105': currentSlide === 2, 'opacity-0 scale-100': currentSlide !== 2 }"
             style="transition: opacity 1.5s ease-in-out, transform 8s ease-out;">
            <template x-if="currentSlide === 2">
                <picture>
                    <source media="(max-width: 640px)" srcset="{{ asset('images/slider/hero_solar_mobile.webp') }}">
                    <source media="(min-width: 641px)" srcset="{{ asset('images/slider/hero_solar.webp') }}">
                    <img src="{{ asset('images/slider/hero_solar_mobile.webp') }}"
                         alt="Energías Renovables y Solar"
                         loading="lazy"
                         width="720"
                         height="401"
                         class="w-full h-full object-cover">
                </picture>
            </template>
        </div>

        <!-- Subtle Gradient Mask Overlay for High Visibility + Legibility -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/70 to-slate-950/40"></div>
    </div>

    <!-- Glowing background accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-blue/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-40 w-96 h-96 bg-gae-green/30 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6">
                <!-- Badge 2026 -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-slate-700/80 text-xs font-semibold tracking-wide text-slate-300 backdrop-blur-md shadow-md">
                    <span class="w-2 h-2 rounded-full bg-gae-amber animate-ping"></span>
                    Plataforma Oficial &nbsp;&bull;&nbsp; Fundada en 2017
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-white drop-shadow-xl">
                    Asociación Gremial de Profesionales del <span class="bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-400 bg-clip-text text-transparent">Gas, Agua y Energía</span> GAE AG
                </h1>

                <p class="text-slate-200 text-sm sm:text-base lg:text-lg leading-relaxed font-medium drop-shadow-md">
                    Nuestra Asociación Gremial fue creada por iniciativa de profesionales y especialistas para <strong>profesionalizar constantemente a los instaladores de Gas, Agua y Energía</strong> y así prestar un servicio técnico de excelencia en todo Chile.
                </p>

                <!-- 2026 Instant SEC Verification Widget -->
                <div class="p-4 rounded-2xl bg-slate-900/95 border border-slate-800 shadow-2xl space-y-3 backdrop-blur-md">
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                        🔍 Verificador Instantáneo de Licencia SEC 2026
                    </label>
                    <div class="flex gap-2">
                        <input type="text" x-model="secQuery" @input="verifySec()" 
                               placeholder="Ingrese RUT o N° de Licencia SEC (Ej: SEC-GAS-0017 o 12.458.932-K)..." 
                               class="w-full px-4 py-3 rounded-xl bg-slate-950/90 border border-slate-700 text-white text-xs focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>

                    <!-- Instant Result Box -->
                    <template x-if="verifiedMember">
                        <div class="p-4 rounded-xl bg-emerald-950/95 border border-emerald-500/50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs text-white backdrop-blur-md">
                            <div class="flex items-center gap-3">
                                <span class="p-2 rounded-lg bg-emerald-500 text-white font-bold text-[10px]">✓ SEC VERIFICADO</span>
                                <div>
                                    <p class="font-bold text-sm" x-text="verifiedMember.full_name"></p>
                                    <p class="text-[11px] text-emerald-300" x-text="'Licencia: ' + (verifiedMember.sec_licence || 'Acreditado SEC') + ' | ' + verifiedMember.category"></p>
                                </div>
                            </div>
                            <a :href="'/profesionales/' + verifiedMember.slug" class="w-full sm:w-auto text-center px-4 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-600 font-bold text-white transition-all min-h-[44px] flex items-center justify-center">
                                Ver Ficha Live &rarr;
                            </a>
                        </div>
                    </template>
                </div>

                <!-- Action buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <a href="#profesionales" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue text-white font-bold text-sm shadow-lg shadow-sky-500/20 hover:shadow-sky-500/40 hover:-translate-y-0.5 transition-all min-h-[44px] flex items-center justify-center">
                        Ver Directorio de Socios SEC
                    </a>
                    <a href="#nosotros" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-xl bg-slate-900/90 hover:bg-slate-800 text-slate-200 border border-slate-700 font-bold text-sm transition-all min-h-[44px] flex items-center justify-center">
                        Conocer a la Directiva
                    </a>
                </div>
            </div>

            <!-- Hero Emblem Card -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md p-6 rounded-3xl bg-slate-900/95 border border-slate-800 shadow-2xl backdrop-blur-xl">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('images/GAEGAG.webp') }}" alt="Emblema GAE AG" width="128" height="128" class="h-28 sm:h-32 w-auto object-contain bg-white p-3 rounded-2xl shadow-md">
                    </div>
                    
                    <div class="text-center space-y-2 border-t border-slate-800 pt-4">
                        <h2 class="text-xl font-bold text-white">G.A.E. A.G.</h2>
                        <p class="text-xs font-semibold text-sky-400 uppercase tracking-wider">Asociación Gremial de Profesionales</p>
                        <p class="text-xs text-slate-400">Gas, Agua y Energías Renovables Chile</p>
                    </div>

                    <div class="mt-6 p-4 rounded-xl bg-slate-950/90 border border-slate-800/80 flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Presidente de GAE AG:</span>
                        <span class="font-bold text-amber-400">Domingo Isaín Plaza Caamaño</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Directiva & Fundador Highlight Section -->
<section id="nosotros" class="py-16 sm:py-20 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Avatar Card -->
            <div class="lg:col-span-5">
                <div class="relative rounded-3xl p-8 bg-slate-900 text-white shadow-xl overflow-hidden group">
                    <div class="absolute top-0 right-0 p-6 opacity-10 font-black text-8xl text-white select-none">2017</div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center space-y-4">
                        <div class="w-32 sm:w-36 h-32 sm:h-36 rounded-full ring-4 ring-gae-green/50 overflow-hidden shadow-xl bg-slate-800 flex items-center justify-center">
                            @if($president && $president->photo_path)
                                <img src="{{ $president->photo_url }}" alt="{{ $president->full_name }}" width="144" height="144" class="w-full h-full object-cover">
                            @else
                                <span class="text-4xl font-extrabold text-white">DP</span>
                            @endif
                        </div>

                        <div>
                            <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-wider">
                                Fundador & Presidente
                            </span>
                            <h3 class="text-2xl font-black text-white mt-2">{{ $president->full_name ?? 'Domingo Isaín Plaza Caamaño' }}</h3>
                            <p class="text-xs font-medium text-slate-300">Presidente del gremio desde su creación en 2017 hasta la actualidad</p>
                        </div>

                        <div class="w-full pt-4 border-t border-slate-800/80 flex items-center justify-center gap-3 text-xs text-slate-300">
                            <span class="flex items-center gap-1 font-semibold text-emerald-300">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Acreditación SEC Verificada
                            </span>
                        </div>

                        @if($president)
                            <a href="{{ route('members.public_show', $president->slug) }}" class="w-full py-3 rounded-xl bg-sky-700 hover:bg-sky-800 text-white font-bold text-xs shadow-md transition-all min-h-[44px] flex items-center justify-center">
                                Ver Ficha & QR SEC del Presidente
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bio Text -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold">
                    Sobre la Asociación Gremial
                </div>

                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-snug">
                    Un Liderazgo Comprometido con la Excelencia Técnica en Gas, Agua y Energía
                </h2>

                <p class="text-slate-600 leading-relaxed font-normal text-sm sm:text-base">
                    Esta Asociación Gremial fue fundada el año <strong>2017 por Domingo Isaín Plaza Caamaño</strong>, quien ejerce la presidencia del gremio desde su creación hasta la fecha. El fin de <strong>GAE AG</strong> es profesionalizar constantemente a los instaladores de Gas, Agua y Energía para asegurar instalaciones seguras y prestar un mejor servicio al cliente.
                </p>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                    <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                        <svg class="w-5 h-5 text-gae-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Compromiso de Acreditación y Transparencia
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Un Profesional del Gas en GAE AG es un Especialista en el área que ha demostrado estar entre los mejores, acreditando su conocimiento y profesionalismo a través del examen de la Superintendencia de Electricidad y Combustibles SEC.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Misión & Pilares del Gremio -->
<section id="mision" class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-12 sm:mb-16">
            <span class="px-3.5 py-1.5 rounded-full bg-sky-100 text-sky-800 text-xs font-bold uppercase tracking-wider">
                Soluciones Profesionales GAE AG
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Especialización Técnica Integral
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Atendemos una clientela diversa, desde propietarios de viviendas residenciales hasta grandes promotores comerciales e industriales.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Gas SEC -->
            <article class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all space-y-4 group">
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-md group-hover:scale-110 transition-transform bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                    <img src="{{ asset('images/icons/icon_gas.webp') }}" alt="Profesionales del Gas SEC" width="64" height="64" loading="lazy" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-900">Profesionales del Gas SEC</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Gasfiter Profesional Certificado en Gas por la Superintendencia SEC. Acredita conocimiento normativo, pruebas de hermeticidad, proyectos de centralizaciones y regularización de Sello Verde.
                </p>
            </article>

            <!-- Agua & Sanitario -->
            <article class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all space-y-4 group">
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-md group-hover:scale-110 transition-transform bg-sky-50 border border-sky-100 flex items-center justify-center">
                    <img src="{{ asset('images/icons/icon_water.webp') }}" alt="Especialistas en Agua" width="64" height="64" loading="lazy" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-900">Especialistas en Agua</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Instalaciones hidráulicas de agua potable domiciliaria e industrial, salas de bombas, alcantarillado, filtraciones complejas y eficiencia hídrica.
                </p>
            </article>

            <!-- Energías Renovables -->
            <article class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all space-y-4 group">
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-md group-hover:scale-110 transition-transform bg-amber-50 border border-amber-100 flex items-center justify-center">
                    <img src="{{ asset('images/icons/icon_energy.webp') }}" alt="Energías Renovables" width="64" height="64" loading="lazy" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-900">Energías Renovables</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Soluciones de energía solar térmica y fotovoltaica. Fusión de tecnología, eficiencia de consumo y cumplimiento estricto con las regulaciones vigentes.
                </p>
            </article>

        </div>

    </div>
</section>

<!-- Directorio Interactivo de Socios SEC -->
<section id="profesionales" class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ search: '', category: 'all' }">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                    Directorio Oficial de Socios
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-2">
                    Profesionales Certificados GAE AG
                </h2>
                <p class="text-slate-600 text-sm mt-1">
                    Encuentra especialistas con CV digital en vivo y código QR de verificación oficial.
                </p>
            </div>

            <!-- Filters & Search -->
            <div class="flex flex-col sm:flex-row gap-3">
                <div>
                    <label for="member-search-input" class="sr-only">Buscar instalador por nombre, ciudad o licencia</label>
                    <input type="text" id="member-search-input" aria-label="Buscar instalador por nombre, ciudad o licencia SEC" x-model="search" placeholder="Buscar por nombre, ciudad o licencia..." 
                        class="px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-gae-blue w-full sm:w-64 min-h-[44px]">
                </div>
                
                <div>
                    <label for="category-filter" class="sr-only">Filtrar por especialidad</label>
                    <select id="category-filter" aria-label="Filtrar instaladores por especialidad" x-model="category" class="px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white min-h-[44px] w-full">
                        <option value="all">Todas las especialidades</option>
                        <option value="Gas">Gas</option>
                        <option value="Agua">Agua</option>
                        <option value="Energía">Energía</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($members as $member)
                <article x-show="(category === 'all' || '{{ strtolower($member->category) }}'.includes(category.toLowerCase())) && ('{{ strtolower($member->full_name) }} {{ strtolower($member->city) }} {{ strtolower($member->sec_licence) }}'.includes(search.toLowerCase()))"
                     class="bg-slate-50 rounded-3xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between space-y-6">
                    
                    <div>
                        <!-- Header & Badge -->
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $member->photo_url }}" alt="Foto de {{ $member->full_name }}" width="56" height="56" loading="lazy" class="w-14 h-14 rounded-2xl object-cover ring-2 ring-slate-200">
                                <div>
                                    <h3 class="font-bold text-slate-900 text-base leading-tight">{{ $member->full_name }}</h3>
                                    <p class="text-xs text-slate-500 font-medium">{{ $member->city }}, {{ $member->region }}</p>
                                </div>
                            </div>
                            
                            <span class="px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-bold flex items-center gap-1 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                SEC
                            </span>
                        </div>

                        <!-- Info details -->
                        <div class="mt-4 pt-4 border-t border-slate-200 space-y-2 text-xs text-slate-700">
                            <div class="flex justify-between">
                                <span class="font-semibold text-slate-600">Licencia SEC:</span>
                                <span class="font-bold text-slate-900">{{ $member->sec_licence ?: 'Acreditado SEC' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold text-slate-600">Clase:</span>
                                <span class="font-bold text-sky-900">{{ $member->class }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold text-slate-600">Especialidad:</span>
                                <span class="font-bold text-emerald-900">{{ $member->category }}</span>
                            </div>
                        </div>

                        <p class="mt-3 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                            {{ $member->bio }}
                        </p>
                    </div>

                    <!-- Actions & WhatsApp Contact -->
                    <div class="pt-4 border-t border-slate-200 flex items-center justify-between gap-2">
                        <a href="{{ route('members.public_show', $member->slug) }}" aria-label="Ver credencial y perfil de {{ $member->full_name }}" class="flex-grow text-center py-2.5 px-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition-all shadow-sm min-h-[44px] flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Ver Credencial
                        </a>

                        @php
                            $memberPhone = preg_replace('/[^0-9]/', '', $member->phone ?: '56949877316');
                        @endphp
                        <a href="https://wa.me/{{ $memberPhone }}?text={{ urlencode('Hola ' . $member->full_name . ', te contacto desde el Directorio Oficial de GAE AG para consultar por tus servicios.') }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           title="Contactar por WhatsApp a {{ $member->full_name }}"
                           class="py-2.5 px-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs transition-all shadow-sm min-h-[44px] flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.175 4.287-1.124zm11.383-6.183c-.309-.154-1.826-.901-2.109-1.004-.284-.103-.491-.154-.698.154-.207.309-.801 1.004-.982 1.211-.181.207-.362.232-.67.077-.309-.154-1.306-.481-2.488-1.535-.919-.82-1.54-1.833-1.721-2.142-.181-.309-.019-.476.135-.63.139-.138.309-.362.464-.542.155-.181.207-.309.31-.516.103-.207.052-.387-.026-.542-.078-.154-.698-1.681-.957-2.301-.252-.603-.509-.522-.698-.531-.18-.009-.387-.009-.595-.009-.207 0-.542.078-.826.387-.284.309-1.085 1.061-1.085 2.589 0 1.528 1.112 3.004 1.267 3.211.155.207 2.189 3.342 5.304 4.686.741.32 1.319.511 1.77.654.743.236 1.419.203 1.953.123.596-.089 1.826-.746 2.084-1.467.258-.721.258-1.339.181-1.467-.078-.128-.284-.206-.593-.361z"/></svg>
                            <span class="hidden sm:inline">Contactar</span>
                        </a>

                        <button onclick="navigator.clipboard.writeText('{{ $member->public_url }}'); alert('¡Enlace copiado al portapapeles!');" 
                                title="Copiar Enlace Público"
                                aria-label="Copiar Enlace Público del Socio"
                                class="p-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 transition-all min-h-[44px] min-w-[44px] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </button>
                    </div>

                </article>
            @endforeach
        </div>

    </div>
</section>

<!-- 10 FAQs SEO Section (Structured FAQ Accordion with Ambient Dark Background & Radial Glow) -->
<section id="faqs" class="py-20 relative overflow-hidden bg-slate-950 text-white border-t border-slate-800">
    
    <!-- Ambient Radial Glow Effects -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-emerald-500/10 via-sky-500/10 to-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center space-y-4 mb-12 sm:mb-16">
            <span class="px-3.5 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider border border-emerald-500/30">
                SEO FAQ Schema
            </span>
            <h2 class="text-2xl sm:text-4xl font-black tracking-tight text-white drop-shadow-md">
                Preguntas Frecuentes sobre GAE AG y Normativa SEC
            </h2>
            <p class="text-slate-400 text-xs sm:text-sm">
                Información técnica optimizada para clientes y especialistas del sector del Gas, Agua y Energía.
            </p>
        </div>

        <div class="space-y-4" x-data="{ active: null }">
            @foreach($faqs as $index => $faq)
                <div class="bg-slate-900/90 rounded-2xl border border-slate-800/90 shadow-xl overflow-hidden transition-all backdrop-blur-md">
                    <button @click="active = (active === {{ $index }} ? null : {{ $index }})" 
                            class="w-full px-6 py-5 text-left font-bold text-sm sm:text-base text-white flex justify-between items-center gap-4 hover:text-emerald-400 transition-colors min-h-[44px]">
                        <span class="flex items-center gap-3">
                            <span class="text-xs font-black text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-lg border border-emerald-500/20">#{{ $index + 1 }}</span>
                            {{ $faq->question }}
                        </span>
                        <svg class="w-5 h-5 transform transition-transform text-slate-400 shrink-0" :class="{ 'rotate-180 text-emerald-400': active === {{ $index }} }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="active === {{ $index }}" x-collapse class="px-6 pb-6 text-slate-300 text-xs sm:text-sm leading-relaxed border-t border-slate-800/80 pt-4">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Únete al Gremio GAE AG Section & Interactive Modal -->
<section id="unete" class="py-20 bg-slate-900 text-white relative border-t border-slate-800 overflow-hidden" x-data="{
    modalOpen: false,
    loading: false,
    chileData: {
        'Región Metropolitana de Santiago': ['Santiago', 'Providencia', 'Las Condes', 'Maipú', 'Puente Alto', 'Ñuñoa', 'La Florida', 'Vitacura', 'Lo Barnechea', 'Peñalolén', 'San Bernardo', 'Pudahuel', 'Quilicura', 'Recoleta', 'Santiago Centro', 'Talagante', 'Melipilla', 'Colina', 'Lampa', 'Buin', 'Paine'],
        'Región de Arica y Parinacota': ['Arica', 'Camarones', 'Putre', 'General Lagos'],
        'Región de Tarapacá': ['Iquique', 'Alto Hospicio', 'Pozo Almonte', 'Camiña', 'Colchane', 'Huara', 'Pica'],
        'Región de Antofagasta': ['Antofagasta', 'Mejillones', 'Sierra Gorda', 'Taltal', 'Calama', 'Ollagüe', 'San Pedro de Atacama', 'Tocopilla', 'María Elena'],
        'Región de Atacama': ['Copiapó', 'Caldera', 'Tierra Amarilla', 'Vallenar', 'Alto del Carmen', 'Freirina', 'Huasco', 'Chañaral', 'Diego de Almagro'],
        'Región de Coquimbo': ['La Serena', 'Coquimbo', 'Andacollo', 'La Higuera', 'Paiguano', 'Vicuña', 'Illapel', 'Canela', 'Los Vilos', 'Salamanca', 'Ovalle', 'Combarbalá', 'Monte Patria', 'Punitaqui', 'Río Hurtado'],
        'Región de Valparaíso': ['Valparaíso', 'Viña del Mar', 'Concón', 'Quintero', 'Puchuncaví', 'Quilpué', 'Villa Alemana', 'Quillota', 'La Calera', 'Limache', 'Olmué', 'San Antonio', 'Los Andes', 'San Felipe', 'Isla de Pascua'],
        'Región del Libertador General Bernardo O\'Higgins': ['Rancagua', 'Machalí', 'Graneros', 'San Fernando', 'Pichilemu', 'Rengo', 'Chimbarongo', 'Santa Cruz'],
        'Región del Maule': ['Talca', 'Curicó', 'Linares', 'Cauquenes', 'Constitución', 'Molina', 'San Javier', 'Parral'],
        'Región de Ñuble': ['Chillán', 'Bulnes', 'San Carlos', 'Yungay', 'Quirihue', 'Coihueco'],
        'Región del Biobío': ['Concepción', 'Talcahuano', 'San Pedro de la Paz', 'Chiguayante', 'Coronel', 'Lota', 'Hualpén', 'Los Ángeles', 'Nacimiento', 'Lebu', 'Arauco'],
        'Región de La Araucanía': ['Temuco', 'Padre Las Casas', 'Angol', 'Villarrica', 'Pucón', 'Victoria', 'Lautaro', 'Traiguén'],
        'Región de Los Ríos': ['Valdivia', 'Corral', 'Lanco', 'Los Lagos', 'Mariquina', 'Paillaco', 'Panguipulli', 'La Unión', 'Río Bueno'],
        'Región de Los Lagos': ['Puerto Montt', 'Calbuco', 'Fresia', 'Frutillar', 'Llanquihue', 'Los Muermos', 'Puerto Varas', 'Castro', 'Ancud', 'Osorno', 'Purranque'],
        'Región de Aysén del General Carlos Ibáñez del Campo': ['Coyhaique', 'Aysén', 'Chile Chico', 'Cochrane'],
        'Región de Magallanes y de la Antártica Chilena': ['Punta Arenas', 'Puerto Natales', 'Porvenir', 'Cabo de Hornos']
    },
    form: {
        full_name: '',
        rut: '',
        sec_licence: '',
        category: 'Gas',
        class: 'Clase B SEC',
        phone: '',
        email: '',
        city: 'Santiago',
        region: 'Región Metropolitana de Santiago',
        bio: ''
    },
    onRegionChange() {
        const comunas = this.chileData[this.form.region] || [];
        this.form.city = comunas.length > 0 ? comunas[0] : '';
    },
    submitApplication() {
        if(!this.form.full_name || !this.form.rut || !this.form.phone || !this.form.email || !this.form.city) {
            alert('Por favor completa todos los campos requeridos (*).');
            return;
        }
        this.loading = true;
        fetch('{{ route('members.apply_store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(this.form)
        })
        .then(res => res.json())
        .then(data => {
            this.loading = false;
            if(data.success) {
                alert('¡Postulación enviada exitosamente! Tu solicitud ha ingresado a la Comisión de Admisión. El Administrador revisará tus antecedentes y te enviará la activación para el Test Psicológico de Admisión por WhatsApp/Correo.');
                this.modalOpen = false;
                this.form = { full_name: '', rut: '', sec_licence: '', category: 'Gas', class: 'Clase B SEC', phone: '', email: '', city: 'Santiago', region: 'Región Metropolitana de Santiago', bio: '' };
            } else {
                alert(data.message || 'Error enviando la postulación. Inténtalo de nuevo.');
            }
        })
        .catch(err => {
            this.loading = false;
            alert('Error enviando la postulación. Inténtalo de nuevo.');
        });
    }
}">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8 relative z-10">
        <span class="px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider border border-emerald-500/30">
            Convocatoria Abierta 2026
        </span>

        <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white max-w-4xl mx-auto leading-tight">
            ¿Eres Especialista en Gas, Agua o Energía? <span class="bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-400 bg-clip-text text-transparent">Únete a GAE AG</span>
        </h2>

        <p class="text-slate-300 text-sm sm:text-lg max-w-2xl mx-auto leading-relaxed">
            Profesionaliza tu carrera, obtén tu CV digital público en vivo y valida tus certificados e instalaciones con código QR dinámico de la SEC.
        </p>

        <div>
            <button @click="modalOpen = true" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-gae-green via-gae-blue to-gae-amber text-white font-extrabold text-sm sm:text-base shadow-2xl hover:scale-105 transition-all min-h-[48px]">
                ⚡ Postular & Unirme como Socio al Gremio
            </button>
        </div>
    </div>

    <!-- Application Modal -->
    <div x-cloak x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog">
        <!-- Backdrop -->
        <div x-show="modalOpen" @click="modalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

        <!-- Modal Card -->
        <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="relative w-full max-w-2xl bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl p-6 sm:p-8 space-y-6 text-white z-10 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <div>
                    <h3 class="text-xl font-black text-white">Formulario de Postulación de Socio</h3>
                    <p class="text-xs text-slate-400">Ingresa tus datos de acreditación para integrarte a GAE AG</p>
                </div>
                <button @click="modalOpen = false" class="p-2 rounded-xl bg-slate-800 text-slate-400 hover:text-white">&times;</button>
            </div>

            <form @submit.prevent="submitApplication()" class="space-y-4 text-xs">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="modal-full-name" class="block font-bold text-slate-300 mb-1">Nombre Completo *</label>
                        <input type="text" id="modal-full-name" x-model="form.full_name" required placeholder="Ej: Juan Pérez Morales" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>

                    <div>
                        <label for="modal-rut" class="block font-bold text-slate-300 mb-1">RUT *</label>
                        <input type="text" id="modal-rut" x-model="form.rut" required placeholder="Ej: 12.345.678-9" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="modal-category" class="block font-bold text-slate-300 mb-1">Especialidad Principal *</label>
                        <select id="modal-category" aria-label="Especialidad Principal" x-model="form.category" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            <option value="Gas">Gas SEC</option>
                            <option value="Agua">Agua & Sanitaria</option>
                            <option value="Energía">Energía Solar</option>
                            <option value="Gas, Agua y Energía">Gas, Agua y Energía</option>
                        </select>
                    </div>

                    <div>
                        <label for="modal-sec-licence" class="block font-bold text-slate-300 mb-1">Licencia SEC</label>
                        <input type="text" id="modal-sec-licence" x-model="form.sec_licence" placeholder="Ej: SEC-GAS-99120" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>

                    <div>
                        <label for="modal-class" class="block font-bold text-slate-300 mb-1">Clase / Certificación</label>
                        <input type="text" id="modal-class" x-model="form.class" placeholder="Ej: Clase A SEC / Sanitaria" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="modal-phone" class="block font-bold text-slate-300 mb-1">Teléfono / WhatsApp *</label>
                        <input type="text" id="modal-phone" x-model="form.phone" required placeholder="Ej: +56 9 1234 5678" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>

                    <div>
                        <label for="modal-email" class="block font-bold text-slate-300 mb-1">Email *</label>
                        <input type="email" id="modal-email" x-model="form.email" required placeholder="ejemplo@correo.cl" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                    </div>
                </div>

                <!-- Dynamic Cascading Region & Commune Selectors (Chile) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="modal-region" class="block font-bold text-slate-300 mb-1">Región de Chile *</label>
                        <select id="modal-region" aria-label="Región de Chile" x-model="form.region" @change="onRegionChange()" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            <template x-for="(comunas, reg) in chileData" :key="reg">
                                <option :value="reg" x-text="reg" :selected="reg === form.region"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label for="modal-city" class="block font-bold text-slate-300 mb-1">Ciudad / Comuna *</label>
                        <select id="modal-city" aria-label="Ciudad o Comuna" x-model="form.city" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            <template x-for="comuna in (chileData[form.region] || [])" :key="comuna">
                                <option :value="comuna" x-text="comuna" :selected="comuna === form.city"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="modal-bio" class="block font-bold text-slate-300 mb-1">Resumen de Experiencia Técnica</label>
                    <textarea id="modal-bio" x-model="form.bio" rows="3" placeholder="Describe brevemente tus años de experiencia en proyectos de gas, agua o energía..." class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-800">
                    <button type="button" @click="modalOpen = false" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 font-bold">Cancelar</button>
                    <button type="submit" :disabled="loading" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue hover:opacity-90 font-bold text-white shadow-md">
                        <span x-show="!loading">🚀 Enviar Postulación & Contactar por WhatsApp</span>
                        <span x-show="loading">Procesando postulación...</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    window.__MEMBERS_CACHE__ = @json($membersSearch ?? []);

    document.addEventListener('alpine:init', () => {
        Alpine.data('secVerificationApp', () => ({
            secQuery: '',
            verifiedMember: null,
            verifySec() {
                const query = this.secQuery.trim().toLowerCase();
                if (!query) {
                    this.verifiedMember = null;
                    return;
                }
                const list = window.__MEMBERS_CACHE__ || [];
                this.verifiedMember = list.find(m => 
                    (m.rut && m.rut.toLowerCase().includes(query)) || 
                    (m.sec_licence && m.sec_licence.toLowerCase().includes(query)) ||
                    (m.full_name && m.full_name.toLowerCase().includes(query))
                ) || null;
            }
        }));
    });
</script>
@endpush
