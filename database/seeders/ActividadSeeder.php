<?php

namespace Database\Seeders;

use App\Models\Actividad;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hoy = Carbon::now();
        $inicioPlan = $hoy->copy()->startOfWeek();
        
        // Limpiar actividades existentes (opcional)
        // Actividad::truncate();

        $actividades = [
            // MES 1 - FASE DE ADAPTACIÓN
            [
                'nombre' => 'Evaluación Inicial y Planificación',
                'descripcion' => 'Medición de composición corporal, fuerza inicial, y diseño del plan personalizado de entrenamiento y nutrición.',
                'fecha_inicio' => $inicioPlan->copy(),
                'fecha_fin' => $inicioPlan->copy()->addDays(3),
                'progreso' => 100,
                'estado' => 'completado',
                'prioridad' => 'alta',
                'color' => '#10b981',
            ],
            [
                'nombre' => 'Fase de Adaptación - Semana 1-2',
                'descripcion' => 'Inicio del entrenamiento con ejercicios básicos. Enfoque en técnica correcta y adaptación del cuerpo al ejercicio.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(4),
                'fecha_fin' => $inicioPlan->copy()->addDays(17),
                'progreso' => 100,
                'estado' => 'completado',
                'prioridad' => 'alta',
                'color' => '#6366f1',
            ],
            [
                'nombre' => 'Ajuste de Plan Nutricional',
                'descripcion' => 'Revisión y ajuste del plan nutricional basado en la respuesta inicial del cuerpo y objetivos de ganancia de masa.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(18),
                'fecha_fin' => $inicioPlan->copy()->addDays(24),
                'progreso' => 100,
                'estado' => 'completado',
                'prioridad' => 'media',
                'color' => '#8b5cf6',
            ],
            [
                'nombre' => 'Fase de Adaptación - Semana 3-4',
                'descripcion' => 'Continuación del entrenamiento adaptativo. Incremento gradual de intensidad y volumen.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(25),
                'fecha_fin' => $inicioPlan->copy()->addDays(38),
                'progreso' => 75,
                'estado' => 'en_progreso',
                'prioridad' => 'alta',
                'color' => '#6366f1',
            ],

            // MES 2 - FASE DE HIPERTROFIA INICIAL
            [
                'nombre' => 'Primera Evaluación de Progreso',
                'descripcion' => 'Medición de cambios en composición corporal, fuerza y medidas corporales después del primer mes.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(39),
                'fecha_fin' => $inicioPlan->copy()->addDays(42),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#f59e0b',
            ],
            [
                'nombre' => 'Fase de Hipertrofia I - Mes 2',
                'descripcion' => 'Entrenamiento enfocado en hipertrofia con rangos de 8-12 repeticiones. Enfoque en grupos musculares principales.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(43),
                'fecha_fin' => $inicioPlan->copy()->addDays(72),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'critica',
                'color' => '#ef4444',
            ],
            [
                'nombre' => 'Optimización de Suplementación',
                'descripcion' => 'Evaluación e incorporación de suplementos (proteína, creatina, etc.) según necesidades y objetivos.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(50),
                'fecha_fin' => $inicioPlan->copy()->addDays(56),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'media',
                'color' => '#8b5cf6',
            ],

            // MES 3 - FASE DE HIPERTROFIA AVANZADA
            [
                'nombre' => 'Segunda Evaluación de Progreso',
                'descripcion' => 'Análisis detallado del progreso a los 2 meses. Ajustes al plan según resultados obtenidos.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(73),
                'fecha_fin' => $inicioPlan->copy()->addDays(76),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#f59e0b',
            ],
            [
                'nombre' => 'Fase de Hipertrofia II - Mes 3',
                'descripcion' => 'Intensificación del entrenamiento. Incorporación de técnicas avanzadas (drop sets, superseries, etc.).',
                'fecha_inicio' => $inicioPlan->copy()->addDays(77),
                'fecha_fin' => $inicioPlan->copy()->addDays(106),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'critica',
                'color' => '#ef4444',
            ],
            [
                'nombre' => 'Ajuste de Macros y Calorías',
                'descripcion' => 'Recálculo de necesidades calóricas y distribución de macronutrientes basado en el nuevo peso y composición corporal.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(85),
                'fecha_fin' => $inicioPlan->copy()->addDays(91),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#8b5cf6',
            ],

            // MES 4 - FASE DE FUERZA E HIPERTROFIA
            [
                'nombre' => 'Tercera Evaluación de Progreso',
                'descripcion' => 'Evaluación intermedia a los 3 meses. Análisis de ganancias de masa muscular y fuerza.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(107),
                'fecha_fin' => $inicioPlan->copy()->addDays(110),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#f59e0b',
            ],
            [
                'nombre' => 'Fase de Fuerza e Hipertrofia - Mes 4',
                'descripcion' => 'Entrenamiento híbrido combinando trabajo de fuerza (3-6 repeticiones) con hipertrofia (8-12 repeticiones).',
                'fecha_inicio' => $inicioPlan->copy()->addDays(111),
                'fecha_fin' => $inicioPlan->copy()->addDays(140),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'critica',
                'color' => '#ef4444',
            ],
            [
                'nombre' => 'Periodo de Descanso Activo',
                'descripcion' => 'Semana de recuperación con entrenamiento ligero y enfoque en recuperación y regeneración.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(127),
                'fecha_fin' => $inicioPlan->copy()->addDays(133),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'media',
                'color' => '#6366f1',
            ],

            // MES 5 - FASE DE VOLUMEN
            [
                'nombre' => 'Cuarta Evaluación de Progreso',
                'descripcion' => 'Evaluación a los 4 meses. Medición de ganancias totales y ajustes finales del plan.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(141),
                'fecha_fin' => $inicioPlan->copy()->addDays(144),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#f59e0b',
            ],
            [
                'nombre' => 'Fase de Alto Volumen - Mes 5',
                'descripcion' => 'Entrenamiento de alto volumen con múltiples series y ejercicios. Enfoque máximo en hipertrofia.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(145),
                'fecha_fin' => $inicioPlan->copy()->addDays(174),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'critica',
                'color' => '#ef4444',
            ],
            [
                'nombre' => 'Optimización de Recuperación',
                'descripcion' => 'Implementación de técnicas avanzadas de recuperación: masajes, estiramientos, sueño optimizado.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(160),
                'fecha_fin' => $inicioPlan->copy()->addDays(180),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'media',
                'color' => '#8b5cf6',
            ],

            // MES 6 - FASE FINAL Y CONSOLIDACIÓN
            [
                'nombre' => 'Quinta Evaluación de Progreso',
                'descripcion' => 'Evaluación a los 5 meses. Análisis completo de resultados y preparación para la fase final.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(175),
                'fecha_fin' => $inicioPlan->copy()->addDays(178),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#f59e0b',
            ],
            [
                'nombre' => 'Fase Final de Consolidación - Mes 6',
                'descripcion' => 'Último mes del plan. Consolidación de ganancias, perfeccionamiento de técnica y preparación para mantenimiento.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(179),
                'fecha_fin' => $inicioPlan->copy()->addDays(208),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'critica',
                'color' => '#ef4444',
            ],
            [
                'nombre' => 'Evaluación Final y Plan de Mantenimiento',
                'descripcion' => 'Evaluación completa final. Comparación de resultados iniciales vs finales. Diseño de plan de mantenimiento a largo plazo.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(209),
                'fecha_fin' => $inicioPlan->copy()->addDays(215),
                'progreso' => 0,
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'color' => '#10b981',
            ],

            // ACTIVIDADES COMPLEMENTARIAS
            [
                'nombre' => 'Seguimiento Semanal de Peso y Medidas',
                'descripcion' => 'Registro semanal de peso corporal, medidas de cintura, brazos, piernas y porcentaje de grasa.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(4),
                'fecha_fin' => $inicioPlan->copy()->addDays(215),
                'progreso' => 25,
                'estado' => 'en_progreso',
                'prioridad' => 'media',
                'color' => '#6366f1',
            ],
            [
                'nombre' => 'Registro Diario de Entrenamientos',
                'descripcion' => 'Documentación diaria de ejercicios, series, repeticiones, pesos y sensaciones durante el entrenamiento.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(4),
                'fecha_fin' => $inicioPlan->copy()->addDays(215),
                'progreso' => 30,
                'estado' => 'en_progreso',
                'prioridad' => 'media',
                'color' => '#6366f1',
            ],
            [
                'nombre' => 'Registro de Alimentación',
                'descripcion' => 'Seguimiento diario de comidas, macros y calorías para asegurar cumplimiento del plan nutricional.',
                'fecha_inicio' => $inicioPlan->copy()->addDays(4),
                'fecha_fin' => $inicioPlan->copy()->addDays(215),
                'progreso' => 28,
                'estado' => 'en_progreso',
                'prioridad' => 'alta',
                'color' => '#8b5cf6',
            ],
        ];

        foreach ($actividades as $actividad) {
            Actividad::create($actividad);
        }

        $this->command->info('✅ Se han creado ' . count($actividades) . ' actividades del plan de gimnasio.');
    }
}
