@extends('layouts.app')

@section('title', 'Calendario de Subactividades')

@push('styles')
<style>
.calendario-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0 1rem;
}

.calendario-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--bg-primary);
    border-radius: 0.75rem;
    box-shadow: var(--shadow-md);
}

.calendario-navegacion {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.calendario-mes {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
}

.calendario-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 0.375rem;
    margin-bottom: 1rem;
}

.calendario-dia-header {
    text-align: center;
    padding: 0.75rem;
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 0.875rem;
    text-transform: uppercase;
    background: var(--bg-secondary);
    border-radius: 0.5rem;
}

.calendario-dia {
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.375rem;
    height: 90px;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.calendario-dia.con-subactividades {
    overflow-y: auto;
}

.calendario-dia:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.calendario-dia.otro-mes {
    opacity: 0.4;
    background: var(--bg-secondary);
}

.calendario-dia.no-habil {
    opacity: 0.5;
    background: var(--bg-secondary);
    border-color: var(--border-color);
}

.calendario-dia.no-habil .calendario-dia-numero {
    color: var(--text-secondary);
}

.calendario-dia.hoy {
    border: 2px solid var(--primary-color);
    background: rgba(99, 102, 241, 0.05);
}

.calendario-dia-numero {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.375rem;
    padding-bottom: 0.375rem;
    border-bottom: 1px solid var(--border-color);
    flex-shrink: 0;
}

.calendario-dia.hoy .calendario-dia-numero {
    color: var(--primary-color);
}

.calendario-subactividades {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
    flex: 1;
    overflow: hidden;
}

.calendario-subactividad {
    padding: 0.375rem;
    border-radius: 0.375rem;
    font-size: 0.6875rem;
    cursor: pointer;
    transition: all 0.2s ease;
    border-left: 3px solid;
    background: var(--bg-secondary);
}

.calendario-subactividad:hover {
    transform: translateX(4px);
    box-shadow: var(--shadow-sm);
}

.calendario-subactividad-nombre {
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 0.6875rem;
}

.calendario-subactividad-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.6875rem;
    color: var(--text-secondary);
}

.calendario-subactividad-estado {
    display: inline-block;
    padding: 0.125rem 0.375rem;
    border-radius: 9999px;
    font-size: 0.625rem;
    font-weight: 500;
}

.calendario-subactividad-estado.pendiente {
    background: #fef3c7;
    color: #92400e;
}

.calendario-subactividad-estado.en_progreso {
    background: #dbeafe;
    color: #1e40af;
}

.calendario-subactividad-estado.completado {
    background: #d1fae5;
    color: #065f46;
}

.calendario-subactividad-estado.pausado {
    background: #fee2e2;
    color: #991b1b;
}

.calendario-subactividad-progreso {
    font-weight: 600;
}

.calendario-mas-subactividades {
    margin-top: 0.5rem;
    padding: 0.375rem;
    text-align: center;
    font-size: 0.6875rem;
    color: var(--primary-color);
    font-weight: 500;
    cursor: pointer;
    border-radius: 0.375rem;
    background: rgba(99, 102, 241, 0.1);
    transition: all 0.2s ease;
}

.calendario-mas-subactividades:hover {
    background: rgba(99, 102, 241, 0.2);
}

.calendario-vacio {
    text-align: center;
    padding: 0.25rem;
    color: var(--text-secondary);
    font-size: 0.6875rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: auto;
}

