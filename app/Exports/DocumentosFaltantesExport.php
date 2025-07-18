<?php

namespace App\Exports;

use App\Models\InfoPostulante;
use Illuminate\Support\Facades\DB;
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
            $postulante->estado == 1 ? '✔ COMPLETO' : '❌ INCOMPLETO',
            optional($postulante->documentos)->estado == 2 ? '✔ COMPLETO' : '❌ INCOMPLETO',
            optional($postulante->declaracionJurada)->id ? '✔ PRESENTÓ' : '❌ NO PRESENTÓ',
            optional($postulante->verificacion)->estado == 2 ? '✔ VALIDADO' : '❌ PENDIENTE',
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

// 📁 app/Exports/DocumentosFaltantesExport.php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentosFaltantesExport implements FromCollection, WithHeadings
{
    protected $modalidad;

    public function __construct($modalidad = null)
    {
        $this->modalidad = $modalidad;
    }

    public function collection()
    {
        $sql = "
        SELECT 
            ip.c_numdoc AS dni,
            CONCAT(ip.c_apepat, ' ', ip.c_apemat, ' ', ip.c_nombres) AS nombre_completo,
            ip.nomesp AS carrera,
            ip.id_mod_ing AS modalidad,

            IF(dp.formulario IS NULL OR LENGTH(dp.formulario) = 0, 'FALTA', 'OK') AS formulario,
            IF(dp.pago IS NULL OR LENGTH(dp.pago) = 0, 'FALTA', 'OK') AS pago,
            IF(dp.seguro IS NULL OR LENGTH(dp.seguro) = 0, 'FALTA', 'OK') AS seguro,
            IF(dp.dni IS NULL OR LENGTH(dp.dni) = 0, 'FALTA', 'OK') AS copia_dni,
            IF(dp.constancia IS NULL OR LENGTH(dp.constancia) = 0, 'FALTA', 'OK') AS constancia,
            IF(dp.merito IS NULL OR LENGTH(dp.merito) = 0, 'FALTA', 'OK') AS merito,
            IF(dp.constancianotas IS NULL OR LENGTH(dp.constancianotas) = 0, 'FALTA', 'OK') AS constancia_notas,
            IF(dp.syllabus IS NULL OR LENGTH(dp.syllabus) = 0, 'FALTA', 'OK') AS syllabus,
            IF(dp.certprofesional IS NULL OR LENGTH(dp.certprofesional) = 0, 'FALTA', 'OK') AS cert_profesional

        FROM info_postulante ip
        LEFT JOIN documentos_postulante dp ON dp.info_postulante_id = ip.id

        WHERE ip.id_mod_ing = ?

        AND (
            dp.formulario IS NULL OR LENGTH(dp.formulario) = 0 OR
            dp.pago IS NULL OR LENGTH(dp.pago) = 0 OR
            dp.seguro IS NULL OR LENGTH(dp.seguro) = 0 OR
            dp.dni IS NULL OR LENGTH(dp.dni) = 0 OR
            dp.constancia IS NULL OR LENGTH(dp.constancia) = 0 OR
            dp.merito IS NULL OR LENGTH(dp.merito) = 0 OR
            dp.constancianotas IS NULL OR LENGTH(dp.constancianotas) = 0 OR
            dp.syllabus IS NULL OR LENGTH(dp.syllabus) = 0 OR
            dp.certprofesional IS NULL OR LENGTH(dp.certprofesional) = 0
        )

        ORDER BY ip.nomesp, ip.c_apepat
        ";

        return collect(DB::select($sql, [$this->modalidad]));
    }

    public function headings(): array
    {
        return [
            'DNI', 'Nombre Completo', 'Carrera', 'Modalidad',
            'Formulario', 'Pago', 'Seguro', 'DNI Copia', 'Constancia', 'Mérito',
            'Notas', 'Syllabus', 'Cert. Profesional'
        ];
    }
}
