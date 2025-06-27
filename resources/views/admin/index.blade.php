{{-- Archivo: resources/views/admin/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard Administrador')

@section('content_header')
    <h1><b>Bienvenido: </b> {{ Auth::user()->name }}</h1>
    <hr>
@stop

@section('content')
    <p>Resumen general del sistema.</p>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/gestion.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Gestiones registradas</b></span><span class="info-box-number">{{ $total_gestiones ?? '0' }} gestiones</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/calendario.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Periodos registrados</b></span><span class="info-box-number">{{ $total_periodos ?? '0' }} Periodos</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/niveles.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Niveles registrados</b></span><span class="info-box-number">{{ $total_niveles ?? '0' }} niveles</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/grados.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Grados registrados</b></span><span class="info-box-number">{{ $total_grados ?? '0' }} grados</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/seccion.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Secciones registradas</b></span><span class="info-box-number">{{ $total_paralelos ?? '0' }} secciones</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/turnos.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Turnos registrados</b></span><span class="info-box-number">{{ $total_turnos ?? '0' }} turnos</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/cursos.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Materias registradas</b></span><span class="info-box-number">{{ $total_materias ?? '0' }} materias</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/roles.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Roles registradas</b></span><span class="info-box-number">{{ $total_roles ?? '0' }} roles</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/administrativo.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Administrativos registrados</b></span><span class="info-box-number">{{ $total_personal_administrativo ?? '0' }} administrativos</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/docente.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Docentes registrados</b></span><span class="info-box-number">{{ $total_personal_docente ?? '0' }} docentes</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/ppff.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Padres registrados</b></span><span class="info-box-number">{{ $total_ppffs ?? '0' }} Padres de familia</span></div></div></div>
        <div class="col-md-3 col-sm-6 col-12"><div class="info-box"><img src="{{ url('/img/estudiante.gif') }}" width="70px" alt=""><div><span class="info-box-text"><b> Estudiantes registrados</b></span><span class="info-box-number">{{ $total_estudiantes ?? '0' }} estudiantes</span></div></div></div>
    </div>
@stop