.modal-content {
    background-color: var(--bg-primary);
    margin: 5% auto;
    padding: 2rem;
    border-radius: 0.75rem;
    width: 90%;
    max-width: 600px;
    box-shadow: var(--shadow-xl);
    position: relative;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

.modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

.modal-close:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.modal-body {
    margin-bottom: 1.5rem;
}

.modal-info-group {
    margin-bottom: 1.25rem;
}

.modal-info-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modal-info-value {
    font-size: 1rem;
    color: var(--text-primary);
}

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

@media (max-width: 768px) {
    .calendario-grid {
        gap: 0.25rem;
    }
    
    .calendario-dia {
        min-height: 80px;
        max-height: 100px;
        padding: 0.375rem;
    }
    
    .calendario-subactividad {
        font-size: 0.625rem;
        padding: 0.25rem;
    }
    
    .calendario-dia-numero {
        font-size: 0.875rem;
    }
    
    .modal-content {
        width: 95%;
        margin: 10% auto;
        padding: 1.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="calendario-container">
    <div class="calendario-header">
        <div class="calendario-navegacion">
            <a href="{{ route('cronograma.calendario', ['fecha' => $mesAnterior]) }}" class="btn btn-secondary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 0.5rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Mes Anterior
            </a>
            <h1 class="calendario-mes">{{ $fecha->locale('es')->isoFormat('MMMM YYYY') }}</h1>
            <a href="{{ route('cronograma.calendario', ['fecha' => $mesSiguiente]) }}" class="btn btn-secondary">
                Mes Siguiente
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-left: 0.5rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div>
            <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Volver al Cronograma</a>
            <a href="{{ route('cronograma.calendario', ['fecha' => now()->format('Y-m')]) }}" class="btn btn-primary">Hoy</a>
        </div>
    </div>

    <div class="calendario-grid">
        <!-- Encabezados de días -->
        <div class="calendario-dia-header">Lun</div>
        <div class="calendario-dia-header">Mar</div>
        <div class="calendario-dia-header">Mié</div>
        <div class="calendario-dia-header">Jue</div>
        <div class="calendario-dia-header">Vie</div>
        <div class="calendario-dia-header">Sáb</div>
        <div class="calendario-dia-header">Dom</div>

        <!-- Días del calendario -->
        @foreach($calendario as $semana)
            @for($dia = 0; $dia < 7; $dia++)
                @if(isset($semana[$dia]))
                    @php
                        $diaData = $semana[$dia];
                        $subactividades = $diaData['subactividades'];
                        $mostrarTodas = false;
                        $limite = 3;
                    @endphp
                    <div class="calendario-dia {{ !$diaData['esDelMes'] ? 'otro-mes' : '' }} {{ !$diaData['esHabil'] ? 'no-habil' : '' }} {{ $diaData['esHoy'] ? 'hoy' : '' }} {{ count($subactividades) > 0 ? 'con-subactividades' : '' }}">
                        <div class="calendario-dia-numero">
                            {{ $diaData['fecha']->day }}
                        </div>
                        <div class="calendario-subactividades">
                            @if(count($subactividades) > 0)
                                @foreach(array_slice($subactividades, 0, $limite) as $subactividad)
                                    <div class="calendario-subactividad" 
                                         style="border-left-color: {{ $subactividad->actividad->color }};"
                                         onclick="mostrarModalSubactividad({{ $subactividad->id }})"
                                         data-subactividad-id="{{ $subactividad->id }}"
                                         data-subactividad-nombre="{{ $subactividad->nombre }}"
                                         data-subactividad-descripcion="{{ $subactividad->descripcion ?? 'Sin descripción' }}"
                                         data-subactividad-fecha-inicio="{{ $subactividad->fecha_inicio->format('d/m/Y') }}"
                                         data-subactividad-fecha-fin="{{ $subactividad->fecha_fin->format('d/m/Y') }}"
                                         data-subactividad-estado="{{ $subactividad->estado }}"
                                         data-subactividad-progreso="{{ $subactividad->progreso }}"
                                         data-actividad-id="{{ $subactividad->actividad->id }}"
                                         data-actividad-nombre="{{ $subactividad->actividad->nombre }}"
                                         data-actividad-color="{{ $subactividad->actividad->color }}"
                                         title="Clic para ver detalles">
                                        <div class="calendario-subactividad-nombre">
                                            {{ Str::limit($subactividad->nombre, 25) }}
                                        </div>
                                        <div class="calendario-subactividad-meta">
                                            <span class="calendario-subactividad-estado estado-{{ $subactividad->estado }}">
                                                {{ ucfirst(str_replace('_', ' ', $subactividad->estado)) }}
                                            </span>
                                            <span class="calendario-subactividad-progreso">
                                                {{ $subactividad->progreso }}%
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                                @if(count($subactividades) > $limite)
                                    @php
                                        $idsSubactividades = $subactividades->pluck('id')->toArray();
                                    @endphp
                                    <div class="calendario-mas-subactividades" 
                                         onclick="mostrarTodasSubactividades('{{ $diaData['fecha']->format('Y-m-d') }}', [{{ implode(',', $idsSubactividades) }}])">
                                        +{{ count($subactividades) - $limite }} más
                                    </div>
                                @endif
                            @else
                                <div class="calendario-vacio">Sin subactividades</div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="calendario-dia otro-mes"></div>
                @endif
            @endfor
        @endforeach
    </div>

    <!-- Leyenda -->
    <div class="card" style="margin-top: 2rem;">
        <h3 style="margin-bottom: 1rem; font-size: 1.125rem; font-weight: 600;">Leyenda</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 16px; height: 16px; border-radius: 4px; background: rgba(99, 102, 241, 0.1); border: 2px solid var(--primary-color);"></div>
                <span style="font-size: 0.875rem;">Día actual</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="calendario-subactividad-estado pendiente">Pendiente</span>
                <span style="font-size: 0.875rem;">Pendiente</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="calendario-subactividad-estado en_progreso">En Progreso</span>
                <span style="font-size: 0.875rem;">En Progreso</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="calendario-subactividad-estado completado">Completado</span>
                <span style="font-size: 0.875rem;">Completado</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="calendario-subactividad-estado pausado">Pausado</span>
                <span style="font-size: 0.875rem;">Pausado</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal de detalles de subactividad -->
<div id="modalSubactividad" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="modalSubactividadTitulo"></h2>
            <button class="modal-close" onclick="cerrarModalSubactividad()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-info-group">
                <div class="modal-info-label">Actividad Padre</div>
                <div class="modal-info-value" id="modalActividadPadre"></div>
            </div>
            <div class="modal-info-group">
                <div class="modal-info-label">Descripción</div>
                <div class="modal-info-value" id="modalDescripcion"></div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                <div class="modal-info-group">
                    <div class="modal-info-label">Fecha de Inicio</div>
                    <div class="modal-info-value" id="modalFechaInicio"></div>
                </div>
                <div class="modal-info-group">
                    <div class="modal-info-label">Fecha de Fin</div>
                    <div class="modal-info-value" id="modalFechaFin"></div>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                <div class="modal-info-group">
                    <div class="modal-info-label">Estado</div>
                    <div class="modal-info-value" id="modalEstado"></div>
                </div>
                <div class="modal-info-group">
                    <div class="modal-info-label">Progreso</div>
                    <div class="modal-info-value" id="modalProgreso"></div>
                </div>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="cerrarModalSubactividad()">Cerrar</button>
            <a id="modalEditarLink" href="#" class="btn btn-primary">Editar Subactividad</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function mostrarModalSubactividad(subactividadId) {
    const elemento = document.querySelector(`[data-subactividad-id="${subactividadId}"]`);
    if (!elemento) return;
    
    const modal = document.getElementById('modalSubactividad');
    const nombre = elemento.getAttribute('data-subactividad-nombre');
    const descripcion = elemento.getAttribute('data-subactividad-descripcion');
    const fechaInicio = elemento.getAttribute('data-subactividad-fecha-inicio');
    const fechaFin = elemento.getAttribute('data-subactividad-fecha-fin');
    const estado = elemento.getAttribute('data-subactividad-estado');
    const progreso = elemento.getAttribute('data-subactividad-progreso');
    const actividadNombre = elemento.getAttribute('data-actividad-nombre');
    const actividadColor = elemento.getAttribute('data-actividad-color');
    
    // Llenar el modal con los datos
    document.getElementById('modalSubactividadTitulo').textContent = nombre;
    document.getElementById('modalActividadPadre').innerHTML = 
        `<span style="display: inline-block; width: 12px; height: 12px; border-radius: 2px; background-color: ${actividadColor}; margin-right: 0.5rem; vertical-align: middle;"></span>${actividadNombre}`;
    document.getElementById('modalDescripcion').textContent = descripcion || 'Sin descripción';
    document.getElementById('modalFechaInicio').textContent = fechaInicio;
    document.getElementById('modalFechaFin').textContent = fechaFin;
    
    // Estado con badge
    const estadoTexto = estado.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
    const estadoClass = estado === 'pendiente' ? 'pendiente' : 
                       estado === 'en_progreso' ? 'en_progreso' : 
                       estado === 'completado' ? 'completado' : 'pausado';
    document.getElementById('modalEstado').innerHTML = 
        `<span class="calendario-subactividad-estado ${estadoClass}">${estadoTexto}</span>`;
    
    document.getElementById('modalProgreso').innerHTML = 
        `<strong>${progreso}%</strong>`;
    
    // Link de editar
    const actividadId = elemento.getAttribute('data-actividad-id');
    if (actividadId) {
        document.getElementById('modalEditarLink').href = 
            `/cronograma/${actividadId}/subactividades/${subactividadId}/edit`;
        document.getElementById('modalEditarLink').style.display = 'inline-flex';
    } else {
        document.getElementById('modalEditarLink').style.display = 'none';
    }
    
    // Mostrar el modal
    modal.style.display = 'block';
}

function cerrarModalSubactividad() {
    document.getElementById('modalSubactividad').style.display = 'none';
}

// Cerrar modal al hacer clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('modalSubactividad');
    if (event.target == modal) {
        cerrarModalSubactividad();
    }
}

// Cerrar modal con ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        cerrarModalSubactividad();
    }
});

function mostrarTodasSubactividades(fecha, subactividadIds) {
    // Crear lista de subactividades para mostrar
    let lista = 'Subactividades del ' + fecha + ':\n\n';
    subactividadIds.forEach((id, index) => {
        const elemento = document.querySelector(`[data-subactividad-id="${id}"]`);
        if (elemento) {
            lista += `${index + 1}. ${elemento.getAttribute('data-subactividad-nombre')}\n`;
        }
    });
    lista += '\nHaz clic en cualquier subactividad para ver sus detalles.';
    alert(lista);
}
</script>
@endpush
@endsection

