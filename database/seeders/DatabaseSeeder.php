<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use App\Models\Gestion;
use App\Models\Grado;
use App\Models\Materia;
use App\Models\Nivel;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\Ppff;
use App\Models\Turno;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);        

        User::create([
            'name' => 'Gonzalo Francia',
            'email' => 'gfvalle17@gmail.com',
            'password' => Hash::make('12345678')
        ])->assignRole('ADMINISTRADOR');

        Configuracion::create([
            'nombre' => 'Colegio Privado José Abelardo Quiñones',
            'descripcion' => 'Colegio Privado',
            'direccion' => 'Calle San Pedro Mz A Lt 10, Mala 15608',
            'telefono' => '934 207 887',
            'divisa' => 'S/.',
            'correo_electronico' => 'admision@jaq.edu.pe',
            'web' => 'https://colegio-quiñones.edu.pe',
            'logo' => 'uploads/logos/1748622478_insignia.jpg'        
        ]);

        Gestion::create(['nombre' => '2025',]);

        Periodo::create(['nombre' => '1ER TRIMESTRE','gestion_id' => 1]);
        Periodo::create(['nombre' => '2ER TRIMESTRE','gestion_id' => 1]);
        Periodo::create(['nombre' => '3ER TRIMESTRE','gestion_id' => 1]);

        Nivel::create(['nombre' => 'INICIAL']);
        Nivel::create(['nombre' => 'PRIMARIA']);
        Nivel::create(['nombre' => 'SECUNDARIA']);

        Turno::create(['nombre' => 'MAÑANA']);

        Materia::create(['nombre' => 'LENGUA CASTELLANA Y ORIGINARIA']);
        Materia::create(['nombre' => 'LENGUA EXTRANJERA']);
        Materia::create(['nombre' => 'MATEMÁTICA']);
        Materia::create(['nombre' => 'QUÍMICA']);
        Materia::create(['nombre' => 'VALORES, ESPIRITUALIDADES Y RELIGIONES']);
        Materia::create(['nombre' => 'TÉCNICA, TECNOLÓGICA GENERAL']);


    }
}