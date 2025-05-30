<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarSesionPostulante
{
    public function handle($request, Closure $next)
    {
        $rol = session('rol');

        if (!$rol || !in_array($rol, ['postulante', 'admin'])) {
            return redirect()->route('login.postulante')->with('error', 'Debes iniciar sesión para acceder.');
        }

        return $next($request);
    }
}