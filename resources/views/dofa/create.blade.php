@extends('layouts.app')

@section('title', 'Agregar Elemento DOFA')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Agregar Elemento a la Matriz DOFA</h2>
        <a href="{{ route('dofa.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <form action="{{ route('dofa.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="titulo" class="form-label">Título *</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
            @error('titulo')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="categoria" class="form-label">Categoría *</label>
                <select id="categoria" name="categoria" class="form-control" required>
                    <option value="debilidad" {{ old('categoria') == 'debilidad' ? 'selected' : '' }}>Debilidad</option>
                    <option value="oportunidad" {{ old('categoria') == 'oportunidad' ? 'selected' : '' }}>Oportunidad</option>
                    <option value="fortaleza" {{ old('categoria') == 'fortaleza' ? 'selected' : '' }}>Fortaleza</option>
                    <option value="amenaza" {{ old('categoria') == 'amenaza' ? 'selected' : '' }}>Amenaza</option>
                </select>
                @error('categoria')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="prioridad" class="form-label">Prioridad (1-5)</label>
                <input type="number" id="prioridad" name="prioridad" class="form-control" value="{{ old('prioridad', 3) }}" min="1" max="5">
                @error('prioridad')
                    <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Agregar Elemento</button>
            <a href="{{ route('dofa.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

