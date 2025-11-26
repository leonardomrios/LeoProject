<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Subactividad;
use Illuminate\Http\Request;

class SubactividadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Actividad $actividad)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'progreso' => 'nullable|integer|min:0|max:100',
            'estado' => 'required|in:pendiente,en_progreso,completado,pausado',
        ]);

        $validated['actividad_id'] = $actividad->id;
        $validated['progreso'] = $validated['progreso'] ?? 0;

        // Si no hay fechas, usar las de la actividad padre
        if (!$validated['fecha_inicio']) {
            $validated['fecha_inicio'] = $actividad->fecha_inicio;
        }
        if (!$validated['fecha_fin']) {
            $validated['fecha_fin'] = $actividad->fecha_fin;
        }

        $subactividad = Subactividad::create($validated);

        // Recalcular progreso de la actividad padre
        $actividad->calcularProgresoDesdeSubactividades();

        return redirect()->route('cronograma.index')
            ->with('success', 'Subactividad creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actividad $actividad, Subactividad $subactividad)
    {
        return view('cronograma.subactividad-edit', compact('actividad', 'subactividad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actividad $actividad, Subactividad $subactividad)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'progreso' => 'nullable|integer|min:0|max:100',
            'estado' => 'required|in:pendiente,en_progreso,completado,pausado',
        ]);

        $validated['progreso'] = $validated['progreso'] ?? 0;

        $subactividad->update($validated);

        // Recalcular progreso de la actividad padre
        $actividad->calcularProgresoDesdeSubactividades();

        return redirect()->route('cronograma.index')
            ->with('success', 'Subactividad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actividad $actividad, Subactividad $subactividad)
    {
        $subactividad->delete();

        // Recalcular progreso de la actividad padre
        $actividad->calcularProgresoDesdeSubactividades();

        return redirect()->route('cronograma.index')
            ->with('success', 'Subactividad eliminada exitosamente.');
    }
}
