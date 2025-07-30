<?php

namespace App\Exports;

use App\Models\InfoPostulante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EvolucionRegistrosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return InfoPostulante::selectRaw('DATE(created_at) as fecha, COUNT(*) as total_registrados')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();
    }

    public function headings(): array
    {
        return ['Fecha', 'Total Postulantes'];
    }
}