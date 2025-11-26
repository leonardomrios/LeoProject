@extends('layouts.app')

@section('title', 'Editar Actividad - Cronograma')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Editar Actividad</h2>
        <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <form action="{{ route('cronograma.update', $cronograma) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre" class="form-label">Nombre de la Actividad *</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $cronograma->nombre) }}" required>
            @error('nombre')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="4">{{ old('descripcion', $cronograma->descripcion) }}</textarea>
            @error('descripcion')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio *</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $cronograma->fecha_inicio->format('Y-m-d')) }}" required>
                @error('fecha_inicio')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_fin" class="form-label">Fecha de Fin *</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $cronograma->fecha_fin->format('Y-m-d')) }}" required>
                @error('fecha_fin')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="estado" class="form-label">Estado *</label>
                <select id="estado" name="estado" class="form-control" required>
                    <option value="pendiente" {{ old('estado', $cronograma->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_progreso" {{ old('estado', $cronograma->estado) == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completado" {{ old('estado', $cronograma->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="pausado" {{ old('estado', $cronograma->estado) == 'pausado' ? 'selected' : '' }}>Pausado</option>
                </select>
                @error('estado')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="prioridad" class="form-label">Prioridad *</label>
                <select id="prioridad" name="prioridad" class="form-control" required>
                    <option value="baja" {{ old('prioridad', $cronograma->prioridad) == 'baja' ? 'selected' : '' }}>Baja</option>
                    <option value="media" {{ old('prioridad', $cronograma->prioridad) == 'media' ? 'selected' : '' }}>Media</option>
                    <option value="alta" {{ old('prioridad', $cronograma->prioridad) == 'alta' ? 'selected' : '' }}>Alta</option>
                    <option value="critica" {{ old('prioridad', $cronograma->prioridad) == 'critica' ? 'selected' : '' }}>Crítica</option>
                </select>
                @error('prioridad')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="progreso" class="form-label">Progreso (%)</label>
                <input type="number" id="progreso" name="progreso" class="form-control" value="{{ old('progreso', $cronograma->progreso) }}" min="0" max="100">
                <div style="margin-top: 0.5rem;">
                    <div style="background: var(--bg-secondary); height: 8px; border-radius: 4px; overflow: hidden;">
                        <div id="progreso-bar" style="background: var(--primary-color); height: 100%; width: {{ $cronograma->progreso }}%; transition: width 0.3s;"></div>
                    </div>
                </div>
                <small style="color: var(--text-light); font-size: 0.8125rem;">Porcentaje de avance (0-100)</small>
                @error('progreso')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="color" class="form-label">Color Personalizado</label>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <input type="color" id="color" name="color" class="form-control" value="{{ old('color', $cronograma->color ?? '#6366f1') }}" style="width: 80px; height: 40px; padding: 0;">
                    <input type="text" id="color_hex" class="form-control" value="{{ old('color', $cronograma->color ?? '#6366f1') }}" placeholder="#6366f1" pattern="^#[0-9A-Fa-f]{6}$">
                </div>
                <small style="color: var(--text-light); font-size: 0.8125rem;">Color para la barra en el cronograma (opcional)</small>
                @error('color')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Actualizar Actividad</button>
            <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.getElementById('color');
    const colorHex = document.getElementById('color_hex');
    const progresoInput = document.getElementById('progreso');
    const progresoBar = document.getElementById('progreso-bar');
    
    colorInput.addEventListener('input', function() {
        colorHex.value = this.value;
    });
    
    colorHex.addEventListener('input', function() {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorInput.value = this.value;
        }
    });
    
    progresoInput.addEventListener('input', function() {
        progresoBar.style.width = this.value + '%';
    });
    
    // Validar que fecha_fin sea mayor o igual a fecha_inicio
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    
    fechaInicio.addEventListener('change', function() {
        fechaFin.min = this.value;
        if (fechaFin.value && fechaFin.value < this.value) {
            fechaFin.value = this.value;
        }
    });
    
    fechaFin.addEventListener('change', function() {
        if (this.value < fechaInicio.value) {
            alert('La fecha de fin debe ser mayor o igual a la fecha de inicio');
            this.value = fechaInicio.value;
        }
    });
});
</script>
@endpush
@endsection

