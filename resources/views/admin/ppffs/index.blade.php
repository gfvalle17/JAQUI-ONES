@extends('adminlte::page')

@section('title', 'Padres de Familia')

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
                        <a href="{{ url('/admin/ppffs/create')}}" class="btn btn-primary">Crear nuevo</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Nro</th>
                                <th>Padre de familia</th>
                                <th>DNI</th>
                                <th>Fecha de nacimiento</th>
                                <th>Parentesco</th>
                                <th>Ocupación</th>
                                <th>Dirección</th>
                                <th style="text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppffs as $ppff)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $ppff->nombres }} {{ $ppff->apellidos }}</td>
                                    <td>{{ $ppff->ci ?? 'N/A' }}</td>  {{-- Usamos 'dni', no 'ci' --}}
                                    <td>{{ $ppff->fecha_nacimiento }}</td>
                                    <td>{{ $ppff->parentesco }}</td>
                                    <td>{{ $ppff->ocupacion }}</td>
                                    <td>{{ $ppff->direccion }}</td>
                                    <td style="text-align: center;">
                                        <div class="d-flex justify-content-center" style="gap: 5px;">
                                            {{-- He corregido los enlaces para usar 'route' y el formulario de borrado --}}
                                            <a href="{{ route('admin.ppffs.show', $ppff) }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.ppffs.edit', $ppff) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('admin.ppffs.destroy', $ppff) }}" method="post" class="form-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                            </form>
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
    {{-- La sección de CSS no necesita cambios, pero es buena práctica tenerla --}}
@stop

@section('js')
    {{-- Este script único maneja la confirmación de borrado para todos los formularios --}}
    <script>
        $(document).ready(function() {
            // Inicialización de DataTables
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                // Puedes añadir la configuración de botones aquí si la necesitas
            });

            // Script para la confirmación de borrado con SweetAlert2
            $('.form-eliminar').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@stop