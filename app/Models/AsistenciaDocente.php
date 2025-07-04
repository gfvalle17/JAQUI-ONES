<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AsistenciaDocente extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
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

