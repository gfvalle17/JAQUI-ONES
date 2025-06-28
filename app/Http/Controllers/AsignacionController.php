<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Materia;
use App\Models\Matriculacion;
use App\Models\Nivel;
use App\Models\Personal;
use App\Models\Turno;
use App\Models\Grado;  
use App\Models\Paralelo;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaciones = Asignacion::with('personal','turno','gestion','nivel','grado','paralelo','materia')->get();
        return view('admin.asignaciones.index', compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gestiones = Gestion::all();
        $niveles = Nivel::all();
        $turnos = Turno::all();
        $docentes = Personal::where('tipo', 'docente')->get();
        $materias = Materia::all();
        return view('admin.asignaciones.create', compact('docentes','turnos','gestiones','niveles','materias'));
    }

    public function buscar_docente($id)
    {
        $docente = Personal::with('usuario','formaciones')->find($id);

       if(!$docente){
            return response()->json(['error','Docente no encontrado']);
        }

        $docente->foto_url = url($docente->foto);
        return response()->json($docente);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'personal_id' => 'required',
            'turno_id' => 'required',
            'gestion_id' => 'required',
            'nivel_id' => 'required',
            'grado_id' => 'required',
            'paralelo_id' => 'required',
            'fecha_asignacion' => 'required',
            'materia_id' => 'required',
        ]);
        
        //validacion para estudiantes ya matriculados
        $asignacion_duplicado = Asignacion::where('personal_id',$request->personal_id)
        ->where('turno_id',$request->turno_id)
        ->where('gestion_id',$request->gestion_id)
        ->where('nivel_id',$request->nivel_id)
        ->where('grado_id',$request->grado_id)
        ->where('paralelo_id',$request->paralelo_id)
        ->where('materia_id',$request->materia_id)
        ->exists();

        if($asignacion_duplicado){
            return redirect()->back()->with([
                'mensaje' => 'El docente ya tiene la asignación en el turno, gestión, nivel, grado y paralelo',
                'Icono' => 'error',
            ]);
        }
        $asignacion = new Asignacion();
        $asignacion->personal_id = $request->personal_id;
        $asignacion->turno_id = $request->turno_id;
        $asignacion->gestion_id = $request->gestion_id;
        $asignacion->nivel_id = $request->nivel_id;
        $asignacion->grado_id = $request->grado_id;
        $asignacion->paralelo_id = $request->paralelo_id;
        $asignacion->fecha_asignacion = $request->fecha_asignacion;
        $asignacion->materia_id = $request->materia_id;
        $asignacion->save();

        return redirect()->route('admin.asignaciones.index')->with([
            'mensaje' => 'Asignacion creada correctamente',
            'icono' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignacion $asignacione)
    {
        $asignacione->load('personal', 'materia', 'turno', 'gestion', 'nivel', 'grado', 'paralelo');
        return view('admin.asignaciones.show', compact('asignacione'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignacion $asignacione)
    {
        $gestiones = Gestion::all();
        $niveles = Nivel::all();
        $turnos = Turno::all();
        $docentes = Personal::where('tipo', 'docente')->get();
        $materias = Materia::all();
        return view('admin.asignaciones.edit', compact('asignacione', 'docentes', 'turnos', 'gestiones', 'niveles', 'materias'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignacion $asignacione)
    {
        $request->validate([
            'personal_id' => 'required',
            'turno_id' => 'required',
            'gestion_id' => 'required',
            'nivel_id' => 'required',
            'grado_id' => 'required',
            'paralelo_id' => 'required',
            'fecha_asignacion' => 'required|date',
            'materia_id' => 'required',
        ]);

        $asignacione->update($request->all());

        return redirect()->route('admin.asignaciones.index')->with([
            'mensaje' => 'Asignación actualizada correctamente',
            'icono' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignacion $asignacione)
    {
        $asignacione->delete();

        return redirect()->route('admin.asignaciones.index')->with([
            'mensaje' => 'Asignación eliminada correctamente',
            'icono' => 'success',
        ]);
    }

    public function getGrados($nivel_id)
    {
        $grados = Grado::where('nivel_id', $nivel_id)->pluck('nombre', 'id');
        return response()->json($grados);
    }

    /**
     * Devuelve los paralelos de un grado en formato JSON para AJAX.
     */
    public function getParalelos($grado_id)
    {
        $paralelos = Paralelo::where('grado_id', $grado_id)->pluck('nombre', 'id');
        return response()->json($paralelos);
    }
}