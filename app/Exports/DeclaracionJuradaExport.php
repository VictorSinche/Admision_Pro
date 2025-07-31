<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeclaracionJuradaExport implements FromCollection, WithHeadings
{
    protected $modalidades;

    public function __construct($modalidades)
    {
        $this->modalidades = (array) $modalidades; // Siempre array
    }

    public function collection()
    {
        $query = DB::table('declaracion_jurada as dj')
            ->leftJoin('info_postulante as ip', 'ip.id', '=', 'dj.info_postulante_id')
            ->selectRaw("
                ip.c_numdoc AS DNI,
                CONCAT(ip.c_apepat, ' ', ip.c_apemat, ' ', ip.c_nombres) AS Nombre,
                
                CASE dj.id_mod_ing
                    WHEN 'B' THEN 'Primeros Puestos'
                    WHEN 'A' THEN 'Ordinario'
                    WHEN 'O' THEN 'Alto Rendimiento'
                    WHEN 'D' THEN 'Traslado Externo'
                    WHEN 'C' THEN 'Admisión Pre-UMA'
                    WHEN 'L' THEN 'Titulos y Graduados'
                    ELSE 'Desconocida'
                END AS Modalidad,

                CASE 
                    WHEN dj.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dj.formulario_inscripcion = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Formulario_Inscripcion,

                CASE 
                    WHEN dj.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dj.comprobante_pago = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Comprobante_Pago,

                CASE 
                    WHEN dj.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dj.copia_dni = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Copia_DNI,

                CASE 
                    WHEN dj.id_mod_ing IN ('A','B','C','D','L','O') THEN 
                        CASE WHEN dj.seguro_salud = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Seguro_Salud,

                CASE 
                    WHEN dj.id_mod_ing IN ('A','B','C','O') THEN 
                        CASE WHEN dj.certificado_estudios = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Certificado_Estudios,

                CASE 
                    WHEN dj.id_mod_ing IN ('B','O') THEN 
                        CASE WHEN dj.certificado_notas_original = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Certificado_Notas,

                CASE 
                    WHEN dj.id_mod_ing IN ('D','L') THEN 
                        CASE WHEN dj.constancia_primera_matricula = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Constancia_Primera_Matricula,

                CASE 
                    WHEN dj.id_mod_ing IN ('D','L') THEN 
                        CASE WHEN dj.syllabus_visados = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Syllabus_Visados,

                CASE 
                    WHEN dj.id_mod_ing = 'L' THEN 
                        CASE WHEN dj.titulo_tecnico = '1' THEN 'PRESENTÓ' ELSE 'FALTA' END
                    ELSE 'NO APLICA'
                END AS Titulo_Tecnico
            ")
            ->orderBy('ip.c_apepat');

        if (!in_array('ALL', $this->modalidades)) {
            $query->whereIn('dj.id_mod_ing', $this->modalidades);
        }
            return $query->get();
        }

    public function headings(): array
    {
        return [
            'DNI', 'Nombre', 'Modalidad',
            'Formulario_Inscripcion', 'Comprobante_Pago', 'Copia_DNI',
            'Seguro_Salud', 'Certificado_Estudios', 'Certificado_Notas',
            'Constancia_Primera_Matricula', 'Syllabus_Visados', 'Titulo_Tecnico'
        ];
    }
}
