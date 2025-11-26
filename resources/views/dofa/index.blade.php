@extends('layouts.app')

@section('title', 'Habilidades y Conocimientos - Matriz DOFA')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Matriz DOFA</h2>
        <a href="{{ route('dofa.create') }}" class="btn btn-primary">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Editar Matriz
        </a>
    </div>

    <div class="dofa-matrix">
        @foreach(['debilidad' => 'Debilidades', 'oportunidad' => 'Oportunidades', 'fortaleza' => 'Fortalezas', 'amenaza' => 'Amenazas'] as $key => $label)
            <div class="dofa-quadrant {{ $key }}">
                <h3 class="quadrant-title">{{ $label }}</h3>
                
                @if($elementos->has($key) && $elementos[$key]->count() > 0)
                    @foreach($elementos[$key] as $elemento)
                        <div class="dofa-item">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                <h4 class="dofa-item-title">{{ $elemento->titulo }}</h4>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('dofa.edit', $elemento) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem;">
                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('dofa.destroy', $elemento) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este elemento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem;">
                                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @if($elemento->descripcion)
                                <p class="dofa-item-description">{{ $elemento->descripcion }}</p>
                            @endif
                            <div style="font-size: 0.75rem; color: var(--text-light); margin-top: 0.5rem;">
                                Prioridad: {{ $elemento->prioridad }}/5
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state" style="padding: 2rem 1rem;">
                        <p style="font-size: 0.875rem; color: var(--text-light);">No hay elementos en esta categoría</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

