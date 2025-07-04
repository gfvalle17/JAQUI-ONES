<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\AsistenciaDocente;
// 1. IMPORTAMOS EL CONTRATO DE AUDITORÍA
use OwenIt\Auditing\Contracts\Auditable;

// 2. IMPLEMENTAMOS EL CONTRATO EN LA CLASE
class Asignacion extends Model implements Auditable
{
    use HasFactory;
    // 3. USAMOS EL TRAIT QUE HACE TODA LA MAGIA
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    // --- RELACIONES ---

    public function personal()
    {
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

    // --- FUNCIONES DE LÓGICA DE ASISTENCIA ---

    public function hasAttendanceToday()
    {
        $timezone = 'America/Lima';
        return AsistenciaDocente::where('asignacion_id', $this->id)
                                ->whereDate('created_at', Carbon::today($timezone))
                                ->exists();
    }

    /**
     * Verifica si la asistencia se puede marcar en el momento actual.
     * VERSIÓN CORREGIDA CON ZONA HORARIA.
     */
    public function isAttendanceMarkingActive(): bool
    {
        $now = Carbon::now('America/Lima');
        
        // Carbon usa 1 para Lunes y 7 para Domingo. IsoFormat('E') devuelve esto.
        $currentDayOfWeek = $now->isoFormat('E');
        $currentTime = $now->format('H:i:s');

        // Busca si existe algún horario para el día de hoy
        // que coincida con la hora actual.
        $activeSchedule = $this->horarios()
            ->where('dia_semana', $currentDayOfWeek)
            ->where('hora_inicio', '<=', $currentTime)
            ->where('hora_fin', '>=', $currentTime)
            ->exists();

        return $activeSchedule;
    }
}