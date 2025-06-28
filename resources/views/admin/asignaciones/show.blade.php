@extends('adminlte::page')

@section('title', 'Detalles de Asignación')

@section('content_header')
    <h1>Detalles de la Asignación</h1>
    <hr>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información Completa</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Docente:</strong> {{ $asignacione->personal->nombres ?? 'N/A' }} {{ $asignacione->personal->apellidos ?? '' }}</p>
                    <p><strong>Materia:</strong> {{ $asignacione->materia->nombre ?? 'N/A' }}</p>
                    <p><strong>Gestión:</strong> {{ $asignacione->gestion->nombre ?? 'N/A' }}</p>
                    <p><strong>Turno:</strong> {{ $asignacione->turno->nombre ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Nivel:</strong> {{ $asignacione->nivel->nombre ?? 'N/A' }}</p>
                    <p><strong>Grado:</strong> {{ $asignacione->grado->nombre ?? 'N/A' }}</p>
                    <p><strong>Sección:</strong> {{ $asignacione->paralelo->nombre ?? 'N/A' }}</p>
                    <p><strong>Fecha de Asignación:</strong> {{ \Carbon\Carbon::parse($asignacione->fecha_asignacion)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.asignaciones.index') }}" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </div>
@stop