<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index.home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');


//rutas para configuracion del sistema
Route::get('/admin/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('admin.configuracion.index')->middleware('auth','can:admin.configuracion.index');
Route::post('/admin/configuracion/create', [App\Http\Controllers\ConfiguracionController::class, 'store'])->name('admin.configuracion.store')->middleware('auth','can:admin.configuracion.store');

//ruta para la gestion del sistema
Route::get('/admin/gestiones', [App\Http\Controllers\GestionController::class, 'index'])->name('admin.gestiones.index')->middleware('auth','can:admin.gestion.index');
Route::get('/admin/gestiones/create', [App\Http\Controllers\GestionController::class, 'create'])->name('admin.gestiones.create')->middleware('auth','can:admin.gestion.create');
Route::post('/admin/gestiones/create', [App\Http\Controllers\GestionController::class, 'store'])->name('admin.gestiones.store')->middleware('auth','can:admin.gestion.store');
Route::get('/admin/gestiones/{id}/edit', [App\Http\Controllers\GestionController::class, 'edit'])->name('admin.gestiones.edit')->middleware('auth','can:admin.gestion.edit');
Route::put('/admin/gestiones/{id}', [App\Http\Controllers\GestionController::class, 'update'])->name('admin.gestiones.update')->middleware('auth','can:admin.gestion.update');
Route::delete('/admin/gestiones/{id}', [App\Http\Controllers\GestionController::class, 'destroy'])->name('admin.gestiones.destroy')->middleware('auth','can:admin.gestion.destroy');

//ruta para los periodos del sistema
Route::get('/admin/periodos', [App\Http\Controllers\PeriodoController::class, 'index'])->name('admin.periodos.index')->middleware('auth','can:admin.periodos.index');
Route::post('/admin/periodos/create', [App\Http\Controllers\PeriodoController::class, 'store'])->name('admin.periodos.store')->middleware('auth','can:admin.periodos.store');
Route::put('/admin/periodos/{id}', [App\Http\Controllers\PeriodoController::class, 'update'])->name('admin.periodos.update')->middleware('auth','can:admin.periodos.update');
Route::delete('/admin/periodos/{id}', [App\Http\Controllers\PeriodoController::class, 'destroy'])->name('admin.periodos.destroy')->middleware('auth','can:admin.periodos.destroy');

//ruta para los niveles del sistema
Route::get('/admin/niveles', [App\Http\Controllers\NivelController::class, 'index'])->name('admin.niveles.index')->middleware('auth','can:admin.niveles.index');
Route::post('/admin/niveles/create', [App\Http\Controllers\NivelController::class, 'store'])->name('admin.niveles.store')->middleware('auth','can:admin.niveles.store');
Route::put('/admin/niveles/{id}', [App\Http\Controllers\NivelController::class, 'update'])->name('admin.niveles.update')->middleware('auth','can:admin.niveles.update');
Route::delete('/admin/niveles/{id}', [App\Http\Controllers\NivelController::class, 'destroy'])->name('admin.niveles.destroy')->middleware('auth','can:admin.niveles.destroy');

//ruta para los grados del sistema
Route::get('/admin/grados', [App\Http\Controllers\GradoController::class, 'index'])->name('admin.grados.index')->middleware('auth','can:admin.grados.index');
Route::post('/admin/grados/create', [App\Http\Controllers\GradoController::class, 'store'])->name('admin.grados.store')->middleware('auth','can:admin.grados.store');
Route::put('/admin/grados/{id}', [App\Http\Controllers\GradoController::class, 'update'])->name('admin.grados.update')->middleware('auth','can:admin.grados.update');
Route::delete('/admin/grados/{id}', [App\Http\Controllers\GradoController::class, 'destroy'])->name('admin.grados.destroy')->middleware('auth','can:admin.grados.destroy');

//ruta para los paralelos del sistema
Route::get('/admin/paralelos', [App\Http\Controllers\ParaleloController::class, 'index'])->name('admin.paralelos.index')->middleware('auth','can:admin.paralelos.index');
Route::post('/admin/paralelos/create', [App\Http\Controllers\ParaleloController::class, 'store'])->name('admin.paralelos.store')->middleware('auth','can:admin.paralelos.store');
Route::put('/admin/paralelos/{id}', [App\Http\Controllers\ParaleloController::class, 'update'])->name('admin.paralelos.update')->middleware('auth','can:admin.paralelos.update');
Route::delete('/admin/paralelos/{id}', [App\Http\Controllers\ParaleloController::class, 'destroy'])->name('admin.paralelos.destroy')->middleware('auth','can:admin.paralelos.destroy');


//ruta para los turnos del sistema
Route::get('/admin/turnos', [App\Http\Controllers\TurnoController::class, 'index'])->name('admin.turnos.index')->middleware('auth','can:admin.turnos.index');
Route::get('/admin/turnos/create', [App\Http\Controllers\TurnoController::class, 'create'])->name('admin.turnos.create')->middleware('auth','can:admin.turnos.create');
Route::post('/admin/turnos/create', [App\Http\Controllers\TurnoController::class, 'store'])->name('admin.turnos.store')->middleware('auth','can:admin.turnos.store');
Route::get('/admin/turnos/{id}/edit', [App\Http\Controllers\TurnoController::class, 'edit'])->name('admin.turnos.edit')->middleware('auth','can:admin.turnos.edit');
Route::put('/admin/turnos/{id}', [App\Http\Controllers\TurnoController::class, 'update'])->name('admin.turnos.update')->middleware('auth','can:admin.turnos.update');
Route::delete('/admin/turnos/{id}', [App\Http\Controllers\TurnoController::class, 'destroy'])->name('admin.turnos.destroy')->middleware('auth','can:admin.turnos.destroy');

//ruta para los materias del sistema
Route::get('/admin/materias', [App\Http\Controllers\MateriaController::class, 'index'])->name('admin.materias.index')->middleware('auth','can:admin.materias.index');
Route::post('/admin/materias/create', [App\Http\Controllers\MateriaController::class, 'store'])->name('admin.materias.store')->middleware('auth','can:admin.materias.store');
Route::put('/admin/materias/{id}', [App\Http\Controllers\MateriaController::class, 'update'])->name('admin.materias.paralelos')->middleware('auth','can:admin.materias.paralelos');
Route::delete('/admin/materias/{id}', [App\Http\Controllers\MateriaController::class, 'destroy'])->name('admin.materias.destroy')->middleware('auth','can:admin.materias.destroy');

//ruta para los roles del sistema
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth','can:admin.roles.index');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth','can:admin.roles.create');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth','can:admin.roles.store');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth','can:admin.roles.edit');
Route::get('/admin/roles/{id}/permisos', [App\Http\Controllers\RoleController::class, 'permisos'])->name('admin.roles.permisos')->middleware('auth','can:admin.roles.permisos');
Route::post('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update_permisos'])->name('admin.roles.update_permisos')->middleware('auth','can:admin.roles.update_permisos');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth','can:admin.roles.update');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth','can:admin.roles.destroy');

