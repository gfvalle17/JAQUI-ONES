@extends('adminlte::page')

@section('content_header')
    <h1><b>Asistencias de estudiantes de: {{ $asignacion->gestion->nombre }} - Turno: {{ $asignacion->turno->nombre }}
        - nivel: {{ $asignacion->nivel->nombre }} - Grado: {{ $asignacion->grado->nombre }} - Sección: {{ $asignacion->paralelo->nombre }}
        - Materia: {{ $asignacion->materia->nombre }}</b></h1>
    <hr>
@stop

@section('content')

<style>
    .rotate-header{
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        text-align: center;
        padding: 5px;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Docente:</b> {{ $asignacion->personal->apellidos." ".$asignacion->personal->nombres }}</h3>
                        <!-- /card-tools -->
                    </div>
                    <!-- /.card header -->
                    <div class="card-body">
                        
                        <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Estudiante</th>
                                    <th>DNI</th>
                                    @foreach ($asistencias->pluck('fecha')->unique()->sort() as $fecha)
                                        <th style="text-align: center; width:10px" class="rotate-header">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td style="text-align: center">{{$loop->iteration }}</td>
                                        <td>{{ $estudiante->apellidos." ".$estudiante->nombres }}</td>
                                        <td>{{ $estudiante->ci }}</td>
                                        @foreach ($fechas as $fecha)
                                            @php
                                                $asistencia = $asistencias->where('fecha', $fecha)->first();
                                                if ($asistencia) {
                                                    $detalle = $asistencia->detalleAsistencias->where('estudiante_id', $estudiante->id)->first();
                                                    $estado = $detalle ? $detalle->estado_asistencia : 'N/A';
                                                }else{
                                                    $estado = 'N/A';
                                                }
                                                if ($estado == 'PRESENTE') {
                                                    $estado = '<span class="badge badge-success">P</span>';
                                                }elseif ($estado == 'FALTA') {
                                                    $estado = '<span class="badge badge-danger">F</span>';
                                                }else {
                                                    $estado = '<span class="badge badge-warning">T</span>';
                                                }
                                            @endphp
                                            <td style="text-align: center">{!! $estado !!}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-->
        </div>
    </div>

@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "dom": 'Bfrtip',
            "pageLength": 25,
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
@stop