<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPostulante;
use App\Models\InfoPostulante;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $currentStep = 1;

        return view('dashboardAdmin.dashboard', compact('currentStep'));
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
            ->leftJoin('sga_tb_adm_cliente as sga', 'sga.c_numdoc', '=', 'p.dni')
            ->select(
                'p.id',
                'ip.c_numdoc',
                DB::raw("CONCAT(p.nombres, ' ', p.apellidos) as nombre_completo"),
                'p.email',
                'ip.estado as estado_info',
                'dp.estado as estado_docs',
                'dj.estado as estado_dj',
                'vd.estado as estado_verificacion',
                // Campos individuales desde verificacion_documentos
                'vd.formulario',
                'vd.pago',
                'vd.dni',
                'vd.seguro',
                'vd.constancia',
                'vd.merito',
                'vd.constancianotas',
                'vd.syllabus',
                'vd.certprofesional',
                'sga.created_at as fecha_registro',
                'ip.id_mod_ing as modalidad',
            )

            ->where('p.dni', $dni)
            ->get();

        return view('dashboardPostulante.dashboard', compact('postulantes'));
    }

    /*
    |--------------------------------------------------------------------------
    | Funciones para el dashboard del administrador
    |--------------------------------------------------------------------------
    */
    public function getKPIs()
    {
        // Total postulantes
        $total_postulantes = DB::table('info_postulante')->count();

        // Sin declaración jurada (estado null o 0)
        $sin_declaracion = DB::table('info_postulante as ip')
            ->leftJoin('declaracion_jurada as dj', 'dj.info_postulante_id', '=', 'ip.id')
            ->whereNull('dj.id')
            ->count();

        // Documentos incompletos (estado = 1)
        $documentos_incompletos = DB::table('documentos_postulante')
            ->where('estado', 1)
            ->count();

        // Completos: declaración.estado = 1 y documentos.estado = 2
        $completos = DB::table('info_postulante as ip')
            ->join('declaracion_jurada as dj', 'dj.info_postulante_id', '=', 'ip.id')
            ->join('documentos_postulante as dp', 'dp.info_postulante_id', '=', 'ip.id')
            ->where('dj.estado', 1)
            ->where('dp.estado', 2)
            ->distinct('ip.id')
            ->count('ip.id');

        return view('dashboardAdmin.dashboard', compact(
            'total_postulantes',
            'sin_declaracion',
            'documentos_incompletos',
            'completos'
        ));
    }
    
    public function obtenerDatosGraficos()
    {
        // Modalidades y colores por código
        $modalidades = [
            'A' => ['label' => 'Ordinario', 'color' => '#3B82F6'],
            'B' => ['label' => 'Primeros Puestos', 'color' => '#10B981'],
            'C' => ['label' => 'Pre UMA', 'color' => '#6366F1'],
            'D' => ['label' => 'Traslados E.', 'color' => '#F59E0B'],
            'L' => ['label' => 'Tit. o Grad.', 'color' => '#8B5CF6'],
            'O' => ['label' => 'Alto Rendimiento', 'color' => '#EC4899'],
            'R' => ['label' => 'Segunda Carrera', 'color' => '#F87171'],
        ];

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($modalidades as $codigo => $info) {
            $labels[] = $info['label'];
            $data[] = InfoPostulante::where('id_mod_ing', $codigo)->count();
            $colors[] = $info['color'];
        }

        // Documentación completa e incompleta
        $completos = DocumentoPostulante::where('estado', 2)->count();
        $incompletos = DocumentoPostulante::where('estado', '!=', 2)->count();

        return response()->json([
            'labels_modalidad' => $labels,
            'data_modalidad' => $data,
            'colors_modalidad' => $colors,
            'documentacion' => [
                'labels' => ['Completos', 'Incompletos'],
                'data' => [$completos, $incompletos],
                'colors' => ['#10B981', '#EF4444']
            ]
        ]);
    }

}