//rutas para el personal del sistema
Route::get('/admin/personal/{tipo}', [App\Http\Controllers\PersonalController::class, 'index'])->name('admin.personal.index')->middleware('auth','can:admin.personal.index');
Route::get('/admin/personal/create/{tipo}', [App\Http\Controllers\PersonalController::class, 'create'])->name('admin.personal.create')->middleware('auth','can:admin.personal.create');
Route::post('/admin/personal/create', [App\Http\Controllers\PersonalController::class, 'store'])->name('admin.personal.store')->middleware('auth','can:admin.personal.store');
Route::get('/admin/personal/show/{id}', [App\Http\Controllers\PersonalController::class, 'show'])->name('admin.personal.show')->middleware('auth','can:admin.personal.show');
Route::get('/admin/personal/{id}/edit', [App\Http\Controllers\PersonalController::class, 'edit'])->name('admin.personal.edit')->middleware('auth','can:admin.personal.edit');
Route::put('/admin/personal/{id}', [App\Http\Controllers\PersonalController::class, 'update'])->name('admin.personal.update')->middleware('auth','can:admin.personal.update');
Route::delete('/admin/personal/{id}', [App\Http\Controllers\PersonalController::class, 'destroy'])->name('admin.personal.destroy')->middleware('auth','can:admin.personal.destroy');

