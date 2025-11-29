@extends('layouts.app')

@section('title', 'Objetivos Profesionales')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Objetivos Profesionales</h2>
            <p style="color: var(--text-secondary); margin: 0.5rem 0 0 0; font-size: 0.875rem;">
                Planificación estratégica de objetivos SMART para tu desarrollo profesional
            </p>
        </div>
        <a href="{{ route('objetivos.create') }}" class="btn btn-primary">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Objetivo
        </a>
    </div>

    <div class="objectives-container">
        @php
            $categorias = [
                'corto' => [
                    'label' => 'Corto Plazo',
                    'rango' => '1-2 años',
                    'periodo' => '2026-2027',
                    'color' => '#3b82f6'
                ],
                'mediano' => [
                    'label' => 'Mediano Plazo',
                    'rango' => '3-5 años',
                    'periodo' => '2027-2030',
                    'color' => '#f59e0b'
                ],
                'largo' => [
                    'label' => 'Largo Plazo',
                    'rango' => '10+ años',
                    'periodo' => '2030-2035+',
                    'color' => '#8b5cf6'
                ]
            ];
        @endphp

        @foreach($categorias as $key => $info)
            @php
                $objetivosCategoria = $objetivos->get($key, collect());
                $count = $objetivosCategoria->count();
                $completados = $objetivosCategoria->where('completado', true)->count();
                $progreso = $count > 0 ? round(($completados / $count) * 100) : 0;
            @endphp

            <div class="objectives-section">
                <div class="section-header">
                    <div class="section-header-content">
                        <h3 class="section-title">
                            <span class="section-title-main">{{ $info['label'] }}</span>
                            <span class="section-title-meta">
                                <span class="section-period">({{ $info['rango'] }})</span>
                                <span class="section-years">: {{ $info['periodo'] }}</span>
                            </span>
                        </h3>
                        <div class="section-stats">
                            <div class="stat-item">
                                <span class="stat-value">{{ $count }}</span>
                                <span class="stat-label">Objetivos</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">{{ $completados }}</span>
                                <span class="stat-label">Completados</span>
                            </div>
                            <div class="stat-item stat-progress">
                                <span class="stat-value">{{ $progreso }}%</span>
                                <span class="stat-label">Progreso</span>
                            </div>
                        </div>
                    </div>
                    <div class="section-progress-bar">
                        <div class="progress-bar-fill" style="width: {{ $progreso }}%; background-color: {{ $info['color'] }};"></div>
                    </div>
                </div>

                @if($objetivosCategoria->count() > 0)
                    <div class="objectives-grid">
                        @foreach($objetivosCategoria as $objetivo)
                            @php
                                $diasRestantes = $objetivo->fecha_limite ? now()->diffInDays($objetivo->fecha_limite, false) : null;
                                $estaVencido = $diasRestantes !== null && $diasRestantes < 0 && !$objetivo->completado;
                                $estaPorVencer = $diasRestantes !== null && $diasRestantes >= 0 && $diasRestantes <= 30 && !$objetivo->completado;
                            @endphp

                            <div class="objective-card {{ $objetivo->completado ? 'completed' : '' }} {{ $estaVencido ? 'overdue' : '' }} {{ $estaPorVencer ? 'urgent' : '' }}">
                                <div class="objective-card-header">
                                    <div class="objective-status-badge">
                                        @if($objetivo->completado)
                                            <span class="status-badge status-completed">
                                                <svg class="status-icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Completado
                                            </span>
                                        @elseif($estaVencido)
                                            <span class="status-badge status-overdue">
                                                <svg class="status-icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Vencido
                                            </span>
                                        @elseif($estaPorVencer)
                                            <span class="status-badge status-urgent">
                                                <svg class="status-icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Por Vencer
                                            </span>
                                        @else
                                            <span class="status-badge status-pending">
                                                <svg class="status-icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                En Progreso
                                            </span>
                                        @endif
                                    </div>
                                    <div class="objective-actions">
                                        <a href="{{ route('objetivos.edit', $objetivo) }}" class="btn-icon-only" title="Editar">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('objetivos.destroy', $objetivo) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este objetivo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon-only btn-danger-icon" title="Eliminar">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <h4 class="objective-title">{{ $objetivo->titulo }}</h4>

                                @if($objetivo->descripcion)
                                    <p class="objective-description">{{ $objetivo->descripcion }}</p>
                                @endif

                                <div class="objective-metrics">
                                    <div class="metric-group">
                                        <div class="metric-item">
                                            <svg class="metric-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <div class="metric-content">
                                                <span class="metric-label">Fecha Límite</span>
                                                <span class="metric-value {{ $estaVencido ? 'metric-overdue' : ($estaPorVencer ? 'metric-urgent' : '') }}">
                                                    @if($objetivo->fecha_limite)
                                                        {{ $objetivo->fecha_limite->format('d/m/Y') }}
                                                        @if($diasRestantes !== null && !$objetivo->completado)
                                                            <span class="metric-days">
                                                                @if($diasRestantes < 0)
                                                                    ({{ abs($diasRestantes) }} días vencidos)
                                                                @elseif($diasRestantes == 0)
                                                                    (Hoy)
                                                                @else
                                                                    ({{ $diasRestantes }} días restantes)
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="metric-empty">Sin fecha</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="metric-item">
                                            <svg class="metric-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <div class="metric-content">
                                                <span class="metric-label">Prioridad</span>
                                                <div class="priority-indicator">
                                                    <div class="priority-stars">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <svg class="priority-star {{ $i <= $objetivo->prioridad ? 'active' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <span class="priority-value">{{ $objetivo->prioridad }}/5</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>No hay objetivos en esta categoría.</p>
                        <a href="{{ route('objetivos.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Crear Primer Objetivo
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
.objectives-container {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}

