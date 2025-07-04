@extends('adminlte::page')

@section('title', 'Informe de Auditoría')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Informe de Auditoría del Sistema</h1>
        <a href="{{ route('admin.auditoria.export', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Exportar a Excel
        </a>
    </div>
@stop

@section('content')

    @php
        // Función auxiliar para obtener nombres en lugar de IDs
        if (!function_exists('getRelatedName')) {
            function getRelatedName($key, $id) {
                if (empty($id)) return 'N/A';
                $model = null;
                $name = "ID: $id"; // Valor por defecto

                switch ($key) {
                    case 'personal_id':
                        $model = \App\Models\Personal::find($id);
                        if ($model) $name = $model->nombres . ' ' . $model->apellidos;
                        break;
                    case 'estudiante_id':
                        $model = \App\Models\Estudiante::find($id);
                        if ($model) $name = $model->nombres . ' ' . $model->apellidos;
                        break;
                    case 'materia_id':
                        $model = \App\Models\Materia::find($id);
                        if ($model) $name = $model->nombre;
                        break;
                    case 'grado_id':
                        $model = \App\Models\Grado::find($id);
                        if ($model) $name = $model->nombre;
                        break;
                    case 'nivel_id':
                        $model = \App\Models\Nivel::find($id);
                        if ($model) $name = $model->nombre;
                        break;
                    case 'turno_id':
                        $model = \App\Models\Turno::find($id);
                        if ($model) $name = $model->nombre;
                        break;
                    case 'paralelo_id':
                        $model = \App\Models\Paralelo::find($id);
                        if ($model) $name = $model->nombre;
                        break;
                    case 'gestion_id':
                        $model = \App\Models\Gestion::find($id);
                        if ($model) $name = $model->gestion;
                        break;
                    default:
                        return $id;
                }
                return $name;
            }
        }
        // Array de meses para el filtro
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
    @endphp

    {{-- FORMULARIO DE FILTROS --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Filtros de Búsqueda</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.auditoria.index') }}" id="filterForm">
                <div class="row">
                    {{-- Filtro por Rol --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role_id">1. Filtrar por Rol:</label>
                            <select name="role_id" id="role_id" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Seleccione un Rol --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $selectedRole == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Filtro por Usuario (solo aparece si se seleccionó un rol) --}}
                    @if ($selectedRole)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">2. Filtrar por Usuario:</label>
                                <select name="user_id" id="user_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Todos los Usuarios de este Rol --</option>
                                    @foreach ($usersInRole as $user)
                                        <option value="{{ $user->id }}" {{ $selectedUser == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    {{-- Filtro por Módulo --}}
                    @if ($selectedRole)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="module">3. Filtrar por Módulo:</label>
                                <select name="module" id="module" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Todos los Módulos --</option>
                                    @foreach ($modules as $moduleName)
                                        <option value="{{ $moduleName }}" {{ $selectedModule == $moduleName ? 'selected' : '' }}>
                                            {{ $moduleName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Nueva fila para el filtro de ID de Registro y Fecha --}}
                @if ($selectedRole)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="auditable_id">4. Filtrar por ID de Registro:</label>
                                <input type="number" name="auditable_id" id="auditable_id" class="form-control" placeholder="Escriba el ID exacto" value="{{ $selectedAuditableId ?? '' }}">
                            </div>
                        </div>
                        {{-- ======================= INICIO DEL CAMBIO ======================= --}}
                        <div class="col-md-2">
                             <div class="form-group">
                                <label for="year">Año:</label>
                                <input type="number" name="year" id="year" class="form-control" placeholder="Ej: {{ date('Y') }}" value="{{ $selectedYear ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                             <div class="form-group">
                                <label for="month">Mes:</label>
                                <select name="month" id="month" class="form-control">
                                    <option value="">-- Todos --</option>
                                    @foreach ($meses as $num => $nombre)
                                        <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                             <div class="form-group">
                                <label for="day">Día:</label>
                                <input type="number" name="day" id="day" class="form-control" placeholder="Ej: 15" value="{{ $selectedDay ?? '' }}">
                            </div>
                        </div>
                        {{-- ======================== FIN DEL CAMBIO ======================== --}}
                    </div>
                @endif

                <div class="row mt-3">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="{{ route('admin.auditoria.index') }}" class="btn btn-secondary">Limpiar Filtros</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLA DE RESULTADOS --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Usuario</th>
                            <th>Evento</th>
                            <th>Área Afectada</th>
                            <th>ID del Registro</th>
                            <th>Detalles de Cambios</th>
                            <th>Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($audits as $audit)
                            <tr>
                                <td>{{ $audit->user->name ?? 'Sistema' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($audit->event == 'created') bg-success 
                                        @elseif($audit->event == 'updated') bg-warning text-dark
                                        @elseif($audit->event == 'deleted') bg-danger 
                                        @endif">
                                        
                                        @if($audit->event == 'created')
                                            Creado
                                        @elseif($audit->event == 'updated')
                                            Actualizado
                                        @elseif($audit->event == 'deleted')
                                            Eliminado
                                        @else
                                            {{ ucfirst($audit->event) }}
                                        @endif
                                    </span>
                                </td>
                                <td>{{ class_basename($audit->auditable_type) }}</td>
                                <td>{{ $audit->auditable_id }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" type="button" data-toggle="collapse" data-target="#collapse{{ $audit->id }}" aria-expanded="false" aria-controls="collapse{{ $audit->id }}">
                                        Ver Detalles
                                    </button>
                                    <div class="collapse mt-2" id="collapse{{ $audit->id }}">
                                        <div class="card card-body mt-2">
                                            @php
                                                $oldValues = $audit->old_values;
                                                $newValues = $audit->new_values;
                                            @endphp

                                            @if ($audit->event == 'created')
                                                <h6>Datos del Nuevo Registro:</h6>
                                                @foreach ($newValues as $key => $value)
                                                    @php
                                                        $displayValue = str_ends_with($key, '_id') ? getRelatedName($key, $value) : $value;
                                                    @endphp
                                                    <p class="mb-1"><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $displayValue }}</p>
                                                @endforeach
                                            @elseif ($audit->event == 'updated')
                                                <h6>Cambios Realizados:</h6>
                                                @foreach ($newValues as $key => $value)
                                                    @if (isset($oldValues[$key]) && $oldValues[$key] != $value)
                                                        @php
                                                            $oldDisplayValue = str_ends_with($key, '_id') ? getRelatedName($key, $oldValues[$key]) : $oldValues[$key];
                                                            $newDisplayValue = str_ends_with($key, '_id') ? getRelatedName($key, $value) : $value;
                                                        @endphp
                                                        <p class="mb-1">
                                                            <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                            <del class="text-danger">{{ $oldDisplayValue }}</del> &#10142; 
                                                            <ins class="text-success">{{ $newDisplayValue }}</ins>
                                                        </p>
                                                    @endif
                                                @endforeach
                                            @elseif ($audit->event == 'deleted')
                                                <h6>Datos del Registro Eliminado:</h6>
                                                @foreach ($oldValues as $key => $value)
                                                    @php
                                                        $displayValue = str_ends_with($key, '_id') ? getRelatedName($key, $value) : $value;
                                                    @endphp
                                                    <p class="mb-1"><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $displayValue }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron registros o no se ha seleccionado un rol.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
             {{ $audits->links() }}
        </div>
    </div>
@stop
