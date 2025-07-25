<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostulanteCredencial extends Model
{
    protected $table = 'postulante_credenciales';

    protected $fillable = [
        'cliente_id',
        'username',
        'password_hash',
    ];
}
