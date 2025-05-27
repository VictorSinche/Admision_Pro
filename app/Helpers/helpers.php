<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('tienePermisoPostulante')) {
    function tienePermisoPostulante(string $codigo): bool
    {
        $dni = session('dni_postulante');

        if (!$dni) return false;

        $postulante = DB::table('postulantes')->where('dni', $dni)->first();

        if (!$postulante) return false;

        return DB::table('permissions_postulantes')
            ->join('items', 'permissions_postulantes.item_id', '=', 'items.id')
            ->where('permissions_postulantes.postulante_id', $postulante->id)
            ->where('items.codigo', $codigo)
            ->where('permissions_postulantes.estado', 'A')
            ->exists();
    }

    function tieneAlgunPermiso(array $codigos): bool
        {
            foreach ($codigos as $codigo) {
                if (tienePermisoPostulante($codigo)) return true;
            }
            return false;
        }

}
