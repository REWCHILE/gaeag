@extends('layouts.app')

@section('title', 'Evaluación Psicológica y Ético-Laboral de Admisión - GAE AG')
@section('meta_description', 'Proceso digital de evaluación psicológica, ética y apego a normas de seguridad SEC para postulantes a socios de la Asociación Gremial GAE AG.')

@section('content')

<section class="py-12 bg-slate-950 text-white min-h-[90vh] relative overflow-hidden" 
         x-data="{
            currentStep: 0,
            totalSteps: 5,
            steps: [
                { title: 'Seguridad y Normativa SEC', desc: 'Apego estricto a reglamentos y protocolos de prevención', icon: '🛡️' },
                { title: 'Estabilidad y Autocontrol', desc: 'Manejo de emergencias, presión y control emocional', icon: '🧠' },
                { title: 'Ética y Honestidad', desc: 'Transparencia técnica, cobros justos y rectitud profesional', icon: '⚖️' },
                { title: 'Trato al Cliente y Servicio', desc: 'Prevención de conflictos, empatía y pulcritud en faenas', icon: '🤝' },
                { title: 'Compromiso Gremial', desc: 'Responsabilidad, puntualidad y prestigio asociativo', icon: '🌟' }
            ],
            questions: {{ json_encode($questions) }},
            answers: {},
            loading: false,
            errorMessage: '',
            
            get progressPercentage() {
                const total = this.questions.length;
                const answered = Object.keys(this.answers).length;
                return Math.round((answered / total) * 100);
            },

            get stepQuestions() {
                const start = this.currentStep * 4;
                return this.questions.slice(start, start + 4);
            },

            isStepComplete() {
                return this.stepQuestions.every(q => this.answers[q.id] !== undefined);
            },

            nextStep() {
                if(!this.isStepComplete()) {
                    this.errorMessage = 'Por favor responde todas las preguntas de esta sección antes de continuar.';
                    return;
                }
                this.errorMessage = '';
                if(this.currentStep < this.totalSteps - 1) {
                    this.currentStep++;
                    window.scrollTo({ top: 100, behavior: 'smooth' });
                } else {
                    this.submitTest();
                }
            },

            prevStep() {
                this.errorMessage = '';
                if(this.currentStep > 0) {
                    this.currentStep--;
                    window.scrollTo({ top: 100, behavior: 'smooth' });
                }
            },

            setAnswer(questionId, value) {
                this.answers[questionId] = value;
                this.errorMessage = '';
            },

            submitTest() {
                if(Object.keys(this.answers).length < this.questions.length) {
                    this.errorMessage = 'Aún faltan preguntas por responder. Por favor revisa cada paso.';
                    return;
                }
                this.loading = true;
                this.errorMessage = '';

                fetch('{{ route('psych.submit', ['token' => $application->test_token]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ answers: this.answers })
                })
                .then(res => res.json())
                .then(data => {
                    this.loading = false;
                    if(data.success && data.redirect_url) {
                        window.location.href = data.redirect_url;
                    } else {
                        this.errorMessage = 'Hubo un inconveniente al registrar tus respuestas. Por favor intenta de nuevo.';
                    }
                })
                .catch(err => {
                    this.loading = false;
                    this.errorMessage = 'Error de conexión con el servidor. Verifica tu conexión a internet.';
                });
            }
         }">

    <!-- Glowing Background Accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gae-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gae-green/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-8">
        
        <!-- Header Info Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-900/90 border border-slate-800 shadow-2xl backdrop-blur-md">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-800 pb-6">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-400 text-xs font-bold uppercase tracking-wider border border-amber-500/30">
                            Paso 2 de 2: Filtro de Admisión
                        </span>
                        <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider border border-emerald-500/30">
                            Evaluación Confidencial
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-white mt-2">
                        Test Psicológico y Ético-Laboral GAE AG
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1">
                        Postulante: <strong class="text-white">{{ $application->full_name }}</strong> &bull; Especialidad: <span class="text-emerald-400 font-bold">{{ $application->category }} ({{ $application->class ?: 'SEC' }})</span>
                    </p>
                </div>

                <div class="flex flex-col items-end">
                    <span class="text-xs font-bold text-slate-400">Progreso Total</span>
                    <span class="text-2xl font-black text-emerald-400" x-text="progressPercentage + '%'"></span>
                </div>
            </div>

            <!-- Global Progress Bar -->
            <div class="mt-6">
                <div class="w-full bg-slate-950 rounded-full h-3 p-0.5 border border-slate-800 overflow-hidden">
                    <div class="bg-gradient-to-r from-gae-green via-gae-blue to-amber-400 h-full rounded-full transition-all duration-300"
                         :style="'width: ' + progressPercentage + '%'"></div>
                </div>
                <div class="flex justify-between items-center text-[11px] text-slate-400 font-semibold mt-2">
                    <span x-text="'Módulo ' + (currentStep + 1) + ' de ' + totalSteps + ': ' + steps[currentStep].title"></span>
                    <span x-text="Object.keys(answers).length + ' de ' + questions.length + ' preguntas respondidas'"></span>
                </div>
            </div>
        </div>

        <!-- Step Indicator Pills -->
        <div class="grid grid-cols-5 gap-2">
            <template x-for="(step, idx) in steps" :key="idx">
                <div class="p-2 sm:p-3 rounded-2xl border text-center transition-all cursor-pointer"
                     :class="{
                         'bg-gae-blue/20 border-gae-blue text-white shadow-lg': currentStep === idx,
                         'bg-slate-900/60 border-slate-800 text-slate-400 hover:bg-slate-900': currentStep !== idx
                     }"
                     @click="if(idx <= currentStep || progressPercentage > (idx * 20)) currentStep = idx">
                    <span class="text-base sm:text-xl block" x-text="step.icon"></span>
                    <span class="text-[10px] sm:text-xs font-bold hidden sm:block truncate mt-1" x-text="step.title"></span>
                </div>
            </template>
        </div>

        <!-- Current Module Details -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-900/95 border border-slate-800 shadow-2xl backdrop-blur-md space-y-6">
            
            <div class="border-b border-slate-800 pb-4 flex items-center justify-between">
                <div>
                    <span class="text-xs font-black uppercase tracking-wider text-gae-blue" x-text="'Dimensión Evaluada #' + (currentStep + 1)"></span>
                    <h2 class="text-xl sm:text-2xl font-black text-white" x-text="steps[currentStep].title"></h2>
                    <p class="text-xs text-slate-400 mt-0.5" x-text="steps[currentStep].desc"></p>
                </div>
                <span class="text-3xl" x-text="steps[currentStep].icon"></span>
            </div>

            <!-- Error Banner if unfilled -->
            <template x-if="errorMessage">
                <div class="p-4 rounded-2xl bg-red-950/80 border border-red-500/50 text-red-200 text-xs font-bold flex items-center gap-2">
                    <span>⚠️</span>
                    <span x-text="errorMessage"></span>
                </div>
            </template>

            <!-- Question Cards -->
            <div class="space-y-6">
                <template x-for="(q, qIndex) in stepQuestions" :key="q.id">
                    <div class="p-5 sm:p-6 rounded-2xl border transition-all duration-200"
                         :class="answers[q.id] !== undefined ? 'bg-slate-950/80 border-emerald-500/40 shadow-inner' : 'bg-slate-950/50 border-slate-800'">
                        
                        <div class="flex items-start gap-3">
                            <span class="px-2.5 py-1 rounded-lg font-black text-xs shrink-0"
                                  :class="answers[q.id] !== undefined ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800 text-slate-300'"
                                  x-text="'P' + q.id"></span>
                            <div class="flex-grow">
                                <p class="text-sm sm:text-base font-semibold text-white leading-relaxed" x-text="q.question"></p>
                            </div>
                        </div>

                        <!-- 5-Point Likert Scale Buttons -->
                        <div class="grid grid-cols-5 gap-1.5 sm:gap-3 mt-4 pt-4 border-t border-slate-800/80">
                            
                            <!-- 1: Totalmente en Desacuerdo -->
                            <button type="button" @click="setAnswer(q.id, 1)"
                                    class="p-2 sm:p-3 rounded-xl border text-center transition-all flex flex-col items-center justify-center gap-1 min-h-[58px]"
                                    :class="answers[q.id] === 1 ? 'bg-red-600 border-red-400 text-white shadow-lg scale-105' : 'bg-slate-900 border-slate-800 text-slate-400 hover:bg-slate-800 hover:text-white'">
                                <span class="text-xs sm:text-sm font-black">1</span>
                                <span class="text-[9px] sm:text-[10px] font-bold leading-tight line-clamp-2">Totalmente en Desacuerdo</span>
                            </button>

                            <!-- 2: En Desacuerdo -->
                            <button type="button" @click="setAnswer(q.id, 2)"
                                    class="p-2 sm:p-3 rounded-xl border text-center transition-all flex flex-col items-center justify-center gap-1 min-h-[58px]"
                                    :class="answers[q.id] === 2 ? 'bg-amber-600 border-amber-400 text-white shadow-lg scale-105' : 'bg-slate-900 border-slate-800 text-slate-400 hover:bg-slate-800 hover:text-white'">
                                <span class="text-xs sm:text-sm font-black">2</span>
                                <span class="text-[9px] sm:text-[10px] font-bold leading-tight line-clamp-2">En Desacuerdo</span>
                            </button>

                            <!-- 3: Neutral -->
                            <button type="button" @click="setAnswer(q.id, 3)"
                                    class="p-2 sm:p-3 rounded-xl border text-center transition-all flex flex-col items-center justify-center gap-1 min-h-[58px]"
                                    :class="answers[q.id] === 3 ? 'bg-slate-600 border-slate-400 text-white shadow-lg scale-105' : 'bg-slate-900 border-slate-800 text-slate-400 hover:bg-slate-800 hover:text-white'">
                                <span class="text-xs sm:text-sm font-black">3</span>
                                <span class="text-[9px] sm:text-[10px] font-bold leading-tight line-clamp-2">Neutral / Parcial</span>
                            </button>

                            <!-- 4: De Acuerdo -->
                            <button type="button" @click="setAnswer(q.id, 4)"
                                    class="p-2 sm:p-3 rounded-xl border text-center transition-all flex flex-col items-center justify-center gap-1 min-h-[58px]"
                                    :class="answers[q.id] === 4 ? 'bg-sky-600 border-sky-400 text-white shadow-lg scale-105' : 'bg-slate-900 border-slate-800 text-slate-400 hover:bg-slate-800 hover:text-white'">
                                <span class="text-xs sm:text-sm font-black">4</span>
                                <span class="text-[9px] sm:text-[10px] font-bold leading-tight line-clamp-2">De Acuerdo</span>
                            </button>

                            <!-- 5: Totalmente de Acuerdo -->
                            <button type="button" @click="setAnswer(q.id, 5)"
                                    class="p-2 sm:p-3 rounded-xl border text-center transition-all flex flex-col items-center justify-center gap-1 min-h-[58px]"
                                    :class="answers[q.id] === 5 ? 'bg-emerald-600 border-emerald-400 text-white shadow-lg scale-105' : 'bg-slate-900 border-slate-800 text-slate-400 hover:bg-slate-800 hover:text-white'">
                                <span class="text-xs sm:text-sm font-black">5</span>
                                <span class="text-[9px] sm:text-[10px] font-bold leading-tight line-clamp-2">Totalmente de Acuerdo</span>
                            </button>

                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation Controls -->
            <div class="pt-6 border-t border-slate-800 flex items-center justify-between gap-4">
                <button type="button" @click="prevStep()" 
                        :disabled="currentStep === 0 || loading"
                        class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold text-xs transition-all disabled:opacity-30 disabled:pointer-events-none min-h-[44px]">
                    &larr; Paso Anterior
                </button>

                <button type="button" @click="nextStep()" 
                        :disabled="loading"
                        class="px-8 py-3.5 rounded-xl font-black text-xs sm:text-sm shadow-xl transition-all flex items-center gap-2 min-h-[48px]"
                        :class="currentStep === totalSteps - 1 ? 'bg-gradient-to-r from-emerald-500 to-sky-500 hover:from-emerald-600 hover:to-sky-600 text-white shadow-emerald-500/30 scale-105' : 'bg-gae-blue hover:bg-gae-blue-dark text-white'">
                    <span x-show="!loading" x-text="currentStep === totalSteps - 1 ? '✓ Finalizar y Enviar Evaluación' : 'Siguiente Módulo &rarr;'"></span>
                    <span x-show="loading" class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                        Procesando Evaluación...
                    </span>
                </button>
            </div>

        </div>

        <!-- Security and Confidentiality Guarantee Notice -->
        <div class="p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80 text-slate-400 text-xs text-center space-y-1">
            <p>🔒 <strong>Protocolo de Autorregulación GAE AG:</strong> Esta evaluación psicométrica y situacional forma parte de las políticas de selección previa para garantizar la seguridad, prestigio gremial y protección de los clientes finales en todo Chile.</p>
        </div>

    </div>
</section>

@endsection
