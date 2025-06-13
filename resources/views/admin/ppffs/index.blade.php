@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de padres de familia</b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Padres de familia registrados</h3>

                        <div class="card-tools">
                            <a href="{{ url('/admin/ppffs/create')}}" class="btn btn-primary"> Crear nuevo</a>

                        </div>
                        <!-- /card-tools -->
                    </div>
                    <!-- /.card header -->
                    <div class="card-body">
                        
                        <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Padre de familia</th>
                                    <th>DNI</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Parentesco</th>
                                    <th>Ocupación</th>
                                    <th>Dirección</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppffs as $ppff)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $ppff->apellidos }} {{ $ppff->nombres }}</td>
                                        <td>{{ $ppff->ci }}</td>
                                        <td>{{ $ppff->fecha_nacimiento }}</td>
                                        <td>{{ $ppff->telefono }}</td>
                                        <td>{{ $ppff->parentesco }}</td>
                                        <td>{{ $ppff->ocupacion }}</td>
                                        <td>{{ $ppff->direccion }}</td>
                                        <td>
                                            <div class="row d-flex justify-content-center">
                                                <a href="{{ url('/admin/ppffs/'.$ppff->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                                                <a href="{{ url('/admin/ppffs/'.$ppff->id.'/edit') }}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                            
                                                <form action="{{ url('/admin/ppffs/'.$ppff->id )}}" method="post" id="miFormulario{{ $ppff->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{ $ppff->id }}(event)">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>

                                            <script>
                                                function preguntar{{ $ppff->id }}(event) {
                                                    event.preventDefault();

                                                    Swal.fire({
                                                        title: '¿Desea eliminar este registro?',
                                                        text: '',
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: 'Eliminar',
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: 'Cancelar',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            // JavaScript puro para enviar el formulario
                                                            document.getElementById('miFormulario{{ $ppff->id }}').submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Padres de familia",
                "infoEmpty": "Mostrando 0 a 0 de 0 Padres de familia",
                "infoFiltered": "(Filtrando de _MAX_total Padres de familia)",
                "lengthMenu": "Mostrar _MENU_ Padres de familia",
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