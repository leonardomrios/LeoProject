<?php

namespace Database\Seeders;

use App\Models\AutoanalisisRespuesta;
use Illuminate\Database\Seeder;

class AutoanalisisRespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar respuestas existentes
        AutoanalisisRespuesta::truncate();

        // Estrategia FO: Fortalezas + Oportunidades
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 1,
            'titulo' => 'Estrategia FO: Capitalizar Fortalezas para Aprovechar Oportunidades',
            'contenido' => 'Mi experiencia única en logística combinada con la alta demanda de especialistas en IA/Automatización me posiciona perfectamente para liderar proyectos de optimización logística con ML. Puedo aplicar mi visión sistémica y conocimiento operativo para crear soluciones diferenciadas que resuelvan problemas reales del sector.

Mi persistencia y capacidad de aprendizaje autodirigido me permiten aprovechar la educación online especializada para completar el roadmap de ML Engineer de manera sistemática. El ecosistema tech ofrece oportunidades de networking donde puedo compartir mi experiencia logística como diferenciador.

La combinación de herramientas no-code (LangChain, n8n) con mi mentalidad de automatización me permite prototipar rápidamente soluciones que luego puedo escalar. Mi formación dual (informática + mecatrónica) es valiosa para proyectos de Industria 4.0, donde la demanda es alta.

Estrategia concreta: Completar el roadmap mientras construyo portafolio de proyectos ML aplicados a logística. Participar activamente en meetups para posicionarme como especialista en ML para logística. Buscar proyectos internos o freelance que me permitan aplicar conocimientos del roadmap a problemas reales.',
        ]);

        // Estrategia DO: Oportunidades para Superar Debilidades
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 2,
            'titulo' => 'Estrategia DO: Usar Oportunidades para Convertir Debilidades en Fortalezas',
            'contenido' => 'El ecosistema tech es mi oportunidad para superar mi tendencia al trabajo solitario. Asistir a 2-3 meetups mensuales y participar en hackathons me forzará a trabajar en equipo, mejorar comunicación y recibir feedback. Esto también me ayudará a desarrollar habilidades blandas mientras aprendo de otros profesionales.

La educación online accesible me permite fortalecer mis fundamentos teóricos de programación. Cursos estructurados en Coursera/edX sobre Algorithms y Data Structures complementarán el roadmap práctico. Dedicaré 4-6 meses intensivos a estos fundamentos críticos.

Para mejorar mi inglés técnico, usaré las APIs de LLMs y documentación real como práctica. Leer papers, documentación técnica y seguir cursos en inglés me ayudará a alcanzar B2 en 18 meses. El acceso a recursos en inglés es una oportunidad de aprendizaje constante.

Mi falta de experiencia en producción ML se resolverá mediante proyectos del roadmap y participación en proyectos open source. El ecosistema tech local puede ofrecer oportunidades de colaboración en proyectos reales que me den experiencia práctica.

Plan de acción: Curso de comunicación + programa intensivo de inglés (B2 en 18 meses). 4-6 meses fortaleciendo fundamentos teóricos. Networking activo: 2-3 eventos/mes, contribuciones a open source, proyectos colaborativos.',
        ]);

        // Estrategia FA: Fortalezas para Mitigar Amenazas
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 3,
            'titulo' => 'Estrategia FA: Usar Fortalezas para Contrarrestar Amenazas',
            'contenido' => 'Mi experiencia única en logística es mi arma secreta contra la competencia de profesionales altamente calificados. Mientras otros tienen maestrías, yo tengo conocimiento práctico de un dominio específico. Me especializaré en ML aplicado a logística y manufactura, creando un nicho donde la competencia es menor pero la demanda es alta.

Mi capacidad de aprendizaje autodirigido es clave para enfrentar la evolución rápida de tecnologías. Estableceré un sistema de actualización continua: 5-7 horas semanales dedicadas a mantenerme actualizado, seguir papers relevantes, experimentar con nuevas herramientas. Mi persistencia me permite no desanimarme cuando tecnologías cambian.

Para contrarrestar la automatización de roles junior por IA, me enfocaré en habilidades de alto nivel que IA no puede reemplazar: diseño de arquitecturas ML, toma de decisiones estratégicas, comprensión de negocio, liderazgo técnico. Mi visión sistémica me permite ver más allá del código.

Mi mentalidad de automatización me ayuda a usar IA como herramienta (GitHub Copilot, ChatGPT) en lugar de verla como amenaza. Aprendo a trabajar con IA para ser más productivo, no competir contra ella.

Estrategia: Especialización profunda en ML para logística como diferenciador. Sistema de aprendizaje continuo estructurado. Enfoque en habilidades de alto nivel y liderazgo técnico desde el inicio.',
        ]);

        // Estrategia DA: Minimizar Debilidades y Amenazas
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 4,
            'titulo' => 'Estrategia DA: Minimizar Debilidades para Reducir Impacto de Amenazas',
            'contenido' => 'Para minimizar el impacto de la competencia calificada y los requisitos de inglés, implementaré un plan dual agresivo: curso de comunicación profesional + programa intensivo de inglés (B2 en 18 meses, C1 en 3 años). Esto me permitirá acceder a mejores oportunidades y competir en igualdad de condiciones.

Mi falta de fundamentos teóricos me hace vulnerable a la automatización de roles junior. Por eso, dedicaré 4-6 meses intensivos a fortalecer estos fundamentos críticos antes de avanzar en temas avanzados. Esto me dará la base sólida necesaria para roles senior.

Para contrarrestar mi tendencia al trabajo solitario (que me hace vulnerable a la saturación del mercado), estableceré networking sistemático: 2-3 eventos/mes, contribuciones activas a open source, mentoría de otros, participación en comunidades. Esto me dará visibilidad y oportunidades que el trabajo solitario no ofrece.

Mi falta de experiencia en producción ML es una debilidad crítica. La abordaré mediante: proyectos del roadmap que simulen producción, colaboraciones en proyectos reales, contribuciones a repositorios open source de MLOps, y eventualmente proyectos freelance o internos que me den experiencia real.

Plan de mitigación: Plan dual inglés + comunicación (18 meses). 4-6 meses de fundamentos teóricos intensivos. Networking sistemático y colaboración activa. Proyectos prácticos que simulen producción desde el inicio del roadmap.',
        ]);

        $this->command->info('✅ Se han creado las respuestas de autoanálisis');
        $this->command->info('   - 4 estrategias reflexivas completas');
    }
}

