<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use Carbon\Carbon;

class HorarioController extends Controller
{
    public function vistaDiaria(Request $request)
    {
        // Validamos que nos llegue una fecha
        $request->validate(['fecha' => 'required|date']);

        $fechaSeleccionada = Carbon::parse($request->fecha);
        $diaDeLaSemana = $fechaSeleccionada->dayOfWeekIso; // 1 para Lunes, 7 para Domingo

        // Buscamos todas las asignaciones que tengan un horario en el día de la semana seleccionado
        $asignacionesDelDia = Asignacion::whereHas('horarios', function ($query) use ($diaDeLaSemana) {
            $query->where('dia_semana', $diaDeLaSemana);
        })->with([
            'materia', 
            'personal.user', 
            'grado',
            // Cargamos solo el horario que corresponde a ese día para ordenarlo
            'horarios' => function($query) use ($diaDeLaSemana) {
                $query->where('dia_semana', $diaDeLaSemana);
            }
        ])->get()
        // Ordenamos la colección final por la hora de inicio del horario
        ->sortBy(function($asignacion) {
            return $asignacion->horarios->first()->hora_inicio;
        });

        // Pasamos los datos a una nueva vista que vamos a crear
        return view('admin.horarios.vista_diaria', [
            'asignaciones' => $asignacionesDelDia,
            'fecha' => $fechaSeleccionada
        ]);
    }
}