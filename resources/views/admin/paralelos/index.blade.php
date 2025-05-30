@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de paralelos<b></h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Paralelos registrados</h3>

                        <div class="card-tools">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
                                Crear nuevo paralelo
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #007bff; color: white;">
                                            <h5 class="modal-title" id="exampleModalLabel">Registro de un nuevo paralelo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('admin/paralelos/create') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Grados</label><b> (*)</b>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepended">
                                                                    <span class="input-group-text"><i 
                                                                        class="fas fa-list-alt"></i></span>
                                                                </div>
                                                                <select class="form-control" name="grado_id_create"
                                                                id="grado_id_create" required>
                                                                <option value="">Seleccione un grado</option>
                                                                @foreach ($grados as $grado)
                                                                    <option value="{{ $grado->id }}">
                                                                        {{ $grado->nombre }}</option>                                                  
                                                                @endforeach                                               
                                                                </select>
                                                            </div>
                                                            @error('grado_id_create')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Nombre del paralelo</label><b> (*)</b>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepended">
                                                                    <span class="input-group-text"><i 
                                                                        class="fas fa-clone"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="nombre" 
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
                                    <th>Grados</th>
                                    <th>Paralelos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               
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