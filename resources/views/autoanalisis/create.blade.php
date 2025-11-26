@extends('layouts.app')

@section('title', 'Escribir Reflexión - Autoanálisis')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Escribir Reflexión</h2>
        <a href="{{ route('autoanalisis.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    @php
        $preguntaTexto = App\Models\AutoanalisisRespuesta::getPreguntaTexto($preguntaNumero);
        $preguntaDescripcion = App\Models\AutoanalisisRespuesta::getPreguntaDescripcion($preguntaNumero);
    @endphp

    <div class="pregunta-context" style="background: var(--bg-secondary); padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 2rem; border-left: 4px solid var(--primary-color);">
        <div style="display: flex; gap: 1rem; align-items: start;">
            <div style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                {{ $preguntaNumero }}
            </div>
            <div style="flex: 1;">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin: 0 0 0.5rem 0;">
                    {{ $preguntaTexto }}
                </h3>
                <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0; line-height: 1.6;">
                    {{ $preguntaDescripcion }}
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('autoanalisis.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pregunta_numero" value="{{ $preguntaNumero }}">

        <div class="form-group">
            <label for="titulo" class="form-label">Título (Opcional)</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo') }}" placeholder="Ej: Mi estrategia para aprovechar oportunidades">
            <small style="color: var(--text-light); font-size: 0.8125rem;">Un título breve que identifique tu reflexión</small>
            @error('titulo')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contenido" class="form-label">Tu Reflexión *</label>
            <textarea id="contenido" name="contenido" class="form-control" rows="12" required placeholder="Escribe aquí tu reflexión detallada sobre esta pregunta...">{{ old('contenido') }}</textarea>
            <small style="color: var(--text-light); font-size: 0.8125rem;">Sé específico y detallado en tu reflexión. Puedes incluir acciones concretas, estrategias y planes.</small>
            @error('contenido')
                <div style="color: var(--danger-color); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Guardar Reflexión</button>
            <a href="{{ route('autoanalisis.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

