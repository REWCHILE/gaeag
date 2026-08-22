<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AiBulletinService
{
    /**
     * Generates a structured HTML technical bulletin for GAE AG guild members.
     * Supports Google AI Studio (Free Tier), OpenRouter (Free Models), and Groq Cloud (Free Tier).
     */
    public function generateBulletin(string $topic, string $category = 'Normativa SEC'): array
    {
        $cleanTopic = trim($topic);
        $geminiKey = Setting::getByKey('gemini_api_key');
        $openRouterKey = Setting::getByKey('openrouter_api_key');
        $groqKey = Setting::getByKey('groq_api_key');

        $aiText = null;

        // 1. Try Google AI Studio Official Free Tier (Gemini 1.5 Flash)
        if ($geminiKey) {
            try {
                $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$geminiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "Actúa como un experto de la Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG en Chile. Escribe un resumen técnico profesional de 3 párrafos sobre el siguiente tema: {$cleanTopic} para la categoría {$category}. Enfócate en cumplimiento normativo SEC, seguridad y calidad de servicio."
                                ]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $aiText = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;
                }
            } catch (\Exception $e) {
                Log::warning("Google AI Studio Gemini API call failed: " . $e->getMessage());
            }
        }

        // 2. Try OpenRouter Free Models (Gemini / Llama / DeepSeek Free Tier)
        if (!$aiText && $openRouterKey) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => "Bearer {$openRouterKey}",
                    'HTTP-Referer' => url('/'),
                    'X-Title' => 'GAE AG Web System',
                ])->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'google/gemini-2.0-flash-lite-preview-02-05:free',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => "Escribe un boletín técnico profesional de la Asociación Gremial del Gas Agua y Energía GAE AG sobre: {$cleanTopic}."
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $aiText = $response->json()['choices'][0]['message']['content'] ?? null;
                }
            } catch (\Exception $e) {
                Log::warning("OpenRouter API call failed: " . $e->getMessage());
            }
        }

        // 3. Try Groq Cloud Free Tier
        if (!$aiText && $groqKey) {
            try {
                $response = Http::withToken($groqKey)->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => "Escribe un boletín técnico profesional de la Asociación Gremial del Gas Agua y Energía GAE AG sobre: {$cleanTopic}."
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $aiText = $response->json()['choices'][0]['message']['content'] ?? null;
                }
            } catch (\Exception $e) {
                Log::warning("Groq API call failed: " . $e->getMessage());
            }
        }

        $title = "Boletín Técnico GAE AG: " . Str::title($cleanTopic);
        $subject = "[GAE AG] Novedades Técnicas y Normativas: " . Str::limit($cleanTopic, 45);

        $dateStr = date('d/m/Y');
        $dynamicBodyText = $aiText 
            ? nl2br(e($aiText))
            : "<p>Como parte de nuestro compromiso constante con la profesionalización técnica y actualización normativa de los instaladores de Gas, Agua y Energías Renovables en Chile, compartimos las siguientes directrices clave sobre <strong>{$cleanTopic}</strong>:</p>
               <div style=\"background-color: #f8fafc; border-left: 4px solid #2a81ba; padding: 16px; margin: 20px 0; border-radius: 8px;\">
                   <h4 style=\"margin: 0 0 8px 0; color: #0f172a; font-size: 14px;\">Puntos Clave de Cumplimiento Técnico:</h4>
                   <ul style=\"margin: 0; padding-left: 20px; color: #475569; font-size: 13px;\">
                       <li style=\"margin-bottom: 6px;\"><strong>Revisión Normativa SEC:</strong> Verificación estricta de protocolos de hermeticidad y sellado de pruebas de presión.</li>
                       <li style=\"margin-bottom: 6px;\"><strong>Registro Digital:</strong> Actualización de credenciales y certificados en la plataforma oficial de GAE AG.</li>
                       <li style=\"margin-bottom: 6px;\"><strong>Calidad de Servicio al Cliente:</strong> Entrega de informes de inspección y regularizaciones con Sello Verde en plazos establecidos.</li>
                   </ul>
               </div>";

        $contentHtml = <<<HTML
