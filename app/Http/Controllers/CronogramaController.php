<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Actividad::query();

        // Filtros
        if ($request->has('estado') && $request->estado !== '') {
            $query->where('estado', $request->estado);
        }

        if ($request->has('prioridad') && $request->prioridad !== '') {
            $query->where('prioridad', $request->prioridad);
        }

        if ($request->has('fecha_desde') && $request->fecha_desde) {
            $query->where('fecha_fin', '>=', $request->fecha_desde);
        }

        if ($request->has('fecha_hasta') && $request->fecha_hasta) {
            $query->where('fecha_inicio', '<=', $request->fecha_hasta);
        }

        // Ordenamiento
        $orden = $request->get('orden', 'fecha_inicio');
        $direccion = $request->get('direccion', 'asc');
        
        if ($orden === 'prioridad') {
            $query->orderByRaw("CASE prioridad WHEN 'critica' THEN 1 WHEN 'alta' THEN 2 WHEN 'media' THEN 3 WHEN 'baja' THEN 4 END");
        } else {
            $query->orderBy($orden, $direccion);
        }

        $actividades = $query->with('subactividades')->get();

        // Extraer categorías de las descripciones
        $categorias = $actividades->map(function($actividad) {
            if (preg_match('/Categoría:\s*([^\.]+)/', $actividad->descripcion, $matches)) {
                return trim($matches[1]);
            }
            return 'Sin Categoría';
        })->unique()->sort()->values();

        // Agrupar actividades por categoría
        $actividadesPorCategoria = $actividades->groupBy(function($actividad) {
            if (preg_match('/Categoría:\s*([^\.]+)/', $actividad->descripcion, $matches)) {
                return trim($matches[1]);
            }
            return 'Sin Categoría';
        })->map(function($grupo, $categoria) {
            $fechaMin = $grupo->min('fecha_inicio');
            $fechaMax = $grupo->max('fecha_fin');
            $progresoPromedio = (int) round($grupo->avg('progreso'));
            $totalActividades = $grupo->count();
            $completadas = $grupo->where('estado', 'completado')->count();
            
            return [
                'nombre' => $categoria,
                'actividades' => $grupo->sortBy('fecha_inicio'),
                'fecha_inicio' => $fechaMin,
                'fecha_fin' => $fechaMax,
                'progreso' => $progresoPromedio,
                'total' => $totalActividades,
                'completadas' => $completadas,
                'color' => $grupo->first()->color ?? '#6366f1',
            ];
        });
        
        // Ordenar por fecha de inicio pero mantener acceso por nombre
        $actividadesPorCategoria = $actividadesPorCategoria->sortBy(function($categoria) {
            return $categoria['fecha_inicio']->timestamp;
        });

        // Agrupar actividades por mes
        $actividadesPorMes = $actividades->groupBy(function($actividad) {
            return $actividad->fecha_inicio->format('Y-m');
        })->map(function($grupo, $mes) {
            return [
                'mes' => \Carbon\Carbon::createFromFormat('Y-m', $mes)->format('F Y'),
                'mes_key' => $mes,
                'actividades' => $grupo->sortBy('fecha_inicio')
            ];
        })->sortBy('mes_key');

        // Calcular estadísticas
        $estadisticas = [
            'total' => $actividades->count(),
            'completadas' => $actividades->where('estado', 'completado')->count(),
            'en_progreso' => $actividades->where('estado', 'en_progreso')->count(),
            'pendientes' => $actividades->where('estado', 'pendiente')->count(),
            'retrasadas' => $actividades->filter(fn($a) => $a->esta_retrasada)->count(),
            'por_vencer' => $actividades->filter(fn($a) => $a->esta_por_vencer)->count(),
        ];

        // Obtener nivel de vista Gantt y categoría seleccionada
        $ganttLevel = $request->get('gantt_level', 'categorias'); // categorias, categoria, actividades
        $categoriaSeleccionada = $request->get('categoria');
        $actividadSeleccionada = $request->get('actividad'); // Inicializar siempre
        
        // Si se selecciona una categoría pero no existe, volver a categorías
        if ($ganttLevel == 'categoria' && $categoriaSeleccionada) {
            $categoriaEncontrada = $actividadesPorCategoria->firstWhere('nombre', $categoriaSeleccionada);
            if (!$categoriaEncontrada) {
                $ganttLevel = 'categorias';
                $categoriaSeleccionada = null;
            }
        }
        
        // Si se selecciona una actividad, obtener sus subactividades
        $actividadConSubactividades = null;
        if ($ganttLevel == 'actividad' && $actividadSeleccionada) {
            $actividadConSubactividades = Actividad::with('subactividades')->find($actividadSeleccionada);
            if (!$actividadConSubactividades) {
                $ganttLevel = 'categorias';
                $actividadSeleccionada = null;
            }
        }
        
        // Si no hay categorías, mostrar actividades por defecto
        if ($actividadesPorCategoria->isEmpty() && $ganttLevel == 'categorias') {
            $ganttLevel = 'actividades';
        }

        return view('cronograma.index', compact(
            'actividades', 
            'actividadesPorMes', 
            'estadisticas',
            'actividadesPorCategoria',
            'ganttLevel',
            'categoriaSeleccionada',
            'actividadSeleccionada',
            'actividadConSubactividades'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cronograma.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'progreso' => 'nullable|integer|min:0|max:100',
            'estado' => 'required|in:pendiente,en_progreso,completado,pausado',
            'prioridad' => 'required|in:baja,media,alta,critica',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $validated['progreso'] = $validated['progreso'] ?? 0;

        Actividad::create($validated);

        return redirect()->route('cronograma.index')
            ->with('success', 'Actividad creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Actividad $cronograma)
    {
        return view('cronograma.show', compact('cronograma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actividad $cronograma)
    {
        return view('cronograma.edit', compact('cronograma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actividad $cronograma)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'progreso' => 'nullable|integer|min:0|max:100',
            'estado' => 'required|in:pendiente,en_progreso,completado,pausado',
            'prioridad' => 'required|in:baja,media,alta,critica',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $validated['progreso'] = $validated['progreso'] ?? 0;

        $cronograma->update($validated);

        return redirect()->route('cronograma.index')
            ->with('success', 'Actividad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actividad $cronograma)
    {
        $cronograma->delete();

        return redirect()->route('cronograma.index')
            ->with('success', 'Actividad eliminada exitosamente.');
    }

    /**
     * Actualizar progreso rápidamente
     */
    public function updateProgreso(Request $request, Actividad $cronograma)
    {
        $validated = $request->validate([
            'progreso' => 'required|integer|min:0|max:100',
        ]);

        $cronograma->update([
            'progreso' => $validated['progreso'],
            'estado' => $validated['progreso'] == 100 ? 'completado' : ($validated['progreso'] > 0 ? 'en_progreso' : 'pendiente'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Progreso actualizado exitosamente.',
        ]);
    }

    /**
     * Mostrar vista de calendario de subactividades
     */
    public function calendario(Request $request)
    {
        $fechaSeleccionada = $request->get('fecha', now()->format('Y-m'));
        $fecha = \Carbon\Carbon::createFromFormat('Y-m', $fechaSeleccionada);
        
        // Obtener todas las subactividades del mes seleccionado
        $fechaInicioMes = $fecha->copy()->startOfMonth();
        $fechaFinMes = $fecha->copy()->endOfMonth();
        
        $subactividades = \App\Models\Subactividad::with('actividad')
            ->where(function($query) use ($fechaInicioMes, $fechaFinMes) {
                $query->whereBetween('fecha_inicio', [$fechaInicioMes, $fechaFinMes])
                      ->orWhereBetween('fecha_fin', [$fechaInicioMes, $fechaFinMes])
                      ->orWhere(function($q) use ($fechaInicioMes, $fechaFinMes) {
                          $q->where('fecha_inicio', '<=', $fechaInicioMes)
                            ->where('fecha_fin', '>=', $fechaFinMes);
                      });
            })
            ->orderBy('fecha_inicio')
            ->get();
        
        // Obtener festivos de Colombia (mismos que en el seeder)
        $festivosColombia = $this->obtenerFestivosColombia();
        $festivos = array_map(function($fechaStr) {
            return \Carbon\Carbon::parse($fechaStr);
        }, $festivosColombia);
        
        // Función para verificar si una fecha es día hábil
        $esDiaHabil = function($fecha) use ($festivos) {
            // No es sábado (6) ni domingo (0)
            if ($fecha->dayOfWeek == \Carbon\Carbon::SATURDAY || $fecha->dayOfWeek == \Carbon\Carbon::SUNDAY) {
                return false;
            }
            // No es día festivo
            foreach ($festivos as $festivo) {
                if ($fecha->isSameDay($festivo)) {
                    return false;
                }
            }
            return true;
        };
        
        // Agrupar subactividades por día (solo días hábiles)
        $subactividadesPorDia = [];
        foreach ($subactividades as $subactividad) {
            $fechaInicio = \Carbon\Carbon::parse($subactividad->fecha_inicio);
            $fechaFin = \Carbon\Carbon::parse($subactividad->fecha_fin);
            
            // Iterar sobre todos los días que cubre la subactividad (solo días hábiles)
            $fechaActual = max($fechaInicio, $fechaInicioMes);
            $fechaFinal = min($fechaFin, $fechaFinMes);
            
            while ($fechaActual <= $fechaFinal) {
                // Solo agregar si es día hábil
                if ($esDiaHabil($fechaActual)) {
                    $diaKey = $fechaActual->format('Y-m-d');
                    if (!isset($subactividadesPorDia[$diaKey])) {
                        $subactividadesPorDia[$diaKey] = [];
                    }
                    // Evitar duplicados
                    $existe = false;
                    foreach ($subactividadesPorDia[$diaKey] as $existente) {
                        if ($existente->id == $subactividad->id) {
                            $existe = true;
                            break;
                        }
                    }
                    if (!$existe) {
                        $subactividadesPorDia[$diaKey][] = $subactividad;
                    }
                }
                $fechaActual->addDay();
            }
        }
        
        // Generar estructura del calendario
        $calendario = [];
        $primerDia = $fechaInicioMes->copy();
        $ultimoDia = $fechaFinMes->copy();
        
        // Ajustar para que el calendario comience en lunes
        $inicioSemana = $primerDia->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        if ($inicioSemana->gt($primerDia)) {
            $inicioSemana->subWeek();
        }
        
        $fechaActual = $inicioSemana->copy();
        $semanaActual = 0;
        $maxSemanas = 6; // Máximo de semanas a mostrar
        
        while ($semanaActual < $maxSemanas) {
            $diaSemanaCarbon = $fechaActual->dayOfWeek; // Carbon: 0=Domingo, 1=Lunes, ..., 6=Sábado
            // Convertir a índice del calendario: 0=Lunes, 1=Martes, ..., 6=Domingo
            $diaSemana = $diaSemanaCarbon == 0 ? 6 : $diaSemanaCarbon - 1;
            
            if ($diaSemanaCarbon == \Carbon\Carbon::MONDAY) {
                $semanaActual++;
                $calendario[$semanaActual] = [];
            }
            
            $diaKey = $fechaActual->format('Y-m-d');
            $calendario[$semanaActual][$diaSemana] = [
                'fecha' => $fechaActual->copy(),
                'esDelMes' => $fechaActual->month == $fecha->month,
                'esHoy' => $fechaActual->isToday(),
                'esHabil' => $esDiaHabil($fechaActual),
                'subactividades' => $subactividadesPorDia[$diaKey] ?? [],
            ];
            
            $fechaActual->addDay();
            
            // Si ya pasamos el último día del mes y completamos la semana, salir
            if ($fechaActual->gt($ultimoDia) && $diaSemanaCarbon == \Carbon\Carbon::SUNDAY) {
                break;
            }
        }
        
        // Mes anterior y siguiente
        $mesAnterior = $fecha->copy()->subMonth()->format('Y-m');
        $mesSiguiente = $fecha->copy()->addMonth()->format('Y-m');
        
        return view('cronograma.calendario', compact(
            'calendario',
            'fecha',
            'mesAnterior',
            'mesSiguiente',
            'subactividadesPorDia'
        ));
    }
    
    /**
     * Obtener lista de festivos de Colombia (2026, 2027, 2028)
     */
    private function obtenerFestivosColombia(): array
    {
        return [
            // 2026
            '2026-01-01', // Año Nuevo
            '2026-01-12', // Día de los Reyes Magos
            '2026-03-23', // Día de San José
            '2026-03-24', // Jueves Santo
            '2026-03-25', // Viernes Santo
            '2026-03-28', // Lunes de Pascua
            '2026-05-01', // Día del Trabajo
            '2026-05-09', // Día de la Ascensión
            '2026-05-30', // Corpus Christi
            '2026-06-20', // Sagrado Corazón
            '2026-06-27', // San Pedro y San Pablo
            '2026-07-04', // Día de la Independencia
            '2026-07-20', // Día de la Independencia
            '2026-08-07', // Batalla de Boyacá
            '2026-08-15', // Asunción de la Virgen
            '2026-10-12', // Día de la Raza
            '2026-11-02', // Día de los Difuntos
            '2026-11-16', // Independencia de Cartagena
            '2026-12-08', // Día de la Inmaculada Concepción
            '2026-12-25', // Navidad
            // 2027
            '2027-01-01', // Año Nuevo
            '2027-01-09', // Día de los Reyes Magos
            '2027-03-20', // Día de San José
            '2027-04-08', // Jueves Santo
            '2027-04-09', // Viernes Santo
            '2027-04-10', // Lunes de Pascua
            '2027-05-01', // Día del Trabajo
            '2027-05-22', // Día de la Ascensión
            '2027-06-12', // Corpus Christi
            '2027-06-19', // Sagrado Corazón
            '2027-06-29', // San Pedro y San Pablo
            '2027-07-03', // Día de la Independencia
            '2027-07-20', // Día de la Independencia
            '2027-08-07', // Batalla de Boyacá
            '2027-08-15', // Asunción de la Virgen
            '2027-10-12', // Día de la Raza
            '2027-11-01', // Día de los Difuntos
            '2027-11-13', // Independencia de Cartagena
            '2027-12-08', // Día de la Inmaculada Concepción
            '2027-12-25', // Navidad
            // 2028
            '2028-01-01', // Año Nuevo
            '2028-01-10', // Día de los Reyes Magos
            '2028-03-19', // Día de San José
            '2028-03-23', // Jueves Santo
            '2028-03-24', // Viernes Santo
            '2028-03-27', // Lunes de Pascua
            '2028-05-01', // Día del Trabajo
            '2028-05-14', // Día de la Ascensión
            '2028-06-04', // Corpus Christi
            '2028-06-11', // Sagrado Corazón
            '2028-06-29', // San Pedro y San Pablo
            '2028-07-03', // Día de la Independencia
            '2028-07-20', // Día de la Independencia
            '2028-08-07', // Batalla de Boyacá
            '2028-08-15', // Asunción de la Virgen
            '2028-10-12', // Día de la Raza
            '2028-11-02', // Día de los Difuntos
            '2028-11-13', // Independencia de Cartagena
            '2028-12-08', // Día de la Inmaculada Concepción
            '2028-12-25', // Navidad
        ];
    }
}
