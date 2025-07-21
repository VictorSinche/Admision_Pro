<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteGeneralPostulantesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = DB::table('info_postulante as ip')
            ->leftJoin('documentos_postulante as dp', 'dp.info_postulante_id', '=', 'ip.id')
            ->leftJoin('declaracion_jurada as dj', 'dj.info_postulante_id', '=', 'ip.id')
            ->leftJoin('verificacion_documentos as vd', 'vd.info_postulante_id', '=', 'ip.id')
            ->select(
                DB::raw("CONCAT(ip.c_apepat, ' ', ip.c_apemat, ' ', ip.c_nombres) AS nombre_completo"),
                'ip.c_numdoc as dni',
                'ip.id_mod_ing as modalidad',
                'ip.nomesp as especialidad',
                'ip.created_at as fecha_registro',
                DB::raw("COALESCE(dp.estado, 0) AS estado_documentacion"),
                DB::raw("COALESCE(dj.estado, 0) AS estado_declaracion"),
                DB::raw("COALESCE(vd.estado, 0) AS estado_validacion")
            )
            ->orderBy('ip.created_at', 'desc')
            ->get();

        return $data->map(function ($row) {
            return [
                $row->nombre_completo,
                $row->dni,
                $this->traducirModalidad($row->modalidad),
                $row->especialidad,
                $row->fecha_registro,
                $this->estadoTexto($row->estado_documentacion),
                $this->estadoTexto($row->estado_declaracion),
                $this->estadoTexto($row->estado_validacion),
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
            'Estado Documentación',
            'Estado Declaración Jurada',
            'Estado Validación',
        ];
    }

    private function estadoTexto($valor)
    {
        return match ((int)$valor) {
            2 => 'COMPLETO',
            1 => 'INCOMPLETO',
            default => 'FALTA',
        };
    }

    private function traducirModalidad($codigo)
    {
        return [
            'A' => 'Ordinario',
            'B' => 'Primeros Puestos',
            'C' => 'Pre-UMA',
            'D' => 'Traslado Externo',
            'L' => 'Técnicos',
            'O' => 'Alto Rendimiento',
        ][$codigo] ?? 'Desconocida';
    }
}
