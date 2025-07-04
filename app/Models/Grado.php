<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Grado extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'grados';

    protected $fillable = [
        'nombre',
        'nivel_id',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function paralelos()
    {
        return $this->hasMany(Paralelo::class);
    }

    public function matriculaciones(){
        return $this->hasMany(Matriculacion::class);
    }

    public function asignaciones(){
        return $this->hasMany(Matriculacion::class);
    }
}
