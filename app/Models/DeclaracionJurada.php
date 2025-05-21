<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionJurada extends Model
{
    protected $table = 'declaracion_jurada';

    protected $fillable = [
        'info_postulante_id',
        'id_mod_ing',
        'formulario_inscripcion',
        'comprobante_pago',
        'certificado_estudios',
        'copia_dni',
        'seguro_salud',
        'foto_carnet',
        'certificado_notas_original',
        'constancia_primera_matricula',
        'syllabus_visados',
        'titulo_tecnico',
        'constancia_colegio',
        'selectVinculo',
        'estado',
    ];

    // Relación con InfoPostulante (opcional, si quieres usarla)
    public function postulante()
    {
        return $this->belongsTo(InfoPostulante::class, 'info_postulante_id');
    }
}
