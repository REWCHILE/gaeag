<?php

namespace App\Services;

class PsychologicalTestService
{
    /**
     * Devuelve la batería completa de evaluación psicométrica y de juicio situacional (SJT)
     * calibrada específicamente para instaladores y especialistas técnicos de Gas, Agua y Energía en Chile.
     */
    public function getQuestions(): array
    {
        return [
            // PILAR 1: RIGOR NORMATIVO SEC Y RESISTENCIA A LA PRESIÓN COMERCIAL
            [
                'id' => 1,
                'dimension' => 'safety',
                'dimension_name' => 'Rigor Normativo SEC & Cero Tolerancia al Riesgo',
                'scenario' => 'Presión de Entrega Rápida:',
                'question' => 'Si un cliente o administrador me exige habilitar el gas o energía "de palabra" un viernes por la tarde para evitar quejas, me niego de forma categórica y mantengo el corte hasta ejecutar la prueba de hermeticidad y protocolo oficial SEC, sin importar su enojo o amenazas.',
                'type' => 'likert',
                'weight' => 1.2,
            ],
            [
                'id' => 2,
                'dimension' => 'safety',
                'dimension_name' => 'Rigor Normativo SEC & Cero Tolerancia al Riesgo',
                'scenario' => 'Detección de Riesgo no Contratado:',
                'question' => 'Si al reparar un artefacto detecto una anomalía grave en los ductos colectivos o ventilaciones (riesgo de monóxido de carbono) que el cliente no quiere pagar por reparar, clausuro el paso o notifico formalmente el Sello Rojo antes de marcharme.',
                'type' => 'likert',
                'weight' => 1.2,
            ],
            [
                'id' => 3,
                'dimension' => 'safety',
                'dimension_name' => 'Rigor Normativo SEC & Cero Tolerancia al Riesgo',
                'scenario' => 'Improvisación de Materiales:',
                'question' => 'Jamás utilizo fittings, sellantes o materiales no certificados para salir de un paso rápido en una obra, aunque me signifique perder medio día yendo a comprar el repuesto normado por el DS 66 / DS 222.',
                'type' => 'likert',
                'weight' => 1.1,
            ],
            [
                'id' => 4,
                'dimension' => 'safety',
                'dimension_name' => 'Rigor Normativo SEC & Cero Tolerancia al Riesgo',
                'scenario' => 'Uso Riguroso de Instrumentos:',
                'question' => 'Utilizo siempre manómetros calibrados, detectores de fugas e instrumental normado, evitando confiar únicamente en el "ojo clínico" o en pruebas con espuma improvisada.',
                'type' => 'likert',
                'weight' => 1.0,
            ],

            // PILAR 2: MANEJO DE CLIENTES DIFÍCILES, HOSTILIDAD Y PREVENCIÓN DE MALOS RATOS
            [
                'id' => 5,
                'dimension' => 'service',
                'dimension_name' => 'Trato Asertivo y Prevención de Conflictos',
                'scenario' => 'Cliente Alterado o Acusatorio:',
                'question' => 'Si llego a un domicilio y el cliente me recibe de forma grosera o acusándome injustamente de cobros abusivos anteriores, mantengo la respiración, bajo el tono de voz y desescalo la tensión con argumentos técnicos respetuosos.',
                'type' => 'likert',
                'weight' => 1.2,
            ],
            [
                'id' => 6,
                'dimension' => 'service',
                'dimension_name' => 'Trato Asertivo y Prevención de Conflictos',
                'scenario' => 'Explicación Pedagógica al Usuario:',
                'question' => 'Me doy el tiempo necesario para explicarle al cliente en lenguaje simple y transparente por qué se produjo la falla y qué pasos preventivos debe seguir en su hogar.',
                'type' => 'likert',
                'weight' => 1.0,
            ],
            [
                'id' => 7,
                'dimension' => 'service',
                'dimension_name' => 'Trato Asertivo y Prevención de Conflictos',
                'scenario' => 'Higiene y Cuidado del Hogar:',
                'question' => 'Considero que retirar los escombros, limpiar el área intervenida y dejar el piso y artefactos impecables es tan obligatorio como la soldadura o conexión técnica.',
                'type' => 'likert',
                'weight' => 1.0,
            ],
            [
                'id' => 8,
                'dimension' => 'service',
                'dimension_name' => 'Trato Asertivo y Prevención de Conflictos',
                'scenario' => 'Retrasos Imprevistos en Agenda:',
                'question' => 'Si por tráfico o contingencia en terreno me atraso más de 15 minutos de la hora pactada, aviso proactivamente al cliente antes de la hora fijada para no generarle incertidumbre ni molestias.',
                'type' => 'likert',
                'weight' => 1.0,
            ],

            // PILAR 3: ÉTICA PROFESIONAL, HONESTIDAD Y TRANSPARENCIA COMERCIAL
            [
                'id' => 9,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad Comercial',
                'scenario' => 'Cobros a Clientes Vulnerables:',
                'question' => 'Si atiendo a un cliente desinformado (ej. adulto mayor) con una falla sumamente simple (ej. pila sulfatada o llave de paso cerrada), le cobro exclusivamente lo justo y le explico la verdad sin inventar fallas complejas.',
                'type' => 'likert',
                'weight' => 1.3,
            ],
            [
                'id' => 10,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad Comercial',
                'scenario' => 'Firma y Certificación de Terceros:',
                'question' => 'Si un colega o conocido me ofrece dinero por firmar o certificar con mi licencia SEC una instalación que yo no inspeccioné ni ejecuté personalmente, rechazo el dinero de inmediato.',
                'type' => 'likert',
                'weight' => 1.4,
            ],
            [
                'id' => 11,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad Comercial',
                'scenario' => 'Daños Involuntarios en Faena:',
                'question' => 'Si durante el desarme o picado rompo accidentalmente un cerámico o accesorio del cliente, le informo de inmediato con honestidad y asumo el costo de la reparación o reposición.',
                'type' => 'likert',
                'weight' => 1.2,
            ],
            [
                'id' => 12,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad Comercial',
                'scenario' => 'Detalle de Cotizaciones:',
                'question' => 'Entrego cotizaciones desglosando claramente materiales, mano de obra y condiciones de garantía, evitando presupuestos ambiguos que generen sorpresas al cliente al momento de pagar.',
                'type' => 'likert',
                'weight' => 1.0,
            ],

            // PILAR 4: CONTROL EMOCIONAL BAJO PRESIÓN Y EMERGENCIAS CRÍTICAS
            [
                'id' => 13,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Control del Estrés',
                'scenario' => 'Emergencia Crítica Súbita:',
                'question' => 'Ante una fuga violenta imprevista, amago de fuego o rotura de matriz con personas gritando en pánico, actúo con absoluta serenidad, cerrando cortes principales y evacuando antes de ponerme nervioso.',
                'type' => 'likert',
                'weight' => 1.3,
            ],
            [
                'id' => 14,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Control del Estrés',
                'scenario' => 'Complicaciones en Obras Largas:',
                'question' => 'Cuando un trabajo que pensé que tomaría 2 horas se extiende a 7 horas por dificultades ocultas en la estructura, mantengo la paciencia y el rigor sin apurar las terminaciones por cansancio.',
                'type' => 'likert',
                'weight' => 1.1,
            ],
            [
                'id' => 15,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Control del Estrés',
                'scenario' => 'Tolerancia a la Frustración:',
                'question' => 'Rara vez pierdo los estribos o reacciono con frustración visible cuando las herramientas o repuestos nuevos presentan fallas de fábrica.',
                'type' => 'likert',
                'weight' => 1.0,
            ],
            [
                'id' => 16,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Control del Estrés',
                'scenario' => 'Separación de Problemas Personales:',
                'question' => 'Logro concentrarme al 100% en las decisiones técnicas críticas de seguridad, dejando fuera de la faena cualquier problema personal o familiar.',
                'type' => 'likert',
                'weight' => 1.0,
            ],

            // PILAR 5: RESPONSABILIDAD DE GARANTÍAS Y PRESTIGIO GREMIAL
            [
                'id' => 17,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad, Garantías y Prestigio Gremial',
                'scenario' => 'Respuesta Inmediata a Garantías:',
                'question' => 'Si un cliente me contacta semanas después reclamando que un trabajo que realicé presenta una anomalía, acudo a revisar con la misma prontitud y amabilidad que cuando fui a cobrar la primera vez.',
                'type' => 'likert',
                'weight' => 1.3,
            ],
            [
                'id' => 18,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad, Garantías y Prestigio Gremial',
                'scenario' => 'Conciencia de Imagen Gremial:',
                'question' => 'Entiendo que al portar la credencial o el nombre de GAE AG, cualquier mala práctica mía no solo daña mi negocio, sino que perjudica el prestigio de todos los socios del gremio.',
                'type' => 'likert',
                'weight' => 1.2,
            ],
            [
                'id' => 19,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad, Garantías y Prestigio Gremial',
                'scenario' => 'Actualización Técnica Permanente:',
                'question' => 'Dedico tiempo periódico y recursos propios a capacitarme en nuevas tecnologías (energía solar, bombas de calor, detección digital de fugas) y normativas actualizadas.',
                'type' => 'likert',
                'weight' => 1.0,
            ],
            [
                'id' => 20,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad, Garantías y Prestigio Gremial',
                'scenario' => 'Disposición a la Autorregulación:',
                'question' => 'Acepto con agrado que el gremio mantenga mecanismos de supervisión y sanciones éticas si algún asociado incumple las normas de seguridad o trato al cliente.',
                'type' => 'likert',
                'weight' => 1.1,
            ],

            // PILAR 6: ESCALA DE CONTROL DE VERACIDAD (LIE SCALE / DETECCIÓN DE FALSEAMIENTO)
            [
                'id' => 21,
                'dimension' => 'lie_scale',
                'dimension_name' => 'Índice de Veracidad y Deseabilidad Social',
                'scenario' => 'Control de Autenticidad 1:',
                'question' => 'En ocasiones he sentido molestia o cansancio cuando un cliente me hace demasiadas preguntas seguidas, pero procuro controlarlo.',
                'type' => 'likert',
                'weight' => 1.0,
                'is_inverted' => false,
            ],
            [
                'id' => 22,
                'dimension' => 'lie_scale',
                'dimension_name' => 'Índice de Veracidad y Deseabilidad Social',
                'scenario' => 'Control de Autenticidad 2:',
                'question' => 'Reconozco que a lo largo de mi trayectoria técnica alguna vez he cometido un error menor en una faena que tuve que corregir posteriormente.',
                'type' => 'likert',
                'weight' => 1.0,
                'is_inverted' => false,
            ],
            [
                'id' => 23,
                'dimension' => 'lie_scale',
                'dimension_name' => 'Índice de Veracidad y Deseabilidad Social',
                'scenario' => 'Control de Autenticidad 3:',
                'question' => 'Si alguna vez me he sentido apurado por terminar una faena tarde en la noche, he tenido que hacer un esfuerzo consciente para no descuidar ningún detalle.',
                'type' => 'likert',
                'weight' => 1.0,
                'is_inverted' => false,
            ],
            [
                'id' => 24,
                'dimension' => 'lie_scale',
                'dimension_name' => 'Índice de Veracidad y Deseabilidad Social',
                'scenario' => 'Control de Autenticidad 4:',
                'question' => 'Cuando un colega me hace una crítica técnica constructiva sobre mi método de trabajo, a veces me cuesta admitirlo al principio aunque luego lo reflexione.',
                'type' => 'likert',
                'weight' => 1.0,
                'is_inverted' => false,
            ],
        ];
    }

