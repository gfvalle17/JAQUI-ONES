<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $fillable = ['logo','nombre','descripcion','direccion', 'telefono','divisa','correo_electronico'];
}
