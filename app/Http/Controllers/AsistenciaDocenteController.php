<?php

namespace App\Http\Controllers;
use App\Models\AsistenciaDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaDocenteController extends Controller
{
    public function store(Request $request)
    {
        // Primero, buscamos la asignación
        $asignacion = \App\Models\Asignacion::findOrFail($request->asignacion_id);

        // VALIDACIÓN DE SEGURIDAD: Usamos la función que creamos en el modelo
        if (!$asignacion->isAttendanceMarkingActive()) {
            return back()->with('error', 'No se puede registrar asistencia fuera del horario permitido.');
        }

        // Simplificamos la validación
        $request->validate([
            'asignacion_id' => 'required',
            'estado' => 'required|in:PRESENTE,FALTA,TARDANZA,FJ',
            'observacion' => 'nullable|string|max:255'
        ]);

        // Creamos la asistencia. La fecha se establece automáticamente a hoy.
        AsistenciaDocente::create([
            'personal_id' => Auth::user()->personal->id,
            'asignacion_id' => $request->asignacion_id,
            'fecha' => now(), // Laravel usará la fecha actual
            'estado' => $request->estado,
            'observacion' => $request->observacion,
        ]);

        return back()->with('success', '¡Asistencia registrada correctamente!');
    }

    public function show($id)
    {
        $asignacion = \App\Models\Asignacion::findOrFail($id);
        $asistencias = \App\Models\AsistenciaDocente::where('asignacion_id', $id)->orderBy('fecha')->get();

        return view('admin.asistencias.show_docente', compact('asignacion', 'asistencias'));
    }

    public function edit($id)
    {
        $asistencia = AsistenciaDocente::findOrFail($id);
        return view('admin.asistencias.edit_docente', compact('asistencia'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|in:PRESENTE,FALTA,TARDANZA,FJ',
            'observacion' => 'nullable|string|max:255',
        ]);

        $asistencia = AsistenciaDocente::findOrFail($id);
        $asistencia->update($request->only(['fecha', 'estado', 'observacion']));

        return redirect()->route('admin.asistencias-docente.show', $asistencia->asignacion_id)
        ->with('success', '¡Asistencia actualizada correctamente!');
    }

    public function destroy($id)
    {
        $asistencia = AsistenciaDocente::findOrFail($id);
        $asistencia->delete();

        return redirect()->back()->with('success', 'Asistencia eliminada correctamente.');
    }


}
