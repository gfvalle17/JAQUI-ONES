@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de grados<b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Grados registrados</h3>

                        <div class="card-tools">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                                Crear nuevo grado
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #007bff; color: white;">
                                            <h5 class="modal-title" id="exampleModalLabel">Registro de un nuevo grado</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.grados.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">niveles</label><b> (*)</b>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepended">
                                                                    <span class="input-group-text"><i 
                                                                        class="fas fa-layer-group"></i></span>
                                                                </div>
                                                                <select class="form-control" name="nivel_id"
                                                                id="nivel_id" required>
                                                                <option value="">Seleccione un nivel</option>
                                                                @foreach ($niveles as $nivel)
                                                                    <option value="{{ $nivel->id }}">
                                                                        {{ $nivel->nombre }}</option>                                                  
                                                                @endforeach                                               
                                                                </select>
                                                            </div>
                                                            @error('nivel_id')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Nombre del grado</label><b> (*)</b>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepended">
                                                                    <span class="input-group-text"><i 
                                                                        class="fas fa-list-alt"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="nombre" 
                                                                value="{{ old('nombre') }}" 
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
                                    <th>Niveles</th>
                                    <th>Grados</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($niveles as $nivel)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $nivel->nombre }}</td>
                                        <td>                                            
                                            @foreach ($nivel->grados as $grado)
                                                <button class="btn btn-info btn-sm btn-block">{{ $grado->nombre }}</button>                                          
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($nivel->grados as $grado)
                                                <div class="row d-flex justify-content-center">
                                                    <!-- Modal de edición de nivel-->
                                                    <button type="button" style="margin: 3px" class="btn btn-success btn-sm" data-toggle="modal" 
                                                        data-target="#ModalUpdate{{ $grado->id }}">
                                                        <i class="fas fa-pencil-alt"></i>Editar
                                                    </button>

                                                    <form action="{{ url('admin.grados.update' . $grado->id) }}" method="post" 
                                                        id="miFormulario{{ $grado->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" style="margin: 3px" class="btn btn-danger btn-sm" 
                                                            onclick="preguntar{{ $grado->id }}(event)">
                                                                <i class="fas fa-trash"></i> Eliminar
                                                            </button>
                                                    </form>
                                                </div>
                                                <script>
                                                    function preguntar{{ $grado->id }}(event) {
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
                                                                    document.getElementById('miFormulario{{ $grado->id }}').submit();
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                    
                                                    <div class="modal fade" id="ModalUpdate{{ $grado->id }}" tabindex="-1" 
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #007bff; color: white;">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar grado</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('admin.grados.destroy', $grado->id )}}" 
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Niveles</label><b> (*)</b>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepended">
                                                                                            <span class="input-group-text"><i 
                                                                                                class="fas fa-layer-group"></i></span>
                                                                                        </div>
                                                                                        <select class="form-control" name="nivel_id"
                                                                                        id="nivel_id" required>
                                                                                        <option value="">Seleccione una nivel</option>
                                                                                        @foreach ($niveles as $nivel)
                                                                                            <option value="{{ $nivel->id }}"  {{ $nivel->id == $grado->nivel_id ? 'selected' : '' }} >
                                                                                                {{ $nivel->nombre }}</option>                                                  
                                                                                        @endforeach                                               
                                                                                        </select>
                                                                                    </div>
                                                                                    @error('nivel_id')
                                                                                        <small style="color: red">{{$message}}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre del grado</label><b> (*)</b>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepended">
                                                                                            <span class="input-group-text"><i 
                                                                                                class="fas fa-list-alt"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" 
                                                                                        name="nombre" value="{{ old('nombre', $grado->nombre) }}" 
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
                                            @endforeach
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