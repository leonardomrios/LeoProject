@extends('layouts.app')

@section('title', 'Nueva Subactividad')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Nueva Subactividad</h2>
        <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <form action="{{ route('subactividades.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="actividad_id" class="form-label">Actividad Padre *</label>
            <select id="actividad_id" name="actividad_id" class="form-control" required>
                <option value="">Selecciona una actividad</option>
                @foreach($actividades as $actividad)
                    <option value="{{ $actividad->id }}" {{ old('actividad_id', $actividadId) == $actividad->id ? 'selected' : '' }}>
                        {{ $actividad->nombre }} 
                        ({{ $actividad->fecha_inicio->format('d/m/Y') }} - {{ $actividad->fecha_fin->format('d/m/Y') }})
                    </option>
                @endforeach
            </select>
            <small style="color: var(--text-light); font-size: 0.8125rem;">Selecciona la actividad a la que pertenecerá esta subactividad</small>
            @error('actividad_id')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nombre" class="form-label">Nombre de la Subactividad *</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required placeholder="Ej: Implementar método de validación">
            @error('nombre')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Describe los detalles de la subactividad...">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
                <small style="color: var(--text-light); font-size: 0.8125rem;">Si no se especifica, usará la fecha de inicio de la actividad padre</small>
                @error('fecha_inicio')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
                <small style="color: var(--text-light); font-size: 0.8125rem;">Si no se especifica, usará la fecha de fin de la actividad padre</small>
                @error('fecha_fin')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="estado" class="form-label">Estado *</label>
                <select id="estado" name="estado" class="form-control" required>
                    <option value="pendiente" {{ old('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="pausado" {{ old('estado') == 'pausado' ? 'selected' : '' }}>Pausado</option>
                </select>
                @error('estado')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="progreso" class="form-label">Progreso (%)</label>
                <input type="number" id="progreso" name="progreso" class="form-control" value="{{ old('progreso', 0) }}" min="0" max="100">
                <small style="color: var(--text-light); font-size: 0.8125rem;">Porcentaje de avance (0-100)</small>
                @error('progreso')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Crear Subactividad</button>
            <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const actividadSelect = document.getElementById('actividad_id');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    
    // Cargar fechas de la actividad seleccionada
    actividadSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            // Obtener fechas de la actividad (podrías hacer una petición AJAX aquí)
            // Por ahora, solo validamos que fecha_fin sea mayor o igual a fecha_inicio
            if (fechaInicio.value && fechaFin.value) {
                if (fechaFin.value < fechaInicio.value) {
                    fechaFin.value = fechaInicio.value;
                }
            }
        }
    });
    
    // Validar que fecha_fin sea mayor o igual a fecha_inicio
    fechaInicio.addEventListener('change', function() {
        if (fechaFin.value && fechaFin.value < this.value) {
            fechaFin.value = this.value;
        }
        fechaFin.min = this.value;
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

