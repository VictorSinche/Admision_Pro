<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('tienePermisoGlobal')) {
    function tienePermisoGlobal(string $codigo): bool
    {
        // 👉 PRIMERO: Validar si es POSTULANTE
        $dni = session('dni_postulante');
        if ($dni) {
            $postulante = DB::table('postulantes')->where('dni', $dni)->first();
            if ($postulante) {
                return DB::table('permissions_postulantes')
                    ->join('items', 'permissions_postulantes.item_id', '=', 'items.id')
                    ->where('permissions_postulantes.postulante_id', $postulante->id)
                    ->where('items.codigo', $codigo)
                    ->where('permissions_postulantes.estado', 'A')
                    ->exists();
            }
        }

        // 👉 SI NO ES POSTULANTE, validar si es ADMIN
        $correo = session('correo');
        if ($correo) {
            $admin = DB::table('users_admin')->where('email', $correo)->first();
            if ($admin) {
                return DB::table('permissions')
                    ->join('items', 'permissions.item_id', '=', 'items.id')
                    ->where('permissions.user_id', $admin->id)
                    ->where('items.codigo', $codigo)
                    ->where('permissions.estado', 'A')
                    ->exists();
            }
        }

        return false;
    }

    function tieneAlgunPermisoGlobal(array $codigos): bool
    {
        foreach ($codigos as $codigo) {
            if (tienePermisoGlobal($codigo)) return true;
        }
        return false;
    }
}