<div style="font-family: 'Inter', Helvetica, Arial, sans-serif; max-width: 640px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
    <!-- Header -->
    <div style="background-color: #0f172a; padding: 32px 24px; text-align: center; border-bottom: 4px solid #4da832;">
        <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 800;">G.A.E. A.G.</h1>
        <p style="color: #38bdf8; margin: 4px 0 0 0; font-size: 12px; font-weight: 600; text-transform: uppercase;">Asociación Gremial del Gas, Agua y Energía</p>
    </div>

    <!-- Content Body -->
    <div style="padding: 32px 28px; color: #334155; line-height: 1.6; font-size: 14px;">
        <div style="display: inline-block; background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #047857; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; margin-bottom: 16px;">
            CATEGORÍA: {$category} &bull; {$dateStr}
        </div>

        <h2 style="color: #0f172a; font-size: 18px; font-weight: 800; margin-top: 0;">{$cleanTopic}</h2>

        <p>Estimado socio y especialista de <strong>GAE AG</strong>,</p>

        {$dynamicBodyText}

        <p style="margin-top: 20px;">Le recordamos a toda nuestra nómina de profesionales mantener sus datos de contacto y licencias SEC vigentes en su perfil público interactivo.</p>

        <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: center;">
            <p style="margin: 0; font-weight: 700; color: #0f172a;">Domingo Isaín Plaza Caamaño</p>
            <p style="margin: 2px 0 0 0; color: #64748b; font-size: 12px;">Presidente Fundador & Directiva GAE AG</p>
        </div>
    </div>

    <!-- Footer -->
    <div style="background-color: #f1f5f9; padding: 20px; text-align: center; font-size: 11px; color: #64748b; border-top: 1px solid #e2e8f0;">
        <p style="margin: 0;">Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG &bull; Santiago, Chile</p>
        <p style="margin: 4px 0 0 0;">Boletín Informativo Técnico Oficial enviado a la nómina acreditada.</p>
    </div>
</div>
HTML;

        return [
            'title' => $title,
            'subject' => $subject,
            'content_html' => $contentHtml,
        ];
    }

    /**
     * Generates a 4-week or 30-day diverse AI Content Grid with distinct technical topics.
     */
    public function generateContentGrid(string $frequency = 'semanal'): array
    {
        $topicsPool = [
            ['topic' => 'Actualización Decreto Supremo 66 SEC: Inspecciones y Medición de Monóxido', 'category' => 'Gas'],
            ['topic' => 'Protocolo de Hermeticidad en Centrales de Gas Licuado y Gas Natural', 'category' => 'Gas'],
            ['topic' => 'Procedimiento de Regularización para la Obtención del Sello Verde Residencial', 'category' => 'Gas'],
            ['topic' => 'Normativa Sanitaria MOP para Redes de Agua Potable y Alcantarillado Domiciliario', 'category' => 'Agua'],
            ['topic' => 'Mantenimiento Preventivo de Salas de Bombas de Agua y Presurización', 'category' => 'Agua'],
            ['topic' => 'Eficiencia Hídrica y Tratamiento de Aguas Grises en Edificaciones Comerciales', 'category' => 'Agua'],
            ['topic' => 'Integración de Colectores Solares Térmicos para Calentamiento de Agua Sanitaria', 'category' => 'Energía'],
            ['topic' => 'Regulaciones Net-Billing y Sistemas Fotovoltaicos On-Grid Normados por SEC', 'category' => 'Energía'],
            ['topic' => 'Medidas de Seguridad e Indumentaria Técnica de Protección para Instaladores', 'category' => 'Normativa SEC'],
            ['topic' => 'Renovación y Verificación Digital de Licencias SEC en la Plataforma GAE AG', 'category' => 'Normativa SEC'],
        ];

        shuffle($topicsPool);

        $count = $frequency === 'mensual' ? 8 : 4;
        $selected = array_slice($topicsPool, 0, $count);

        $startDate = now()->startOfWeek();
        $gridItems = [];

        foreach ($selected as $index => $item) {
            $daysToAdd = $frequency === 'mensual' ? ($index * 3) + 1 : ($index * 7) + 2;
            $gridItems[] = [
                'topic' => $item['topic'],
                'category' => $item['category'],
                'frequency' => $frequency,
                'scheduled_date' => $startDate->copy()->addDays($daysToAdd)->format('Y-m-d'),
                'status' => 'planned',
            ];
        }

        return $gridItems;
    }
}
