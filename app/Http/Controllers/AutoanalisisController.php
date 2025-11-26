<?php

namespace App\Http\Controllers;

use App\Models\AutoanalisisRespuesta;
use Illuminate\Http\Request;

class AutoanalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $respuestas = AutoanalisisRespuesta::orderBy('pregunta_numero', 'asc')->get()->keyBy('pregunta_numero');
        
        return view('autoanalisis.index', compact('respuestas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $preguntaNumero = request()->get('pregunta', 1);
        $respuestaExistente = AutoanalisisRespuesta::where('pregunta_numero', $preguntaNumero)->first();
        
        if ($respuestaExistente) {
            return redirect()->route('autoanalisis.edit', $respuestaExistente)
                ->with('info', 'Ya existe una reflexión para esta pregunta. Puedes editarla.');
        }

        return view('autoanalisis.create', ['preguntaNumero' => $preguntaNumero]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pregunta_numero' => 'required|integer|min:1|max:4|unique:autoanalisis_respuestas,pregunta_numero',
            'titulo' => 'nullable|string|max:255',
            'contenido' => 'required|string',
        ]);

        AutoanalisisRespuesta::create($validated);

        return redirect()->route('autoanalisis.index')
            ->with('success', 'Reflexión guardada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AutoanalisisRespuesta $autoanalisi)
    {
        return view('autoanalisis.show', compact('autoanalisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutoanalisisRespuesta $autoanalisi)
    {
        return view('autoanalisis.edit', compact('autoanalisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AutoanalisisRespuesta $autoanalisi)
    {
        $validated = $request->validate([
            'titulo' => 'nullable|string|max:255',
            'contenido' => 'required|string',
        ]);

        $autoanalisi->update($validated);

        return redirect()->route('autoanalisis.index')
            ->with('success', 'Reflexión actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutoanalisisRespuesta $autoanalisi)
    {
        $autoanalisi->delete();

        return redirect()->route('autoanalisis.index')
            ->with('success', 'Reflexión eliminada exitosamente.');
    }
}
