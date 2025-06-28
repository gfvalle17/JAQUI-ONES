@extends('adminlte::page')

@section('title', 'Editar Asignación')

@section('content_header')
    <h1>Editar Asignación</h1>
@stop

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">Actualizar datos de la Asignación</h3></div>
    <div class="card-body">
        <form action="{{ url('admin/asignaciones/update', $asignacione) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Fila 1: Docente y Materia --}}
                <div class="form-group col-md-6"><label for="personal_id">Docente</label><select name="personal_id" class="form-control">@foreach($docentes as $docente)<option value="{{ $docente->id }}" {{ $asignacione->personal_id == $docente->id ? 'selected' : '' }}>{{ $docente->nombres }} {{ $docente->apellidos }}</option>@endforeach</select></div>
                <div class="form-group col-md-6"><label for="materia_id">Materia</label><select name="materia_id" class="form-control">@foreach($materias as $materia)<option value="{{ $materia->id }}" {{ $asignacione->materia_id == $materia->id ? 'selected' : '' }}>{{ $materia->nombre }}</option>@endforeach</select></div>
                
                {{-- Fila 2: Turno y Gestión --}}
                <div class="form-group col-md-6"><label for="turno_id">Turno</label><select name="turno_id" class="form-control">@foreach($turnos as $turno)<option value="{{ $turno->id }}" {{ $asignacione->turno_id == $turno->id ? 'selected' : '' }}>{{ $turno->nombre }}</option>@endforeach</select></div>
                <div class="form-group col-md-6"><label for="gestion_id">Gestión</label><select name="gestion_id" class="form-control">@foreach($gestiones as $gestion)<option value="{{ $gestion->id }}" {{ $asignacione->gestion_id == $gestion->id ? 'selected' : '' }}>{{ $gestion->nombre }}</option>@endforeach</select></div>
                
                {{-- Fila 3: Nivel, Grado, Sección --}}
                <div class="form-group col-md-4"><label for="nivel_id">Nivel</label><select name="nivel_id" id="nivel_id" class="form-control"><option value="">Seleccione un Nivel</option>@foreach($niveles as $nivel)<option value="{{ $nivel->id }}" {{ $asignacione->nivel_id == $nivel->id ? 'selected' : '' }}>{{ $nivel->nombre }}</option>@endforeach</select></div>
                <div class="form-group col-md-4"><label for="grado_id">Grado</label><select name="grado_id" id="grado_id" class="form-control" required><option value="">Seleccione Nivel</option></select></div>
                <div class="form-group col-md-4"><label for="paralelo_id">Sección</label><select name="paralelo_id" id="paralelo_id" class="form-control" required><option value="">Seleccione Grado</option></select></div>
                
                {{-- Fila 4: Fecha --}}
                <div class="form-group col-md-12"><label for="fecha_asignacion">Fecha de Asignación</label><input type="date" name="fecha_asignacion" class="form-control" value="{{ \Carbon\Carbon::parse($asignacione->fecha_asignacion)->format('Y-m-d') }}"></div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Actualizar Asignación</button>
            <a href="{{ route('admin.asignaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop

{{-- Usamos @push('js') para que el script se cargue DESPUÉS de jQuery --}}
@push('js')
<script>
$(document).ready(function() {
    const gradoGuardadoId = '{{ $asignacione->grado_id }}';
    const paraleloGuardadoId = '{{ $asignacione->paralelo_id }}';

    function cargarGrados(nivelId, gradoASeleccionar) {
        if (!nivelId) {
            $('#grado_id').html('<option value="">Seleccione un nivel primero</option>');
            $('#paralelo_id').html('<option value="">Seleccione un grado primero</option>');
            return;
        }
        
        const url = "{{ url('admin/asignaciones/getGrados', ['nivel' => ':id']) }}".replace(':id', nivelId);
        
        $.get(url, function(grados) {
            let opciones = '<option value="">Seleccione un Grado</option>';
            $.each(grados, function(id, nombre) {
                opciones += `<option value="${id}">${nombre}</option>`;
            });
            $('#grado_id').html(opciones);

            if (gradoASeleccionar) {
                $('#grado_id').val(gradoASeleccionar).trigger('change');
            }
        });
    }

    function cargarParalelos(gradoId, paraleloASeleccionar) {
        if (!gradoId) {
            $('#paralelo_id').html('<option value="">Seleccione un grado primero</option>');
            return;
        }
        const url = "{{ url('admin/asignaciones/getParalelos', ['grado' => ':id']) }}".replace(':id', gradoId);
        
        $.get(url, function(paralelos) {
            let opciones = '<option value="">Seleccione una Sección</option>';
            $.each(paralelos, function(id, nombre) {
                opciones += `<option value="${id}">${nombre}</option>`;
            });
            $('#paralelo_id').html(opciones);
            
            if (paraleloASeleccionar) {
                $('#paralelo_id').val(paraleloASeleccionar);
            }
        });
    }

    // Al cargar la página, si ya hay un nivel, iniciamos la cascada
    var nivelInicial = $('#nivel_id').val();
    if (nivelInicial) {
        cargarGrados(nivelInicial, gradoGuardadoId);
    }

    // Eventos de cambio para el usuario
    $('#nivel_id').on('change', function() {
        cargarGrados($(this).val());
    });
    
    $('#grado_id').on('change', function() {
        const esElGradoOriginal = $(this).val() == gradoGuardadoId;
        cargarParalelos($(this).val(), esElGradoOriginal ? paraleloGuardadoId : null);
    });
});
</script>
@endpush
