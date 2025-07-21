<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostulantesSinDeclaracionExport implements FromCollection, WithHeadings
{
    protected $modalidad;

    public function __construct($modalidad)
    {
        $this->modalidad = $modalidad;
    }

    public function collection(): Collection
    {
        return DB::table('info_postulante as ip')
            ->leftJoin('documentos_postulante as dp', 'dp.info_postulante_id', '=', 'ip.id')
            ->leftJoin('declaracion_jurada as dj', 'dj.info_postulante_id', '=', 'ip.id')
            ->whereNull('dj.id')
            ->when($this->modalidad, function ($query) {
                $query->where('ip.id_mod_ing', $this->modalidad);
            })
            ->orderBy('ip.created_at', 'desc')
            ->selectRaw("
                CONCAT(ip.c_apepat, ' ', ip.c_apemat, ' ', ip.c_nombres) AS nombre_completo,
                ip.c_numdoc AS dni,
                ip.id_mod_ing AS modalidad,
                ip.nomesp AS especialidad,
                ip.created_at AS fecha_registro,
                COALESCE(dp.estado, 0) AS estado_documentacion
            ")
            ->get()
            ->map(function ($p) {
                return [
                    $p->nombre_completo,
                    $p->dni,
                    $p->modalidad,
                    $p->especialidad,
                    $p->fecha_registro,
                    $p->estado_documentacion == 2 ? 'Completa' : ($p->estado_documentacion == 1 ? 'Incompleta' : 'Faltante'),
                    'NO REGISTRADA'
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nombre completo',
            'DNI',
            'Modalidad',
            'Especialidad',
            'Fecha de registro',
            'Estado documentación',
            'Estado declaración jurada'
        ];
    }
}
