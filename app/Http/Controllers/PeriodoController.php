<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\Periodo;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestiones = Gestion::with('periodos')
        ->orderBy('nombre', 'asc')
        ->get();
        return view('admin.periodos.index', compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
            $request->validate([
            'nombre' => 'required|string|max:255',
            'gestion_id_create' => 'required|exists:gestions,id',
        ]);

        $periodo = new Periodo();
        $periodo->nombre = $request->nombre;
        $periodo->gestion_id = $request->gestion_id_create;
        $periodo->save();
        
        return redirect()->route('admin.periodos.index')
        ->with('mensaje', 'El periodo se ha creado correctamente')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);
       $request->validate([
            'gestion_id' => 'required|exists:gestions,id',
            'nombre' => 'required|string|max:255',
       ]);
        $periodo = Periodo::find($id);
        $periodo->nombre = $request->nombre;
        $periodo->gestion_id = $request->gestion_id;
        $periodo->save();

        return redirect()->route('admin.periodos.index')
        ->with('mensaje', 'El periodo se ha actualizado correctamente')
        ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periodo = Periodo::find($id);
        $periodo->delete();

        return redirect()->route('admin.periodos.index')
        ->with('mensaje', 'El periodo se ha eliminado correctamente')
        ->with('icono', 'success');
    }
}