    /**
     * Evalúa las respuestas del postulante con ponderaciones psicométricas avanzadas
     * y cálculo de confiabilidad / índice de veracidad.
     */
    public function evaluate(array $answers): array
    {
        $questions = $this->getQuestions();
        $dimensions = [
            'safety' => ['weighted_sum' => 0, 'total_weights' => 0, 'label' => 'Seguridad y Normativa SEC'],
            'stress' => ['weighted_sum' => 0, 'total_weights' => 0, 'label' => 'Estabilidad Emocional y Control de Estrés'],
            'ethics' => ['weighted_sum' => 0, 'total_weights' => 0, 'label' => 'Ética Profesional y Honestidad'],
            'service' => ['weighted_sum' => 0, 'total_weights' => 0, 'label' => 'Trato Asertivo y Prevención de Conflictos'],
            'responsibility' => ['weighted_sum' => 0, 'total_weights' => 0, 'label' => 'Responsabilidad y Garantías'],
            'lie_scale' => ['weighted_sum' => 0, 'total_weights' => 0, 'label' => 'Índice de Veracidad'],
        ];

        $detailedAnswers = [];

        foreach ($questions as $q) {
            $qId = $q['id'];
            $val = isset($answers[$qId]) ? intval($answers[$qId]) : 3;
            $val = max(1, min(5, $val));
            $weight = $q['weight'] ?? 1.0;

            $dimKey = $q['dimension'];
            $dimensions[$dimKey]['weighted_sum'] += ($val * $weight);
            $dimensions[$dimKey]['total_weights'] += $weight;

            $detailedAnswers[] = [
                'question_id' => $qId,
                'scenario' => $q['scenario'] ?? '',
                'question' => $q['question'],
                'dimension' => $dimKey,
                'score' => $val,
            ];
        }

        // Función de cálculo porcentual normalizada (1 -> 0%, 5 -> 100%)
        $calculatePct = function($data) {
            if ($data['total_weights'] <= 0) return 0;
            $weightedAvg = $data['weighted_sum'] / $data['total_weights'];
            return (int) round((($weightedAvg - 1) / 4) * 100);
        };

        $safetyScore = $calculatePct($dimensions['safety']);
        $stressScore = $calculatePct($dimensions['stress']);
        $ethicsScore = $calculatePct($dimensions['ethics']);
        $serviceScore = $calculatePct($dimensions['service']);
        $respScore = $calculatePct($dimensions['responsibility']);
        $lieScore = $calculatePct($dimensions['lie_scale']);

        // Ponderación global: Safety (25%), Ethics (25%), Service (20%), Responsibility (15%), Stress (15%)
        $totalScore = (int) round(
            ($safetyScore * 0.25) +
            ($ethicsScore * 0.25) +
            ($serviceScore * 0.20) +
            ($stressScore * 0.15) +
            ($respScore * 0.15)
        );

        // Detección de patrones de riesgo y generación de alertas
        $alerts = [];

        if ($safetyScore < 75) {
            $alerts[] = '⚠️ Alerta Crítica en Normativa SEC: Tendencia a flexibilizar pruebas de hermeticidad o habilitaciones provisorias.';
        }
        if ($ethicsScore < 80) {
            $alerts[] = '⚖️ Alerta en Integridad Comercial: Riesgo en cobros desmedidos a clientes vulnerables o firma de certificaciones a terceros.';
        }
        if ($serviceScore < 75) {
            $alerts[] = '🤝 Riesgo de Conflictos con Clientes ("Malos Ratos"): Dificultad para mantener la calma ante clientes hostiles o poca proactividad en avisar retrasos.';
        }
        if ($stressScore < 70) {
            $alerts[] = '🧠 Vulnerabilidad ante Situaciones de Emergencia: Posible desborde emocional o pérdida de método bajo alta presión en terreno.';
        }
        if ($respScore < 75) {
            $alerts[] = '📋 Alerta en Respuesta a Garantías: Posible resistencia a acudir a reclamos de post-venta sin costo.';
        }
        if ($lieScore < 40) {
            $alerts[] = '🎭 Posible Sesgo de Deseabilidad Social: El postulante respondió de forma excesivamente complaciente intentando aparentar infalibilidad.';
        }

        // Diagnóstico cualitativo
        if ($totalScore >= 88 && count($alerts) === 0) {
            $riskLevel = 'Bajo';
            $recommendation = 'Perfil de Excelencia Profesional (Apto con Distinción)';
            $summary = 'El postulante demostró un criterio técnico intachable, integridad comercial a toda prueba y excelente capacidad de contención frente a clientes difíciles. No presenta factores de riesgo.';
        } elseif ($totalScore >= 75 && count($alerts) <= 1) {
            $riskLevel = 'Medio-Bajo';
            $recommendation = 'Apto para Admisión Gremial';
            $summary = 'Candidato con sólida formación ética y normativa. Cumple con los estándares requeridos para representar a GAE AG con garantía de buen servicio.';
        } elseif ($totalScore >= 60) {
            $riskLevel = 'Medio';
            $recommendation = 'Admisión Condicional / Requiere Entrevista Personal';
            $summary = 'El postulante evidencia experiencia básica, pero presenta áreas de mejora en manejo de clientes conflictivos o apego irrestricto a normativas. Se recomienda entrevista presencial previa.';
        } else {
            $riskLevel = 'Alto';
            $recommendation = 'No Recomendado para Ingreso';
            $summary = 'El perfil evaluado presenta discrepancias severas con los estándares de rigor técnico, transparencia comercial o autocontrol exigidos por la Asociación Gremial GAE AG.';
        }

        return [
            'score_total' => $totalScore,
            'score_safety' => $safetyScore,
            'score_stress' => $stressScore,
            'score_ethics' => $ethicsScore,
            'score_service' => $serviceScore,
            'score_responsibility' => $respScore,
            'score_lie' => $lieScore,
            'risk_level' => $riskLevel,
            'recommendation' => $recommendation,
            'summary' => $summary,
            'alerts' => $alerts,
            'detailed_answers' => $detailedAnswers,
        ];
    }
}
