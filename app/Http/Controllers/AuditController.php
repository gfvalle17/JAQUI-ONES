<?php

namespace App\Http\Controllers;

use App\Exports\AuditsExport;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Role;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        // --- Lógica para los filtros ---
        $roleId = $request->get('role_id');
        $userId = $request->get('user_id');
        $module = $request->get('module');
        $auditableId = $request->get('auditable_id');
        $year = $request->get('year');
        $month = $request->get('month');
        $day = $request->get('day');

        $roles = Role::orderBy('name')->get();
        $audits = new LengthAwarePaginator([], 0, 25);
        $usersInRole = collect();
        $modules = collect();

        if ($roleId) {
            $role = Role::findById($roleId);
            if ($role) {
                $usersInRole = User::role($role->name)->orderBy('name')->get();
                $userIdsInRole = $usersInRole->pluck('id');
                $query = Audit::with('user');

                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->whereIn('user_id', $userIdsInRole);
                }

                if ($module) {
                    $fullModelPath = 'App\\Models\\' . $module;
                    $query->where('auditable_type', $fullModelPath);
                }
                
                if ($auditableId) {
                    $query->where('auditable_id', $auditableId);
                }

                // ======================= INICIO DEL CAMBIO =======================
                // Añadimos los filtros de fecha a la consulta
                if ($year) {
                    $query->whereYear('created_at', $year);
                }
                if ($month) {
                    $query->whereMonth('created_at', $month);
                }
                if ($day) {
                    $query->whereDay('created_at', $day);
                }
                // ======================== FIN DEL CAMBIO ========================

                $audits = $query->latest()->paginate(25)->appends($request->query());

                $moduleUserIdFilter = $userId ? [$userId] : $userIdsInRole;
                $modules = Audit::select('auditable_type')
                                ->whereIn('user_id', $moduleUserIdFilter)
                                ->distinct()
                                ->get()
                                ->map(function ($item) {
                                    return class_basename($item->auditable_type);
                                })
                                ->unique()
                                ->sort();
            }
        }

        return view('admin.auditoria.index', [
            'audits' => $audits,
            'roles' => $roles,
            'usersInRole' => $usersInRole,
            'modules' => $modules,
            'selectedRole' => $roleId,
            'selectedUser' => $userId,
            'selectedModule' => $module,
            'selectedAuditableId' => $auditableId,
            'selectedYear' => $year,
            'selectedMonth' => $month,
            'selectedDay' => $day,
        ]);
    }

    public function export(Request $request)
    {
        // Pasamos todos los filtros a la clase de exportación
        return Excel::download(new AuditsExport($request->all()), 'informe-de-auditoria-filtrado.xlsx');
    }
}
