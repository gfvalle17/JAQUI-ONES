@extends('adminlte::page')

@section('title', 'Prueba de Modal')

@section('content_header')
    <h1>Página de Prueba para el Modal</h1>
@stop

@section('content')
    <p>Si haces clic en el botón de abajo, debería aparecer una ventana modal.</p>
    <hr>

    <button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#miModalDePrueba">
        Abrir Modal de Prueba
    </button>

    <div class="modal fade" id="miModalDePrueba" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¡El Modal Funciona!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Si puedes ver esto, significa que jQuery y Bootstrap.js están cargando correctamente y son capaces de trabajar juntos.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{-- Dejamos esta sección vacía para probar si AdminLTE carga los scripts por sí solo --}}
    <script> console.log('Página de prueba cargada.'); </script>
@stop