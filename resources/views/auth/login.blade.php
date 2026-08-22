@extends('layouts.app')

@section('title', 'Acceso Administración - GAE AG')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-xl">
        
        <div class="text-center space-y-3">
            <img src="{{ asset('images/GAEGAG.jpg') }}" alt="GAE AG Logo" class="h-16 w-auto mx-auto bg-white p-2 rounded-xl shadow-sm">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Acceso Directiva & Administración</h2>
            <p class="text-xs text-slate-500 font-medium">Ingresa tus credenciales para administrar la nómina de socios y certificados SEC de GAE AG</p>
        </div>

        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Correo Electrónico</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email', 'admin@gae-ag.cl') }}" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-gae-blue transition-all" 
                           placeholder="admin@gae-ag.cl">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Contraseña</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required value="password123"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-gae-blue transition-all" 
                           placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-gae-blue focus:ring-gae-blue">
                    Recordar sesión
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-lg transition-all">
                Iniciar Sesión en Panel Admin
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-400">
            Credenciales por defecto: <strong>admin@gae-ag.cl</strong> / <strong>password123</strong>
        </div>

    </div>
</div>
@endsection
