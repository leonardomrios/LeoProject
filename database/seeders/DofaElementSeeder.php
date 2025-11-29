<?php

namespace Database\Seeders;

use App\Models\DofaElement;
use Illuminate\Database\Seeder;

class DofaElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar elementos existentes
        DofaElement::truncate();

        // FORTALEZAS
        $fortalezas = [
            [
                'titulo' => 'Persistencia y Resolución de Problemas',
                'descripcion' => 'Capacidad excepcional para resolver problemas complejos sin rendirse. Enfoque sistemático para abordar desafíos técnicos y encontrar soluciones creativas. Esta persistencia es clave en ML donde los problemas requieren iteración constante.',
                'categoria' => 'fortaleza',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Visión Sistémica y Holística',
                'descripcion' => 'Comprensión profunda de sistemas desde múltiples perspectivas: técnica, de negocio y operativa. Capacidad de ver el panorama completo, lo cual es esencial para diseñar soluciones ML que se integren bien en procesos empresariales.',
                'categoria' => 'fortaleza',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Experiencia en Logística y Operaciones',
                'descripcion' => 'Conocimiento práctico en logística de transporte y gestión operativa. Este dominio de dominio es un diferenciador único para aplicar ML en optimización logística, routing, asignación de recursos y predicción de demanda.',
                'categoria' => 'fortaleza',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Mentalidad de Automatización',
                'descripcion' => 'Interés genuino y capacidad para identificar procesos automatizables e ineficiencias. Pensamiento orientado a optimización y mejora continua, ideal para implementar soluciones de IA que reduzcan trabajo manual.',
                'categoria' => 'fortaleza',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Aprendizaje Autodirigido con IA',
                'descripcion' => 'Habilidad comprobada para aprender autónomamente usando IA, documentación técnica y recursos online. Capacidad de mantenerse actualizado en un campo que evoluciona rápidamente como ML/AI.',
                'categoria' => 'fortaleza',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Formación Técnica Dual (Informática + Mecatrónica)',
                'descripcion' => 'Base sólida en programación (informática) combinada con conocimientos de sistemas físicos (mecatrónica). Esta combinación es valiosa para proyectos de ML aplicado a IoT, manufactura inteligente e Industria 4.0.',
                'categoria' => 'fortaleza',
                'prioridad' => 3,
            ],
        ];

        // DEBILIDADES
        $debilidades = [
            [
                'titulo' => 'Habilidades Blandas y Comunicación',
                'descripcion' => 'Dificultades en comunicación efectiva, trabajo en equipo y presentación de ideas. En roles senior de ML, la capacidad de explicar modelos complejos a stakeholders no técnicos y liderar equipos es crítica.',
                'categoria' => 'debilidad',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Fundamentos Teóricos de Programación',
                'descripcion' => 'Dominio básico de conceptos teóricos fundamentales: estructuras de datos avanzadas, algoritmos complejos, complejidad computacional. Necesario para optimizar modelos ML y tomar decisiones arquitectónicas informadas.',
                'categoria' => 'debilidad',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Nivel de Inglés Técnico',
                'descripcion' => 'Inglés básico limita el acceso a recursos avanzados, documentación técnica, papers de investigación y oportunidades globales. La mayoría de la literatura y herramientas de ML están en inglés.',
                'categoria' => 'debilidad',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Tendencia al Trabajo Solitario',
                'descripcion' => 'Preferencia por trabajo individual reduce oportunidades de aprendizaje colaborativo, feedback de pares y construcción de relaciones profesionales. En ML, la colaboración es clave para proyectos complejos.',
                'categoria' => 'debilidad',
                'prioridad' => 3,
            ],
            [
                'titulo' => 'Experiencia Limitada en Producción ML',
                'descripcion' => 'Falta de experiencia práctica desplegando modelos ML en producción, monitoreo, versionado y MLOps. El roadmap cubre estos temas, pero la experiencia real solo viene con proyectos reales.',
                'categoria' => 'debilidad',
                'prioridad' => 4,
            ],
        ];

        // OPORTUNIDADES
        $oportunidades = [
            [
                'titulo' => 'Alta Demanda de Especialistas en IA/Automatización',
                'descripcion' => 'Mercado con escasez de profesionales cualificados en ML/AI. Empresas buscan activamente especialistas que puedan implementar soluciones prácticas. Salarios competitivos y múltiples oportunidades de crecimiento.',
                'categoria' => 'oportunidad',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Adopción Masiva de Industria 4.0',
                'descripcion' => 'Sector manufacturero y logístico adoptando tecnologías de automatización e IA. Oportunidad de aplicar conocimientos de logística + ML para crear soluciones diferenciadas en un mercado en crecimiento.',
                'categoria' => 'oportunidad',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Ecosistema Tech Activo',
                'descripcion' => 'Hub tecnológico con comunidades activas, meetups, hackathons y eventos tech. Oportunidades de networking, aprendizaje colaborativo y exposición a proyectos reales. Acceso a mentores y colaboradores.',
                'categoria' => 'oportunidad',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Educación Online Accesible y Especializada',
                'descripcion' => 'Abundancia de cursos especializados en IA, ML, Deep Learning accesibles online (Coursera, edX, Fast.ai, Hugging Face). Roadmap estructurado permite aprendizaje sistemático sin necesidad de maestría inicial.',
                'categoria' => 'oportunidad',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Herramientas No-Code y Low-Code para Prototipado',
                'descripcion' => 'Frameworks como LangChain, n8n, Make permiten crear automatizaciones y prototipos rápidamente. Esto acelera el tiempo de desarrollo y permite validar ideas antes de inversión significativa.',
                'categoria' => 'oportunidad',
                'prioridad' => 3,
            ],
            [
                'titulo' => 'Modelos Pre-entrenados y APIs de LLMs',
                'descripcion' => 'Disponibilidad de modelos pre-entrenados (Hugging Face) y APIs (OpenAI, Anthropic) reduce barrera de entrada. Permite construir aplicaciones avanzadas sin necesidad de entrenar modelos desde cero.',
                'categoria' => 'oportunidad',
                'prioridad' => 4,
            ],
        ];

        // AMENAZAS
        $amenazas = [
            [
                'titulo' => 'Competencia de Profesionales Altamente Calificados',
                'descripcion' => 'Ingenieros con maestrías, doctorados, inglés fluido y experiencia internacional compiten por las mejores posiciones. Necesidad de diferenciarse mediante especialización y experiencia práctica demostrable.',
                'categoria' => 'amenaza',
                'prioridad' => 5,
            ],
            [
                'titulo' => 'Evolución Rápida de Tecnologías',
                'descripcion' => 'Tecnologías y frameworks obsoletos en 12-18 meses. Lo aprendido hoy puede quedar desactualizado rápidamente. Requiere aprendizaje continuo y adaptación constante, lo cual es demandante en tiempo y energía.',
                'categoria' => 'amenaza',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Automatización de Roles Junior por IA',
                'descripcion' => 'IA (GitHub Copilot, ChatGPT) automatizando código básico y tareas rutinarias. Roles junior en riesgo. Necesidad de especialización profunda y habilidades de alto nivel que IA no puede reemplazar fácilmente.',
                'categoria' => 'amenaza',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Requisitos de Inglés para Mejores Oportunidades',
                'descripcion' => 'Posiciones mejor pagadas y más interesantes requieren inglés técnico avanzado para comunicación con equipos globales, lectura de papers y participación en conferencias internacionales.',
                'categoria' => 'amenaza',
                'prioridad' => 4,
            ],
            [
                'titulo' => 'Saturación del Mercado en Áreas Básicas',
                'descripcion' => 'Muchos profesionales aprendiendo fundamentos de ML. Mercado puede saturarse en roles básicos. Diferenciación mediante especialización (logística + ML) y experiencia práctica es crucial.',
                'categoria' => 'amenaza',
                'prioridad' => 3,
            ],
            [
                'titulo' => 'Cambios Regulatorios en IA',
                'descripcion' => 'Regulaciones emergentes sobre IA (GDPR, leyes de transparencia) pueden afectar cómo se desarrollan y despliegan modelos. Necesidad de mantenerse actualizado en compliance y ética de IA.',
                'categoria' => 'amenaza',
                'prioridad' => 2,
            ],
        ];

        // Crear todos los elementos
        foreach (array_merge($fortalezas, $debilidades, $oportunidades, $amenazas) as $elemento) {
            DofaElement::create($elemento);
        }

        $this->command->info('✅ Se ha creado la matriz DOFA');
        $this->command->info('   - ' . count($fortalezas) . ' fortalezas');
        $this->command->info('   - ' . count($debilidades) . ' debilidades');
        $this->command->info('   - ' . count($oportunidades) . ' oportunidades');
        $this->command->info('   - ' . count($amenazas) . ' amenazas');
    }
}

