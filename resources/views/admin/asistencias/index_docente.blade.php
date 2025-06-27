@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de asignaciones para asistencia de docente</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Asignaciones registradas</h3>
                </div>
                <div class="card-body">
                    
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Turno</th>
                                <th>Gestión</th>
                                <th>Nivel</th>
                                <th>Grado</th>
                                <th>Sección</th>
                                <th>Materia</th>
                                <th>Acciones</th>
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

                                    <td>
                                        <center>
                                            @if ($asignacione->isAttendanceMarkingActive())
                                                <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalAsistenciaDocente{{ $asignacione->id }}">
                                                    <i class="fas fa-user-check"></i> Mi asistencia
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-secondary btn-sm mb-1" disabled title="Puede marcar asistencia solo durante el horario de clases">
                                                    <i class="fas fa-clock"></i> Fuera de Horario
                                                </button>
                                            @endif

                                            <a class="btn btn-success btn-sm" href="{{ url('/admin/asistencias/create/asignacion/'.$asignacione->id) }}">
                                                <i class="fas fa-list-alt"></i> Ver asistencias
                                            </a>
                                        </center>

                                        <div class="modal fade" id="modalAsistenciaDocente{{ $asignacione->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ url('/docente/asistencias-docente') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="asignacion_id" value="{{ $asignacione->id }}">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Registrar mi asistencia</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <p><strong>Fecha de hoy:</strong> {{ \Carbon\Carbon::now('America/Lima')->format('d/m/Y') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Estado:</label><br>
                                                                <input type="radio" name="estado" value="PRESENTE" required checked> Presente
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Observación (opcional):</label>
                                                                <input type="text" name="observacion" class="form-control" placeholder="Ej: Ingreso 5 minutos tarde">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Registrar</button>
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

@section('css')
{{-- Tu CSS original se mantiene igual --}}
<style>
    /*Fondo transparente y sin borde en el contenedor*/
    #example1_wrapper .dt-buttons{
        background-color: transparent;
        box-shadow: none;
        border: none;
        display: flex;
        justify-content: center; /* Centrar los botones */
        gap: 10px; /* Espaciado entre botones */
        margin-bottom: 15px; /* Separar botones de la tabla */
    }

    /* Estilo personalizado para los botones */
    #example1_wrapper .btn {
        color: #fff; /* Color del texto en blanco */
        border-radius: 4px; /* Bordes redondeados */
        padding: 5px 15px; /* Espaciado interno */
        font-size: 14px; /* Tamaño de fuente */
    }

    /* Colores por tipo de botón */
    .btn-danger { background-color: #dc3545; border: none; }
    .btn-success { background-color: #28a745; border: none; }
    .btn-info { background-color: #17a2b8; border: none; }
    .btn-warning {background-color: #ffc107; color: #212559; border: none; }
    .btn-default {background-color: #6e7176; color: #212559; border: none; }
</style>
@stop

@section('js')
{{-- Tu JS original se mantiene igual --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Asignaciones",
                "infoEmpty": "Mostrando 0 a 0 de 0 Asignaciones",
                "infoFiltered": "(Filtrando de _MAX_total Asignaciones)",
                "lengthMenu": "Mostrar _MENU_ Asignaciones",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default' },
                { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
                { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
                { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
                { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' },
            ]
        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        toast: true,
        position: 'top-end'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 3000,
        toast: true,
        position: 'top-end'
    });
</script>
@endif
@stop