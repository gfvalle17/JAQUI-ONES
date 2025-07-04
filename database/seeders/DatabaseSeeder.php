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
use App\Models\Estudiante;
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

        /*........................................................*/

        $usuarioEstudiante = User::create([
            'name' => 'Mateo Vargas López',
            'email' => 'mateo.vargas@jaq-estudiante.com',
            'password' => Hash::make('12345678')
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

        Materia::create(['nombre' => 'Geometría']);
        Materia::create(['nombre' => 'H. Universal y Geografía']);
        Materia::create(['nombre' => 'Trigonometría']);
        Materia::create(['nombre' => 'Inglés']);
        Materia::create(['nombre' => 'H. del Perú y Economía']);
        Materia::create(['nombre' => 'Algebra']);
        Materia::create(['nombre' => 'Aritmética']);
        Materia::create(['nombre' => 'Química']);
        Materia::create(['nombre' => 'Aritmética']);
        Materia::create(['nombre' => 'Lenguaje']);
        Materia::create(['nombre' => 'Razonamiento Matemático']);
        Materia::create(['nombre' => 'Razonamiento Verbal']);
        Materia::create(['nombre' => 'Biología']);
        Materia::create(['nombre' => 'Física']);
        Materia::create(['nombre' => 'Literatura']);
        Materia::create(['nombre' => 'D.P.C.C.']);
        
        Ppff::create([
            'nombres' => 'Ana María',
            'apellidos' => 'López Gómez',
            'ci' => '12345678',
            'fecha_nacimiento' => '1985-05-15',
            'parentesco' => 'MADRE', // Campo obligatorio
            'ocupacion' => 'Comerciante', // Campo obligatorio
            'direccion' => 'Mala',
            'telefono' => '987654321',
            // La línea 'foto' ha sido eliminada
        ]);

        Ppff::create([
            'nombres' => 'Carlos Alberto',
            'apellidos' => 'González Rojas',
            'ci' => '71234567',
            'fecha_nacimiento' => '1980-03-12',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Ingeniero Civil',
            'direccion' => 'San Antonio',
            'telefono' => '987654321',
        ]);

        Ppff::create([
            'nombres' => 'Mariana Sofía',
            'apellidos' => 'Rodríguez Flores',
            'ci' => '72345678',
            'fecha_nacimiento' => '1982-11-25',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Doctora',
            'direccion' => 'Mala',
            'telefono' => '912345678',
        ]);

        Ppff::create([
            'nombres' => 'José Luis',
            'apellidos' => 'Gómez Sánchez',
            'ci' => '73456789',
            'fecha_nacimiento' => '1979-07-02',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Abogado',
            'direccion' => 'Asia',
            'telefono' => '923456789',
        ]);

        Ppff::create([
            'nombres' => 'Laura Valentina',
            'apellidos' => 'Fernández Torres',
            'ci' => '74567890',
            'fecha_nacimiento' => '1988-01-30',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Contadora',
            'direccion' => 'Calango',
            'telefono' => '934567890',
        ]);

        Ppff::create([
            'nombres' => 'Miguel Ángel',
            'apellidos' => 'López Martínez',
            'ci' => '75678901',
            'fecha_nacimiento' => '1981-09-14',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Comerciante',
            'direccion' => 'Santa Cruz de Flores',
            'telefono' => '945678901',
        ]);

        Ppff::create([
            'nombres' => 'Elena Patricia',
            'apellidos' => 'Pérez Ruiz',
            'ci' => '76789012',
            'fecha_nacimiento' => '1990-05-22',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Diseñadora Gráfica',
            'direccion' => 'San Vicente de Cañete',
            'telefono' => '956789012',
        ]);

        Ppff::create([
            'nombres' => 'Juan David',
            'apellidos' => 'García Vargas',
            'ci' => '77890123',
            'fecha_nacimiento' => '1983-02-18',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Profesor',
            'direccion' => 'Imperial',
            'telefono' => '967890123',
        ]);

        Ppff::create([
            'nombres' => 'Lucía Carmen',
            'apellidos' => 'Romero Mendoza',
            'ci' => '78901234',
            'fecha_nacimiento' => '1987-08-08',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Enfermera',
            'direccion' => 'Lunahuaná',
            'telefono' => '978901234',
        ]);

        Ppff::create([
            'nombres' => 'Pedro Javier',
            'apellidos' => 'Suárez Castillo',
            'ci' => '79012345',
            'fecha_nacimiento' => '1978-12-01',
            'parentesco' => 'APODERADO/A',
            'ocupacion' => 'Técnico Electricista',
            'direccion' => 'Cerro Azul',
            'telefono' => '989012345',
        ]);

        Ppff::create([
            'nombres' => 'Isabel Cristina',
            'apellidos' => 'Díaz Ortega',
            'ci' => '70123456',
            'fecha_nacimiento' => '1991-04-16',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Arquitecta',
            'direccion' => 'Mala',
            'telefono' => '990123456',
        ]);

        Ppff::create([
            'nombres' => 'Fernando Andrés',
            'apellidos' => 'Reyes Ramos',
            'ci' => '69876543',
            'fecha_nacimiento' => '1984-06-05',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Conductor',
            'direccion' => 'Asia',
            'telefono' => '981234567',
        ]);

        Ppff::create([
            'nombres' => 'Verónica Alejandra',
            'apellidos' => 'Castro Morales',
            'ci' => '68765432',
            'fecha_nacimiento' => '1989-10-11',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Secretaria',
            'direccion' => 'San Antonio',
            'telefono' => '972345678',
        ]);

        Ppff::create([
            'nombres' => 'Diego Armando',
            'apellidos' => 'Herrera Medina',
            'ci' => '67654321',
            'fecha_nacimiento' => '1986-03-27',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Albañil',
            'direccion' => 'Calango',
            'telefono' => '963456789',
        ]);

        Ppff::create([
            'nombres' => 'Claudia Marcela',
            'apellidos' => 'Gómez López',
            'ci' => '66543210',
            'fecha_nacimiento' => '1992-01-09',
            'parentesco' => 'APODERADO/A',
            'ocupacion' => 'Psicóloga',
            'direccion' => 'Santa Cruz de Flores',
            'telefono' => '954321098',
        ]);

        Ppff::create([
            'nombres' => 'Ricardo Manuel',
            'apellidos' => 'Sánchez Pérez',
            'ci' => '65432109',
            'fecha_nacimiento' => '1980-07-13',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Mecánico',
            'direccion' => 'Mala',
            'telefono' => '943210987',
        ]);

        Ppff::create([
            'nombres' => 'Gabriela Beatriz',
            'apellidos' => 'Rodríguez Díaz',
            'ci' => '64321098',
            'fecha_nacimiento' => '1985-09-03',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Vendedora',
            'direccion' => 'San Vicente de Cañete',
            'telefono' => '932109876',
        ]);

        Ppff::create([
            'nombres' => 'Jorge Francisco',
            'apellidos' => 'Martínez Vargas',
            'ci' => '63210987',
            'fecha_nacimiento' => '1977-04-20',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Agricultor',
            'direccion' => 'Imperial',
            'telefono' => '921098765',
        ]);

        Ppff::create([
            'nombres' => 'Andrea Carolina',
            'apellidos' => 'Suárez Flores',
            'ci' => '62109876',
            'fecha_nacimiento' => '1993-06-28',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Chef',
            'direccion' => 'Lunahuaná',
            'telefono' => '910987654',
        ]);

        Ppff::create([
            'nombres' => 'Sergio Alberto',
            'apellidos' => 'Romero Castillo',
            'ci' => '61098765',
            'fecha_nacimiento' => '1982-08-17',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Policía',
            'direccion' => 'Cerro Azul',
            'telefono' => '909876543',
        ]);

        Ppff::create([
            'nombres' => 'Mónica Liliana',
            'apellidos' => 'González Torres',
            'ci' => '60987654',
            'fecha_nacimiento' => '1988-12-24',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Cajera',
            'direccion' => 'Mala',
            'telefono' => '988765432',
        ]);

        Ppff::create([
            'nombres' => 'Rafael Antonio',
            'apellidos' => 'Pérez Castro',
            'ci' => '59876543',
            'fecha_nacimiento' => '1976-02-02',
            'parentesco' => 'APODERADO/A',
            'ocupacion' => 'Carpintero',
            'direccion' => 'Asia',
            'telefono' => '977654321',
        ]);

        Ppff::create([
            'nombres' => 'Sandra Milena',
            'apellidos' => 'López Morales',
            'ci' => '58765432',
            'fecha_nacimiento' => '1990-09-19',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Estilista',
            'direccion' => 'San Antonio',
            'telefono' => '966543210',
        ]);

        Ppff::create([
            'nombres' => 'Daniel Eduardo',
            'apellidos' => 'Fernández Reyes',
            'ci' => '57654321',
            'fecha_nacimiento' => '1983-05-31',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Periodista',
            'direccion' => 'Calango',
            'telefono' => '955432109',
        ]);

        Ppff::create([
            'nombres' => 'Natalia Andrea',
            'apellidos' => 'García Ruiz',
            'ci' => '56543210',
            'fecha_nacimiento' => '1994-07-23',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Traductora',
            'direccion' => 'Santa Cruz de Flores',
            'telefono' => '944321098',
        ]);

        Ppff::create([
            'nombres' => 'Francisco Javier',
            'apellidos' => 'Martínez Herrera',
            'ci' => '55432109',
            'fecha_nacimiento' => '1979-11-04',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Contador',
            'direccion' => 'Mala',
            'telefono' => '933210987',
        ]);

        Ppff::create([
            'nombres' => 'Paula Daniela',
            'apellidos' => 'Sánchez Medina',
            'ci' => '54321098',
            'fecha_nacimiento' => '1987-01-15',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Administradora',
            'direccion' => 'San Vicente de Cañete',
            'telefono' => '922109876',
        ]);

        Ppff::create([
            'nombres' => 'Alejandro José',
            'apellidos' => 'Romero Vargas',
            'ci' => '53210987',
            'fecha_nacimiento' => '1981-06-09',
            'parentesco' => 'PADRE',
            'ocupacion' => 'Ingeniero de Sistemas',
            'direccion' => 'Imperial',
            'telefono' => '911098765',
        ]);

        Ppff::create([
            'nombres' => 'Cristina Isabel',
            'apellidos' => 'Gómez Flores',
            'ci' => '52109876',
            'fecha_nacimiento' => '1991-02-14',
            'parentesco' => 'MADRE',
            'ocupacion' => 'Abogada',
            'direccion' => 'Mala',
            'telefono' => '900987654',
        ]);

        Ppff::create([
            'nombres' => 'Adriana Lucia',
            'apellidos' => 'Torres Mendoza',
            'ci' => '51098765',
            'fecha_nacimiento' => '1984-10-26',
            'parentesco' => 'APODERADO/A',
            'ocupacion' => 'Ama de Casa',
            'direccion' => 'Asia',
            'telefono' => '999876543',
        ]);


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