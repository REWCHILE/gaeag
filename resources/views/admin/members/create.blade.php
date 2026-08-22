@extends('admin.layout')

@section('title', 'Registrar Nuevo Socio - Panel Admin GAE AG')

@section('admin_content')

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 max-w-3xl mx-auto space-y-6">
    <div>
        <h3 class="text-xl font-black text-slate-900">Registrar Nuevo Profesional Socio</h3>
        <p class="text-xs text-slate-500">Al registrar al socio, el sistema creará automáticamente su página de CV Digital Live y generará su código QR único.</p>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            <div>
                <label class="block font-bold text-slate-700 mb-1">Nombre Completo *</label>
                <input type="text" name="full_name" required value="{{ old('full_name') }}" placeholder="Ej: Juan Pablo Pérez Soto" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">RUT Identificación</label>
                <input type="text" name="rut" value="{{ old('rut') }}" placeholder="Ej: 15.482.910-K" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Licencia SEC</label>
                <input type="text" name="sec_licence" value="{{ old('sec_licence') }}" placeholder="Ej: SEC-GAS-99120" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-bold text-slate-700 mb-1">URL Oficial de Verificación SEC (para Código QR Dinámico)</label>
                <input type="url" name="sec_qr_url" value="{{ old('sec_qr_url') }}" placeholder="Ej: https://wlhttp.sec.cl/rnii/public/licencia/qr?o=..." 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
                <p class="text-[11px] text-slate-500 mt-1">Si ingresas la URL de verificación oficial de la SEC, el código QR apuntará directamente a dicha dirección. Si se deja en blanco, apuntará al CV Live del socio.</p>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Categoría Principal *</label>
                <select name="category" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">
                    <option value="Gas">Gas</option>
                    <option value="Agua">Agua</option>
                    <option value="Energía">Energía</option>
                    <option value="Gas Agua y Energía">Gas Agua y Energía (Multidisciplinario)</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Clase de Licencia *</label>
                <input type="text" name="class" required value="{{ old('class', 'Clase A SEC') }}" placeholder="Ej: Clase A SEC, Clase B SEC" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Título / Cargo</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Ej: Gasfiter Profesional Certificado SEC" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Teléfono WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Ej: +56 9 1234 5678" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Ej: contacto@ejemplo.cl" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Ciudad *</label>
                <input type="text" name="city" required value="{{ old('city', 'Santiago') }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Región *</label>
                <input type="text" name="region" required value="{{ old('region', 'Región Metropolitana') }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

        </div>

        <div>
            <label class="block font-bold text-slate-700 mb-1">Fotografía del Profesional</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
        </div>

        <div>
            <label class="block font-bold text-slate-700 mb-1">Biografía / Descripción de Experiencia</label>
            <textarea name="bio" rows="4" placeholder="Escriba la biografía y especializaciones del profesional..." 
                      class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">{{ old('bio') }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-slate-300 text-gae-blue focus:ring-gae-blue">
            <label for="is_active" class="font-bold text-slate-700">Publicar CV Digital Live de forma inmediata</label>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
            <a href="{{ route('admin.members.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold shadow-md">
                Registrar Socio & Generar QR
            </button>
        </div>
    </form>
</div>

@endsection
