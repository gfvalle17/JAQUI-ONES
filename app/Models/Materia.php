<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Materia extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'materias';
    protected $fillable = [
        'nombre',
    ];

    public function asignaciones(){
        return $this->hasMany(Matriculacion::class);
    }
}
