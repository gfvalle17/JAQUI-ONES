<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\AsistenciaDocente;

class Asignacion extends Model
{
    use HasFactory;

    // Eliminamos la propiedad $with para tener más control en el controlador.
    // protected $with = [...];

    protected $guarded = [];

    // --- RELACIONES (VERSIÓN CORREGIDA Y EXPLÍCITA) ---

    public function personal()
    {
        // Le decimos explícitamente que la llave foránea es 'personal_id'.
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }

    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class, 'paralelo_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'asignacion_id');
    }

    // --- FUNCIONES DE LÓGICA DE ASISTENCIA (SIN CAMBIOS) ---

    public function hasAttendanceToday()
    {
        $timezone = 'America/Lima';
        return AsistenciaDocente::where('asignacion_id', $this->id)
                                ->whereDate('created_at', Carbon::today($timezone))
                                ->exists();
    }

    public function isAttendanceMarkingActive()
    {
        if ($this->hasAttendanceToday()) {
            return false;
        }
        try {
            $timezone = 'America/Lima';
            $now = Carbon::now($timezone);
            $todayWeekDay = $now->dayOfWeekIso;
            $horarioDeHoy = $this->horarios()->where('dia_semana', $todayWeekDay)->first();

            if (!$horarioDeHoy) return false;
            
            $horaInicio = Carbon::parse($horarioDeHoy->hora_inicio, $timezone)->subMinutes(15);
            $horaFin = Carbon::parse($horarioDeHoy->hora_fin, $timezone)->addMinutes(10);

            return $now->between($horaInicio, $horaFin);
        } catch (\Exception $e) {
            return false;
        }
    }
}