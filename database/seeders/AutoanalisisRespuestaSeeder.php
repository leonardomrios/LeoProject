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
            'titulo' => 'Aprovechando mis fortalezas en un mercado con grandes oportunidades',
            'contenido' => 'Cuando pienso en cómo puedo aprovechar mis fortalezas, me doy cuenta de que tengo algo bastante único: años de experiencia práctica en logística y transporte. Esto, combinado con la enorme demanda que hay ahora mismo por especialistas en IA y automatización, me da una ventaja clara.

No es que sea el mejor programador del mundo, pero entiendo los problemas reales que enfrentan las empresas de logística. Sé qué duele, qué procesos son ineficientes y dónde se pierde dinero. Eso es algo que muchos ingenieros de ML no tienen, y puedo usarlo para crear soluciones que realmente funcionen.

Mi plan es bastante directo: voy a completar el roadmap de ML Engineer que tengo, pero mientras lo hago, voy a construir un portafolio enfocado específicamente en proyectos de ML aplicados a logística. Cada proyecto que haga será una oportunidad de demostrar que puedo combinar conocimiento técnico con entendimiento del negocio.

También veo que el ecosistema tech está creciendo mucho. Hay meetups, hackathons y comunidades activas. Mi idea es participar activamente, no solo para aprender, sino para compartir mi experiencia en logística. Quiero posicionarme como "el tipo que sabe de ML Y entiende logística", porque ese nicho es más pequeño y la competencia es menor.

Las herramientas como LangChain y n8n me permiten prototipar rápido, lo cual es perfecto para mi estilo de trabajo. Puedo crear algo funcional rápido, validar la idea, y luego escalarlo. Mi formación en informática y mecatrónica también me ayuda porque entiendo tanto el software como los sistemas físicos, algo valioso para Industria 4.0.',
        ]);

        // Estrategia DO: Oportunidades para Superar Debilidades
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 2,
            'titulo' => 'Convirtiendo mis debilidades en oportunidades de crecimiento',
            'contenido' => 'Sé que tengo debilidades, pero también veo que hay oportunidades claras para trabajarlas. Mi problema más grande es que tiendo a trabajar solo, y eso me limita. Pero el ecosistema tech está lleno de eventos y comunidades. Mi plan es forzarme a salir: asistir a 2-3 meetups al mes, participar en hackathons, aunque me cueste al principio. Necesito exponerme a trabajar en equipo y recibir feedback real de otros desarrolladores.

Sobre mis fundamentos teóricos... la verdad es que sé programar, pero no tengo la base sólida en algoritmos y estructuras de datos que debería tener. La buena noticia es que hay cursos excelentes en Coursera y edX. Voy a dedicar 4-6 meses intensivos a esto, porque sé que sin una base sólida, no podré llegar a niveles senior. Es una inversión que debo hacer ahora.

El inglés es otro tema. Sé que me limita mucho. Pero en lugar de verlo como una barrera, lo veo como una oportunidad constante de aprendizaje. Cada vez que leo documentación técnica, papers o sigo un curso en inglés, estoy mejorando. Mi meta es B2 en 18 meses, y C1 en 3 años. Es ambicioso, pero necesario.

Y sobre la experiencia en producción... bueno, no la tengo todavía. Pero puedo crearla. Voy a hacer que cada proyecto del roadmap simule un entorno de producción real.  Buscaré colaboraciones locales en proyectos reales, aunque sea de forma voluntaria al principio. La experiencia práctica es lo que más necesito.',
        ]);

        // Estrategia FA: Fortalezas para Mitigar Amenazas
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 3,
            'titulo' => 'Usando mis fortalezas como escudo contra las amenazas',
            'contenido' => 'Sé que hay mucha competencia. Hay ingenieros con maestrías, doctorados, años de experiencia. Pero tengo algo que muchos no tienen: conocimiento profundo de un dominio específico. La logística no es solo teoría para mí, la he vivido. Eso es mi diferenciador, y voy a usarlo.

En lugar de competir en el mercado general de ML (donde hay mucha competencia), me voy a especializar en ML aplicado a logística y manufactura. Es un nicho más pequeño, pero la demanda es real y la competencia es menor. Mientras otros tienen títulos impresionantes, yo tengo experiencia práctica que resuelve problemas reales.

La tecnología cambia rápido, eso es una amenaza constante. Pero mi capacidad de aprender por mi cuenta es una fortaleza. Voy a establecer un sistema: 5-7 horas semanales dedicadas solo a mantenerme actualizado. Leer papers relevantes, experimentar con nuevas herramientas, seguir a los expertos en LinkedIn. Mi persistencia me ayuda a no desanimarme cuando algo que aprendí se vuelve obsoleto.

Sobre la automatización por IA... bueno, GitHub Copilot y ChatGPT pueden escribir código básico. Pero no pueden diseñar arquitecturas complejas, tomar decisiones estratégicas, entender el negocio o liderar equipos. Esas son las habilidades en las que me voy a enfocar. Mi visión sistémica me ayuda a ver el panorama completo, no solo el código.

Y en lugar de ver la IA como amenaza, la uso como herramienta. Copilot me hace más productivo, ChatGPT me ayuda a entender conceptos complejos. Aprendo a trabajar CON la IA, no contra ella.',
        ]);

        // Estrategia DA: Minimizar Debilidades y Amenazas
        AutoanalisisRespuesta::create([
            'pregunta_numero' => 4,
            'titulo' => 'Reduciendo riesgos trabajando en mis debilidades',
            'contenido' => 'Sé que tengo debilidades que me hacen vulnerable. La competencia es fuerte y muchos puestos requieren inglés fluido. Por eso voy a atacar esto de frente: plan dual de 18 meses. Curso de comunicación profesional (porque sé que me cuesta expresarme bien) + programa intensivo de inglés para llegar a B2. En 3 años, meta C1. Es una inversión grande en tiempo, pero necesaria si quiero competir en igualdad de condiciones.

Mi falta de fundamentos teóricos es otra debilidad que me hace vulnerable. Si solo sé usar herramientas pero no entiendo los conceptos profundos, me quedo en roles junior y la automatización me puede reemplazar. Por eso voy a parar y dedicar 4-6 meses intensivos a algoritmos, estructuras de datos, complejidad computacional. Es aburrido, pero es la base que necesito para roles senior.

El trabajo solitario es otro problema. Me aísla y me hace invisible. Si nadie me conoce, no tendré oportunidades. Por eso voy a forzarme a hacer networking sistemático: 2-3 eventos al mes mínimo, ofrecerme como mentor de alguien más junior, participar en comunidades. La visibilidad es importante, y el trabajo solitario no me la da.

Y sobre producción ML... es mi debilidad más crítica. Voy a abordar esto haciendo que cada proyecto del roadmap simule producción real. Docker, APIs, logging, monitoreo. También buscaré colaboraciones en proyectos reales, aunque sea gratis al principio. La experiencia práctica es lo que más necesito, y no la voy a conseguir solo estudiando.',
        ]);

        $this->command->info('✅ Se han creado las respuestas de autoanálisis');
        $this->command->info('   - 4 estrategias reflexivas completas');
    }
}

