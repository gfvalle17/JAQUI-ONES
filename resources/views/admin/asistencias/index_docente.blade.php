@extends('adminlte::page')

@section('title', 'Mis Asignaciones')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0"><b>Listado de mis Asignaciones</b></h1>
        <h5 class="mb-0 text-muted">
            <i class="far fa-calendar-alt mr-1"></i>
            {{-- La variable $fechaActual es pasada desde el AsistenciaController --}}
            {{ $fechaActual ?? now()->translatedFormat('l, d \de F \de Y') }}
        </h5>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mis cursos y materias asignadas</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nro</th>
                                <th>Turno</th>
                                <th>Gestión</th>
                                <th>Nivel</th>
                                <th>Grado</th>
                                <th style="text-align: center">Sección</th>
                                <th>Materia</th>
                                <th style="text-align: center; min-width: 350px;">Acciones y Horarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaciones as $asignacione)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $asignacione->turno->nombre ?? 'N/A' }}</td>
                                    <td style="text-align: center">{{ $asignacione->gestion->nombre ?? 'N/A' }}</td>
                                    <td>{{ $asignacione->nivel->nombre ?? 'N/A' }}</td>
                                    <td>{{ $asignacione->grado->nombre ?? 'N/A' }}</td>
                                    <td style="text-align: center">{{ $asignacione->paralelo->nombre ?? 'N/A' }}</td>
                                    <td>{{ $asignacione->materia->nombre ?? 'N/A' }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="mr-3" style="min-width: 180px