<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Asistencia;
use App\Models\Matriculacion;
use App\Models\Personal;
use App\Models\DetalleAsistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rol = Auth::user()->roles->pluck('name')->implode(', ');
        $id_usuario = Auth::user()->id;

        if( ($rol == 'ADMINISTRADOR') || ($rol == 'DIRECTOR') ){
            $asignaciones = Asignacion::all();
            return view('admin.asistencias.index', compact('asignaciones'));
        }

        if($rol == 'DOCENTE'){
            Carbon::setLocale('es');
            $fechaActual = Carbon::now('America/Lima')->translatedFormat('l, d \de F \de Y');
            $docente = Personal::where('usuario_id', $id_usuario)->first();
            $asignaciones = Asignacion::where('personal_id', $docente->id)->get();

            $asignacion_ids = $asignaciones->pluck('id');

            $asistenciasHoy = Asistencia::whereIn('asignacion_id', $asignacion_ids)
                                        ->whereDate('fecha', Carbon::today('America/Lima'))
                                        ->pluck('asignacion_id')
                                        ->unique()
                                        ->toArray();

            return view('admin.asistencias.index_docente', compact('docente', 'asignaciones', 'fechaActual', 'asistenciasHoy'));
        }

        if($rol == 'ESTUDIANTE'){
            return view('admin.asistencias.index_estudiante');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $docente = Personal::where('usuario_id', Auth::user()->id)->first();
        $asistencias = Asistencia::with('detalleAsistencias')->where('asignacion_id', $id)->get();

        $matriculados = Matriculacion::with('estudiante') 
        ->where('turno_id',$asignacion->turno_id)
        ->where('gestion_id', $asignacion->gestion_id)
        ->where('nivel_id', $asignacion->nivel_id)
        ->where('grado_id', $asignacion->grado_id)
        ->where('paralelo_id', $asignacion->paralelo_id)
        ->get()
        ->sortBy('estudiante.apellidos');

        return view('admin.asistencias.create', compact('asignacion','docente','asistencias','matriculados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required',
            'fecha' => 'required|date',
            'observacion' => 'nullable|string|max:255',
            'estado_asistencia' => 'required',
        ]);

        $asistencia = new Asistencia();
        $asistencia->asignacion_id = $request->asignacion_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->observacion = $request->observacion;
        $asistencia->save();

        $estado_asistencia = $request->estado_asistencia;

        foreach ($estado_asistencia as $estudiante_id => $estado){
            DetalleAsistencia::create([
                'asistencia_id' => $asistencia->id,
                'estudiante_id' => $estudiante_id,
                'estado_asistencia' => $estado,
            ]);
        }

        return redirect()->back()
        ->with('mensaje', 'Se registró la asistencia')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asignacion = Asignacion::findOrFail($id);

        $asistencias = Asistencia::with('detalleAsistencias.estudiante')
                                ->where('asignacion_id', $id)
                                ->orderBy('fecha', 'desc')
                                ->get();

        return view('admin.asistencias.show', compact('asistencias', 'asignacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asistencia = Asistencia::with('detalleAsistencias.estudiante', 'asignacion')->findOrFail($id);
        
        return view('admin.asistencias.edit', compact('asistencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'asignacion_id' => 'required',
            'fecha' => 'required|date',
            'observacion' => 'nullable|string|max:255',
            'estado_asistencia' => 'required',
        ]);

        $asistencia = Asistencia::findOrFail($id);
        $asistencia->asignacion_id = $request->asignacion_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->observacion = $request->observacion;
        $asistencia->save();

        $estado_asistencia = $request->estado_asistencia;

        foreach ($estado_asistencia as $estudiante_id => $estado){
            DetalleAsistencia::where('asistencia_id', $asistencia->id)
            ->where('estudiante_id', $estudiante_id)
            ->update(['estado_asistencia' => $estado]);
        }

        // ======================= ESTA ES LA LÍNEA CORREGIDA =======================
        // Redirige a la vista del "Historial de asistencias" (la que usas como 'show').
        return redirect()->route('admin.asistencias.show', $asistencia->asignacion_id)
                         ->with('mensaje', 'Se actualizó la asistencia correctamente')
                         ->with('icono', 'success');
        // =========================================================================
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->detalleAsistencias()->delete();
        $asistencia->delete();

        return redirect()->back()
        ->with('mensaje', 'Se eliminó la asistencia')
        ->with('icono', 'success');
    }
}
