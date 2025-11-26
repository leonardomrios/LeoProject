@extends('layouts.app')

@section('title', 'Autoanálisis')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Autoanálisis</h2>
        <p style="color: var(--text-secondary); margin: 0; font-size: 0.875rem;">
            Reflexiona sobre tus fortalezas, debilidades, oportunidades y amenazas
        </p>
    </div>

    <div class="autoanalisis-container">
        @for($i = 1; $i <= 4; $i++)
            @php
                $respuesta = $respuestas->get($i);
                $preguntaTexto = App\Models\AutoanalisisRespuesta::getPreguntaTexto($i);
                $preguntaDescripcion = App\Models\AutoanalisisRespuesta::getPreguntaDescripcion($i);
            @endphp

            <div class="pregunta-section">
                <div class="pregunta-header">
                    <div class="pregunta-number">{{ $i }}</div>
                    <div class="pregunta-content">
                        <h3 class="pregunta-title">{{ $preguntaTexto }}</h3>
                        <p class="pregunta-description">{{ $preguntaDescripcion }}</p>
                    </div>
                </div>

                @if($respuesta)
                    <div class="reflexion-card">
                        @if($respuesta->titulo)
                            <h4 class="reflexion-titulo">{{ $respuesta->titulo }}</h4>
                        @endif
                        <div class="reflexion-contenido">
                            {!! nl2br(e($respuesta->contenido)) !!}
                        </div>
                        <div class="reflexion-meta">
                            <span style="font-size: 0.75rem; color: var(--text-light);">
                                Última actualización: {{ $respuesta->updated_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div class="reflexion-actions">
                            <a href="{{ route('autoanalisis.edit', $respuesta) }}" class="btn btn-primary btn-sm">
                                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar Reflexión
                            </a>
                            <form action="{{ route('autoanalisis.destroy', $respuesta) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta reflexión?');">
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
                @else
                    <div class="empty-reflexion">
                        <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                            Aún no has escrito una reflexión para esta pregunta.
                        </p>
                        <a href="{{ route('autoanalisis.create', ['pregunta' => $i]) }}" class="btn btn-primary">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Escribir Reflexión
                        </a>
                    </div>
                @endif
            </div>
        @endfor
    </div>
</div>

<style>
.autoanalisis-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.pregunta-section {
    background: var(--bg-secondary);
    border-radius: 0.75rem;
    padding: 1.5rem;
    border-left: 4px solid var(--primary-color);
}

.pregunta-header {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.pregunta-number {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.pregunta-content {
    flex: 1;
}

.pregunta-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
    line-height: 1.5;
}

.pregunta-description {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.6;
}

.reflexion-card {
    background: var(--bg-primary);
    border-radius: 0.5rem;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
}

.reflexion-titulo {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem 0;
}

.reflexion-contenido {
    color: var(--text-primary);
    line-height: 1.8;
    margin-bottom: 1rem;
    white-space: pre-wrap;
}

.reflexion-meta {
    margin-bottom: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

.reflexion-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.empty-reflexion {
    background: var(--bg-primary);
    border-radius: 0.5rem;
    padding: 2rem;
    text-align: center;
    border: 2px dashed var(--border-color);
}

@media (max-width: 768px) {
    .pregunta-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .pregunta-content {
        text-align: center;
    }
}
</style>
@endsection

