<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Faq;
use App\Models\Member;
use App\Models\User;
use App\Services\QrCodeService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GaeAgSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Administrator
        User::updateOrCreate(
            ['email' => 'admin@gae-ag.cl'],
            [
                'name' => 'Administrador GAE AG',
                'password' => Hash::make('password123'),
            ]
        );

        $qrService = new QrCodeService();

        // 2. Domingo Isaín Plaza Caamaño (Presidente Fundador)
        $domingoSlug = 'domingo-isain-plaza-caamano';
        $domingoUrl = url("/profesionales/{$domingoSlug}");
        $domingoSecQrUrl = 'https://wlhttp.sec.cl/rnii/public/licencia/qr?o=285eb263edf5cb049f3f4cc7fa0d2182';
        $domingoQrPath = $qrService->generateForMemberUrl($domingoSecQrUrl, $domingoSlug);

        $domingo = Member::updateOrCreate(
            ['slug' => $domingoSlug],
            [
                'full_name' => 'Domingo Isaín Plaza Caamaño',
                'rut' => '12.458.932-K',
                'sec_licence' => 'SEC-GAS-AGUA-0017',
                'sec_qr_url' => $domingoSecQrUrl,
                'category' => 'Gas, Agua y Energía',
                'class' => 'Clase A SEC',
                'title' => 'Presidente y Fundador de GAE AG',
                'phone' => '+56 9 9123 4567',
                'email' => 'presidencia@gae-ag.cl',
                'city' => 'Santiago',
                'region' => 'Región Metropolitana',
                'bio' => 'Fundador de la Asociación Gremial de Profesionales del Gas, Agua y Energía (GAE AG) en el año 2017 y Presidente continuo de la organización. Profesional especialista e ingeniero del área comprometido con la profesionalización constante, ética y capacitación continua de instaladores técnicos e ingenieros en Gas, Agua y Energías Renovables en todo Chile.',
                'photo_path' => 'members/domingo-isain.png',
                'is_active' => true,
                'is_verified' => true,
                'qr_code_path' => $domingoQrPath,
            ]
        );

        Certificate::updateOrCreate(
            ['member_id' => $domingo->id, 'title' => 'Certificado Oficial de Inscripción Instalador Autorizado SEC'],
            [
                'issuing_entity' => 'Superintendencia de Electricidad y Combustibles (SEC)',
                'issue_date' => '2017-03-15',
                'file_path' => 'certificates/CERTIFICADO-SEC-DOMINGO-ISAIN-CAAMAÑO.png',
                'certificate_number' => 'SEC-774129-GAE',
                'is_verified' => true,
            ]
        );

        // 3. Demo Members
        $demoMembers = [
            [
                'full_name' => 'Carlos Alberto Mendoza Silva',
                'slug' => 'carlos-mendoza-silva',
                'sec_licence' => 'SEC-GAS-55421',
                'category' => 'Gas',
                'class' => 'Clase A SEC',
                'title' => 'Ingeniero Especialista en Redes de Gas Comercial e Industrial',
                'phone' => '+56 9 8765 4321',
                'email' => 'c.mendoza@gae-ag.cl',
                'city' => 'Concepción',
                'region' => 'Región del Bío Bío',
                'bio' => 'Más de 15 años de experiencia en proyección, cálculo y montaje de centralizaciones de gas licuado y gas natural para edificios y plantas industriales con certificación de sello verde SEC.',
            ],
            [
                'full_name' => 'María José Morales Fuentes',
                'slug' => 'maria-jose-morales',
                'sec_licence' => 'SEC-AGUA-33291',
                'category' => 'Agua y Sanitario',
                'class' => 'Licencia Sanitaria MOP',
                'title' => 'Especialista en Instalaciones Hidráulicas y Tratamiento de Agua',
                'phone' => '+56 9 7654 3210',
                'email' => 'mj.morales@gae-ag.cl',
                'city' => 'Valparaíso',
                'region' => 'Región de Valparaíso',
                'bio' => 'Técnico Senior en sistemas de bombeo, filtración, agua potable domiciliaria y proyectos de alcantarillado con altos estándares de eficiencia hídrica.',
            ],
            [
                'full_name' => 'Roberto Esteban Tapia Vargas',
                'slug' => 'roberto-tapia-vargas',
                'sec_licence' => 'SEC-E-99120',
                'category' => 'Energías Renovables',
                'class' => 'Clase B SEC - Solar & Fotovoltaica',
                'title' => 'Instalador Certificado de Sistemas Solares Térmicos y Fotovoltaicos',
                'phone' => '+56 9 6543 2109',
                'email' => 'r.tapia@gae-ag.cl',
                'city' => 'La Serena',
                'region' => 'Región de Coquimbo',
                'bio' => 'Experto en integración de energía solar térmica para calentamiento de agua sanitaria y sistemas fotovoltaicos on-grid y off-grid normados por SEC.',
            ],
            [
                'full_name' => 'Gonzalo Patricio Reyes Oyarzún',
                'slug' => 'gonzalo-reyes-oyarzun',
                'sec_licence' => 'SEC-GAS-88124',
                'category' => 'Gas y Agua',
                'class' => 'Clase B SEC',
                'title' => 'Gasfiter Profesional Certificado e Inspector de Centrales térmicas',
                'phone' => '+56 9 5432 1098',
                'email' => 'g.reyes@gae-ag.cl',
                'city' => 'Temuco',
                'region' => 'Región de La Araucanía',
                'bio' => 'Gasfiter e instalador autorizado SEC enfocado en mantenimiento preventivo, regularización de instalaciones de gas y eliminación de fuga de gases tóxicos.',
            ],
        ];

        foreach ($demoMembers as $m) {
            $memberUrl = url("/profesionales/{$m['slug']}");
            $qrPath = $qrService->generateForMemberUrl($memberUrl, $m['slug']);

            $created = Member::updateOrCreate(
                ['slug' => $m['slug']],
                array_merge($m, [
                    'rut' => rand(10, 22) . '.' . rand(100, 999) . '.' . rand(100, 999) . '-K',
                    'is_active' => true,
                    'is_verified' => true,
                    'qr_code_path' => $qrPath,
                ])
            );

            Certificate::updateOrCreate(
                ['member_id' => $created->id, 'title' => "Credencial SEC Autorizada - {$created->category}"],
                [
                    'issuing_entity' => 'Superintendencia de Electricidad y Combustibles SEC',
                    'issue_date' => '2020-05-10',
                    'file_path' => 'certificates/CERTIFICADO-SEC-DOMINGO-ISAIN-CAAMAÑO.png',
                    'certificate_number' => $m['sec_licence'],
                    'is_verified' => true,
                ]
            );
        }

        // 4. 10 SEO-Optimized FAQs with detailed answers
        $faqs = [
            [
                'order' => 1,
                'question' => '¿Qué es la Asociación Gremial GAE AG y cuál es su objetivo principal?',
                'answer' => 'La Asociación Gremial de Profesionales del Gas Agua y Energía GAE AG fue fundada en el año 2017 por Domingo Isaín Plaza Caamaño. Su propósito fundamental es profesionalizar constantemente a los instaladores, especialistas, técnicos e ingenieros del área de Gas, Agua y Energía en Chile, garantizando servicios de alta calidad, ética y seguridad para clientes residenciales, comerciales e industriales.',
                'category' => 'Institucional',
            ],
            [
                'order' => 2,
                'question' => '¿Qué significa contar con una certificación SEC en Gas, Agua o Energía?',
                'answer' => 'La acreditación SEC (Superintendencia de Electricidad y Combustibles) valida oficialmente que un instalador posee los conocimientos técnicos, conocimientos normativos y competencias prácticas exigidas por la legislación chilena para proyectar, ejecutar, reparar y mantener instalaciones de gas, sistemas hidráulicos o redes eléctricas en forma segura.',
                'category' => 'Certificación SEC',
            ],
            [
                'order' => 3,
                'question' => '¿Por qué es imprescindible contratar a un Gasfiter Profesional Certificado por SEC?',
                'answer' => 'Las instalaciones de gas involucran riesgos severos de intoxicación por monóxido de carbono, fuga de combustible o explosión. Un Gasfiter Profesional Certificado SEC cumple estrictamente con el Decreto Supremo 66 y normativas vigentes, asegurando que su hogar o local obtenga el Sello Verde y opere bajo condiciones 100% herméticas y seguras.',
                'category' => 'Seguridad & Gas',
            ],
            [
                'order' => 4,
                'question' => '¿Cómo puedo verificar la autenticidad y vigencia de la licencia SEC de un instalador?',
                'answer' => 'En la plataforma oficial de GAE AG, cada socio cuenta con un CV digital en vivo accesible mediante su enlace público y su código QR único. Al escanear el QR o ingresar a su perfil de GAE AG, el cliente puede visualizar la licencia SEC verificada por la administración del gremio y consultar directamente en la Superintendencia.',
                'category' => 'Verificación',
            ],
            [
                'order' => 5,
                'question' => '¿Cuáles son las categorías y clases de licencias SEC en instalaciones de Gas?',
                'answer' => 'Existen distintas clases de licencias de Gas normadas por la SEC: Clase A (proyectos de mayor envergadura industrial, redes de gas licuado y gas natural sin límite de potencia), Clase B (instalaciones interiores residenciales, comerciales y centrales de GLP) y Clase C (mantenimiento y reparación de artefactos a gas). Los profesionales de GAE AG cuentan con licencias vigentes en cada una de estas categorías.',
                'category' => 'Normativa SEC',
            ],
            [
                'order' => 6,
                'question' => '¿Qué tipos de servicios realizan los especialistas en Agua y Alcantarillado de GAE AG?',
                'answer' => 'Nuestros profesionales en agua abarcan desde el diseño y montaje de redes de agua potable domiciliaria e industrial, bombas de presión, salas de calderas, sistemas de alcantarillado, plantas de tratamiento y soluciones de eficiencia hídrica hasta la inspección técnica preventiva.',
                'category' => 'Servicios de Agua',
            ],
            [
                'order' => 7,
                'question' => '¿Cómo integra GAE AG las Energías Renovables en sus proyectos técnicos?',
                'answer' => 'Promovemos activamente la transición energética mediante la capacitación e instalación de sistemas de Energía Solar Térmica (calentamiento de agua sanitaria por colectores solares) y sistemas Fotovoltaicos (generación eléctrica on-grid y off-grid), optimizando el consumo y reduciendo la huella de carbono.',
                'category' => 'Energías Renovables',
            ],
            [
                'order' => 8,
                'question' => '¿Cuáles son los beneficios para un instalador al unirse a la Asociación Gremial GAE AG?',
                'answer' => 'Los socios de GAE AG acceden a capacitaciones continuas de perfeccionamiento técnico, respaldo institucional ante la SEC y clientes, currículum digital público interactivo con código QR dinámico, bolsa de proyectos y pertenencia a una red de profesionales líderes en el país.',
                'category' => 'Beneficios Socios',
            ],
            [
                'order' => 9,
                'question' => '¿Qué procedimiento se requiere para obtener la certificación de Sello Verde de Gas?',
                'answer' => 'El Sello Verde de Gas es la certificación otorgada tras una inspección técnica que valida que los artefactos (calefones, cocinas, estufas) y la red de gas no presenten fugas ni deficiencias de ventilación. Un profesional certificado SEC de GAE AG realiza las correcciones necesarias para asegurar la aprobación de la entidad inspectora.',
                'category' => 'Inspección & Sello Verde',
            ],
            [
                'order' => 10,
                'question' => '¿Cómo me contacto con GAE AG para contratar a un profesional o solicitar información gremial?',
                'answer' => 'Puede contactar a GAE AG directamente a través de nuestro sitio web en el directorio público de profesionales, comunicándose al correo presidencia@gae-ag.cl o interactuando de forma directa vía WhatsApp con cualquiera de nuestros instaladores certificados en cada región de Chile.',
                'category' => 'Contacto',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['is_published' => true])
            );
        }
    }
}
