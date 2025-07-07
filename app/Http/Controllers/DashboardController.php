<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $currentStep = 1;

        return view('dashboardAdmin.dashboard', compact('currentStep')); // Asegúrate de tener la vista en resources/views/dashboard/index.blade.php
    }

    public function resumenEstados()
    {
        $dni = session('dni_postulante');

        if (!$dni) {
            abort(403, 'Acceso no autorizado');
        }

        $postulantes = DB::table('postulantes as p')
            ->leftJoin('info_postulante as ip', 'ip.c_numdoc', '=', 'p.dni')
            ->leftJoin('documentos_postulante as dp', 'dp.info_postulante_id', '=', 'ip.id')
            ->leftJoin('declaracion_jurada as dj', 'dj.info_postulante_id', '=', 'ip.id')
            ->leftJoin('verificacion_documentos as vd', 'vd.info_postulante_id', '=', 'ip.id')
            ->select(
                'p.id',
                'ip.c_numdoc',
                DB::raw("CONCAT(p.nombres, ' ', p.apellidos) as nombre_completo"),
                'p.email',
                'ip.estado as estado_info',
                'dp.estado as estado_docs',
                'dj.estado as estado_dj',
                'vd.estado as estado_verificacion'
            )
            ->where('p.dni', $dni)
            ->get();

        return view('dashboardPostulante.dashboard', compact('postulantes'));
    }

}
