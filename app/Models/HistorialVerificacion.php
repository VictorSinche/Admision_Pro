<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialVerificacion extends Model
{
    protected $table = 'historial_verificaciones';

    protected $fillable = [
        'info_postulante_id',
        'tabla',
        'campo',
        'estado',
        'cod_user',
        'observacion',
        'actualizado_por',
    ];

    public function postulante()
    {
        return $this->belongsTo(InfoPostulante::class, 'info_postulante_id');
    }
}