//rutas para la formacion del personal
Route::get('/admin/personal/{id}/formaciones', [App\Http\Controllers\FormacionController::class, 'index'])->name('admin.formaciones.index')->middleware('auth','can:admin.formaciones.index');
Route::get('/admin/personal/{id}/formaciones/create', [App\Http\Controllers\FormacionController::class, 'create'])->name('admin.formaciones.create')->middleware('auth','can:admin.formaciones.create');
Route::post('/admin/personal/{id}/formaciones/create', [App\Http\Controllers\FormacionController::class, 'store'])->name('admin.formaciones.store')->middleware('auth','can:admin.formaciones.store');
Route::get('/admin/personal/formaciones/{id}', [App\Http\Controllers\FormacionController::class, 'edit'])->name('admin.formaciones.edit')->middleware('auth','can:admin.formaciones.edit');
Route::put('/admin/personal/formaciones/{id}', [App\Http\Controllers\FormacionController::class, 'update'])->name('admin.formaciones.update')->middleware('auth','can:admin.formaciones.update');
Route::delete('/admin/personal/formaciones/{id}', [App\Http\Controllers\FormacionController::class, 'destroy'])->name('admin.formaciones.destroy')->middleware('auth','can:admin.formaciones.destroy');

//rutas para los estudiantes del sistema
Route::get('/admin/estudiantes', [App\Http\Controllers\EstudianteController::class, 'index'])->name('admin.estudiantes.index')->middleware('auth','can:admin.estudiantes.index');
Route::get('/admin/estudiantes/create', [App\Http\Controllers\EstudianteController::class, 'create'])->name('admin.estudiantes.create')->middleware('auth','can:admin.estudiantes.create');
Route::post('/admin/estudiantes/create', [App\Http\Controllers\EstudianteController::class, 'store'])->name('admin.estudiantes.store')->middleware('auth','can:admin.estudiantes.store');
Route::get('/admin/estudiantes/{id}', [App\Http\Controllers\EstudianteController::class, 'show'])->name('admin.estudiantes.show')->middleware('auth','can:admin.estudiantes.show');
Route::get('/admin/estudiantes/{id}/edit', [App\Http\Controllers\EstudianteController::class, 'edit'])->name('admin.estudiantes.edit')->middleware('auth','can:admin.estudiantes.edit');
Route::put('/admin/estudiantes/{id}', [App\Http\Controllers\EstudianteController::class, 'update'])->name('admin.estudiantes.update')->middleware('auth','can:admin.estudiantes.update');
Route::delete('/admin/estudiantes/{id}', [App\Http\Controllers\EstudianteController::class, 'destroy'])->name('admin.estudiantes.destroy')->middleware('auth','can:admin.estudiantes.destroy');

//rutas para matrículas del estudiante
Route::get('/admin/matriculaciones', [App\Http\Controllers\MatriculacionController::class, 'index'])->name('admin.matriculaciones.index')->middleware('auth','can:admin.matriculaciones.index');
Route::get('/admin/matriculaciones/create', [App\Http\Controllers\MatriculacionController::class, 'create'])->name('admin.matriculaciones.create')->middleware('auth','can:admin.matriculaciones.create');
Route::post('/admin/matriculaciones/create', [App\Http\Controllers\MatriculacionController::class, 'store'])->name('admin.matriculaciones.store')->middleware('auth','can:admin.matriculaciones.store');
Route::get('/admin/matriculaciones/buscar_estudiante/{id}', [App\Http\Controllers\MatriculacionController::class, 'buscar_estudiante'])->name('admin.matriculaciones.buscar_estudiante')->middleware('auth','can:admin.matriculaciones.buscar_estudiante');
Route::get('/admin/matriculaciones/buscar_grado/{id}', [App\Http\Controllers\MatriculacionController::class, 'buscar_grados'])->name('admin.matriculaciones.buscar_grados')->middleware('auth','can:admin.matriculaciones.buscar_grados');
Route::get('/admin/matriculaciones/buscar_paralelo/{id}', [App\Http\Controllers\MatriculacionController::class, 'buscar_paralelos'])->name('admin.matriculaciones.buscar_paralelos')->middleware('auth','can:admin.matriculaciones.buscar_paralelos');
Route::get('/admin/matriculaciones/pdf/{id}', [App\Http\Controllers\MatriculacionController::class, 'pdf_matricula'])->name('admin.matriculaciones.pdf_matricula')->middleware('auth');
Route::get('/admin/matriculaciones/{id}', [App\Http\Controllers\MatriculacionController::class, 'show'])->name('admin.matriculaciones.show')->middleware('auth');
Route::get('/admin/matriculaciones/{id}/edit', [App\Http\Controllers\MatriculacionController::class, 'edit'])->name('admin.matriculaciones.edit')->middleware('auth');
Route::put('/admin/matriculaciones/{id}', [App\Http\Controllers\MatriculacionController::class, 'update'])->name('admin.matriculaciones.update')->middleware('auth');
Route::delete('/admin/matriculaciones/{id}', [App\Http\Controllers\MatriculacionController::class, 'destroy'])->name('admin.matriculaciones.destroy')->middleware('auth');

