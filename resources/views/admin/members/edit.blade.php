@extends('admin.layout')

@section('title', "Editar Socio: {$member->full_name} - Panel Admin GAE AG")

@section('admin_content')

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 max-w-3xl mx-auto space-y-6">
    <div>
        <h3 class="text-xl font-black text-slate-900">Editar Datos del Socio: {{ $member->full_name }}</h3>
        <p class="text-xs text-slate-500">Actualice la información profesional o la foto del socio.</p>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.members.update', $member) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            <div>
                <label class="block font-bold text-slate-700 mb-1">Nombre Completo *</label>
                <input type="text" name="full_name" required value="{{ old('full_name', $member->full_name) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">RUT Identificación</label>
                <input type="text" name="rut" value="{{ old('rut', $member->rut) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Licencia SEC</label>
                <input type="text" name="sec_licence" value="{{ old('sec_licence', $member->sec_licence) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-bold text-slate-700 mb-1">URL Oficial de Verificación SEC (para Código QR Dinámico)</label>
                <input type="url" name="sec_qr_url" value="{{ old('sec_qr_url', $member->sec_qr_url) }}" placeholder="Ej: https://wlhttp.sec.cl/rnii/public/licencia/qr?o=..." 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
                <p class="text-[11px] text-slate-500 mt-1">Si configuras la URL oficial de la SEC, el código QR se regenerará automáticamente apuntando a dicha verificación oficial.</p>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Categoría Principal *</label>
                <select name="category" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue bg-white">
                    <option value="Gas" {{ $member->category == 'Gas' ? 'selected' : '' }}>Gas</option>
                    <option value="Agua" {{ $member->category == 'Agua' ? 'selected' : '' }}>Agua</option>
                    <option value="Energía" {{ $member->category == 'Energía' ? 'selected' : '' }}>Energía</option>
                    <option value="Gas Agua y Energía" {{ $member->category == 'Gas Agua y Energía' ? 'selected' : '' }}>Gas Agua y Energía</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Clase de Licencia *</label>
                <input type="text" name="class" required value="{{ old('class', $member->class) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Título / Cargo</label>
                <input type="text" name="title" value="{{ old('title', $member->title) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Teléfono WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Ciudad *</label>
                <input type="text" name="city" required value="{{ old('city', $member->city) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Región *</label>
                <input type="text" name="region" required value="{{ old('region', $member->region) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">
            </div>

        </div>

        <div>
            <label class="block font-bold text-slate-700 mb-1">Fotografía del Profesional</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
        </div>

        <div>
            <label class="block font-bold text-slate-700 mb-1">Biografía / Descripción de Experiencia</label>
            <textarea name="bio" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-gae-blue">{{ old('bio', $member->bio) }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $member->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-gae-blue focus:ring-gae-blue">
            <label for="is_active" class="font-bold text-slate-700">Publicar CV Digital Live de forma inmediata</label>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
            <a href="{{ route('admin.members.show', $member) }}" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold shadow-md">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

@endsection
