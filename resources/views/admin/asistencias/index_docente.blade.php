@extends('adminlte::page')

@section('title', 'Mis Asignaciones')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0"><b>Listado de mis Asignaciones</b></h1>
        <h5 class="mb-0 text-muted">
            <i class="far fa-calendar-alt mr-1"></i>
            {{ $fechaActual ?? now()->locale('es')->translatedFormat('l, d \de F \de Y') }}
        </h5>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mis cursos y materias asignadas</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nro</th>
                                <th>Turno</th>
                                <th>Gestión</th>
                                <th>Nivel</th>
                                <th>Grado</th>
                                <th style="text-align: center">Sección</th>
                                <th>Materia</th>
                                <th style="text-align: center; min-width: 350px;">Acciones y Horarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaciones as $asignacione)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $asignacione->turno->nombre }}</td>
                                    <td style="text-align: center">{{ $asignacione->gestion->nombre }}</td>
                                    <td>{{ $asignacione->nivel->nombre }}</td>
                                    <td>{{ $asignacione->grado->nombre }}</td>
                                    <td style="text-align: center">{{ $asignacione->paralelo->nombre }}</td>
                                    <td>{{ $asignacione->materia->nombre }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="mr-3" style="min-width: 180px;">
                                                @forelse($asignacione->horarios->sortBy('dia_semana') as $horario)
                                                    @php $diasMap = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo']; @endphp
                                                    <div style="display: flex; justify-content: flex-start; align-items: center; margin-bottom: 3px; text-align: left;">
                                                        <span class="badge badge-info mr-2" style="width: 85px; font-size: 0.8em;">{{ $diasMap[$horario->dia_semana] ?? '?' }}</span>
                                                        <small style="font-weight: 500;">{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }} - {{ \Carbon\Carbon::parse($horario->hora_fin)->format('h:i A') }}</small>
                                                    </div>
                                                @empty
                                                    <small class="badge badge-warning"><i class="fas fa-times-circle"></i> Sin Horario</small>
                                                @endforelse
                                            </div>
                                            
                                            <div class="d-flex flex-column">
                                                {{-- ======================= NUEVA LÓGICA DE BOTONES ======================= --}}
                                                
                                                @if (in_array($asignacione->id, $asistenciasHoy))
                                                    {{-- Caso 1: Asistencia ya registrada hoy --}}
                                                    <button type="button" class="btn btn-success btn-sm mb-1" disabled>
                                                        <i class="fas fa-check-square"></i> Asistencia Registrada
                                                    </button>
                                                @elseif ($asignacione->isAttendanceMarkingActive())
                                                    {{-- Caso 2: Dentro del horario permitido --}}
                                                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalAsistenciaDocente" data-asignacion-id="{{ $asignacione->id }}">
                                                        <i class="fas fa-user-check"></i> Marcar mi Asistencia
                                                    </button>
                                                @else
                                                    {{-- Caso 3: Fuera del horario permitido --}}
                                                    <button type="button" class="btn btn-secondary btn-sm mb-1" disabled>
                                                        <i class="fas fa-lock"></i> Fuera de Horario
                                                    </button>
                                                @endif
                                                
                                                <a class="btn btn-info btn-sm" href="{{ url('/admin/asistencias/create/asignacion/'.$asignacione->id) }}">
                                                    <i class="fas fa-list-alt"></i> Asistencia Alumnos
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA MARCAR ASISTENCIA --}}
    <div class="modal fade" id="modalAsistenciaDocente" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Marcar mi Asistencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('docente.asistencia.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="asignacion_id" id="modal_asignacion_id" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="estado">Estado de la Asistencia</label>
                            <select name="estado" class="form-control" required>
                                <option value="PRESENTE" selected>Presente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="observacion">Observación (Opcional)</label>
                            <textarea name="observacion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $('#modalAsistenciaDocente').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var asignacionId = button.data('asignacion-id');
        var modal = $(this);
        modal.find('#modal_asignacion_id').val(asignacionId);
    });

    @if(session('success'))
        Swal.fire({ icon: 'success', title: '¡Éxito!', text: '{{ session('success') }}', showConfirmButton: false, timer: 2000 });
    @endif
</script>
@stop
