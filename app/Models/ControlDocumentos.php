<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlDocumentos extends Model
{
    protected $table = 'control_documentos';

    protected $fillable = [
        'info_postulante_id',
        'formulario',
        'pago',
        'constancia',
        'constancianotas',
        'dni',
        'seguro',
        'constmatricula',
        'certprofesional',
        'syllabus',
        'merito',
    ];

    public function postulante()
    {
        return $this->belongsTo(InfoPostulante::class, 'info_postulante_id');
    }
}
