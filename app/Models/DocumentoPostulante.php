<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoPostulante extends Model
{
    use HasFactory;

    protected $table = 'documentos_postulante';

    protected $fillable = [
        'info_postulante_id',
        'formulario',
        'pago',
        'constancia',
        'constancianotas',
        'dni',
        'seguro',
        'foto',
        'constmatricula',
        'certprofecional',
        'syllabus',
        'merito',
        'estado',
    ];

    public function postulante()
    {
        return $this->belongsTo(InfoPostulante::class, 'info_postulante_id');
    }
}

