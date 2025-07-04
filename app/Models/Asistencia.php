<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Asistencia extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }

    public function detalleAsistencias()
    {
        return $this->hasMany(DetalleAsistencia::class);
    }
}
