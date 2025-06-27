@extends('adminlte::page')

@section('title', 'Mis Asignaciones')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0"><b>Listado de mis Asignaciones</b></h1>
        <h5 class="mb-0 text-muted">
            <i class="far fa-calendar-alt mr-1"></i>
            {{ $fechaActual ?? now()->translatedFormat('l, d \de F \de Y') }}
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
                                                    @php
                                                        $diasMap = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];
                                                    @endphp
                                                    <div style="display: flex; justify-content: flex-start; align-items: center; margin-bottom: 3px; text-align: left;">
                                                        <span class="badge badge-info mr-2" style="width: 85px; font-size: 0.8em;">
                                                            {{ $diasMap[$horario->dia_semana] ?? '?' }}
                                                        </span>
                                                        <small style="font-weight: 500;">
                                                            {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }} - {{ \Carbon\Carbon::parse($horario->hora_fin)->format('h:i A') }}
                                                        </small>
                                                    </div>
                                                @empty
                                                    <small class="badge badge-warning"><i class="fas fa-times-circle"></i> Sin Horario</small>
                                                @endforelse
                                            </div>
                                            <div class="d-flex flex-column">
                                                {{-- Lógica de 3 estados para los botones --}}
                                                @if ($asignacione->hasAttendanceToday())
                                                    <button type="button" class="btn btn-success btn-sm mb-1" disabled>
                                                        <i class="fas fa-check-circle"></i> Asistencia Registrada
                                                    </button>
                                                @elseif ($asignacione->isAttendanceMarkingActive())
                                                    <button type="button" class="btn btn-primary btn-sm mb-1 abre-modal-asistencia" data-target="#modalAsistenciaDocente{{ $asignacione->id }}">
                                                        <i class="fas fa-user-check"></i> Mi asistencia
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-secondary btn-sm mb-1" disabled>
                                                        <i class="fas fa-lock"></i> Fuera de Horario
                                                    </button>
                                                @endif

                                                <a class="btn btn-info btn-sm" href="{{ url('/admin/asistencias/create/asignacion/'.$asignacione->id) }}">
                                                    <i class="fas fa-list-alt"></i> Ver Asistencias
                                                </a>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modalAsistenciaDocente{{ $asignacione->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $asignacione->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('docente.asistencia.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="asignacion_id" value="{{ $asignacione->id }}">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="modalLabel{{ $asignacione->id }}">Registrar Mi Asistencia</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Fecha:</strong> {{ now()->format('d/m/Y') }}</p>
                                                            <p><strong>Curso:</strong> {{ $asignacione->materia->nombre }}</p>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label>Mi estado:</label><br>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="estado" id="estado_presente_{{ $asignacione->id }}" value="PRESENTE" required checked>
                                                                    <label class="form-check-label" for="estado_presente_{{ $asignacione->id }}">Presente</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="observacion_{{ $asignacione->id }}">Observación (opcional):</label>
                                                                <textarea class="form-control" name="observacion" id="observacion_{{ $asignacione->id }}" rows="2"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                                                        </div>
                                                    </div>
                                                </form>
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
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            //$('#example1').DataTable(); // Descomenta si necesitas DataTables en esta vista

            $('.abre-modal-asistencia').on('click', function() {
                var targetModal = $(this).data('target');
                $(targetModal).modal('show');
            });

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session("success") }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ session("error") }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
            @endif
        });
    </script>
@stop