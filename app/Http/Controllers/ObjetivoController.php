<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objetivos = Objetivo::orderBy('prioridad', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('categoria');
        
        return view('objetivos.index', compact('objetivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('objetivos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|in:corto,mediano,largo',
            'fecha_limite' => 'nullable|date',
            'prioridad' => 'nullable|integer|min:1|max:5',
        ]);

        Objetivo::create($validated);

        return redirect()->route('objetivos.index')
            ->with('success', 'Objetivo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Objetivo $objetivo)
    {
        return view('objetivos.show', compact('objetivo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Objetivo $objetivo)
    {
        return view('objetivos.edit', compact('objetivo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Objetivo $objetivo)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|in:corto,mediano,largo',
            'fecha_limite' => 'nullable|date',
            'completado' => 'boolean',
            'prioridad' => 'nullable|integer|min:1|max:5',
        ]);

        $objetivo->update($validated);

        return redirect()->route('objetivos.index')
            ->with('success', 'Objetivo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Objetivo $objetivo)
    {
        $objetivo->delete();

        return redirect()->route('objetivos.index')
            ->with('success', 'Objetivo eliminado exitosamente.');
    }
}
