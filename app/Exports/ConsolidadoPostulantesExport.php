<?php
namespace App\Exports;

use App\Models\InfoPostulante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConsolidadoPostulantesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return InfoPostulante::with(['documentos', 'declaracionJurada', 'verificacion'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function map($postulante): array
    {
        return [
            $postulante->c_numdoc,
            $postulante->c_apepat . ' ' . $postulante->c_apemat . ' ' . $postulante->c_nombres,
            $postulante->c_email,
            $postulante->c_celu,
            $postulante->nomesp,
            $this->modalidadNombre($postulante->id_mod_ing),
            $postulante->estado == 1 ? 'COMPLETO' : 'INCOMPLETO',
            optional($postulante->documentos)->estado == 2 ? 'COMPLETO' : 'INCOMPLETO',
            optional($postulante->declaracionJurada)->id ? 'PRESENTÓ' : 'NO PRESENTÓ',
            optional($postulante->verificacion)->estado == 1 ? 'VALIDADO' : 'PENDIENTE',
            optional($postulante->created_at)->format('d/m/Y H:i')
        ];
    }

    public function headings(): array
    {
        return [
            'DNI',
            'Nombres Completos',
            'Email',
            'Celular',
            'Carrera',
            'Modalidad',
            'Info Personal',
            'Documentos',
            'DJ',
            'Validación Final',
            'Fecha Registro'
        ];
    }

    private function modalidadNombre($codigo)
    {
        return [
            'A' => 'Ordinario',
            'B' => 'Primeros Puestos',
            'C' => 'Pre-UMA',
            'D' => 'Traslado Externo',
            'O' => 'Alto Rendimiento',
            'L' => 'Técnicos',
        ][$codigo] ?? 'Desconocido';
    }
}
