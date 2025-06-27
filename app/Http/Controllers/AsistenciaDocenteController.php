<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaDocente;
use App\Models\Asignacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaDocenteController extends Controller
{
    /**
     * Guarda una nueva asistencia para el docente.
     * Esta es la versión mejorada que valida duplicados y horarios.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:asignaciones,id',
            'estado' => 'required|string|in:PRESENTE',
            'observacion' => 'nullable|string|max:255',
        ]);

        $asignacion = Asignacion::find($request->asignacion_id);

        if ($asignacion->hasAttendanceToday()) {
            return redirect()->back()->with('error', 'La asistencia para este curso ya fue registrada hoy.');
        }
        
        if (!$asignacion->isAttendanceMarkingActive()) {
            return redirect()->back()->with('error', 'No se puede registrar asistencia fuera del horario permitido.');
        }

        AsistenciaDocente::create([
            'asignacion_id' => $request->asignacion_id,
            'personal_id' => Auth::user()->personal->id,
            'estado' => $request->estado,
            'observacion' => $request->observacion,
        ]);

        return redirect()->back()->with('success', '¡Asistencia registrada correctamente!');
    }

    /**
     * Muestra las asistencias de un docente para una asignación específica.
     * Esta es la función que faltaba.
     */
    public function show($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $asistencias = AsistenciaDocente::where('asignacion_id', $id)->orderBy('created_at', 'desc')->get();

        return view('admin.asistencias.show_docente', compact('asignacion', 'asistencias'));
    }

    /**
     * Muestra el formulario para editar una asistencia de docente.
     * Esta es una de las funciones que faltaban.
     */
    public function edit($id)
    {
        $asistencia = AsistenciaDocente::findOrFail($id);
        return view('admin.asistencias.edit_docente', compact('asistencia'));
    }

    /**
     * Actualiza una asistencia de docente en la base de datos.
     * Esta es una de las funciones que faltaban.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|in:PRESENTE,FALTA,TARDANZA,FJ',
            'observacion' => 'nullable|string|max:255',
        ]);

        $asistencia = AsistenciaDocente::findOrFail($id);
        // Asumiendo que tu modelo tiene una columna 'fecha' que se puede actualizar.
        // Si la fecha es 'created_at', esta lógica puede necesitar un ajuste.
        $asistencia->update($request->only(['fecha', 'estado', 'observacion']));

        return redirect()->route('admin.asistencias-docente.show', $asistencia->asignacion_id)
            ->with('success', '¡Asistencia actualizada correctamente!');
    }

    /**
     * Elimina una asistencia de docente.
     * Esta es una de las funciones que faltaban.
     */
    public function destroy($id)
    {
        $asistencia = AsistenciaDocente::findOrFail($id);
        $asistencia->delete();

        return redirect()->back()->with('success', 'Asistencia eliminada correctamente.');
    }
}