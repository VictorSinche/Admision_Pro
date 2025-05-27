<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class PostulantesDJExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = collect($data);
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Nombre Postulante',
            'DNI',
            'Carrera',
            'Tipo',
            'Fecha Registro',
            'Formulario Inscripción',
            'Comprobante de Pago',
            'Certificado de Estudios',
            'Constancia Colegio',
            'Copia DNI',
            'Seguro Salud',
            'Foto Carnet',
            'Certificado Notas Original',
            'Constancia 1ra Matrícula',
            'Syllabus Visados',
            'Título Técnico',
        ];
    }
}
