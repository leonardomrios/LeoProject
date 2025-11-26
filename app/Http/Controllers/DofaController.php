<?php

namespace App\Http\Controllers;

use App\Models\DofaElement;
use Illuminate\Http\Request;

class DofaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elementos = DofaElement::orderBy('prioridad', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('categoria');
        
        return view('dofa.index', compact('elementos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dofa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|in:debilidad,oportunidad,fortaleza,amenaza',
            'prioridad' => 'nullable|integer|min:1|max:5',
        ]);

        DofaElement::create($validated);

        return redirect()->route('dofa.index')
            ->with('success', 'Elemento DOFA creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DofaElement $dofa)
    {
        return view('dofa.show', compact('dofa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DofaElement $dofa)
    {
        return view('dofa.edit', compact('dofa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DofaElement $dofa)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|in:debilidad,oportunidad,fortaleza,amenaza',
            'prioridad' => 'nullable|integer|min:1|max:5',
        ]);

        $dofa->update($validated);

        return redirect()->route('dofa.index')
            ->with('success', 'Elemento DOFA actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DofaElement $dofa)
    {
        $dofa->delete();

        return redirect()->route('dofa.index')
            ->with('success', 'Elemento DOFA eliminado exitosamente.');
    }
}
