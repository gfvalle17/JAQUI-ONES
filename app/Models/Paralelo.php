<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Paralelo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'paralelos';

    protected $fillable = [
        'nombre',
        'grado_id'
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function matriculaciones(){
        return $this->hasMany(Matriculacion::class);
    }

    public function asignaciones(){
        return $this->hasMany(Matriculacion::class);
    }
}
