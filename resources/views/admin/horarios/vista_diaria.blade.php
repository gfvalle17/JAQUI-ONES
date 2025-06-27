{{-- resources/views/admin/horarios/vista_diaria.blade.php --}}
@extends('adminlte::page')

@section('title', 'Horario del Día')

@section('content_header')
    {{-- Establecemos el idioma para Carbon y mostramos la fecha formateada --}}
    @php
        \Carbon\Carbon::setLocale('es');
    @endphp
    <h1><b>Horario del Día</b></h1>
    <h5>{{ $fecha->translatedFormat('l, d \de F \de Y') }}</h5>
    <hr>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clases Programadas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Materia</th>
                        <th>Docente</th>
                        <th>Grado y Sección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asignaciones as $asignacion)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($asignacion->horarios->first()->hora_inicio)->format('h:i A') }} - 
                                {{ \Carbon\Carbon::parse($asignacion->horarios->first()->hora_fin)->format('h:i A') }}
                            </td>
                            <td>{{ $asignacion->materia->nombre }}</td>
                            <td>{{ $asignacion->personal->user->name ?? 'No asignado' }}</td>
                            <td>{{ $asignacion->grado->nombre }}</td>
                            <td>
                                <a href="{{ url('/admin/asistencias/create/asignacion/' . $asignacion->id) }}" class="btn btn-primary btn-sm">
                                    Ver Asistencia
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay clases programadas para este día.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('calendario') }}" class="btn btn-secondary">Volver al Calendario</a>
        </div>
    </div>
@stop