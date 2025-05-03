<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPostulante extends Model
{
    protected $table = 'info_postulante';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'direccion',
        'sexo',
        'fecha_nacimiento',
        'distrito',
        'celular',
        'modalidad_ingreso_id',
        'programa_interes',
        'proceso_admision',
        'sede',
        'estado',
        'fecha_confirmacion',
    ];
}
