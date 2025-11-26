@extends('layouts.app')

@section('title', 'Objetivos Profesionales')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Objetivos Profesionales</h2>
        <a href="{{ route('objetivos.create') }}" class="btn btn-primary">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Objetivo
        </a>
    </div>

    <div class="objectives-container">
        @foreach(['corto' => 'Corto Plazo', 'mediano' => 'Mediano Plazo', 'largo' => 'Largo Plazo'] as $key => $label)
            <div class="objectives-section">
                <h3 class="section-title">
                    <span>{{ $label }}</span>
                    <span class="badge badge-{{ $key }}">{{ $objetivos->get($key, collect())->count() }}</span>
                </h3>

                @if($objetivos->has($key) && $objetivos[$key]->count() > 0)
                    @foreach($objetivos[$key] as $objetivo)
                        <div class="objective-card {{ $objetivo->completado ? 'completed' : '' }}">
                            <div class="objective-header">
                                <div>
                                    <h4 class="objective-title">
                                        @if($objetivo->completado)
                                            <svg style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 0.5rem; color: var(--success-color);" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        {{ $objetivo->titulo }}
                                    </h4>
                                </div>
                                <div class="objective-actions">
                                    <a href="{{ route('objetivos.edit', $objetivo) }}" class="btn btn-secondary btn-sm">
                                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Editar
                                    </a>
                                    <form action="{{ route('objetivos.destroy', $objetivo) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este objetivo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @if($objetivo->descripcion)
                                <p class="objective-description">{{ $objetivo->descripcion }}</p>
                            @endif
                            <div class="objective-meta">
                                @if($objetivo->fecha_limite)
                                    <span>
                                        <svg style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $objetivo->fecha_limite->format('d/m/Y') }}
                                    </span>
                                @endif
                                <span>
                                    <svg style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    Prioridad: {{ $objetivo->prioridad }}/5
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <p>No hay objetivos en esta categoría. <a href="{{ route('objetivos.create') }}">Crear uno nuevo</a></p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

