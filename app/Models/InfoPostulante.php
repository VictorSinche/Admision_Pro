<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPostulante extends Model
{
    protected $table = 'info_postulante';

    protected $fillable = [
        'id_mod_ing', 'c_apepat', 'c_apemat', 'c_nombres', 'c_tipdoc', 'c_numdoc',
        'c_email', 'c_celu', 'c_codesp1', 'id_proceso', 'c_sedcod',
        'estado', 'fecha_confirmacion', 'nomesp'
    ];

    public function documentos()
    {
        return $this->hasOne(\App\Models\DocumentoPostulante::class, 'info_postulante_id');
    }

    public function verificacion()
    {
        return $this->hasOne(\App\Models\VerificacionDocumento::class, 'info_postulante_id');
    }

}
