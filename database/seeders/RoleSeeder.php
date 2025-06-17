<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'ADMINISTRADOR']);
        $director_general = Role::create(['name' => 'DIRECTOR/A GENERAL']);
        $director_academico = Role::create(['name' => 'DIRECTOR/A ACADÉMICO']);
        $director_administrativo = Role::create(['name' => 'DIRECTOR/A ADMINISTRATIVO']);
        $docente = Role::create(['name' => 'DOCENTE']);
        $estudiante = Role::create(['name' => 'ESTUDIANTE']);
        $caja = Role::create(['name' => 'CAJERO/A']);
        $secretaria = Role::create(['name' => 'SECRETARIO/A']);
        $regente = Role::create(['name' => 'REGENTE']);

        //permisos para la configuracion del sistema
        Permission::create(['name' => 'admin.configuracion.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.configuracion.store'])->syncRoles($admin);

        //permisos para las gestiones del sistema
        Permission::create(['name' => 'admin.gestion.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestion.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestion.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestion.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestion.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.gestion.destroy'])->syncRoles($admin);

        //permisos para los periodos del sistema
        Permission::create(['name' => 'admin.periodos.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.periodos.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.periodos.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.periodos.destroy'])->syncRoles($admin);

        //permisos para los niveles del sistema
        Permission::create(['name' => 'admin.niveles.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.niveles.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.niveles.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.niveles.destroy'])->syncRoles($admin);

        //permisos para los grados del sistema
        Permission::create(['name' => 'admin.grados.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.grados.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.grados.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.grados.destroy'])->syncRoles($admin);

        //permisos para los secciones del sistema
        Permission::create(['name' => 'admin.paralelos.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.paralelos.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.paralelos.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.paralelos.destroy'])->syncRoles($admin);

        //permisos para los turnos del sistema
        Permission::create(['name' => 'admin.turnos.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.turnos.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.turnos.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.turnos.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.turnos.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.turnos.destroy'])->syncRoles($admin);

        //permisos para las materias del sistema
        Permission::create(['name' => 'admin.materias.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.materias.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.materias.paralelos'])->syncRoles($admin);
        Permission::create(['name' => 'admin.materias.destroy'])->syncRoles($admin);

        //permisos para los roles del sistema
        Permission::create(['name' => 'admin.roles.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.permisos'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.update_permisos'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.roles.destroy'])->syncRoles($admin);

        //permisos para el personal del sistema
        Permission::create(['name' => 'admin.personal.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.personal.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.personal.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.personal.show'])->syncRoles($admin);
        Permission::create(['name' => 'admin.personal.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.personal.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.personal.destroy'])->syncRoles($admin);

        //permisos para la formacion del sistema
        Permission::create(['name' => 'admin.formaciones.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.formaciones.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.formaciones.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.formaciones.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.formaciones.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.formaciones.destroy'])->syncRoles($admin);

        //permisos para los estudiantes del sistema
        Permission::create(['name' => 'admin.estudiantes.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.estudiantes.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.estudiantes.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.estudiantes.show'])->syncRoles($admin);
        Permission::create(['name' => 'admin.estudiantes.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.estudiantes.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.estudiantes.destroy'])->syncRoles($admin);

        //permisos para las matriculas del sistema
        Permission::create(['name' => 'admin.matriculaciones.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.matriculaciones.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.matriculaciones.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.matriculaciones.buscar_estudiante'])->syncRoles($admin);
        Permission::create(['name' => 'admin.matriculaciones.buscar_grados'])->syncRoles($admin);
        Permission::create(['name' => 'admin.matriculaciones.buscar_paralelos'])->syncRoles($admin);

        //permisos para los padres de familia del estudiante
        Permission::create(['name' => 'admin.ppffs.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.store_ppff'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.show'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.ppffs.destroy'])->syncRoles($admin);

        //permisos para la asignación de materias de los docentes
        Permission::create(['name' => 'admin.asignaciones.index'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.create'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.store'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.buscar_docente'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.show'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.edit'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.update'])->syncRoles($admin);
        Permission::create(['name' => 'admin.asignaciones.destroy'])->syncRoles($admin);

    }
}
