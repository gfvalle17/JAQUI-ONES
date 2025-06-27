<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Asignacion;
use App\Models\User;
use App\Models\Personal;
use App\Models\Estudiante;
use App\Models\Materia;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // En app/Http/Controllers/HomeController.php

    public function index(Request $request)
    {
        $user = Auth::user();

        // Prioridad 1: Si el usuario es Administrador, lo enviamos a su dashboard.
        if ($user->hasRole('ADMINISTRADOR')) {
            
            $total_gestiones = \App\Models\Gestion::count();
            $total_periodos = \App\Models\Periodo::count();
            $total_niveles = \App\Models\Nivel::count();
            $total_grados = \App\Models\Grado::count();
            $total_paralelos = \App\Models\Paralelo::count();
            $total_turnos = \App\Models\Turno::count();
            $total_materias = \App\Models\Materia::count();
            $total_roles = \Spatie\Permission\Models\Role::count();
            $total_personal_administrativo = \App\Models\Personal::where('tipo', 'administrativo')->count();
            $total_personal_docente = \App\Models\Personal::where('tipo', 'docente')->count();
            $total_ppffs = \App\Models\Ppff::count();
            $total_estudiantes = \App\Models\Estudiante::count();

            // DEVOLVEMOS LA VISTA DEL ADMIN
            return view('admin.index', compact(
                'total_gestiones', 'total_periodos', 'total_niveles', 'total_grados',
                'total_paralelos', 'total_turnos', 'total_materias', 'total_roles',
                'total_personal_administrativo', 'total_personal_docente', 'total_ppffs', 'total_estudiantes'
            ));

        } 
        // Prioridad 2: Si NO es admin, pero SÍ es Docente, lo enviamos a su PROPIO dashboard.
        elseif ($user->hasRole('DOCENTE')) {
            
            if (!$user->personal) {
                // Manejar caso de docente sin perfil de personal (opcional)
                return view('docente.dashboard_sin_personal'); 
            }
            
            Carbon::setLocale('es');
            $fechaActual = Carbon::now('America/Lima')->translatedFormat('l, d \de F \de Y');
            $todayWeekDay = Carbon::now('America/Lima')->dayOfWeekIso;
            
            $clasesHoy = Asignacion::where('personal_id', $user->personal->id)
                            ->whereHas('horarios', function($q) use ($todayWeekDay) {
                                $q->where('dia_semana', $todayWeekDay);
                            })
                            ->with(['materia', 'grado', 'paralelo', 'horarios'])
                            ->get()
                            ->sortBy(function($asignacion) {
                                return optional($asignacion->horarios->first())->hora_inicio;
                            });
            
            // DEVOLVEMOS LA NUEVA VISTA DEL DOCENTE
            return view('docente.dashboard', compact('clasesHoy', 'fechaActual'));
        }

        // Si no es ninguno, va a una ruta por defecto.
        return redirect('/');
    }

    public function calendario(Request $request)
    {
        if (Gate::allows('ver-calendario')) {

            $asignacionesQuery = Asignacion::query()->with('horarios', 'materia', 'personal.user');

            if (Auth::user()->hasRole('DOCENTE')) {
                $asignacionesQuery->whereHas('personal', function ($query) {
                    $query->where('usuario_id', Auth::id());
                });
            }

            $asignaciones = $asignacionesQuery->get();
            $eventos = [];

            foreach ($asignaciones as $asignacion) {
                foreach ($asignacion->horarios as $horario) {
                    
                    $tituloEvento = $asignacion->materia->nombre;
                    if (Auth::user()->hasRole('ADMINISTRADOR') && $asignacion->personal && $asignacion->personal->user) {
                        $tituloEvento .= ' - ' . $asignacion->personal->user->name;
                    }

                    $eventos[] = [
                        'title' => $tituloEvento,
                        'daysOfWeek' => [$horario->dia_semana],
                        'startTime' => $horario->hora_inicio,
                        'endTime' => $horario->hora_fin,
                        'display' => 'block',
                        'url' => url('/admin/asistencias/create/asignacion/' . $asignacion->id)
                    ];
                }
            }

            return view('admin.asistencias.index.calendario', ['eventos' => json_encode($eventos)]);
        }

        return redirect('/');
    }
}