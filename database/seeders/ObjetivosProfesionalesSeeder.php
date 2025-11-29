<?php

namespace Database\Seeders;

use App\Models\Objetivo;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ObjetivosProfesionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar objetivos existentes
        Objetivo::truncate();

        // OBJETIVOS DE CORTO PLAZO (1-2 años): 2026-2027
        // Alineados con las primeras categorías del roadmap: Fundamentos de Python y ML Core
        
        $objetivosCorto = [
            [
                'titulo' => 'Completar Roadmap de Fundamentos de Python y ML Core',
                'descripcion' => 'Finalizar las 8 categorías del roadmap de Machine Learning Engineer, incluyendo: Fundamentos de Python, Stack Científico, Conceptos Core de ML, Deep Learning, RAG, LangChain, MLOps y Cloud. Total: ~450 horas de estudio estructurado.',
                'categoria' => 'corto',
                'fecha_limite' => Carbon::create(2027, 6, 30), // Junio 2027
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Obtener Certificación en Python para Data Science',
                'descripcion' => 'Completar certificación reconocida en Python aplicado a Data Science (Coursera, edX o similar). Demostrar dominio de NumPy, Pandas, Matplotlib y fundamentos de ML con Scikit-learn.',
                'categoria' => 'corto',
                'fecha_limite' => Carbon::create(2026, 12, 31), // Diciembre 2026
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Desarrollar Portafolio con 5-8 Proyectos ML',
                'descripcion' => 'Crear portafolio en GitHub con proyectos demostrables: análisis de datos, modelos de ML, implementación de RAG, chatbot con LangChain. Cada proyecto debe incluir documentación, código limpio y resultados medibles.',
                'categoria' => 'corto',
                'fecha_limite' => Carbon::create(2027, 6, 30), // Junio 2027
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Mejorar Nivel de Inglés a B2',
                'descripcion' => 'Alcanzar nivel B2 en inglés técnico para acceder a documentación, cursos y oportunidades internacionales. Certificación TOEFL/IELTS o equivalente. Enfoque en lectura técnica y comprensión de documentación.',
                'categoria' => 'corto',
                'fecha_limite' => Carbon::create(2027, 12, 31), // Diciembre 2027
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Implementar Proyecto RAG en Producción',
                'descripcion' => 'Desarrollar e implementar un sistema RAG completo usando LangChain, vector stores (FAISS/Chroma) y modelos de embeddings. Desplegar con FastAPI y documentar todo el proceso. Objetivo: tener un proyecto real funcionando.',
                'categoria' => 'corto',
                'fecha_limite' => Carbon::create(2027, 3, 31), // Marzo 2027
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Construir Red Profesional en LinkedIn',
                'descripcion' => 'Expandir red profesional a 200+ conexiones relevantes en ML/AI. Participar activamente en grupos, compartir aprendizajes del roadmap y conectar con profesionales del sector. Asistir a 6+ eventos tech locales.',
                'categoria' => 'corto',
                'fecha_limite' => Carbon::create(2027, 6, 30), // Junio 2027
                'completado' => false,
                'prioridad' => 3,
            ],
        ];

        // OBJETIVOS DE MEDIANO PLAZO (3-5 años): 2027-2030
        // Especialización profunda y liderazgo técnico
        
        $objetivosMediano = [
            [
                'titulo' => 'Completar Maestría en Machine Learning o Data Science',
                'descripcion' => 'Obtener título de posgrado en ML/Data Science de universidad reconocida. Tesis enfocada en aplicación de ML en logística o manufactura. Combinar conocimientos teóricos avanzados con experiencia práctica.',
                'categoria' => 'mediano',
                'fecha_limite' => Carbon::create(2029, 12, 31), // Diciembre 2029
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Liderar Proyecto de Transformación Digital con IA',
                'descripcion' => 'Dirigir proyecto multiequipo de implementación de IA/ML que genere impacto medible: reducción de costos 30%+, mejora de eficiencia, automatización de procesos críticos. Demostrar liderazgo técnico y de proyecto.',
                'categoria' => 'mediano',
                'fecha_limite' => Carbon::create(2028, 12, 31), // Diciembre 2028
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Alcanzar Posición Senior ML Engineer o Tech Lead',
                'descripcion' => 'Promover a posición senior con liderazgo técnico. Responsabilidades: arquitectura de sistemas ML, mentoría de junior developers, toma de decisiones técnicas estratégicas. Salario objetivo: 2x el inicial.',
                'categoria' => 'mediano',
                'fecha_limite' => Carbon::create(2029, 6, 30), // Junio 2029
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Publicar 10+ Artículos Técnicos y Dar Charlas',
                'descripcion' => 'Escribir artículos técnicos en Medium/DEV.to sobre ML, RAG, LangChain y experiencias prácticas. Dar al menos 3 charlas en meetups o conferencias locales. Construir reputación como especialista.',
                'categoria' => 'mediano',
                'fecha_limite' => Carbon::create(2030, 6, 30), // Junio 2030
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Desarrollar Producto SaaS con IA (5-10 clientes)',
                'descripcion' => 'Crear y lanzar producto SaaS propio que utilice IA/ML para resolver problema real. MVP funcional con 5-10 clientes pagos. Generar ingresos recurrentes y validar modelo de negocio.',
                'categoria' => 'mediano',
                'fecha_limite' => Carbon::create(2030, 12, 31), // Diciembre 2030
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Alcanzar Inglés C1 para Conferencias Internacionales',
                'descripcion' => 'Mejorar inglés a nivel C1 para participar activamente en conferencias internacionales, presentar trabajos y colaborar con equipos globales. Certificación oficial requerida.',
                'categoria' => 'mediano',
                'fecha_limite' => Carbon::create(2029, 6, 30), // Junio 2029
                'completado' => false,
                'prioridad' => 3,
            ],
        ];

        // OBJETIVOS DE LARGO PLAZO (10+ años): 2030-2035+
        // Liderazgo estratégico e impacto sectorial
        
        $objetivosLargo = [
            [
                'titulo' => 'Alcanzar Posición CTO o Director de IA',
                'descripcion' => 'Liderar área de tecnología o IA en empresa mediana/grande. Responsabilidades C-level: estrategia tecnológica, decisiones arquitectónicas, gestión de equipos 15+ personas, presupuestos y visión a largo plazo.',
                'categoria' => 'largo',
                'fecha_limite' => Carbon::create(2034, 12, 31), // Diciembre 2034
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Escalar Producto Propio a 50+ Clientes Rentable',
                'descripcion' => 'Hacer crecer SaaS propio a 50+ clientes con modelo de negocio sostenible. ARR objetivo: $500K+. Construir equipo de 5-10 personas. Establecer producto como referente en su nicho.',
                'categoria' => 'largo',
                'fecha_limite' => Carbon::create(2033, 6, 30), // Junio 2033
                'completado' => false,
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Convertirse en Referente Nacional en IA/ML',
                'descripcion' => 'Ser reconocido como experto nacional en ML/AI aplicado a logística y manufactura. Keynote speaker en eventos nacionales, consultor para empresas top, presencia en medios y comunidad tech.',
                'categoria' => 'largo',
                'fecha_limite' => Carbon::create(2035, 12, 31), // Diciembre 2035
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Impactar 10+ Empresas con Soluciones IA',
                'descripcion' => 'Tener portfolio documentado de 10+ empresas donde se haya implementado exitosamente soluciones de IA/ML con resultados medibles. Casos de estudio publicados y referencias verificables.',
                'categoria' => 'largo',
                'fecha_limite' => Carbon::create(2035, 6, 30), // Junio 2035
                'completado' => false,
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Establecer Programa de Mentoría Sistemática',
                'descripcion' => 'Crear y mantener programa de mentoría que haya impactado a 20+ profesionales junior en ML/AI. Material educativo, sesiones regulares, seguimiento de mentees. Contribuir al crecimiento del ecosistema.',
                'categoria' => 'largo',
                'fecha_limite' => Carbon::create(2034, 12, 31), // Diciembre 2034
                'completado' => false,
                'prioridad' => 3,
            ],
        ];

        // Crear todos los objetivos
        foreach (array_merge($objetivosCorto, $objetivosMediano, $objetivosLargo) as $objetivo) {
            Objetivo::create($objetivo);
        }

        $this->command->info('✅ Se han creado los objetivos profesionales');
        $this->command->info('   - ' . count($objetivosCorto) . ' objetivos de corto plazo');
        $this->command->info('   - ' . count($objetivosMediano) . ' objetivos de mediano plazo');
        $this->command->info('   - ' . count($objetivosLargo) . ' objetivos de largo plazo');
    }
}

