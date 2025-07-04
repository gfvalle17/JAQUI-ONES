<?php

namespace App\Exports;

use OwenIt\Auditing\Models\Audit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles; // 1. Importamos la interfaz para estilos
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; // 2. Importamos la clase Worksheet
use App\Models\User;
use Spatie\Permission\Models\Role;

// 3. Implementamos la nueva interfaz WithStyles
class AuditsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    // Recibimos todos los filtros como un array
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Construimos la misma consulta filtrada que en el controlador
        $query = Audit::with('user')->latest();

        // Filtro por Rol y Usuario
        if (!empty($this->filters['role_id'])) {
            $role = Role::findById($this->filters['role_id']);
            if ($role) {
                $userIds = User::role($role->name)->pluck('id');
                if (!empty($this->filters['user_id'])) {
                    $query->where('user_id', $this->filters['user_id']);
                } else {
                    $query->whereIn('user_id', $userIds);
                }
            }
        }

        // Filtro por Módulo
        if (!empty($this->filters['module'])) {
            $fullModelPath = 'App\\Models\\' . $this->filters['module'];
            $query->where('auditable_type', $fullModelPath);
        }

        // Filtro por ID de Registro
        if (!empty($this->filters['auditable_id'])) {
            $query->where('auditable_id', $this->filters['auditable_id']);
        }

        // Filtros de Fecha
        if (!empty($this->filters['year'])) {
            $query->whereYear('created_at', $this->filters['year']);
        }
        if (!empty($this->filters['month'])) {
            $query->whereMonth('created_at', $this->filters['month']);
        }
        if (!empty($this->filters['day'])) {
            $query->whereDay('created_at', $this->filters['day']);
        }

        return $query->get();
    }

    // ======================= INICIO DE LA MEJORA =======================

    /**
     * Define los encabezados de las columnas en el archivo Excel.
     */
    public function headings(): array
    {
        return [
            'Usuario',
            'Evento',
            'Área Afectada',
            'ID del Registro',
            'Detalles del Cambio', // Columna única y más clara
            'Fecha y Hora',
        ];
    }

    /**
     * Mapea y formatea los datos para cada fila del archivo Excel.
     */
    public function map($audit): array
    {
        // Traducimos el evento a español
        $evento_es = ucfirst($audit->event);
        if ($audit->event == 'created') $evento_es = 'Creado';
        if ($audit->event == 'updated') $evento_es = 'Actualizado';
        if ($audit->event == 'deleted') $evento_es = 'Eliminado';

        return [
            $audit->user->name ?? 'Sistema',
            $evento_es,
            class_basename($audit->auditable_type),
            $audit->auditable_id,
            $this->formatDetails($audit), // Usamos la nueva función para formatear los detalles
            $audit->created_at->format('d/m/Y H:i:s'),
        ];
    }

    /**
     * Aplica estilos a la hoja de cálculo.
     */
    public function styles(Worksheet $sheet)
    {
        // Estilo para la fila de encabezados
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4F81BD'], // Un color azul oscuro
            ],
        ]);

        // Autoajustar el tamaño de las columnas
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Ajuste específico para la columna de detalles para que no sea demasiado ancha
        $sheet->getColumnDimension('E')->setWidth(50);
        $sheet->getStyle('E')->getAlignment()->setWrapText(true);
    }


    /**
     * Formatea los detalles de la auditoría en un texto legible.
     */
    private function formatDetails($audit)
    {
        $details = [];
        $oldValues = $audit->old_values;
        $newValues = $audit->new_values;

        $processValues = function ($values) {
            $formatted = [];
            foreach ($values as $key => $value) {
                $displayValue = str_ends_with($key, '_id') ? $this->getRelatedName($key, $value) : $value;
                $formatted[] = ucfirst(str_replace('_', ' ', $key)) . ": " . $displayValue;
            }
            return implode("\n", $formatted); // Salto de línea para Excel
        };

        if ($audit->event === 'created') {
            return "Registro Creado con los siguientes datos:\n" . $processValues($newValues);
        }

        if ($audit->event === 'updated') {
            foreach ($newValues as $key => $value) {
                if (isset($oldValues[$key]) && $oldValues[$key] != $value) {
                    $oldDisplay = str_ends_with($key, '_id') ? $this->getRelatedName($key, $oldValues[$key]) : $oldValues[$key];
                    $newDisplay = str_ends_with($key, '_id') ? $this->getRelatedName($key, $value) : $value;
                    $details[] = ucfirst(str_replace('_', ' ', $key)) . ": '" . $oldDisplay . "' -> '" . $newDisplay . "'";
                }
            }
            return "Cambios realizados:\n" . implode("\n", $details);
        }

        if ($audit->event === 'deleted') {
            return "Registro Eliminado. Datos:\n" . $processValues($oldValues);
        }

        return '';
    }

    /**
     * Función auxiliar para obtener nombres en lugar de IDs.
     */
    private function getRelatedName($key, $id)
    {
        if (empty($id)) return 'N/A';
        $model = null;
        $name = "ID: $id";

        switch ($key) {
            case 'personal_id':
                $model = \App\Models\Personal::find($id);
                if ($model) $name = $model->nombres . ' ' . $model->apellidos;
                break;
            case 'estudiante_id':
                $model = \App\Models\Estudiante::find($id);
                if ($model) $name = $model->nombres . ' ' . $model->apellidos;
                break;
            case 'materia_id':
                $model = \App\Models\Materia::find($id);
                if ($model) $name = $model->nombre;
                break;
            case 'grado_id':
                $model = \App\Models\Grado::find($id);
                if ($model) $name = $model->nombre;
                break;
            case 'nivel_id':
                $model = \App\Models\Nivel::find($id);
                if ($model) $name = $model->nombre;
                break;
            case 'turno_id':
                $model = \App\Models\Turno::find($id);
                if ($model) $name = $model->nombre;
                break;
            case 'paralelo_id':
                $model = \App\Models\Paralelo::find($id);
                if ($model) $name = $model->nombre;
                break;
            case 'gestion_id':
                $model = \App\Models\Gestion::find($id);
                if ($model) $name = $model->gestion;
                break;
            default:
                return $id;
        }
        return $name;
    }
    // ======================== FIN DE LA MEJORA ========================
}
