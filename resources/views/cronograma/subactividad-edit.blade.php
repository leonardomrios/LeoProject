@extends('layouts.app')

@section('title', 'Editar Subactividad')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Editar Subactividad</h2>
        <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <form action="{{ route('subactividades.update', ['actividad' => $actividad, 'subactividad' => $subactividad]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $subactividad->nombre) }}" required>
            @error('nombre')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3">{{ old('descripcion', $subactividad->descripcion) }}</textarea>
            @error('descripcion')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $subactividad->fecha_inicio ? $subactividad->fecha_inicio->format('Y-m-d') : '') }}">
                @error('fecha_inicio')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $subactividad->fecha_fin ? $subactividad->fecha_fin->format('Y-m-d') : '') }}">
                @error('fecha_fin')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="estado" class="form-label">Estado *</label>
                <select id="estado" name="estado" class="form-control" required>
                    <option value="pendiente" {{ old('estado', $subactividad->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_progreso" {{ old('estado', $subactividad->estado) == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completado" {{ old('estado', $subactividad->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="pausado" {{ old('estado', $subactividad->estado) == 'pausado' ? 'selected' : '' }}>Pausado</option>
                </select>
                @error('estado')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="progreso" class="form-label">Progreso (%)</label>
                <input type="number" id="progreso" name="progreso" class="form-control" value="{{ old('progreso', $subactividad->progreso) }}" min="0" max="100">
                @error('progreso')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Actualizar Subactividad</button>
            <a href="{{ route('cronograma.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

