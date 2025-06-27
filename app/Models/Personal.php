<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use App\Models\User;

class Personal extends Model
{
    protected $fillable = [
        'usuario_id',
        'tipo',
        'nombres',
        'apellidos',
        'ci',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'profesion',
        'foto',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function formaciones()
    {
        return $this->hasMany(Formacion::class,'personal_id');
    }

    public function asignaciones(){
        return $this->hasMany(Matriculacion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
