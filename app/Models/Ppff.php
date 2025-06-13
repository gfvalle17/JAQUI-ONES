<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppff extends Model
{
    public function estudiantes(){
        return $this->hasMany(Estudiante::class);
    }
}
