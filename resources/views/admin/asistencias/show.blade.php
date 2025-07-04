@extends('adminlte::page')

@section('title', 'Historial de Asistencias')

@section('content_header')
    <h1>Historial de Asistencias</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>Materia:</strong> {{ $asignacion->materia->nombre }} <br>
                <strong>Grado:</strong> {{ $asignacion->grado->nombre }} - {{ $asignacion->paralelo->nombre }}
            </h3>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
                <div class="alert alert-{{ session('icono') }}">
                    {{ session('mensaje') }}
                </div>
            @endif

            {{-- ======================= INICIO DEL CAMBIO ======================= --}}
            {{-- El botón para registrar asistencia ahora solo es visible para el rol de Docente --}}
            @if(Auth::user()->hasRole('DOCENTE'))
                <div class="mb-3">
                    <a href="{{ route('admin.asistencias.create', $asignacion->id) }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Registrar Asistencia del Día
                    </a>
                </div>
            @endif
            {{-- ======================== FIN DEL CAMBIO ======================== --}}

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Estudiante</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1; @endphp
                    @forelse ($asistencias as $asistencia)
                        @foreach ($asistencia->detalleAsistencias as $detalle)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $detalle->estudiante->nombres ?? 'N/A' }} {{ $detalle->estudiante->apellidos ?? '' }}</td>
                                <td>
                                    @if ($detalle->estado_asistencia == 'PRESENTE')
                                        <span class="badge bg-success">Presente</span>
                                    @elseif ($detalle->estado_asistencia == 'FALTA')
                                        <span class="badge bg-danger">Falta</span>
                                    @elseif ($detalle->estado_asistencia == 'TARDANZA')
                                        <span class="badge bg-warning text-dark">Tardanza</span>
                                    @else
                                        <span class="badge bg-info">{{ $detalle->estado_asistencia }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Nota: Estos botones editan y eliminan la asistencia de TODO el día. --}}
                                    <a href="{{ route('admin.asistencias.edit', $asistencia->id) }}" class="btn btn-sm btn-warning" title="Editar asistencia del día">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.asistencias.destroy', $asistencia->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar asistencia del día" onclick="return confirm('¿Está seguro de que desea eliminar la asistencia de este día para todos los estudiantes?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay registros de asistencia para esta asignación.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
