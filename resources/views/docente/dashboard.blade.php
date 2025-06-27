{{-- Archivo: resources/views/docente/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard Docente')

@section('content_header')
    <h1><b>Bienvenido: </b> {{ Auth::user()->name }}</h1>
    <hr>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Resumen del Día - {{ $fechaActual }}</h3>
        </div>
        <div class="card-body">
            @if($clasesHoy->isEmpty())
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">¡Día Libre!</h4>
                    <p>No tienes clases programadas para hoy. ¡Que tengas un excelente día!</p>
                </div>
            @else
                <p class="lead">Hoy tienes <strong>{{ $clasesHoy->count() }}</strong> clases programadas:</p>
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Hora</th>
                            <th>Materia</th>
                            <th>Grado y Sección</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clasesHoy as $clase)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($clase->horarios->first()->hora_inicio)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($clase->horarios->first()->hora_fin)->format('h:i A') }}
                                </td>
                                <td>{{ $clase->materia->nombre }}</td>
                                <td>{{ $clase->grado->nombre }} - {{ $clase->paralelo->nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('docente.asignaciones.index') }}" class="btn btn-primary btn-lg btn-block">
                <i class="fas fa-tasks mr-2"></i> Ver Mi Lista de Asignaciones
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('calendario') }}" class="btn btn-info btn-lg btn-block">
                <i class="fas fa-calendar-alt mr-2"></i> Ver Mi Calendario Completo
            </a>
        </div>
    </div>
@stop