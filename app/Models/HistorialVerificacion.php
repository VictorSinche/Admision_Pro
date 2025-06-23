<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialVerificacion extends Model
{
    protected $table = 'historial_verificaciones';

    protected $fillable = [
        'info_postulante_id',
        'campo',
        'estado',
        // 'actualizado_por',
    ];

    public function postulante()
    {
        return $this->belongsTo(InfoPostulante::class, 'info_postulante_id');
    }
}
