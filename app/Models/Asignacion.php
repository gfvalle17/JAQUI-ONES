<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // <-- 1. ASEGÚRATE DE AÑADIR ESTA LÍNEA

class Asignacion extends Model
{
    // --- Todo tu código original se mantiene ---
    public function personal(){
        return $this->belongsTo(Personal::class);
    }

    public function turno(){
        return $this->belongsTo(Turno::class);
    }

    public function gestion(){
        return $this->belongsTo(Gestion::class);
    }

    public function nivel(){
        return $this->belongsTo(Nivel::class);
    }

    public function grado(){
        return $this->belongsTo(Grado::class);
    }

    public function paralelo(){
        return $this->belongsTo(Paralelo::class);
    }

    public function materia(){
        return $this->belongsTo(Materia::class);
    }

    public function matriculaciones(){
        return $this->hasMany(Matriculacion::class);
    }

    public function asistencias(){
        return $this->hasMany(Asistencia::class);
    }

    public function asistenciasDocentes()
    {
        return $this->hasMany(AsistenciaDocente::class);
    }

    // --- CÓDIGO NUEVO QUE DEBES AÑADIR ---

    /**
     * 2. RELACIÓN: Una asignación puede tener muchos horarios.
     */
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    /**
     * 3. FUNCIÓN CLAVE: Verifica si la asistencia se puede marcar AHORA.
     * Devuelve true si está en horario, false si no.
     */
    public function isAttendanceMarkingActive()
    {
        // --- NO CAMBIOS AQUÍ ---
        $now = Carbon::now('America/Lima');
        $todayWeekDay = $now->dayOfWeekIso;

        $minutosAntes = 15;
        $minutosDespues = 10;

        $horarioDeHoy = $this->horarios()->where('dia_semana', $todayWeekDay)->first();

        if (!$horarioDeHoy) {
            return false;
        }

        // --- INICIO DE LA LÓGICA CORREGIDA ---

        // Creamos objetos Carbon para poder comparar correctamente
        $horaInicio = Carbon::parse($horarioDeHoy->hora_inicio);
        $horaFin = Carbon::parse($horarioDeHoy->hora_fin);

        // Aplicamos la tolerancia
        $inicioPermitido = $horaInicio->subMinutes($minutosAntes);
        $finPermitido = $horaFin->addMinutes($minutosDespues);

        // Verificamos si el rango cruza la medianoche (ej: de 22:00 a 02:00)
        if ($inicioPermitido->gt($finPermitido)) { 
            // Si cruza la medianoche, la hora actual debe ser mayor al inicio O menor que el fin
            return $now->gte($inicioPermitido) || $now->lte($finPermitido);
        }

        // Si es un horario normal (en el mismo día), usamos 'between'
        return $now->between($inicioPermitido, $finPermitido);
    }
}