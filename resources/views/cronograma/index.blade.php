@extends('layouts.app')

@section('title', 'Cronograma')

@section('content')
<div class="cronograma-container">
    <!-- Header con estadísticas -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <div class="card-header">
            <div>
                <h2 class="card-title">Cronograma del Proyecto</h2>
                <p style="color: var(--text-secondary); margin: 0.5rem 0 0 0; font-size: 0.875rem;">
                    {{ $actividades->count() }} actividades en total
                </p>
            </div>
            <div style="display: flex; gap: 0.75rem; align-items: center;">
                <div class="view-controls">
                    <button class="view-btn active" data-view="grouped" title="Vista Agrupada por Mes">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z"></path>
                        </svg>
                    </button>
                    <button class="view-btn" data-view="gantt" title="Vista Gantt">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </button>
                    <button class="view-btn" data-view="cards" title="Vista Tarjetas">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </button>
                </div>
                <a href="{{ route('cronograma.create') }}" class="btn btn-primary">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nueva Actividad
                </a>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="estadisticas-grid">
            <div class="estadistica-item">
                <div class="estadistica-valor">{{ $estadisticas['total'] }}</div>
                <div class="estadistica-label">Total Actividades</div>
            </div>
            <div class="estadistica-item success">
                <div class="estadistica-valor">{{ $estadisticas['completadas'] }}</div>
                <div class="estadistica-label">Completadas</div>
            </div>
            <div class="estadistica-item primary">
                <div class="estadistica-valor">{{ $estadisticas['en_progreso'] }}</div>
                <div class="estadistica-label">En Progreso</div>
            </div>
            <div class="estadistica-item warning">
                <div class="estadistica-valor">{{ $estadisticas['pendientes'] }}</div>
                <div class="estadistica-label">Pendientes</div>
            </div>
            <div class="estadistica-item danger">
                <div class="estadistica-valor">{{ $estadisticas['retrasadas'] }}</div>
                <div class="estadistica-label">Retrasadas</div>
            </div>
            <div class="estadistica-item info">
                <div class="estadistica-valor">{{ $estadisticas['por_vencer'] }}</div>
                <div class="estadistica-label">Por Vencer (≤3 días)</div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <form method="GET" action="{{ route('cronograma.index') }}" class="filtros-form">
            <div class="filtros-grid">
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="estado" class="form-label">Estado</label>
                    <select id="estado" name="estado" class="form-control">
                        <option value="">Todos</option>
                        <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_progreso" {{ request('estado') == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                        <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                        <option value="pausado" {{ request('estado') == 'pausado' ? 'selected' : '' }}>Pausado</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="prioridad" class="form-label">Prioridad</label>
                    <select id="prioridad" name="prioridad" class="form-control">
                        <option value="">Todas</option>
                        <option value="critica" {{ request('prioridad') == 'critica' ? 'selected' : '' }}>Crítica</option>
                        <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                        <option value="media" {{ request('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                        <option value="baja" {{ request('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="orden" class="form-label">Ordenar por</label>
                    <select id="orden" name="orden" class="form-control">
                        <option value="fecha_inicio" {{ request('orden') == 'fecha_inicio' ? 'selected' : '' }}>Fecha Inicio</option>
                        <option value="fecha_fin" {{ request('orden') == 'fecha_fin' ? 'selected' : '' }}>Fecha Fin</option>
                        <option value="prioridad" {{ request('orden') == 'prioridad' ? 'selected' : '' }}>Prioridad</option>
                        <option value="nombre" {{ request('orden') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                    </select>
                </div>
                <div style="display: flex; align-items: flex-end; gap: 0.5rem;">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Vista Agrupada por Mes -->
    <div class="card" id="groupedView">
        <div class="grouped-container">
            @if($actividadesPorMes->count() > 0)
                @foreach($actividadesPorMes as $grupo)
                    <div class="month-group">
                        <div class="month-header">
                            <h3 class="month-title">{{ $grupo['mes'] }}</h3>
                            <span class="month-count">{{ $grupo['actividades']->count() }} actividades</span>
                        </div>
                        <div class="month-activities">
                            @foreach($grupo['actividades'] as $actividad)
                                <div class="activity-item-compact {{ $actividad->esta_retrasada ? 'retrasada' : '' }} {{ $actividad->esta_por_vencer ? 'por-vencer' : '' }}">
                                    <div class="activity-item-left">
                                        <div class="activity-item-header">
                                            <span class="prioridad-badge prioridad-{{ $actividad->prioridad }}"></span>
                                            <h4>{{ $actividad->nombre }}</h4>
                                            <span class="estado-badge estado-{{ $actividad->estado }}">{{ ucfirst(str_replace('_', ' ', $actividad->estado)) }}</span>
                                        </div>
                                        @if($actividad->descripcion)
                                            <p class="activity-item-desc">{{ Str::limit($actividad->descripcion, 100) }}</p>
                                        @endif
                                        <div class="activity-item-dates">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $actividad->fecha_inicio->format('d/m/Y') }} - {{ $actividad->fecha_fin->format('d/m/Y') }}</span>
                                            <span class="activity-days">({{ $actividad->dias_totales }} días)</span>
                                        </div>
                                    </div>
                                    <div class="activity-item-right">
                                        <div class="activity-progress-compact">
                                            <div class="progress-info">
                                                <span>{{ $actividad->progreso }}%</span>
                                                <span>{{ $actividad->dias_transcurridos }}/{{ $actividad->dias_totales }} días</span>
                                            </div>
                                            <div class="progress-bar-compact">
                                                <div class="progress-fill" style="width: {{ $actividad->progreso }}%; background-color: {{ $actividad->color }};"></div>
                                            </div>
                                        </div>
                                        <div class="activity-item-actions">
                                            <button class="btn-icon-small toggle-subactividades" data-actividad-id="{{ $actividad->id }}" title="Ver/OCultar Subactividades">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                            <button class="btn-icon-small btn-add-subactividad" data-actividad-id="{{ $actividad->id }}" title="Agregar Subactividad">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                            <a href="{{ route('cronograma.edit', $actividad) }}" class="btn-icon-small" title="Editar">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('cronograma.destroy', $actividad) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar esta actividad?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon-small" title="Eliminar">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Subactividades -->
                                <div class="subactividades-container" id="subactividades-{{ $actividad->id }}" style="display: none;">
                                    @if($actividad->subactividades->count() > 0)
                                        <div class="subactividades-list">
                                            @foreach($actividad->subactividades as $subactividad)
                                                <div class="subactividad-item">
                                                    <div class="subactividad-content">
                                                        <div class="subactividad-header">
                                                            <span class="subactividad-indicator">└─</span>
                                                            <h5>{{ $subactividad->nombre }}</h5>
                                                            <span class="estado-badge estado-{{ $subactividad->estado }}">{{ ucfirst(str_replace('_', ' ', $subactividad->estado)) }}</span>
                                                        </div>
                                                        @if($subactividad->descripcion)
                                                            <p class="subactividad-desc">{{ Str::limit($subactividad->descripcion, 80) }}</p>
                                                        @endif
                                                        <div class="subactividad-meta">
                                                            @if($subactividad->fecha_inicio && $subactividad->fecha_fin)
                                                                <span>{{ $subactividad->fecha_inicio->format('d/m/Y') }} - {{ $subactividad->fecha_fin->format('d/m/Y') }}</span>
                                                            @endif
                                                            <span class="subactividad-progreso">{{ $subactividad->progreso }}%</span>
                                                        </div>
                                                        <div class="subactividad-progress-bar">
                                                            <div class="progress-fill-small" style="width: {{ $subactividad->progreso }}%; background-color: {{ $actividad->color }};"></div>
                                                        </div>
                                                    </div>
                                                    <div class="subactividad-actions">
                                                        <button class="btn-icon-small btn-edit-subactividad" data-subactividad-id="{{ $subactividad->id }}" data-actividad-id="{{ $actividad->id }}" title="Editar">
                                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px;">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                            </svg>
                                                        </button>
                                                        <form action="{{ route('subactividades.destroy', ['actividad' => $actividad->id, 'subactividad' => $subactividad->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar esta subactividad?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-icon-small" title="Eliminar">
                                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px;">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="subactividades-empty">
                                            <p>No hay subactividades. <button class="btn-link btn-add-subactividad" data-actividad-id="{{ $actividad->id }}">Agregar una</button></p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state" style="padding: 3rem; text-align: center;">
                    <p style="color: var(--text-secondary); margin-bottom: 1rem;">No hay actividades en el cronograma.</p>
                    <a href="{{ route('cronograma.create') }}" class="btn btn-primary">Crear Primera Actividad</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Vista Gantt -->
    <div class="card" id="ganttView" style="display: none;">
        <div class="gantt-controls" style="padding: 1rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; background: var(--bg-secondary);">
            <div style="display: flex; gap: 0.5rem; align-items: center;">
                <button class="zoom-btn" data-zoom="out" title="Alejar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path>
                    </svg>
                </button>
                <span class="zoom-level">100%</span>
                <button class="zoom-btn" data-zoom="in" title="Acercar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                    </svg>
                </button>
            </div>
            <button class="btn btn-secondary btn-sm" id="scrollToToday" title="Ir a hoy">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 0.5rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
                Ir a Hoy
            </button>
        </div>
        <div class="gantt-container" id="ganttContainer">
            @if($actividades->count() > 0)
                @php
                    $fechaMin = $actividades->min('fecha_inicio');
                    $fechaMax = $actividades->max('fecha_fin');
                    $diasTotales = $fechaMin->diffInDays($fechaMax) + 1;
                    $fechaActual = now();
                @endphp

                <div class="gantt-header">
                    <div class="gantt-sidebar-header">Actividad</div>
                    <div class="gantt-timeline-header">
                        <div class="timeline-months">
                            @php
                                $mesActual = $fechaMin->copy()->startOfMonth();
                                $meses = [];
                                while($mesActual <= $fechaMax) {
                                    $mesSiguiente = $mesActual->copy()->addMonth();
                                    $diasEnMes = $mesActual->diffInDays(min($mesSiguiente, $fechaMax->copy()->endOfMonth())) + 1;
                                    $meses[] = [
                                        'fecha' => $mesActual->copy(),
                                        'dias' => $diasEnMes
                                    ];
                                    $mesActual = $mesSiguiente;
                                }
                            @endphp
                            @foreach($meses as $mes)
                                <div class="timeline-month" style="width: {{ ($mes['dias'] / $diasTotales) * 100 }}%">
                                    {{ $mes['fecha']->format('M Y') }}
                                </div>
                            @endforeach
                        </div>
                        <div class="timeline-days">
                            @for($fecha = $fechaMin->copy(); $fecha <= $fechaMax; $fecha->addDay())
                                <div class="timeline-day {{ $fecha->isToday() ? 'today' : '' }}" 
                                     style="width: {{ (1 / $diasTotales) * 100 }}%"
                                     title="{{ $fecha->format('d/m/Y') }}">
                                    @if($fecha->day == 1 || $fecha->isToday())
                                        {{ $fecha->format('d') }}
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="gantt-body">
                    @foreach($actividades as $actividad)
                        <div class="gantt-row {{ $actividad->esta_retrasada ? 'retrasada' : '' }} {{ $actividad->esta_por_vencer ? 'por-vencer' : '' }}">
                            <div class="gantt-sidebar">
                                <div class="actividad-info">
                                    <div class="actividad-nombre">
                                        <span class="prioridad-badge prioridad-{{ $actividad->prioridad }}"></span>
                                        {{ $actividad->nombre }}
                                    </div>
                                    <div class="actividad-meta">
                                        <span class="estado-badge estado-{{ $actividad->estado }}">{{ ucfirst(str_replace('_', ' ', $actividad->estado)) }}</span>
                                        <span class="progreso-texto">{{ $actividad->progreso }}%</span>
                                    </div>
                                </div>
                                <div class="actividad-actions">
                                    <a href="{{ route('cronograma.edit', $actividad) }}" class="btn-icon-small" title="Editar">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('cronograma.destroy', $actividad) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar esta actividad?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon-small" title="Eliminar">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="gantt-timeline">
                                @php
                                    $diasDesdeInicio = $fechaMin->diffInDays($actividad->fecha_inicio);
                                    $duracion = $actividad->fecha_inicio->diffInDays($actividad->fecha_fin) + 1;
                                    $anchoBarra = ($duracion / $diasTotales) * 100;
                                    $margenIzquierdo = ($diasDesdeInicio / $diasTotales) * 100;
                                @endphp
                                <div class="gantt-bar-container" style="position: relative; width: 100%; height: 100%;">
                                    <div class="gantt-bar" 
                                         style="left: {{ $margenIzquierdo }}%; width: {{ $anchoBarra }}%; background-color: {{ $actividad->color }};"
                                         title="{{ $actividad->nombre }} - {{ $actividad->fecha_inicio->format('d/m/Y') }} a {{ $actividad->fecha_fin->format('d/m/Y') }}">
                                        <div class="gantt-bar-progress" style="width: {{ $actividad->progreso }}%;"></div>
                                        <div class="gantt-bar-label">
                                            {{ $actividad->nombre }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Línea de tiempo actual -->
                @if($fechaActual >= $fechaMin && $fechaActual <= $fechaMax)
                    @php
                        $posicionHoy = ($fechaMin->diffInDays($fechaActual) / $diasTotales) * 100;
                    @endphp
                    <div class="gantt-today-line" style="left: {{ $posicionHoy }}%;"></div>
                @endif
            @else
                <div class="empty-state" style="padding: 3rem; text-align: center;">
                    <svg style="width: 64px; height: 64px; margin: 0 auto 1rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p style="color: var(--text-secondary); margin-bottom: 1rem;">No hay actividades en el cronograma.</p>
                    <a href="{{ route('cronograma.create') }}" class="btn btn-primary">Crear Primera Actividad</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Vista Tarjetas -->
    <div class="card" id="cardsView" style="display: none;">
        <div class="cards-container">
            @if($actividades->count() > 0)
                @foreach($actividades as $actividad)
                    <div class="activity-card {{ $actividad->esta_retrasada ? 'retrasada' : '' }} {{ $actividad->esta_por_vencer ? 'por-vencer' : '' }}">
                        <div class="activity-card-header">
                            <div class="activity-card-title">
                                <span class="prioridad-badge prioridad-{{ $actividad->prioridad }}"></span>
                                <h3>{{ $actividad->nombre }}</h3>
                            </div>
                            <div class="activity-card-actions">
                                <a href="{{ route('cronograma.edit', $actividad) }}" class="btn-icon-small" title="Editar">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('cronograma.destroy', $actividad) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar esta actividad?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon-small" title="Eliminar">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if($actividad->descripcion)
                            <p class="activity-card-description">{{ $actividad->descripcion }}</p>
                        @endif
                        <div class="activity-card-meta">
                            <div class="meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $actividad->fecha_inicio->format('d/m/Y') }} - {{ $actividad->fecha_fin->format('d/m/Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="estado-badge estado-{{ $actividad->estado }}">{{ ucfirst(str_replace('_', ' ', $actividad->estado)) }}</span>
                            </div>
                        </div>
                        <div class="activity-card-progress">
                            <div class="progress-label">
                                <span>Progreso: {{ $actividad->progreso }}%</span>
                                <span>{{ $actividad->dias_transcurridos }} / {{ $actividad->dias_totales }} días</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $actividad->progreso }}%; background-color: {{ $actividad->color }};"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state" style="padding: 3rem; text-align: center;">
                    <p style="color: var(--text-secondary); margin-bottom: 1rem;">No hay actividades en el cronograma.</p>
                    <a href="{{ route('cronograma.create') }}" class="btn btn-primary">Crear Primera Actividad</a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para Subactividades -->
<div class="modal" id="subactividadModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Nueva Subactividad</h3>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>
        <form id="subactividadForm" method="POST">
            @csrf
            <input type="hidden" id="modalActividadId" name="actividad_id">
            <input type="hidden" id="modalSubactividadId" name="subactividad_id">
            
            <div class="form-group">
                <label for="subactividad_nombre" class="form-label">Nombre *</label>
                <input type="text" id="subactividad_nombre" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="subactividad_descripcion" class="form-label">Descripción</label>
                <textarea id="subactividad_descripcion" name="descripcion" class="form-control" rows="3"></textarea>
            </div>

            <div class="grid grid-2">
                <div class="form-group">
                    <label for="subactividad_fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" id="subactividad_fecha_inicio" name="fecha_inicio" class="form-control">
                </div>

                <div class="form-group">
                    <label for="subactividad_fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" id="subactividad_fecha_fin" name="fecha_fin" class="form-control">
                </div>
            </div>

            <div class="grid grid-2">
                <div class="form-group">
                    <label for="subactividad_estado" class="form-label">Estado *</label>
                    <select id="subactividad_estado" name="estado" class="form-control" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="en_progreso">En Progreso</option>
                        <option value="completado">Completado</option>
                        <option value="pausado">Pausado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subactividad_progreso" class="form-label">Progreso (%)</label>
                    <input type="number" id="subactividad_progreso" name="progreso" class="form-control" min="0" max="100" value="0">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelModal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
.cronograma-container {
    max-width: 100%;
    overflow-x: auto;
}

.estadisticas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.estadistica-item {
    text-align: center;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: 0.5rem;
}

.estadistica-valor {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
}

.estadistica-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.estadistica-item.success .estadistica-valor { color: var(--success-color); }
.estadistica-item.primary .estadistica-valor { color: var(--primary-color); }
.estadistica-item.warning .estadistica-valor { color: var(--warning-color); }
.estadistica-item.danger .estadistica-valor { color: var(--danger-color); }
.estadistica-item.info .estadistica-valor { color: #3b82f6; }

.filtros-form {
    padding: 0;
}

.filtros-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
}

.gantt-container {
    overflow-x: auto;
    min-width: 100%;
}

.gantt-header {
    display: flex;
    border-bottom: 2px solid var(--border-color);
    position: sticky;
    top: 0;
    background: var(--bg-primary);
    z-index: 10;
}

.gantt-sidebar-header {
    width: 300px;
    min-width: 300px;
    padding: 1rem;
    font-weight: 600;
    border-right: 2px solid var(--border-color);
    background: var(--bg-secondary);
}

.gantt-timeline-header {
    flex: 1;
    min-width: 600px;
}

.timeline-months {
    display: flex;
    border-bottom: 1px solid var(--border-color);
}

.timeline-month {
    padding: 0.5rem;
    text-align: center;
    font-weight: 600;
    font-size: 0.875rem;
    border-right: 1px solid var(--border-color);
}

.timeline-days {
    display: flex;
    height: 30px;
}

.timeline-day {
    border-right: 1px solid var(--border-color);
    padding: 0.25rem;
    font-size: 0.75rem;
    text-align: center;
    position: relative;
}

.timeline-day.today {
    background: rgba(99, 102, 241, 0.1);
    font-weight: 600;
}

.gantt-body {
    position: relative;
}

.gantt-row {
    display: flex;
    min-height: 80px;
    border-bottom: 1px solid var(--border-color);
    transition: background 0.2s;
}

.gantt-row:hover {
    background: var(--bg-secondary);
}

.gantt-row.retrasada {
    background: rgba(239, 68, 68, 0.05);
}

.gantt-row.por-vencer {
    background: rgba(245, 158, 11, 0.05);
}

.gantt-sidebar {
    width: 300px;
    min-width: 300px;
    padding: 1rem;
    border-right: 2px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--bg-primary);
}

.actividad-info {
    flex: 1;
}

.actividad-nombre {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.actividad-meta {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    font-size: 0.8125rem;
}

.actividad-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-icon-small {
    padding: 0.25rem;
    background: transparent;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    border-radius: 0.25rem;
    transition: all 0.2s;
}

.btn-icon-small:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.prioridad-badge {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.prioridad-critica { background: #ef4444; }
.prioridad-alta { background: #f59e0b; }
.prioridad-media { background: #6366f1; }
.prioridad-baja { background: #10b981; }

.estado-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
}

.estado-pendiente { background: #e2e8f0; color: #475569; }
.estado-en_progreso { background: #dbeafe; color: #1e40af; }
.estado-completado { background: #d1fae5; color: #065f46; }
.estado-pausado { background: #fef3c7; color: #92400e; }

.progreso-texto {
    color: var(--text-secondary);
    font-weight: 500;
}

.gantt-timeline {
    flex: 1;
    min-width: 600px;
    position: relative;
    padding: 1rem 0;
}

.gantt-bar-container {
    height: 50px;
}

.gantt-bar {
    position: absolute;
    height: 40px;
    border-radius: 0.25rem;
    display: flex;
    align-items: center;
    padding: 0 0.75rem;
    color: white;
    font-weight: 500;
    font-size: 0.875rem;
    box-shadow: var(--shadow-sm);
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    overflow: hidden;
}

.gantt-bar:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    z-index: 5;
}

.gantt-bar-progress {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    background: rgba(255, 255, 255, 0.3);
    transition: width 0.3s;
}

.gantt-bar-label {
    position: relative;
    z-index: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.gantt-today-line {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--primary-color);
    z-index: 20;
    pointer-events: none;
}

.gantt-today-line::before {
    content: 'Hoy';
    position: absolute;
    top: -20px;
    left: -15px;
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .gantt-sidebar {
        width: 200px;
        min-width: 200px;
    }
    
    .gantt-sidebar-header {
        width: 200px;
        min-width: 200px;
    }
}

/* Vista Tarjetas */
.cards-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
    padding: 1.5rem;
}

.activity-card {
    background: var(--bg-primary);
    border-radius: 0.75rem;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border-left: 4px solid var(--primary-color);
    transition: all 0.2s ease;
}

.activity-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.activity-card.retrasada {
    border-left-color: var(--danger-color);
    background: rgba(239, 68, 68, 0.02);
}

.activity-card.por-vencer {
    border-left-color: var(--warning-color);
    background: rgba(245, 158, 11, 0.02);
}

.activity-card-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 1rem;
}

.activity-card-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex: 1;
}

.activity-card-title h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin: 0;
    color: var(--text-primary);
}

.activity-card-description {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.activity-card-meta {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--text-secondary);
}

.activity-card-progress {
    margin-top: 1rem;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.8125rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.progress-bar-container {
    height: 8px;
    background: var(--bg-secondary);
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    border-radius: 4px;
    transition: width 0.3s ease;
}

/* Controles de Vista */
.view-controls {
    display: flex;
    gap: 0.25rem;
    background: var(--bg-secondary);
    padding: 0.25rem;
    border-radius: 0.5rem;
}

.view-btn {
    padding: 0.5rem;
    background: transparent;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    color: var(--text-secondary);
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.view-btn:hover {
    background: var(--border-color);
    color: var(--text-primary);
}

.view-btn.active {
    background: var(--primary-color);
    color: white;
}

.zoom-btn {
    padding: 0.5rem;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 0.25rem;
    cursor: pointer;
    color: var(--text-primary);
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.zoom-btn:hover {
    background: var(--bg-secondary);
    border-color: var(--primary-color);
}

.zoom-level {
    font-size: 0.875rem;
    color: var(--text-secondary);
    min-width: 50px;
    text-align: center;
}

/* Vista Agrupada */
.grouped-container {
    padding: 1.5rem;
}

.month-group {
    margin-bottom: 2.5rem;
}

.month-group:last-child {
    margin-bottom: 0;
}

.month-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    background: var(--bg-secondary);
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    border-left: 4px solid var(--primary-color);
}

.month-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.month-count {
    font-size: 0.875rem;
    color: var(--text-secondary);
    background: var(--bg-primary);
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
}

.month-activities {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item-compact {
    background: var(--bg-primary);
    border-radius: 0.75rem;
    padding: 1.25rem;
    box-shadow: var(--shadow-sm);
    border-left: 4px solid var(--primary-color);
    transition: all 0.2s ease;
    display: flex;
    justify-content: space-between;
    gap: 1.5rem;
}

.activity-item-compact:hover {
    box-shadow: var(--shadow-md);
    transform: translateX(4px);
}

.activity-item-compact.retrasada {
    border-left-color: var(--danger-color);
    background: rgba(239, 68, 68, 0.02);
}

.activity-item-compact.por-vencer {
    border-left-color: var(--warning-color);
    background: rgba(245, 158, 11, 0.02);
}

.activity-item-left {
    flex: 1;
    min-width: 0;
}

.activity-item-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    flex-wrap: wrap;
}

.activity-item-header h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
    flex: 1;
    min-width: 200px;
}

.activity-item-desc {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.75rem 0;
    line-height: 1.5;
}

.activity-item-dates {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--text-secondary);
    flex-wrap: wrap;
}

.activity-days {
    color: var(--text-light);
}

.activity-item-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 1rem;
    min-width: 200px;
}

.activity-progress-compact {
    width: 100%;
    max-width: 250px;
}

.progress-info {
    display: flex;
    justify-content: space-between;
    font-size: 0.8125rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.progress-bar-compact {
    height: 8px;
    background: var(--bg-secondary);
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.activity-item-actions {
    display: flex;
    gap: 0.5rem;
}

@media (max-width: 968px) {
    .activity-item-compact {
        flex-direction: column;
    }
    
    .activity-item-right {
        width: 100%;
        align-items: flex-start;
    }
    
    .activity-progress-compact {
        max-width: 100%;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle entre vistas
    const viewButtons = document.querySelectorAll('.view-btn');
    const groupedView = document.getElementById('groupedView');
    const ganttView = document.getElementById('ganttView');
    const cardsView = document.getElementById('cardsView');

    function showView(viewName) {
        // Ocultar todas las vistas primero con !important para asegurar que se aplique
        if (groupedView) {
            groupedView.setAttribute('style', 'display: none !important;');
        }
        if (ganttView) {
            ganttView.setAttribute('style', 'display: none !important;');
        }
        if (cardsView) {
            cardsView.setAttribute('style', 'display: none !important;');
        }

        // Mostrar la vista seleccionada
        if (viewName === 'grouped') {
            if (groupedView) {
                groupedView.setAttribute('style', 'display: block !important;');
            }
        } else if (viewName === 'gantt') {
            if (ganttView) {
                ganttView.setAttribute('style', 'display: block !important;');
            }
        } else if (viewName === 'cards') {
            if (cardsView) {
                cardsView.setAttribute('style', 'display: block !important;');
            }
        }

        // Actualizar botones activos
        viewButtons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.view === viewName) {
                btn.classList.add('active');
            }
        });

        // Guardar preferencia
        localStorage.setItem('cronogramaView', viewName);
    }

    if (viewButtons.length > 0) {
        viewButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const view = this.dataset.view;
                showView(view);
            });
        });

        // Cargar vista guardada (por defecto: grouped)
        const savedView = localStorage.getItem('cronogramaView') || 'grouped';
        showView(savedView);
    } else {
        // Si no hay botones, asegurar que groupedView esté visible por defecto
        if (groupedView) groupedView.style.display = 'block';
        if (ganttView) ganttView.style.display = 'none';
        if (cardsView) cardsView.style.display = 'none';
    }

    // Zoom del timeline
    const ganttContainer = document.getElementById('ganttContainer');
    const zoomButtons = document.querySelectorAll('.zoom-btn');
    const zoomLevel = document.querySelector('.zoom-level');
    let currentZoom = 100;

    if (zoomButtons.length > 0 && ganttContainer && zoomLevel) {
        zoomButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const zoom = this.dataset.zoom;
                if (zoom === 'in' && currentZoom < 200) {
                    currentZoom += 25;
                } else if (zoom === 'out' && currentZoom > 50) {
                    currentZoom -= 25;
                }
                
                ganttContainer.style.transform = `scale(${currentZoom / 100})`;
                ganttContainer.style.transformOrigin = 'top left';
                zoomLevel.textContent = currentZoom + '%';
            });
        });
    }

    // Scroll a hoy
    const scrollToTodayBtn = document.getElementById('scrollToToday');
    if (scrollToTodayBtn) {
        scrollToTodayBtn.addEventListener('click', function() {
            const todayLine = document.querySelector('.gantt-today-line');
            if (todayLine) {
                todayLine.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
            }
        });
    }

    // Toggle subactividades
    document.querySelectorAll('.toggle-subactividades').forEach(btn => {
        btn.addEventListener('click', function() {
            const actividadId = this.dataset.actividadId;
            const container = document.getElementById('subactividades-' + actividadId);
            if (container) {
                container.style.display = container.style.display === 'none' ? 'block' : 'none';
                const icon = this.querySelector('svg');
                if (icon) {
                    icon.style.transform = container.style.display === 'none' ? 'rotate(0deg)' : 'rotate(180deg)';
                    icon.style.transition = 'transform 0.3s';
                }
            }
        });
    });

    // Modal de subactividades
    const modal = document.getElementById('subactividadModal');
    const form = document.getElementById('subactividadForm');
    const modalTitle = document.getElementById('modalTitle');
    const modalActividadId = document.getElementById('modalActividadId');
    const modalSubactividadId = document.getElementById('modalSubactividadId');
    const closeModal = document.getElementById('closeModal');
    const cancelModal = document.getElementById('cancelModal');

    // Abrir modal para crear
    document.querySelectorAll('.btn-add-subactividad').forEach(btn => {
        btn.addEventListener('click', function() {
            const actividadId = this.dataset.actividadId;
            modalActividadId.value = actividadId;
            modalSubactividadId.value = '';
            modalTitle.textContent = 'Nueva Subactividad';
            form.reset();
            form.action = `/cronograma/${actividadId}/subactividades`;
            form.method = 'POST';
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
            modal.classList.add('active');
        });
    });

    // Abrir modal para editar
    document.querySelectorAll('.btn-edit-subactividad').forEach(btn => {
        btn.addEventListener('click', function() {
            const subactividadId = this.dataset.subactividadId;
            const actividadId = this.dataset.actividadId;
            
            // Aquí deberías cargar los datos de la subactividad
            // Por ahora, solo abrimos el modal con la estructura
            modalActividadId.value = actividadId;
            modalSubactividadId.value = subactividadId;
            modalTitle.textContent = 'Editar Subactividad';
            
            // Necesitarías hacer una petición AJAX para cargar los datos
            // Por simplicidad, redirigimos a una ruta de edición
            window.location.href = `/cronograma/${actividadId}/subactividades/${subactividadId}/edit`;
        });
    });

    // Cerrar modal
    if (closeModal) {
        closeModal.addEventListener('click', () => modal.classList.remove('active'));
    }
    if (cancelModal) {
        cancelModal.addEventListener('click', () => modal.classList.remove('active'));
    }
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});
</script>
@endpush
@endsection

