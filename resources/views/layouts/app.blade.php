<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>@yield('title', 'Asociación Gremial de Profesionales del Gas Agua y Energía - GAE AG')</title>

    <!-- SEO First Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'GAE AG es la Asociación Gremial fundada en 2017 por Domingo Isaín Plaza Caamaño para la constante profesionalización de especialistas e instaladores autorizados SEC en Gas, Agua y Energía en Chile.')">
    <meta name="keywords" content="GAE AG, Domingo Isain Plaza Caamano, Profesionales del Gas, Gasfiter SEC, Certificado SEC, Agua y Energia, Asociacion Gremial Gas Chile, Sello Verde Gas, Instaladores Autorizados Chile">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="author" content="Asociación Gremial GAE AG - Domingo Isaín Plaza Caamaño">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#0f172a">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:locale" content="es_CL">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="GAE AG - Asociación Gremial del Gas, Agua y Energía">
    <meta property="og:title" content="@yield('title', 'GAE AG - Asociación Gremial de Profesionales del Gas Agua y Energía')">
    <meta property="og:description" content="@yield('meta_description', 'Profesionalización constante de especialistas en instalaciones de Gas, Agua y Energía en Chile. Fundada por Domingo Isaín Plaza Caamaño.')">
    <meta property="og:image" content="@yield('og_image', asset('images/GAEGAG.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'GAE AG - Profesionales del Gas Agua y Energía')">
    <meta name="twitter:description" content="@yield('meta_description', 'Profesionalización constante de instaladores autorizados SEC en Gas, Agua y Energía.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/GAEGAG.jpg'))">

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN & AlpineJS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        gae: {
                            green: '#4da832',
                            'green-dark': '#3d8727',
                            blue: '#2a81ba',
                            'blue-dark': '#1f6594',
                            amber: '#f0a827',
                            'amber-dark': '#c98818',
                            dark: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Universal Browser Scrollbar (Firefox, Chrome, Edge, Safari, Opera) */
        html {
            scrollbar-width: thin;
            scrollbar-color: #2a81ba #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            -webkit-tap-highlight-color: transparent;
        }
        [x-cloak] { display: none !important; }

        /* Custom WebKit Scrollbar Styling (Verde - Azul - Ámbar) */
        ::-webkit-scrollbar {
            width: 12px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #4da832 0%, #2a81ba 50%, #f0a827 100%);
            border-radius: 6px;
            border: 2px solid #0f172a;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #3d8727 0%, #1f6594 50%, #c98818 100%);
        }
    </style>

    @stack('head')
</head>
<body class="text-slate-800 antialiased flex flex-col min-h-screen relative" x-data="{ mobileNavOpen: false }">

    <!-- 2026 Brand Vertical Scroll Progress Indicator (Left Edge) -->
    <div id="scroll-progress-vertical" class="fixed left-0 top-0 w-1.5 bg-gradient-to-b from-gae-green via-gae-blue to-gae-amber z-50 rounded-r-full shadow-lg transition-all duration-150 pointer-events-none" style="height: 0%"></div>

    <!-- 2026 Custom Glowing Cursor Follower -->
    <div id="cursor-follower" class="pointer-events-none fixed top-0 left-0 w-8 h-8 rounded-full border-2 border-emerald-400/70 bg-sky-400/10 backdrop-blur-xs z-50 transition-transform duration-100 ease-out -translate-x-1/2 -translate-y-1/2 hidden lg:block"></div>
    <div id="cursor-dot" class="pointer-events-none fixed top-0 left-0 w-2 h-2 rounded-full bg-emerald-400 z-50 transition-transform duration-75 ease-out -translate-x-1/2 -translate-y-1/2 hidden lg:block"></div>

    <!-- Smart Floating "Go to Top" Button (ONLY appears when reaching footer/page bottom on Left Side) -->
    <button id="back-to-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
            aria-label="Volver arriba"
            class="fixed bottom-6 left-6 z-50 p-3.5 rounded-2xl bg-slate-900/95 text-emerald-400 border border-slate-700 shadow-2xl backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300 hover:scale-110 hover:bg-slate-900 hover:text-white flex items-center gap-2 text-xs font-bold">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
        <span class="hidden sm:inline">Ir Arriba</span>
    </button>

    <!-- Floating Action Buttons (Lower Right Corner): Phone & WhatsApp -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3 group">
        <!-- Quick Phone Call Button -->
        <a href="tel:+56912345678" 
           title="Llamar a GAE AG" 
           aria-label="Llamar a GAE AG por teléfono"
           class="p-3.5 rounded-full bg-gae-blue hover:bg-gae-blue-dark text-white shadow-xl hover:scale-110 transition-all flex items-center justify-center min-h-[48px] min-w-[48px] border-2 border-white/20">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </a>

        <!-- WhatsApp Direct Chat Button -->
        <a href="https://wa.me/56912345678?text=Hola%20GAE%20AG,%20necesito%20información%20sobre%20un%20profesional%20certificado" 
           target="_blank" 
           rel="noopener noreferrer"
           title="Contactar por WhatsApp"
           aria-label="Contactar por WhatsApp"
           class="relative p-3.5 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xl hover:scale-110 transition-all flex items-center justify-center min-h-[52px] min-w-[52px] border-2 border-white/30">
            <!-- Pulsing ring effect -->
            <span class="absolute inset-0 rounded-full bg-emerald-400 animate-ping opacity-40"></span>
            
            <svg class="w-7 h-7 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.144 4.175 4.287-1.124zm11.383-6.183c-.309-.154-1.826-.901-2.109-1.004-.284-.103-.491-.154-.698.154-.207.309-.801 1.004-.982 1.211-.181.207-.362.232-.67.077-.309-.154-1.306-.481-2.488-1.535-.919-.82-1.54-1.833-1.721-2.142-.181-.309-.019-.476.135-.63.139-.138.309-.362.464-.542.155-.181.207-.309.31-.516.103-.207.052-.387-.026-.542-.078-.154-.698-1.681-.957-2.301-.252-.603-.509-.522-.698-.531-.18-.009-.387-.009-.595-.009-.207 0-.542.078-.826.387-.284.309-1.085 1.061-1.085 2.589 0 1.528 1.112 3.004 1.267 3.211.155.207 2.189 3.342 5.304 4.686.741.32 1.319.511 1.77.654.743.236 1.419.203 1.953.123.596-.089 1.826-.746 2.084-1.467.258-.721.258-1.339.181-1.467-.078-.128-.284-.206-.593-.361z"/>
            </svg>
        </a>
    </div>

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-40 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <div class="flex items-center gap-3">
                    <!-- Mobile Menu Hamburger Button -->
                    <button @click="mobileNavOpen = true" aria-label="Abrir Menú Principal" class="md:hidden p-2.5 rounded-xl text-slate-700 hover:bg-slate-100 focus:outline-none min-h-[44px] min-w-[44px] flex items-center justify-center border border-slate-200">
                        <svg class="h-6 w-6 text-slate-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Logo & Brand -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/GAEGAG.jpg') }}" alt="GAE AG Logo" class="h-10 sm:h-14 w-auto object-contain transition-transform group-hover:scale-105">
                        <div class="flex flex-col">
                            <span class="font-extrabold text-base sm:text-xl leading-tight text-slate-900 tracking-tight flex items-center gap-1.5">
                                G.A.E. A.G.
                                <span class="inline-block w-2 h-2 rounded-full bg-gae-green animate-pulse"></span>
                            </span>
                            <span class="text-[11px] sm:text-xs font-semibold text-slate-500 hidden sm:block">Profesionales del Gas, Agua y Energía</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}#nosotros" class="text-sm font-semibold text-slate-700 hover:text-gae-blue transition-colors py-2">Nosotros</a>
                    <a href="{{ route('home') }}#mision" class="text-sm font-semibold text-slate-700 hover:text-gae-blue transition-colors py-2">Misión</a>
                    <a href="{{ route('home') }}#profesionales" class="text-sm font-semibold text-slate-700 hover:text-gae-blue transition-colors py-2">Socios SEC</a>
                    <a href="{{ route('home') }}#faqs" class="text-sm font-semibold text-slate-700 hover:text-gae-blue transition-colors py-2">FAQs SEO</a>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-bold rounded-xl text-white bg-gae-blue hover:bg-gae-blue-dark shadow-sm transition-all min-h-[44px]">
                            Panel Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-slate-900 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 transition-all min-h-[44px] inline-flex items-center">
                            Acceso Directiva
                        </a>
                    @endauth
                </nav>

            </div>
        </div>
    </header>

    <!-- Mobile Off-Canvas Drawer (Deslizable de Izquierda a Derecha) -->
    <div x-cloak x-show="mobileNavOpen" class="relative z-50 md:hidden" role="dialog" aria-modal="true">
        <!-- Backdrop Overlay -->
        <div x-show="mobileNavOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileNavOpen = false" 
             class="fixed inset-0 bg-slate-950/70 backdrop-blur-md"></div>

        <!-- Drawer Content Container (Solid White Background, Left-to-Right Slide) -->
        <div class="fixed inset-y-0 left-0 max-w-full flex">
            <div x-show="mobileNavOpen" 
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="w-80 max-w-[85vw] bg-white shadow-2xl p-6 flex flex-col justify-between overflow-y-auto">
                
                <div class="space-y-6">
                    <!-- Drawer Header & Close Button -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/GAEGAG.jpg') }}" alt="GAE AG" class="h-10 w-auto">
                            <div>
                                <span class="font-black text-slate-900 text-sm block">G.A.E. A.G.</span>
                                <span class="text-[10px] text-slate-500 font-semibold uppercase">Menú Principal</span>
                            </div>
                        </div>
                        <button @click="mobileNavOpen = false" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 min-h-[44px] min-w-[44px] flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex flex-col gap-2 font-bold text-slate-800 text-sm">
                        <a href="{{ route('home') }}#nosotros" @click="mobileNavOpen = false" class="px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors flex items-center justify-between">
                            <span>Nosotros</span>
                            <span class="text-slate-400">&rarr;</span>
                        </a>
                        <a href="{{ route('home') }}#mision" @click="mobileNavOpen = false" class="px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors flex items-center justify-between">
                            <span>Misión & Pilares</span>
                            <span class="text-slate-400">&rarr;</span>
                        </a>
                        <a href="{{ route('home') }}#profesionales" @click="mobileNavOpen = false" class="px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors flex items-center justify-between">
                            <span>Socios SEC</span>
                            <span class="text-slate-400">&rarr;</span>
                        </a>
                        <a href="{{ route('home') }}#faqs" @click="mobileNavOpen = false" class="px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors flex items-center justify-between">
                            <span>Preguntas Frecuentes SEC</span>
                            <span class="text-slate-400">&rarr;</span>
                        </a>
                    </nav>
                </div>

                <!-- Footer Action -->
                <div class="pt-6 border-t border-slate-100 space-y-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="w-full text-center py-3.5 rounded-xl bg-gae-blue text-white font-bold text-xs shadow-md flex items-center justify-center min-h-[44px]">
                            Ir al Panel de Administración
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center py-3.5 rounded-xl bg-slate-900 text-white font-bold text-xs shadow-md flex items-center justify-center min-h-[44px]">
                            Acceso Directiva & Admin
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>

    <!-- Main Content Body -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer" class="bg-slate-950 text-slate-300 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-slate-800/80">
                
                <!-- Brand Info -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/GAEGAG.jpg') }}" alt="GAE AG Logo" class="h-12 w-auto bg-white p-1 rounded-lg">
                        <span class="text-xl font-bold text-white tracking-wide">G.A.E. A.G.</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                        <strong>Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG.</strong><br>
                        Fundada en el año 2017 por Domingo Isaín Plaza Caamaño para la profesionalización continua de especialistas, instaladores técnicos e ingenieros en Chile.
                    </p>
                    <div class="flex flex-wrap items-center gap-3 text-xs font-semibold text-slate-400 pt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800 text-emerald-400 border border-slate-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Acreditación SEC
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800 text-sky-400 border border-slate-700">
                            Fundación 2017
                        </span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Navegación</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}#nosotros" class="hover:text-white transition-colors">Directiva Fundadora</a></li>
                        <li><a href="{{ route('home') }}#mision" class="hover:text-white transition-colors">Propósito Gremial</a></li>
                        <li><a href="{{ route('home') }}#profesionales" class="hover:text-white transition-colors">Directorio de Socios</a></li>
                        <li><a href="{{ route('home') }}#faqs" class="hover:text-white transition-colors">Preguntas Frecuentes SEC</a></li>
                    </ul>
                </div>

                <!-- Contact & Support -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Contacto & Soporte</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gae-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            contacto@gae-ag.cl
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gae-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Santiago, Chile
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} GAE AG Asociación Gremial de Profesionales del Gas Agua y Energía. Todos los derechos reservados.</p>
                <p class="flex items-center gap-1">
                    <span>Presidente: <strong>Domingo Isaín Plaza Caamaño</strong></span>
                </p>
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts: Custom Cursor, Vertical Scroll Progress & Footer-Only Go To Top -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cursorFollower = document.getElementById('cursor-follower');
            const cursorDot = document.getElementById('cursor-dot');
            const progressBarVertical = document.getElementById('scroll-progress-vertical');
            const backToTopBtn = document.getElementById('back-to-top-btn');

            // Custom glowing cursor follower
            if (cursorFollower && cursorDot) {
                window.addEventListener('mousemove', (e) => {
                    cursorFollower.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
                    cursorDot.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
                });

                // Scale up on interactive hover
                document.querySelectorAll('a, button, input, select').forEach(el => {
                    el.addEventListener('mouseenter', () => cursorFollower.classList.add('scale-150', 'border-sky-400'));
                    el.addEventListener('mouseleave', () => cursorFollower.classList.remove('scale-150', 'border-sky-400'));
                });
            }

            // Scroll events: vertical left bar & footer-only go to top button
            window.addEventListener('scroll', () => {
                const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPos = window.scrollY;

                // Vertical Scroll Percentage (Left Edge)
                if (totalHeight > 0 && progressBarVertical) {
                    const percentage = (scrollPos / totalHeight) * 100;
                    progressBarVertical.style.height = percentage + '%';
                }

                // Show Go To Top button ONLY when reaching the footer / bottom of the page (within last 350px)
                if (scrollPos + window.innerHeight >= document.documentElement.scrollHeight - 350) {
                    backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                    backToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                    backToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
