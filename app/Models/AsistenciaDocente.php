<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsistenciaDocente extends Model
{
    protected $fillable = ['personal_id', 'asignacion_id', 'fecha', 'estado', 'observacion'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }
}

