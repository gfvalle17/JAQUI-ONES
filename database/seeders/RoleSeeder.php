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
        // ======================= CORRECCIÓN =======================
        // Se cambió Role::create por Role::firstOrCreate para evitar errores
        // si el seeder se ejecuta más de una vez.
        $admin = Role::firstOrCreate(['name' => 'ADMINISTRADOR']);
        $director_general = Role::firstOrCreate(['name' => 'DIRECTOR']);
        $docente = Role::firstOrCreate(['name' => 'DOCENTE']);
        $estudiante = Role::firstOrCreate(['name' => 'ESTUDIANTE']);
        $caja = Role::firstOrCreate(['name' => 'CAJERO/A']);
        $secretaria = Role::firstOrCreate(['name' => 'SECRETARIO/A']);

        // Se cambió Permission::create por Permission::firstOrCreate
        Permission::firstOrCreate(['name' => 'admin.home'])->syncRoles([$admin, $director_general, $docente]);

        // La misma lógica se aplica a todos los permisos para que sean re-ejecutables
        Permission::firstOrCreate(['name' => 'admin.configuracion.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.configuracion.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestion.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestion.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestion.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestion.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestion.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestion.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.periodos.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.periodos.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.periodos.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.periodos.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.niveles.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.niveles.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.niveles.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.niveles.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grados.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grados.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grados.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grados.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.paralelos.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.paralelos.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.paralelos.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.paralelos.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.turnos.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.turnos.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.turnos.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.turnos.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.turnos.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.turnos.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.materias.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.materias.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.materias.paralelos'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.materias.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.permisos'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.update_permisos'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.show'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.personal.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.formaciones.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.formaciones.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.formaciones.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.formaciones.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.formaciones.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.formaciones.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.show'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.estudiantes.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.matriculaciones.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.matriculaciones.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.matriculaciones.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.matriculaciones.buscar_estudiante'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.matriculaciones.buscar_grados'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.matriculaciones.buscar_paralelos'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.store_ppff'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.show'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.ppffs.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.buscar_docente'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.show'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asignaciones.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.asistencias.index'])->syncRoles([$admin, $docente, $estudiante]);
        Permission::firstOrCreate(['name' => 'admin.asistencias.create'])->syncRoles($docente);
        Permission::firstOrCreate(['name' => 'admin.asistencias.store'])->syncRoles($docente);
    }
}