<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentosFaltantesDetalleExport implements FromCollection, WithHeadings
{
    protected $modalidad;

    public function __construct($modalidad)
    {
        $this->modalidad = $modalidad;
    }

    public function collection()
    {
        $query = DB::table('info_postulante as ip')
            ->leftJoin('documentos_postulante as dp', 'dp.info_postulante_id', '=', 'ip.id')
            ->selectRaw("
                ip.c_numdoc AS DNI,
                CONCAT(ip.c_apepat, ' ', ip.c_apemat, ' ', ip.c_nombres) AS Nombre,
                ip.id_mod_ing AS Modalidad,

                CASE 
                    WHEN ip.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dp.formulario IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Formulario,

                CASE 
                    WHEN ip.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dp.pago IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Pago,

                CASE 
                    WHEN ip.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dp.dni IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS DNI_Doc,

                CASE 
                    WHEN ip.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dp.seguro IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Seguro,

                CASE 
                    WHEN ip.id_mod_ing IN ('A','B','C','O') THEN 
                        CASE WHEN dp.constancia IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Constancia,

                CASE 
                    WHEN ip.id_mod_ing IN ('B','O') THEN 
                        CASE WHEN dp.merito IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Merito,

                CASE 
                    WHEN ip.id_mod_ing IN ('D','L') THEN 
                        CASE WHEN dp.constancianotas IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Constancia_Notas,

                CASE 
                    WHEN ip.id_mod_ing IN ('D','L') THEN 
                        CASE WHEN dp.syllabus IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Syllabus,

                CASE 
                    WHEN ip.id_mod_ing = 'L' THEN 
                        CASE WHEN dp.certprofesional IS NOT NULL THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Cert_Profesional
            ")
            ->orderBy('ip.c_apepat');

        if ($this->modalidad && $this->modalidad !== 'ALL') {
            $query->where('ip.id_mod_ing', $this->modalidad);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'DNI', 'Nombre', 'Modalidad',
            'Formulario', 'Pago', 'DNI',
            'Seguro', 'Constancia', 'Merito',
            'Constancia_Notas', 'Syllabus', 'Cert_Profesional'
        ];
    }
}