.objectives-section {
    background: var(--bg-secondary);
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid var(--border-color);
}

.section-header {
    margin-bottom: 1.5rem;
}

.section-header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.section-title-main {
    color: var(--text-primary);
}

.section-title-meta {
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-secondary);
}

.section-period {
    color: var(--text-secondary);
}

.section-years {
    color: var(--primary-color);
    font-weight: 600;
}

.section-stats {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0.5rem 1rem;
    background: var(--bg-primary);
    border-radius: 0.5rem;
    min-width: 80px;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.25rem;
}

.stat-progress .stat-value {
    color: var(--primary-color);
}

.section-progress-bar {
    width: 100%;
    height: 8px;
    background: var(--border-color);
    border-radius: 9999px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    transition: width 0.3s ease;
    border-radius: 9999px;
}

.objectives-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.25rem;
}

.objective-card {
    background: var(--bg-primary);
    border-radius: 0.75rem;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 2px solid var(--border-color);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.objective-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--primary-color);
    transition: width 0.3s ease;
}

.objective-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-4px);
    border-color: var(--primary-color);
}

.objective-card:hover::before {
    width: 6px;
}

.objective-card.completed {
    opacity: 0.85;
    border-color: var(--success-color);
}

.objective-card.completed::before {
    background: var(--success-color);
}

.objective-card.overdue {
    border-color: var(--danger-color);
    background: #fef2f2;
}

.objective-card.overdue::before {
    background: var(--danger-color);
}

.objective-card.urgent {
    border-color: var(--warning-color);
    background: #fffbeb;
}

.objective-card.urgent::before {
    background: var(--warning-color);
}

.objective-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.objective-status-badge {
    flex: 1;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-icon {
    width: 14px;
    height: 14px;
}

.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-pending {
    background: #dbeafe;
    color: #1e40af;
}

.status-overdue {
    background: #fee2e2;
    color: #991b1b;
}

.status-urgent {
    background: #fef3c7;
    color: #92400e;
}

.objective-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-icon-only {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    padding: 0;
    border: 1px solid var(--border-color);
    background: var(--bg-primary);
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s ease;
    color: var(--text-secondary);
}

.btn-icon-only svg {
    width: 16px;
    height: 16px;
}

.btn-icon-only:hover {
    background: var(--bg-secondary);
    border-color: var(--primary-color);
    color: var(--primary-color);
    transform: scale(1.05);
}

.btn-danger-icon:hover {
    background: var(--danger-color);
    border-color: var(--danger-color);
    color: white;
}

.objective-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.75rem 0;
    line-height: 1.4;
}

.objective-description {
    color: var(--text-secondary);
    margin-bottom: 1.25rem;
    font-size: 0.875rem;
    line-height: 1.6;
}

.objective-metrics {
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

.metric-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.metric-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.metric-icon {
    width: 20px;
    height: 20px;
    color: var(--text-secondary);
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.metric-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.metric-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

.metric-value {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
}

.metric-days {
    font-size: 0.8125rem;
    font-weight: 400;
    color: var(--text-secondary);
    margin-left: 0.5rem;
}

.metric-overdue {
    color: var(--danger-color);
}

.metric-urgent {
    color: var(--warning-color);
}

.metric-empty {
    color: var(--text-light);
    font-style: italic;
}

.priority-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.priority-stars {
    display: flex;
    gap: 0.125rem;
}

.priority-star {
    width: 16px;
    height: 16px;
    color: var(--border-color);
    transition: color 0.2s ease;
}

.priority-star.active {
    color: #fbbf24;
}

.priority-value {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-secondary);
}

.empty-state-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 1rem;
    opacity: 0.3;
    color: var(--text-secondary);
}

.empty-state p {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .objectives-grid {
        grid-template-columns: 1fr;
    }

    .section-header-content {
        flex-direction: column;
    }

    .section-stats {
        width: 100%;
        justify-content: space-around;
    }

    .section-title {
        font-size: 1.25rem;
    }
}
</style>
@endpush
@endsection

