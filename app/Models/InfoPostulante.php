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
        return $this->hasOne(DocumentoPostulante::class, 'info_postulante_id');
    }

    public function verificacion()
    {
        return $this->hasOne(VerificacionDocumento::class, 'info_postulante_id');
    }

    public function historial()
    {
        return $this->hasMany(HistorialVerificacion::class, 'info_postulante_id');
    }

    public function controlDocumentos()
    {
        return $this->hasOne(ControlDocumentos::class, 'info_postulante_id');
    }
    public function declaracionJurada()
    {
        return $this->hasOne(DeclaracionJurada::class, 'info_postulante_id');
    }

}
