<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerificacionDocumento extends Model
{
    use HasFactory;

    protected $table = 'verificacion_documentos';

    protected $fillable = [
        'info_postulante_id',
        'formulario',
        'pago',
        'dni',
        'dj',
        'foto',
        'confirmado_por',
    ];

    /**
     * Relación con el postulante
     */
    public function postulante()
    {
        return $this->belongsTo(InfoPostulante::class, 'info_postulante_id');
    }
}
