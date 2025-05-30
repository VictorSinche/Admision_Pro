<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarSesionAdmin
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('rol') || session('rol') !== 'admin') {
            return redirect()->route('login.postulante')->with('error', 'Debes iniciar sesión como administrador.');
        }

        return $next($request);
    }
}
