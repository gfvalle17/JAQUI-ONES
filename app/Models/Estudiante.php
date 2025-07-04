<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Estudiante extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'estudiantes'; 
    public $timestamps = false;
    public function ppff(){
        return $this->belongsTo(Ppff::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function matriculaciones(){
        return $this->hasMany(Matriculacion::class);
    }
}
