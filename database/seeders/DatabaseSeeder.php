<?php

namespace Database\Seeders;

use App\Models\Asignacion;
use App\Models\Configuracion;
use App\Models\Gestion;
use App\Models\Grado;
use App\Models\Materia;
use App\Models\Nivel;
use App\Models\Paralelo;
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

        $inicial = Nivel::create(['nombre' => 'INICIAL']);
        $primaria = Nivel::create(['nombre' => 'PRIMARIA']);
        $secundaria = Nivel::create(['nombre' => 'SECUNDARIA']);

        $grado1 = Grado::create(['nombre' => '3 AÑOS', 'nivel_id' => $inicial->id]);
        $grado2 = Grado::create(['nombre' => '4 AÑOS', 'nivel_id' => $inicial->id]);
        $grado3 = Grado::create(['nombre' => '5 AÑOS', 'nivel_id' => $inicial->id]);
        $grado4 = Grado::create(['nombre' => '1ERO PRIMARIA', 'nivel_id' => $primaria->id]);
        $grado5 = Grado::create(['nombre' => '2DO PRIMARIA', 'nivel_id' => $primaria->id]);
        $grado6 = Grado::create(['nombre' => '3ERO PRIMARIA', 'nivel_id' => $primaria->id]);
        $grado7 = Grado::create(['nombre' => '4TO PRIMARIA', 'nivel_id' => $primaria->id]);
        $grado8 = Grado::create(['nombre' => '5TO PRIMARIA', 'nivel_id' => $primaria->id]);
        $grado9 = Grado::create(['nombre' => '6TO PRIMARIA', 'nivel_id' => $primaria->id]);
        $grado10 = Grado::create(['nombre' => '1ERO SECUNDARIA', 'nivel_id' => $secundaria->id]);
        $grado11 = Grado::create(['nombre' => '2DO SECUNDARIA', 'nivel_id' => $secundaria->id]);
        $grado12 = Grado::create(['nombre' => '3ERO SECUNDARIA', 'nivel_id' => $secundaria->id]);
        $grado13 = Grado::create(['nombre' => '4TO SECUNDARIA', 'nivel_id' => $secundaria->id]);
        $grado14 = Grado::create(['nombre' => '5TO SECUNDARIA', 'nivel_id' => $secundaria->id]);

        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado1->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado1->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado2->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado2->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado3->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado3->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado4->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado4->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado5->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado5->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado6->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado6->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado7->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado7->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado8->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado8->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado9->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado9->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado10->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado10->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado11->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado11->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado12->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado12->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado13->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado13->id]);
        Paralelo::create(['nombre' => 'A', 'grado_id' => $grado14->id]);
        Paralelo::create(['nombre' => 'B', 'grado_id' => $grado14->id]);

        Turno::create(['nombre' => 'MAÑANA']);

        Materia::create(['nombre' => 'LENGUA CASTELLANA Y ORIGINARIA']);
        Materia::create(['nombre' => 'LENGUA EXTRANJERA']);
        Materia::create(['nombre' => 'MATEMÁTICA']);
        Materia::create(['nombre' => 'QUÍMICA']);
        Materia::create(['nombre' => 'VALORES, ESPIRITUALIDADES Y RELIGIONES']);
        Materia::create(['nombre' => 'TÉCNICA, TECNOLÓGICA GENERAL']);


        //DOCENTES
        $usuario = User::create([
        'name' => 'Angel Siccha',
        'email' => 'angel.siccha@jaq.com',
        'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Angel',
            'apellidos' => 'Siccha',
            'ci' => '78767890',
            'fecha_nacimiento' => '2004-11-12',
            'direccion' => 'Mala',
            'telefono' => '987898765',
            'profesion' => 'Ing. de Sistemas',
            'foto' => 'uploads/fotos/' . time() . '_ana.jpg',
        ]);

        $usuario = User::create([
        'name' => 'Lucía Vargas',
        'email' => 'lucia.vargas@jaq.com',
        'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Lucía',
            'apellidos' => 'Vargas',
            'ci' => '71234567',
            'fecha_nacimiento' => '1990-03-25',
            'direccion' => 'Calango',
            'telefono' => '987654321',
            'profesion' => 'Lic. en Educación Primaria',
            'foto' => 'uploads/fotos/' . time() . '_lucia.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Carlos Núñez',
            'email' => 'carlos.nunez@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Carlos',
            'apellidos' => 'Núñez',
            'ci' => '72345678',
            'fecha_nacimiento' => '1985-06-15',
            'direccion' => 'Asia',
            'telefono' => '912345678',
            'profesion' => 'Profesor de Matemática',
            'foto' => 'uploads/fotos/' . time() . '_carlos.jpg',
        ]);

        $usuario = User::create([
            'name' => 'María Torres',
            'email' => 'maria.torres@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'María',
            'apellidos' => 'Torres',
            'ci' => '73456789',
            'fecha_nacimiento' => '1987-01-10',
            'direccion' => 'San Antonio',
            'telefono' => '923456789',
            'profesion' => 'Lic. en Ciencias Sociales',
            'foto' => 'uploads/fotos/' . time() . '_maria.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Pedro García',
            'email' => 'pedro.garcia@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Pedro',
            'apellidos' => 'García',
            'ci' => '74567890',
            'fecha_nacimiento' => '1992-07-20',
            'direccion' => 'Mala',
            'telefono' => '934567890',
            'profesion' => 'Profesor de Química',
            'foto' => 'uploads/fotos/' . time() . '_pedro.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Sofía Mendoza',
            'email' => 'sofia.mendoza@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Sofía',
            'apellidos' => 'Mendoza',
            'ci' => '75678901',
            'fecha_nacimiento' => '1995-02-05',
            'direccion' => 'Santa Cruz de Flores',
            'telefono' => '945678901',
            'profesion' => 'Lic. en Lenguas',
            'foto' => 'uploads/fotos/' . time() . '_sofia.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Luis Fernández',
            'email' => 'luis.fernandez@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Luis',
            'apellidos' => 'Fernández',
            'ci' => '76789012',
            'fecha_nacimiento' => '1980-09-30',
            'direccion' => 'Coayllo',
            'telefono' => '956789012',
            'profesion' => 'Profesor de Historia',
            'foto' => 'uploads/fotos/' . time() . '_luis.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Daniela Ruiz',
            'email' => 'daniela.ruiz@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Daniela',
            'apellidos' => 'Ruiz',
            'ci' => '77890123',
            'fecha_nacimiento' => '1993-12-01',
            'direccion' => 'San Vicente',
            'telefono' => '967890123',
            'profesion' => 'Lic. en Educación Inicial',
            'foto' => 'uploads/fotos/' . time() . '_daniela.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Miguel Ríos',
            'email' => 'miguel.rios@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Miguel',
            'apellidos' => 'Ríos',
            'ci' => '78901234',
            'fecha_nacimiento' => '1988-08-22',
            'direccion' => 'Mala',
            'telefono' => '978901234',
            'profesion' => 'Profesor de Ciencias',
            'foto' => 'uploads/fotos/' . time() . '_miguel.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Alejandra Castro',
            'email' => 'alejandra.castro@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('DOCENTE');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'docente',
            'nombres' => 'Alejandra',
            'apellidos' => 'Castro',
            'ci' => '79012345',
            'fecha_nacimiento' => '1991-04-18',
            'direccion' => 'Santa Cruz de Flores',
            'telefono' => '989012345',
            'profesion' => 'Profesora de Computación',
            'foto' => 'uploads/fotos/' . time() . '_alejandra.jpg',
        ]);

        //ADMINISTRATIVOS
        $usuario = User::create([
            'name' => 'Piero Zavala',
            'email' => 'piero.zavala@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('ADMINISTRADOR');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'administrativo',
            'nombres' => 'Piero',
            'apellidos' => 'Zavala',
            'ci' => '70123456',
            'fecha_nacimiento' => '1984-05-14',
            'direccion' => 'Mala',
            'telefono' => '976543210',
            'profesion' => 'Asistente Administrativa',
            'foto' => 'uploads/fotos/' . time() . '_piero.jpg',
        ]);

        $usuario = User::create([
            'name' => 'Alexander García',
            'email' => 'alexander.garcia@jaq.com',
            'password' => Hash::make('12345678')
        ]);
        $usuario->assignRole('ADMINISTRADOR');

        Personal::create([
            'usuario_id' => $usuario->id,
            'tipo' => 'administrativo',
            'nombres' => 'Alexander',
            'apellidos' => 'García',
            'ci' => '78432123',
            'fecha_nacimiento' => '1990-08-20',
            'direccion' => 'Mala',
            'telefono' => '976543210',
            'profesion' => 'Ing de Sistemas',
            'foto' => 'uploads/fotos/' . time() . '_alexander.jpg',
        ]);

        Asignacion::create(['personal_id' => 1,'gestion_id' => 1,'nivel_id' => 3,'grado_id' => 12,'paralelo_id' => 23,'materia_id' => 3,'turno_id' => 1,'fecha_asignacion' => '2025-06-17']);
        Asignacion::create(['personal_id' => 1,'gestion_id' => 1,'nivel_id' => 3,'grado_id' => 13,'paralelo_id' => 26,'materia_id' => 4,'turno_id' => 1,'fecha_asignacion' => '2018-06-17']);


    }
}