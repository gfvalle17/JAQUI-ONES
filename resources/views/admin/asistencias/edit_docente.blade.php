@extends('adminlte::page')

@section('title', 'Editar Asistencia del Docente')

@section('content_header')
    <h1><b>Editar Asistencia del Docente</b></h1>
    <hr>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulario de edición</h3>
            </div>
            <form action="{{ route('admin.asistencias-docentes.update', $asistencia->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    {{-- Fecha --}}
                    <div class="form-group">
                        <label for="fecha">Fecha de Asistencia</label>
                        <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $asistencia->fecha) }}" required>
                    </div>

                    {{-- Estado --}}
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="PRESENTE" {{ $asistencia->estado == 'PRESENTE' ? 'selected' : '' }}>Presente</option>
                            <option value="FALTA" {{ $asistencia->estado == 'FALTA' ? 'selected' : '' }}>Falta</option>
                            <option value="TARDANZA" {{ $asistencia->estado == 'TARDANZA' ? 'selected' : '' }}>Tardanza</option>
                            <option value="FJ" {{ $asistencia->estado == 'FJ' ? 'selected' : '' }}>Falta Justificada</option>
                        </select>
                    </div>

                    {{-- Observación --}}
                    <div class="form-group">
                        <label for="observacion">Observación (opcional)</label>
                        <textarea name="observacion" class="form-control" rows="3">{{ old('observacion', $asistencia->observacion) }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
