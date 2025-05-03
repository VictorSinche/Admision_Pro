<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadIngreso extends Model
{
    protected $table = 'modalidades_ingreso';

    protected $fillable = [
        'id_mod_ing',
        'descripcion',
    ];
}
