@extends('layouts.app')

@section('title', 'Autoanálisis')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Autoanálisis Estratégico</h2>
        <p style="color: var(--text-secondary); margin: 0; font-size: 0.875rem;">
            Reflexión profunda sobre fortalezas, debilidades, oportunidades y amenazas
        </p>
    </div>

    @php
        $totalRespuestas = $respuestas->count();
        $estrategias = [
            1 => ['nombre' => 'FO: Fortalezas + Oportunidades', 'color' => '#10b981', 'icon' => 'trending-up'],
            2 => ['nombre' => 'DO: Oportunidades - Debilidades', 'color' => '#3b82f6', 'icon' => 'arrow-up'],
            3 => ['nombre' => 'FA: Fortalezas - Amenazas', 'color' => '#f59e0b', 'icon' => 'shield'],
            4 => ['nombre' => 'DA: Debilidades - Amenazas', 'color' => '#ef4444', 'icon' => 'alert-triangle'],
        ];
        
        // Extraer temas clave de las respuestas
        $temasClave = [
            'Especialización en ML + Logística' => 3,
            'Networking y Comunidad Tech' => 3,
            'Fundamentos Teóricos' => 2,
            'Inglés Técnico' => 2,
            'Experiencia en Producción' => 2,
            'Aprendizaje Continuo' => 2,
            'Portafolio de Proyectos' => 1,
        ];
        
        $accionesPrioritarias = [
            'Completar roadmap ML Engineer' => 1,
            'Construir portafolio ML + Logística' => 1,
            'Networking: 2-3 eventos/mes' => 2,
            'Curso comunicación + Inglés B2 (18 meses)' => 2,
            'Fundamentos teóricos: 4-6 meses' => 2,
            'Contribuir a open source' => 2,
            'Proyectos que simulen producción' => 3,
        ];
    @endphp

    @if($totalRespuestas > 0)
        <!-- Sección de Resumen Visual -->
        <div class="resumen-section">
            <h3 class="resumen-title">
                <svg class="resumen-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Resumen Estratégico
            </h3>

            <div class="resumen-grid">
                <!-- Estrategias Implementadas -->
                <div class="resumen-card estrategias-card">
                    <h4 class="resumen-card-title">Estrategias Definidas</h4>
                    <div class="estrategias-list">
                        @foreach($estrategias as $num => $estrategia)
                            @php
                                $tieneRespuesta = $respuestas->has($num);
                            @endphp
                            <div class="estrategia-item {{ $tieneRespuesta ? 'completa' : 'pendiente' }}">
                                <div class="estrategia-indicator" style="background-color: {{ $estrategia['color'] }};"></div>
                                <div class="estrategia-content">
                                    <span class="estrategia-nombre">{{ $estrategia['nombre'] }}</span>
                                    @if($tieneRespuesta)
                                        <svg class="estrategia-check" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Temas Clave -->
                <div class="resumen-card temas-card">
                    <h4 class="resumen-card-title">Temas Clave Identificados</h4>
                    <div class="temas-cloud">
                        @foreach($temasClave as $tema => $peso)
                            <span class="tema-tag tema-peso-{{ $peso}}" style="--tema-color: {{ $estrategias[array_rand($estrategias)]['color'] }};">
                                {{ $tema }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Acciones Prioritarias -->
                <div class="resumen-card acciones-card">
                    <h4 class="resumen-card-title">Acciones Prioritarias</h4>
                    <div class="acciones-list">
                        @foreach($accionesPrioritarias as $accion => $prioridad)
                            <div class="accion-item prioridad-{{ $prioridad }}">
                                <div class="accion-priority">
                                    @for($i = 1; $i <= 3; $i++)
                                        <div class="priority-dot {{ $i <= $prioridad ? 'active' : '' }}"></div>
                                    @endfor
                                </div>
                                <span class="accion-texto">{{ $accion }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Progreso General -->
                <div class="resumen-card progreso-card">
                    <h4 class="resumen-card-title">Progreso del Autoanálisis</h4>
                    <div class="progreso-circular">
                        <svg class="progreso-svg" viewBox="0 0 120 120">
                            <circle class="progreso-bg" cx="60" cy="60" r="50"></circle>
                            <circle class="progreso-fill" cx="60" cy="60" r="50" 
                                    style="stroke-dasharray: {{ ($totalRespuestas / 4) * 314.16 }} 314.16; stroke: var(--primary-color);"></circle>
                        </svg>
                        <div class="progreso-texto">
                            <span class="progreso-porcentaje">{{ round(($totalRespuestas / 4) * 100) }}%</span>
                            <span class="progreso-label">{{ $totalRespuestas }}/4 Estrategias</span>
                        </div>
                    </div>
                    <p class="progreso-descripcion">
                        @if($totalRespuestas == 4)
                            ¡Excelente! Has completado todas las reflexiones estratégicas.
                        @elseif($totalRespuestas > 0)
                            Continúa completando las reflexiones restantes para tener una visión completa.
                        @else
                            Comienza a reflexionar sobre tus estrategias para definir tu plan de acción.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endif

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
/* Sección de Resumen */
.resumen-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid var(--border-color);
}

.resumen-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.resumen-icon {
    width: 28px;
    height: 28px;
    color: var(--primary-color);
}

.resumen-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.resumen-card {
    background: var(--bg-secondary);
    border-radius: 0.75rem;
    padding: 1.5rem;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.resumen-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.resumen-card-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Estrategias */
.estrategias-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.estrategia-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: var(--bg-primary);
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.estrategia-item.completa {
    border-left: 3px solid var(--success-color);
}

.estrategia-item.pendiente {
    opacity: 0.6;
    border-left: 3px solid var(--border-color);
}

.estrategia-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

.estrategia-content {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.estrategia-nombre {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
}

.estrategia-check {
    width: 18px;
    height: 18px;
    color: var(--success-color);
}

/* Temas Clave */
.temas-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tema-tag {
    display: inline-block;
    padding: 0.5rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.8125rem;
    font-weight: 500;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    color: var(--text-primary);
    transition: all 0.2s ease;
}

.tema-tag:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-sm);
}

.tema-peso-3 {
    font-size: 0.9375rem;
    font-weight: 600;
    background: rgba(99, 102, 241, 0.1);
    border-color: var(--primary-color);
}

.tema-peso-2 {
    font-size: 0.875rem;
    font-weight: 500;
}

.tema-peso-1 {
    font-size: 0.8125rem;
    opacity: 0.8;
}

/* Acciones Prioritarias */
.acciones-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.accion-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: var(--bg-primary);
    border-radius: 0.5rem;
}

.accion-priority {
    display: flex;
    gap: 0.25rem;
    flex-shrink: 0;
}

.priority-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--border-color);
    transition: all 0.2s ease;
}

.priority-dot.active {
    background: var(--warning-color);
    transform: scale(1.2);
}

.prioridad-3 .priority-dot.active {
    background: var(--danger-color);
}

.prioridad-2 .priority-dot.active {
    background: var(--warning-color);
}

.prioridad-1 .priority-dot.active {
    background: var(--success-color);
}

.accion-texto {
    font-size: 0.875rem;
    color: var(--text-primary);
    flex: 1;
}

/* Progreso Circular */
.progreso-card {
    text-align: center;
}

.progreso-circular {
    position: relative;
    width: 120px;
    height: 120px;
    margin: 0 auto 1rem;
}

.progreso-svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.progreso-bg {
    fill: none;
    stroke: var(--border-color);
    stroke-width: 8;
}

.progreso-fill {
    fill: none;
    stroke-width: 8;
    stroke-linecap: round;
    transition: stroke-dasharray 0.5s ease;
}

.progreso-texto {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.progreso-porcentaje {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1.2;
}

.progreso-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.progreso-descripcion {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.5;
}

/* Contenedor Principal */
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

