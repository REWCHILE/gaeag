<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración - GAE AG')</title>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & AlpineJS -->
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
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col" x-data="{ adminMobileOpen: false }">

    <!-- Header / Navbar Admin Top Bar -->
    <header class="bg-slate-900 text-white sticky top-0 z-40 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <div class="flex items-center gap-3">
                    <!-- Mobile Hamburger Button for Admin -->
                    <button @click="adminMobileOpen = true" aria-label="Abrir Menú Admin" class="lg:hidden p-2.5 rounded-xl bg-slate-800 text-white hover:bg-slate-700 min-h-[44px] min-w-[44px] flex items-center justify-center border border-slate-700">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/GAEGAG.jpg') }}" alt="GAE AG" class="h-9 sm:h-12 w-auto bg-white p-1 rounded-lg">
                        <div>
                            <h1 class="font-extrabold text-sm sm:text-lg text-white leading-tight">Panel Admin GAE AG</h1>
                            <p class="text-[10px] text-slate-400 font-medium hidden sm:block">Gestión Gremial & Boletines IA</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('admin.dashboard') ? 'bg-gae-blue text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }} transition-all">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.members.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('admin.members.*') ? 'bg-gae-blue text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }} transition-all">
                        Socios ({{ \App\Models\Member::count() }})
                    </a>
                    <a href="{{ route('admin.bulletins.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('admin.bulletins.*') ? 'bg-gae-blue text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }} transition-all flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Boletines & Mailer IA
                    </a>
                    <a href="{{ route('admin.content_grid.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('admin.content_grid.*') ? 'bg-gae-blue text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }} transition-all">
                        📅 Grilla de Contenido
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('admin.settings.*') ? 'bg-gae-blue text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }} transition-all">
                        ⚙️ Llaves de API IA
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-xl bg-red-950/80 hover:bg-red-900 text-red-300 text-xs font-bold transition-all border border-red-800/50">
                            Salir
                        </button>
                    </form>
                </div>

                <!-- Back to Site Link -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold flex items-center gap-1 border border-slate-700">
                        <span>Ver Sitio Web ↗</span>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- Admin Mobile Off-Canvas Drawer (Deslizable de Izquierda a Derecha con Fondo Opaco Sólido) -->
    <div x-cloak x-show="adminMobileOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
        <!-- Backdrop Overlay -->
        <div x-show="adminMobileOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="adminMobileOpen = false" 
             class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

        <!-- Drawer Body (Solid Dark Slate Background, Left-to-Right Slide) -->
        <div class="fixed inset-y-0 left-0 max-w-full flex">
            <div x-show="adminMobileOpen" 
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="w-80 max-w-[85vw] bg-slate-900 text-white shadow-2xl p-6 flex flex-col justify-between overflow-y-auto border-r border-slate-800">
                
                <div class="space-y-6">
                    <!-- Drawer Header -->
                    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/GAEGAG.jpg') }}" alt="GAE AG" class="h-10 w-auto bg-white p-1 rounded">
                            <div>
                                <span class="font-black text-white text-sm block">Navegación Admin</span>
                                <span class="text-[10px] text-slate-400 font-semibold uppercase">GAE AG Panel</span>
                            </div>
                        </div>
                        <button @click="adminMobileOpen = false" class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 min-h-[44px] min-w-[44px] flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Admin Links in Mobile Drawer -->
                    <nav class="flex flex-col gap-2 font-bold text-sm">
                        <a href="{{ route('admin.dashboard') }}" @click="adminMobileOpen = false" class="px-4 py-3.5 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-gae-blue text-white' : 'bg-slate-800/80 text-slate-200 hover:bg-slate-800' }} flex items-center justify-between">
                            <span>📊 Resumen Dashboard</span>
                            <span>&rarr;</span>
                        </a>

                        <a href="{{ route('admin.members.index') }}" @click="adminMobileOpen = false" class="px-4 py-3.5 rounded-xl {{ request()->routeIs('admin.members.*') ? 'bg-gae-blue text-white' : 'bg-slate-800/80 text-slate-200 hover:bg-slate-800' }} flex items-center justify-between">
                            <span>👥 Gestión de Socios ({{ \App\Models\Member::count() }})</span>
                            <span>&rarr;</span>
                        </a>

                        <a href="{{ route('admin.bulletins.index') }}" @click="adminMobileOpen = false" class="px-4 py-3.5 rounded-xl {{ request()->routeIs('admin.bulletins.*') ? 'bg-gae-blue text-white' : 'bg-slate-800/80 text-slate-200 hover:bg-slate-800' }} flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                ⚡ Boletines & Mailer IA
                            </span>
                            <span>&rarr;</span>
                        </a>

                        <a href="{{ route('admin.content_grid.index') }}" @click="adminMobileOpen = false" class="px-4 py-3.5 rounded-xl {{ request()->routeIs('admin.content_grid.*') ? 'bg-gae-blue text-white' : 'bg-slate-800/80 text-slate-200 hover:bg-slate-800' }} flex items-center justify-between">
                            <span>📅 Grilla de Contenido IA</span>
                            <span>&rarr;</span>
                        </a>

                        <a href="{{ route('admin.settings.index') }}" @click="adminMobileOpen = false" class="px-4 py-3.5 rounded-xl {{ request()->routeIs('admin.settings.*') ? 'bg-gae-blue text-white' : 'bg-slate-800/80 text-slate-200 hover:bg-slate-800' }} flex items-center justify-between">
                            <span>⚙️ Llaves de API IA</span>
                            <span>&rarr;</span>
                        </a>
                    </nav>
                </div>

                <!-- Footer Action: Logout -->
                <div class="pt-6 border-t border-slate-800 space-y-3">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full py-3 rounded-xl bg-red-950 hover:bg-red-900 text-red-300 font-bold text-xs border border-red-800 flex items-center justify-center min-h-[44px]">
                            🔴 Cerrar Sesión
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Admin Container -->
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500 text-white font-bold text-xs shadow-md flex items-center justify-between">
                    <span>✓ {{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-white hover:opacity-80">✕</button>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-red-600 text-white font-bold text-xs shadow-md flex items-center justify-between">
                    <span>⚠️ {{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-white hover:opacity-80">✕</button>
                </div>
            @endif

            @yield('admin_content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        <p>Panel Administrativo GAE AG &bull; {{ date('Y') }} &bull; Sistema de Gestión de Socios & Boletines IA</p>
    </footer>

    @stack('scripts')
</body>
</html>
