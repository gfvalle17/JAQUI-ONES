@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content_header')
    <h1>Editar Asistencia del día: {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>Materia:</strong> {{ $asistencia->asignacion->materia->nombre }} <br>
                <strong>Grado:</strong> {{ $asistencia->asignacion->grado->nombre }} - {{ $asistencia->asignacion->paralelo->nombre }}
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.asistencias.update', $asistencia->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="asignacion_id" value="{{ $asistencia->asignacion_id }}">
                <input type="hidden" name="fecha" value="{{ $asistencia->fecha }}">

                <div class="form-group">
                    <label for="observacion">Observación General:</label>
                    <input type="text" name="observacion" class="form-control" value="{{ $asistencia->observacion }}">
                </div>

                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Estudiante</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asistencia->detalleAsistencias as $detalle)
                            <tr>
                                <td>{{ $detalle->estudiante->nombres }} {{ $detalle->estudiante->apellidos }}</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estado_asistencia[{{ $detalle->estudiante_id }}]" value="PRESENTE" {{ $detalle->estado_asistencia == 'PRESENTE' ? 'checked' : '' }}>
                                        <label class="form-check-label">Presente</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estado_asistencia[{{ $detalle->estudiante_id }}]" value="FALTA" {{ $detalle->estado_asistencia == 'FALTA' ? 'checked' : '' }}>
                                        <label class="form-check-label">Falta</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estado_asistencia[{{ $detalle->estudiante_id }}]" value="TARDANZA" {{ $detalle->estado_asistencia == 'TARDANZA' ? 'checked' : '' }}>
                                        <label class="form-check-label">Tardanza</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estado_asistencia[{{ $detalle->estudiante_id }}]" value="FJ" {{ $detalle->estado_asistencia == 'FJ' ? 'checked' : '' }}>
                                        <label class="form-check-label">Falta Justificada</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Actualizar Asistencia</button>
                    <a href="{{ route('admin.asistencias.show', $asistencia->asignacion_id) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop