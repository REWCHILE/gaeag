<?php

namespace App\Services;

class PsychologicalTestService
{
    /**
     * Devuelve la batería completa de 20 preguntas calibradas para evaluación técnica y conductual.
     */
    public function getQuestions(): array
    {
        return [
            // DIMENSIÓN 1: SEGURIDAD OPERATIVA Y RIGOR NORMATIVO SEC (safety)
            [
                'id' => 1,
                'dimension' => 'safety',
                'dimension_name' => 'Seguridad Operativa y Normativa SEC',
                'question' => 'Si un cliente me pide una solución provisoria rápida para habilitar el gas sin esperar la prueba de hermeticidad oficial, me niego firmemente sin importar su molestia.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 2,
                'dimension' => 'safety',
                'dimension_name' => 'Seguridad Operativa y Normativa SEC',
                'question' => 'Prefiero demorar más tiempo en una faena e inspeccionar dos veces las válvulas de corte y uniones antes que dar por terminado el trabajo con prisas.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 3,
                'dimension' => 'safety',
                'dimension_name' => 'Seguridad Operativa y Normativa SEC',
                'question' => 'Ante una duda técnica sobre el reglamento SEC (DS 66 / DS 222), detengo la maniobra y consulto las normas oficiales o manuales antes de improvisar.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 4,
                'dimension' => 'safety',
                'dimension_name' => 'Seguridad Operativa y Normativa SEC',
                'question' => 'Utilizo siempre mis Elementos de Protección Personal (EPP) e instrumentos calibrados, incluso en trabajos breves o domiciliarios simples.',
                'type' => 'likert',
                'weight' => 1,
            ],

            // DIMENSIÓN 2: ESTABILIDAD EMOCIONAL Y MANEJO DE ESTRÉS (stress)
            [
                'id' => 5,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Autocontrol',
                'question' => 'Cuando un cliente se muestra exaltado, alterado o impaciente, mantengo la calma, el tono de voz firme y una actitud profesional serena.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 6,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Autocontrol',
                'question' => 'Frente a una contingencia inesperada (rotura de matriz, fuga de gas imprevista o corte de energía), actúo con cabeza fría siguiendo el protocolo de emergencia sin caer en pánico.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 7,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Autocontrol',
                'question' => 'Rara vez me dejo llevar por la frustración cuando una instalación técnica se complica más de lo presupuestado.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 8,
                'dimension' => 'stress',
                'dimension_name' => 'Estabilidad Emocional y Autocontrol',
                'question' => 'Separo mis preocupaciones personales de la concentración total que requiere el trabajo técnico en terreno.',
                'type' => 'likert',
                'weight' => 1,
            ],

            // DIMENSIÓN 3: ÉTICA, HONESTIDAD Y TRANSPARENCIA (ethics)
            [
                'id' => 9,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad',
                'question' => 'Entrego siempre al cliente el detalle claro y justo de los repuestos, materiales utilizados y valores reales sin recargos ocultos.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 10,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad',
                'question' => 'Si por error cometo un fallo menor durante la instalación, asumo la responsabilidad frente al cliente y lo soluciono de inmediato sin cobrar adicional.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 11,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad',
                'question' => 'Jamás firmaría ni certificaría un plano o instalación que no haya sido ejecutada o inspeccionada personalmente por mí bajo estándares de ley.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 12,
                'dimension' => 'ethics',
                'dimension_name' => 'Ética Profesional y Honestidad',
                'question' => 'Respeto la propiedad y privacidad del hogar del cliente, manteniendo un comportamiento intachable y pulcro en todo momento.',
                'type' => 'likert',
                'weight' => 1,
            ],

            // DIMENSIÓN 4: TRATO AL CLIENTE Y PREVENCIÓN DE CONFLICTOS / MALOS RATOS (service)
            [
                'id' => 13,
                'dimension' => 'service',
                'dimension_name' => 'Trato al Cliente y Prevención de Conflictos',
                'question' => 'Explico con palabras claras y paciencia el diagnóstico técnico a clientes que no tienen conocimientos del área, asegurándome de que comprendan el trabajo.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 14,
                'dimension' => 'service',
                'dimension_name' => 'Trato al Cliente y Prevención de Conflictos',
                'question' => 'Ante un reclamo o disconformidad de un cliente, escucho activamente sin interrumpir ni ponerme a la defensiva para buscar una solución constructiva.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 15,
                'dimension' => 'service',
                'dimension_name' => 'Trato al Cliente y Prevención de Conflictos',
                'question' => 'Dejo el lugar de trabajo limpio, ordenado y en las mejores condiciones higiénicas tras finalizar la intervención técnica.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 16,
                'dimension' => 'service',
                'dimension_name' => 'Trato al Cliente y Prevención de Conflictos',
                'question' => 'Mantengo informado proactivamente al cliente si surge algún atraso en la hora de llegada acordada para la visita técnica.',
                'type' => 'likert',
                'weight' => 1,
            ],

            // DIMENSIÓN 5: RESPONSABILIDAD Y COMPROMISO GREMIAL (responsibility)
            [
                'id' => 17,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad y Prestigio Gremial',
                'question' => 'Considero que representar a la Asociación Gremial GAE AG exige mantener un estándar de conducta ejemplar que prestigie a todo el gremio.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 18,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad y Prestigio Gremial',
                'question' => 'Tengo total disposición para capacitarme continuamente, actualizar mis conocimientos normativos y compartir buenas prácticas con mis colegas.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 19,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad y Prestigio Gremial',
                'question' => 'Cumplo con puntualidad y rigor los compromisos y presupuestos que entrego por escrito.',
                'type' => 'likert',
                'weight' => 1,
            ],
            [
                'id' => 20,
                'dimension' => 'responsibility',
                'dimension_name' => 'Responsabilidad y Prestigio Gremial',
                'question' => 'Estoy dispuesto a aceptar las auditorías y normas de autorregulación ética que el directorio gremial determine para proteger a la comunidad.',
                'type' => 'likert',
                'weight' => 1,
            ],
        ];
    }