//rutas para padres de familia del estudiante
Route::get('/admin/ppffs', [App\Http\Controllers\PpffController::class, 'index'])->name('admin.ppffs.index')->middleware('auth','can:admin.ppffs.index');
Route::post('/admin/estudiantes/ppff/create', [App\Http\Controllers\PpffController::class, 'store'])->name('admin.estudiante.ppffs.store')->middleware('auth','can:admin.ppffs.store');
Route::get('/admin/ppffs/create', [App\Http\Controllers\PpffController::class, 'create'])->name('admin.ppffs.create')->middleware('auth','can:admin.ppffs.create');
Route::post('/admin/ppffs/create', [App\Http\Controllers\PpffController::class, 'store_ppff'])->name('admin.ppffs.store')->middleware('auth','can:admin.ppffs.store');
Route::get('/admin/ppffs/{id}', [App\Http\Controllers\PpffController::class, 'show'])->name('admin.ppffs.show')->middleware('auth','can:admin.ppffs.show');
Route::get('/admin/ppffs/{id}/edit', [App\Http\Controllers\PpffController::class, 'edit'])->name('admin.ppffs.edit')->middleware('auth','can:admin.ppffs.edit');
Route::put('/admin/ppffs/{id}', [App\Http\Controllers\PpffController::class, 'update'])->name('admin.ppffs.update')->middleware('auth','can:admin.ppffs.update');
Route::delete('/admin/ppffs/{id}', [App\Http\Controllers\PpffController::class, 'destroy'])->name('admin.ppffs.destroy')->middleware('auth','can:admin.ppffs.destroy');

//rutas para asignación de materias de los docentes
Route::get('/admin/asignaciones', [App\Http\Controllers\AsignacionController::class, 'index'])->name('admin.asignaciones.index')->middleware('auth','can:admin.asignaciones.index');
Route::get('/admin/asignaciones/create', [App\Http\Controllers\AsignacionController::class, 'create'])->name('admin.asignaciones.create')->middleware('auth','can:admin.asignaciones.create');
Route::post('/admin/asignaciones/create', [App\Http\Controllers\AsignacionController::class, 'store'])->name('admin.asignaciones.store')->middleware('auth','can:admin.asignaciones.store');
Route::get('/admin/asignaciones/buscar_docente/{id}', [App\Http\Controllers\AsignacionController::class, 'buscar_docente'])->name('admin.asignaciones.buscar_docente')->middleware('auth','can:admin.asignaciones.buscar_docente');
Route::get('/admin/asignaciones/{id}', [App\Http\Controllers\AsignacionController::class, 'show'])->name('admin.asignaciones.show')->middleware('auth','can:admin.asignaciones.show');
Route::get('/admin/asignaciones/{id}/edit', [App\Http\Controllers\AsignacionController::class, 'edit'])->name('admin.asignaciones.edit')->middleware('auth','can:admin.asignaciones.edit');
Route::put('/admin/asignaciones/{id}/edit', [App\Http\Controllers\AsignacionController::class, 'update'])->name('admin.asignaciones.update')->middleware('auth','can:admin.asignaciones.update');
Route::delete('/admin/asignaciones/{id}/edit', [App\Http\Controllers\AsignacionController::class, 'destroy'])->name('admin.asignaciones.destroy')->middleware('auth','can:admin.asignaciones.destroy');

//rutas para asistencias del estudiante
Route::get('/admin/asistencias', [App\Http\Controllers\AsistenciaController::class, 'index'])->name('admin.asistencias.index')->middleware('auth','can:admin.asistencias.index');
Route::get('/admin/asistencias/create/asignacion/{id}', [App\Http\Controllers\AsistenciaController::class, 'create'])->name('admin.asistencias.create')->middleware('auth','can:admin.asistencias.create');
Route::get('/admin/asistencias/asignacion/{id}', [App\Http\Controllers\AsistenciaController::class, 'show'])->name('admin.asistencias.show')->middleware('auth');
Route::post('/admin/asistencias/create', [App\Http\Controllers\AsistenciaController::class, 'store'])->name('admin.asistencias.store')->middleware('auth','can:admin.asistencias.store');
Route::put('/admin/asistencias/{id}', [App\Http\Controllers\AsistenciaController::class, 'update'])->name('admin.asistencias.update')->middleware('auth');
Route::delete('/admin/asistencias/{id}', [App\Http\Controllers\AsistenciaController::class, 'destroy'])->name('admin.asistencias.destroy')->middleware('auth');
