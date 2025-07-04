<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Matriculacion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
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
}
