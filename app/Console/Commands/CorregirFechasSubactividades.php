<?php

namespace App\Console\Commands;

use App\Models\Actividad;
use App\Models\Subactividad;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CorregirFechasSubactividades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronograma:corregir-fechas-subactividades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrige las fechas de las subactividades para que estén dentro del rango de sus actividades padre';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando corrección de fechas de subactividades...');
        $this->newLine();

        $actividades = Actividad::with('subactividades')->get();
        $corregidas = 0;
        $total = 0;

        foreach ($actividades as $actividad) {
            $subactividades = $actividad->subactividades;
            
            if ($subactividades->isEmpty()) {
                continue;
            }

            $fechaInicioActividad = Carbon::parse($actividad->fecha_inicio);
            $fechaFinActividad = Carbon::parse($actividad->fecha_fin);
            $diasTotalesActividad = $fechaInicioActividad->diffInDays($fechaFinActividad) + 1;

            // Calcular horas totales de subactividades
            $horasTotales = 0;
            foreach ($subactividades as $sub) {
                // Intentar extraer horas de la descripción
                if (preg_match('/Horas estimadas:\s*([\d.]+)h/', $sub->descripcion, $matches)) {
                    $horasTotales += (float) $matches[1];
                } else {
                    // Si no se puede extraer, estimar basado en la duración actual
                    $diasSub = Carbon::parse($sub->fecha_inicio)->diffInDays(Carbon::parse($sub->fecha_fin)) + 1;
                    $horasTotales += $diasSub * 1.5; // Estimación: 1.5 horas por día
                }
            }

            // Calcular proporción de días por hora
            $diasPorHora = $horasTotales > 0 ? $diasTotalesActividad / $horasTotales : 1;

            $fechaSubActual = $fechaInicioActividad->copy();

            foreach ($subactividades->sortBy('orden') as $subactividad) {
                $total++;
                
                // Extraer horas de la descripción
                $horasSub = 0;
                if (preg_match('/Horas estimadas:\s*([\d.]+)h/', $subactividad->descripcion, $matches)) {
                    $horasSub = (float) $matches[1];
                } else {
                    // Si no se puede extraer, usar la duración actual
                    $diasSubActual = Carbon::parse($subactividad->fecha_inicio)->diffInDays(Carbon::parse($subactividad->fecha_fin)) + 1;
                    $horasSub = $diasSubActual * 1.5;
                }

                // Calcular días proporcionales
                $diasSub = max(1, (int) round($horasSub * $diasPorHora));

                // Calcular nuevas fechas
                $fechaInicioSub = $fechaSubActual->copy();
                $fechaFinSub = min(
                    $fechaSubActual->copy()->addDays($diasSub - 1),
                    $fechaFinActividad->copy()
                );

                // Asegurar que no se exceda el rango
                if ($fechaFinSub->gt($fechaFinActividad)) {
                    $fechaFinSub = $fechaFinActividad->copy();
                }
                if ($fechaInicioSub->gt($fechaFinActividad)) {
                    $fechaInicioSub = $fechaFinActividad->copy();
                    $fechaFinSub = $fechaFinActividad->copy();
                }

                // Verificar si necesita corrección
                $fechaInicioActual = Carbon::parse($subactividad->fecha_inicio);
                $fechaFinActual = Carbon::parse($subactividad->fecha_fin);

                if ($fechaInicioActual->ne($fechaInicioSub) || $fechaFinActual->ne($fechaFinSub)) {
                    $subactividad->fecha_inicio = $fechaInicioSub;
                    $subactividad->fecha_fin = $fechaFinSub;
                    $subactividad->save();
                    $corregidas++;

                    $this->line("  ✓ Corregida: {$subactividad->nombre}");
                    $this->line("    Antes: {$fechaInicioActual->format('Y-m-d')} a {$fechaFinActual->format('Y-m-d')}");
                    $this->line("    Ahora: {$fechaInicioSub->format('Y-m-d')} a {$fechaFinSub->format('Y-m-d')}");
                }

                // Avanzar al día siguiente
                $fechaSubActual = $fechaFinSub->copy()->addDay();
                
                if ($fechaSubActual->gt($fechaFinActividad)) {
                    break;
                }
            }
        }

        $this->info("\nCorrección completada:");
        $this->info("  Total de subactividades procesadas: {$total}");
        $this->info("  Subactividades corregidas: {$corregidas}");

        return 0;
    }
}

