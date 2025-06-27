@extends('adminlte::page')

@section('content_header')
    <h1><b>Asistencias del Docente: {{ $asignacion->personal->apellidos }} {{ $asignacion->personal->nombres }}</b></h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                {{ $asignacion->materia->nombre }} | 
                {{ $asignacion->grado->nombre }} "{{ $asignacion->paralelo->nombre }}" - 
                {{ $asignacion->nivel->nombre }} | 
                Turno: {{ $asignacion->turno->nombre }} - 
                Gestión: {{ $asignacion->gestion->nombre }}
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
    <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Observación</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach($asistencias as $asistencia)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
            <td>
                @if($asistencia->estado == 'PRESENTE')
                    <span class="badge badge-success">PRESENTE</span>
                @elseif($asistencia->estado == 'FALTA')
                    <span class="badge badge-danger">FALTA</span>
                @elseif($asistencia->estado == 'TARDANZA')
                    <span class="badge badge-warning">TARDANZA</span>
                @elseif($asistencia->estado == 'FJ')
                    <span class="badge badge-info">FJ</span>
                @endif
            </td>
            <td>{{ $asistencia->observacion ?? '---' }}</td>
            <td>
                <a href="{{ route('admin.asistencias-docentes.edit', $asistencia->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.asistencias-docentes.destroy', $asistencia->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Deseas eliminar esta asistencia?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
@stop

@section('js')
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        toast: true,
        position: 'top-end'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 3000,
        toast: true,
        position: 'top-end'
    });
</script>
@endif
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        timer: 2500,
        showConfirmButton: false,
    });
</script>
@endif
@endsection
