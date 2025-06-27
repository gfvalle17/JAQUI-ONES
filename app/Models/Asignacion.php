<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\AsistenciaDocente;

class Asignacion extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- RELACIONES ---

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    // --- FUNCIONES DE LÓGICA DE ASISTENCIA ---

    /**
     * Verifica si ya existe un registro de asistencia para esta
     * asignación en la fecha actual.
     */
    public function hasAttendanceToday()
    {
        $timezone = 'America/Lima'; // O la zona horaria de tu país
        // Usamos whereDate para comparar solo la parte de la fecha (YYYY-MM-DD)
        return AsistenciaDocente::where('asignacion_id', $this->id)
                                ->whereDate('created_at', Carbon::today($timezone))
                                ->exists();
    }

    /**
     * Revisa si el botón de "Mi asistencia" debe estar activo.
     * Solo se activa si está en horario Y si no se ha marcado ya la asistencia.
     */
    public function isAttendanceMarkingActive()
    {
        // PRIMERA VERIFICACIÓN: Si ya se marcó hoy, no puede estar activo.
        if ($this->hasAttendanceToday()) {
            return false;
        }

        // SEGUNDA VERIFICACIÓN: Revisa si está dentro del horario permitido.
        try {
            $timezone = 'America/Lima';
            $now = Carbon::now($timezone);
            $todayWeekDay = $now->dayOfWeekIso; // 1 para Lunes, 7 para Domingo

            $horarioDeHoy = $this->horarios()->where('dia_semana', $todayWeekDay)->first();

            if (!$horarioDeHoy) {
                return false;
            }

            $minutosAntes = 15;
            $minutosDespues = 10;

            $horaInicio = Carbon::parse($horarioDeHoy->hora_inicio, $timezone);
            $horaFin = Carbon::parse($horarioDeHoy->hora_fin, $timezone);

            return $now->between(
                $horaInicio->subMinutes($minutosAntes),
                $horaFin->addMinutes($minutosDespues)
            );
        } catch (\Exception $e) {
            // Si algo falla, devolvemos false por seguridad.
            return false;
        }
    }
}