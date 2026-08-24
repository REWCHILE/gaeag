@extends('layouts.app')

@section('title', 'Únete al Gremio - Postulación e Incorporación a GAE AG | Instaladores SEC')
@section('meta_description', 'Postula como socio a la Asociación Gremial de Profesionales del Gas, Agua y Energía GAE AG. Convocatoria abierta para instaladores autorizados SEC en todo Chile.')

@section('content')

<!-- Recruitment Landing Hero & Form Section -->
<section class="py-16 lg:py-24 bg-slate-950 text-white relative overflow-hidden"
         x-data="{
            loading: false,
            errorMessage: '',
            chileData: {
                'Región de Arica y Parinacota': ['Arica', 'Camarones', 'Putre', 'General Lagos'],
                'Región de Tarapacá': ['Iquique', 'Alto Hospicio', 'Pozo Almonte', 'Pica', 'Huara'],
                'Región de Antofagasta': ['Antofagasta', 'Mejillones', 'Calama', 'Tocopilla', 'San Pedro de Atacama'],
                'Región de Atacama': ['Copiapó', 'Caldera', 'Vallenar', 'Huasco', 'Chañaral'],
                'Región de Coquimbo': ['La Serena', 'Coquimbo', 'Ovalle', 'Illapel', 'Salamanca', 'Vicuña'],
                'Región de Valparaíso': ['Valparaíso', 'Viña del Mar', 'Quilpué', 'Villa Alemana', 'Quillota', 'San Antonio', 'Los Andes', 'San Felipe'],
                'Región Metropolitana de Santiago': ['Santiago', 'Providencia', 'Las Condes', 'Ñuñoa', 'Maipú', 'Puente Alto', 'La Florida', 'San Miguel', 'La Reina', 'Vitacura', 'Lo Barnechea', 'Quilicura', 'San Bernardo', 'Melipilla', 'Colina', 'Buin', 'Talagante'],
                'Región del Libertador Gral. Bernardo O’Higgins': ['Rancagua', 'Machalí', 'Rengo', 'San Fernando', 'Santa Cruz', 'Pichilemu'],
                'Región del Maule': ['Talca', 'Curicó', 'Linares', 'Constitución', 'Cauquenes', 'Parral', 'Molina'],
                'Región de Ñuble': ['Chillán', 'Chillán Viejo', 'San Carlos', 'Bulnes', 'Yungay', 'Quirihue'],
                'Región del Biobío': ['Concepción', 'Talcahuano', 'San Pedro de la Paz', 'Los Ángeles', 'Coronel', 'Chiguayante', 'Hualpén', 'Tomé'],
                'Región de La Araucanía': ['Temuco', 'Padre Las Casas', 'Villarrica', 'Pucón', 'Angol', 'Victoria', 'Lautaro'],
                'Región de Los Ríos': ['Valdivia', 'La Unión', 'Río Bueno', 'Panguipulli', 'Paillaco', 'Los Lagos'],
                'Región de Los Lagos': ['Puerto Montt', 'Puerto Varas', 'Osorno', 'Castro', 'Ancud', 'Quellón', 'Frutillar', 'Calbuco'],
                'Región de Aysén del Gral. Carlos Ibáñez del Campo': ['Coyhaique', 'Puerto Aysén', 'Chile Chico', 'Cochrane'],
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
                    this.errorMessage = 'Por favor completa todos los campos requeridos marcados con (*).';
                    return;
                }
                this.loading = true;
                this.errorMessage = '';

                fetch('{{ route('members.apply_store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.form)
                })
                .then(res => res.json())
                .then(data => {
                    this.loading = false;
                    if(data.success && data.test_url) {
                        // Redirect to Step 2: Digital Psychological Test
                        window.location.href = data.test_url;
                    } else {
                        this.errorMessage = data.message || 'Ocurrió un error al enviar tu solicitud. Intenta nuevamente.';
                    }
                })
                .catch(err => {
                    this.loading = false;
                    this.errorMessage = 'Error de conexión. Por favor verifica tus datos e inténtalo nuevamente.';
                });
            }
         }">

    <!-- Glowing Background Accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gae-green/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Info Column -->
            <div class="lg:col-span-6 space-y-6">
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-wider border border-emerald-500/30">
                    Convocatoria Nacional Abierta 2026
                </span>

                <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white leading-tight">
                    Colegiatura e Incorporación a <span class="bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-400 bg-clip-text text-transparent">GAE AG</span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Forma parte del gremio oficial de especialistas en <strong>Gas, Agua y Energía</strong> en Chile. Como socio activo obtendrás respaldo institucional, tu propia ficha web con <strong>código QR SEC dinámico</strong>, derivación de obras y acceso a la red gremial nacional.
                </p>

                <!-- 2-Step Process Visual -->
                <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-300">
                        Proceso de Incorporación en 2 Pasos:
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-gae-blue text-white font-black text-xs flex items-center justify-center">1</span>
                            <span class="text-xs font-bold text-slate-200">Paso 1: Completa tus datos técnicos y de contacto (Aquí al lado)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-emerald-500 text-slate-950 font-black text-xs flex items-center justify-center">2</span>
                            <span class="text-xs font-bold text-slate-200">Paso 2: Rinde el Test Psicológico y Ético-Laboral Digital (Inmediato)</span>
                        </div>
                    </div>
                </div>

                <!-- Contact note -->
                <p class="text-xs text-slate-400">
                    ¿Tienes dudas sobre los requisitos? Contáctanos directamente a nuestro WhatsApp oficial: 
                    <a href="https://wa.me/{{ \App\Models\Setting::getByKey('contact_whatsapp', '56949877316') }}" target="_blank" class="text-emerald-400 font-bold underline">
                        {{ \App\Models\Setting::getByKey('contact_phone', '+56 9 4987 7316') }}
                    </a>
                </p>
            </div>

            <!-- Right Form Column -->
            <div class="lg:col-span-6">
                <div class="bg-slate-900/95 border border-slate-800 shadow-2xl rounded-3xl p-6 sm:p-8 backdrop-blur-md space-y-6">
                    
                    <div class="border-b border-slate-800 pb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-black uppercase tracking-wider text-gae-green">Paso 1 de 2</span>
                            <span class="text-xs text-slate-400 font-medium">Registro Técnico</span>
                        </div>
                        <h2 class="text-xl font-black text-white mt-1">Formulario de Postulación a Socio</h2>
                    </div>

                    <!-- Error Alert -->
                    <template x-if="errorMessage">
                        <div class="p-4 rounded-2xl bg-red-950/80 border border-red-500/50 text-red-200 text-xs font-bold flex items-center gap-2">
                            <span>⚠️</span>
                            <span x-text="errorMessage"></span>
                        </div>
                    </template>

                    <form @submit.prevent="submitApplication" class="space-y-4 text-xs">
                        
                        <div>
                            <label class="block font-bold text-slate-300 mb-1">Nombre Completo (*):</label>
                            <input type="text" x-model="form.full_name" required placeholder="Ej: Domingo Isaín Plaza Caamaño"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-300 mb-1">RUT (*):</label>
                                <input type="text" x-model="form.rut" required placeholder="Ej: 12.345.678-9"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            </div>

                            <div>
                                <label class="block font-bold text-slate-300 mb-1">N° Licencia SEC (Opcional):</label>
                                <input type="text" x-model="form.sec_licence" placeholder="Ej: SEC-GAS-0017"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-300 mb-1">Especialidad Principal (*):</label>
                                <select x-model="form.category" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                                    <option value="Gas">Gas & Redes de Combustibles</option>
                                    <option value="Agua">Agua Potable & Alcantarillado</option>
                                    <option value="Energía">Energía Eléctrica & Solar</option>
                                    <option value="Gas, Agua y Energía">Integral (Gas, Agua y Energía)</option>
                                    <option value="Climatización">Climatización & Calderas</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-300 mb-1">Categoría / Clase SEC:</label>
                                <select x-model="form.class" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                                    <option value="Clase A SEC">Clase A SEC (Ingeniero / Máxima Potencia)</option>
                                    <option value="Clase B SEC">Clase B SEC (Media y Alta Presión)</option>
                                    <option value="Clase C SEC">Clase C SEC (Instalaciones Domiciliarias)</option>
                                    <option value="Clase D SEC">Clase D SEC (Mantenimiento de Artefactos)</option>
                                    <option value="En Trámite">En Trámite de Certificación</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-300 mb-1">Teléfono / WhatsApp (*):</label>
                                <input type="text" x-model="form.phone" required placeholder="Ej: +56 9 1234 5678"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            </div>

                            <div>
                                <label class="block font-bold text-slate-300 mb-1">Correo Electrónico (*):</label>
                                <input type="email" x-model="form.email" required placeholder="tuemail@ejemplo.cl"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-300 mb-1">Región (*):</label>
                                <select x-model="form.region" @change="onRegionChange()" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                                    <template x-for="(comunas, regName) in chileData" :key="regName">
                                        <option :value="regName" x-text="regName" :selected="regName === form.region"></option>
                                    </template>
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold text-slate-300 mb-1">Comuna / Ciudad (*):</label>
                                <select x-model="form.city" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green">
                                    <template x-for="comuna in (chileData[form.region] || [])" :key="comuna">
                                        <option :value="comuna" x-text="comuna" :selected="comuna === form.city"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-300 mb-1">Reseña o Experiencia Profesional (Opcional):</label>
                            <textarea x-model="form.bio" rows="2" placeholder="Años de experiencia, proyectos destacados o certificaciones adicionales..."
                                      class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-gae-green"></textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit" :disabled="loading"
                                    class="w-full py-4 rounded-xl bg-gradient-to-r from-gae-green to-gae-blue hover:from-emerald-600 hover:to-sky-600 text-white font-black text-sm shadow-xl hover:shadow-emerald-500/20 transition-all flex items-center justify-center gap-2 min-h-[50px] disabled:opacity-50">
                                <span x-show="!loading">Continuar al Paso 2: Test Psicológico de Admisión &rarr;</span>
                                <span x-show="loading" class="inline-flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                    Registrando Postulación...
                                </span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection
