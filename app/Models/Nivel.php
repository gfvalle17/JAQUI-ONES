<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Nivel extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'nivels';
    protected $fillable = ['nombre'];

    public function grados()
    {
        return $this->hasMany(Grado::class);
    }

    public function matriculaciones(){
        return $this->hasMany(Matriculacion::class);
    }

    public function asignaciones(){
        return $this->hasMany(Matriculacion::class);
    }
}