    /**
     * Evalúa las respuestas del postulante y calcula los puntajes por dimensión, perfil global y nivel de riesgo.
     */
    public function evaluate(array $answers): array
    {
        $questions = $this->getQuestions();
        $dimensions = [
            'safety' => ['sum' => 0, 'count' => 0, 'label' => 'Seguridad y Normativa SEC'],
            'stress' => ['sum' => 0, 'count' => 0, 'label' => 'Estabilidad Emocional y Control de Estrés'],
            'ethics' => ['sum' => 0, 'count' => 0, 'label' => 'Ética Profesional y Honestidad'],
            'service' => ['sum' => 0, 'count' => 0, 'label' => 'Trato al Cliente y Prevención de Conflictos'],
            'responsibility' => ['sum' => 0, 'count' => 0, 'label' => 'Responsabilidad y Compromiso Gremial'],
        ];

        $totalSum = 0;
        $totalCount = 0;
        $detailedAnswers = [];

        foreach ($questions as $q) {
            $qId = $q['id'];
            $val = isset($answers[$qId]) ? intval($answers[$qId]) : 3;
            // Normalizar escala de 1 a 5
            $val = max(1, min(5, $val));

            $dimKey = $q['dimension'];
            $dimensions[$dimKey]['sum'] += $val;
            $dimensions[$dimKey]['count']++;

            $totalSum += $val;
            $totalCount++;

            $detailedAnswers[] = [
                'question_id' => $qId,
                'question' => $q['question'],
                'dimension' => $dimKey,
                'score' => $val,
            ];
        }

        // Calcular porcentajes (escala 0 - 100)
        // Valor mínimo posible = 1 -> 20%, valor máximo = 5 -> 100%
        $calculatePct = function($sum, $count) {
            if ($count === 0) return 0;
            $avg = $sum / $count; // Entre 1.0 y 5.0
            return (int) round((($avg - 1) / 4) * 100);
        };

        $safetyScore = $calculatePct($dimensions['safety']['sum'], $dimensions['safety']['count']);
        $stressScore = $calculatePct($dimensions['stress']['sum'], $dimensions['stress']['count']);
        $ethicsScore = $calculatePct($dimensions['ethics']['sum'], $dimensions['ethics']['count']);
        $serviceScore = $calculatePct($dimensions['service']['sum'], $dimensions['service']['count']);
        $respScore = $calculatePct($dimensions['responsibility']['sum'], $dimensions['responsibility']['count']);

        // Ponderación global: Safety (25%), Ethics (25%), Service/Prevención conflictos (20%), Stress (15%), Responsibility (15%)
        $totalScore = (int) round(
            ($safetyScore * 0.25) +
            ($ethicsScore * 0.25) +
            ($serviceScore * 0.20) +
            ($stressScore * 0.15) +
            ($respScore * 0.15)
        );

        // Determinación del nivel de riesgo laboral / malos ratos
        $riskLevel = 'Bajo';
        $recommendation = 'Altamente Recomendado para Admisión';
        $alerts = [];

        if ($safetyScore < 70) {
            $alerts[] = 'Alerta en Apego a Protocolos de Seguridad SEC: El postulante mostró cierta flexibilidad indebida ante normas técnicas.';
        }
        if ($ethicsScore < 75) {
            $alerts[] = 'Alerta en Honestidad y Ética: Posible tendencia a ocultar errores o sobrecargar cobros.';
        }
        if ($serviceScore < 70) {
            $alerts[] = 'Riesgo de Malos Ratos con Clientes: Puntaje moderado en paciencia, empatía y resolución de quejas.';
        }
        if ($stressScore < 65) {
            $alerts[] = 'Vulnerabilidad ante Presión: Puede reaccionar con frustración o descontrol en situaciones de emergencia.';
        }

        if ($totalScore >= 85 && empty($alerts)) {
            $riskLevel = 'Bajo';
            $recommendation = 'Perfil de Excelencia Profesional (Apto con Distinción)';
            $summary = 'El postulante presenta una personalidad altamente ética, orientada a la seguridad técnica estricta y con excelentes habilidades de contención y servicio al cliente. Presenta un índice mínimo de riesgo para el prestigio del gremio.';
        } elseif ($totalScore >= 70 && count($alerts) <= 1) {
            $riskLevel = 'Medio-Bajo';
            $recommendation = 'Apto para Admisión Gremial';
            $summary = 'Perfil confiable y responsable con buen apego a normas. Demuestra solvencia técnica y trato correcto con el usuario final.';
        } elseif ($totalScore >= 55) {
            $riskLevel = 'Medio';
            $recommendation = 'Admisión Condicional / Requiere Entrevista Personal';
            $summary = 'El postulante evidencia competencias técnicas básicas, pero presenta indicadores que ameritan revisión en entrevista personal antes de admitirlo, a fin de prevenir posibles desavenencias con clientes o colegas.';
        } else {
            $riskLevel = 'Alto';
            $recommendation = 'No Recomendado para Ingreso';
            $summary = 'El perfil evaluado refleja discrepancias significativas con los estándares éticos, de seguridad normativa o de trato asertivo exigidos por la Asociación Gremial GAE AG.';
        }

        return [
            'score_total' => $totalScore,
            'score_safety' => $safetyScore,
            'score_stress' => $stressScore,
            'score_ethics' => $ethicsScore,
            'score_service' => $serviceScore,
            'score_responsibility' => $respScore,
            'risk_level' => $riskLevel,
            'recommendation' => $recommendation,
            'summary' => $summary,
            'alerts' => $alerts,
            'detailed_answers' => $detailedAnswers,
        ];
    }
}
