<?php

namespace App\Helpers;

class Util
{
    public static function base64ImgRelativo($ruta)
    {
        $path = public_path($ruta);

        if (!file_exists($path)) {
            return ''; // O puedes devolver una imagen por defecto
        }

        $contenido = file_get_contents($path);
        return base64_encode($contenido);
    }
}
