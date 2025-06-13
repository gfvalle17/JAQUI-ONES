@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de materias<b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Materias registradas</h3>

                        <div class="card-tools">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                                Crear nueva materia
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #007bff; color: white;">
                                            <h5 class="modal-title" id="exampleModalLabel">Registro de una nueva materia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/admin/materias/create') }}" method="POST">
                                                @csrf
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Nombre de la materia</label><b> (*)</b>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepended">
                                                                    <span class="input-group-text"><i 
                                                                        class="fas fa-list-book"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="nombre_create" 
                                                                value="{{ old('nombre_create') }}" 
                                                                placeholder="Escriba aquí..." required>
                                                            </div>
                                                            @error('nombre_create')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <button type="button" class="btn btn-secondary" 
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /card-tools -->
                    </div>
                    <!-- /.card header -->
                    <div class="card-body">
                        
                        <table id="example" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Materia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($materias as $materia)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $materia->nombre }}</td>
                                        <td>
                                            <div class="row d-flex justify-content-center">
                                                    <!-- Modal de edición de nivel-->
                                                    <button type="button" style="margin: 3px" class="btn btn-success btn-sm" data-toggle="modal" 
                                                        data-target="#ModalUpdate{{ $materia->id }}">
                                                        <i class="fas fa-pencil-alt"></i>Editar
                                                    </button>

                                                    <form action="{{ url('/admin/materias/' . $materia->id) }}" method="post" 
                                                        id="miFormulario{{ $materia->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" style="margin: 3px" class="btn btn-danger btn-sm" 
                                                            onclick="preguntar{{ $materia->id }}(event)">
                                                                <i class="fas fa-trash"></i> Eliminar
                                                            </button>
                                                    </form>
                                                </div>
                                                <script>
                                                    function preguntar{{ $materia->id }}(event) {
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
                                                                    document.getElementById('miFormulario{{ $materia->id }}').submit();
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                    
                                                    <div class="modal fade" id="ModalUpdate{{ $materia->id }}" tabindex="-1" 
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #007bff; color: white;">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar materia</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('/admin/materias/'. $materia->id )}}" 
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre de la materia</label><b> (*)</b>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepended">
                                                                                            <span class="input-group-text"><i 
                                                                                                class="fas fa-book"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" 
                                                                                        name="nombre" value="{{ old('nombre', $materia->nombre) }}" 
                                                                                        placeholder="Escriba aquí..." required>
                                                                                    </div>
                                                                                    @error('nombre')
                                                                                        <small style="color: red">{{$message}}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <button type="button" class="btn btn-secondary" 
                                                                                data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

@stop

@section('js')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                @if (session('modal_id'))
                    $('#ModalUpdate{{ session('modal_id') }}').modal('show');
                @else
                    $('#ModalCreate').modal('show');      
                @endif
            });
        </script>
    @endif
@stop
