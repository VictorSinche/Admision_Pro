<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DeclaracionJurada;
use Illuminate\Support\Facades\Log;

class DeclaracionJuradaController extends Controller
{

    public function descargarDeclaracionJuradaPDF()
    {
        $dni = session('c_numdoc');
        Log::info('📥 Iniciando descarga de declaración jurada para DNI: ' . $dni);

        if (!$dni) {
            Log::warning('⛔ No hay sesión activa.');
            return redirect()->route('login.postulante')->with('error', 'Debes iniciar sesión.');
        }

        $declaracion = DeclaracionJurada::whereHas('infoPostulante', function ($query) use ($dni) {
            $query->where('c_numdoc', $dni);
        })->first();

        if (!$declaracion) {
            Log::warning('❌ No se encontró la declaración para el DNI: ' . $dni);
            return redirect()->back()->with('error', 'No se encontró tu declaración jurada.');
        }

        // Cargar data externa
        $data = DB::connection('mysql_sigu')
            ->table('sga_tb_adm_cliente')
            ->where('c_numdoc', $dni)
            ->first();

        if (!$data) {
            Log::error('❌ No se encontraron datos del postulante en mysql_sigu para el DNI: ' . $dni);
            return redirect()->back()->with('error', 'No se encontraron datos completos del postulante.');
        }

                // Cargar ubigeo: se arma el código con 3 partes
        $codigoUbigeo = $data->c_dptodom . $data->c_provdom . $data->c_distdom;
        $ubigeo = DB::connection('mysql_sigu')
            ->table('vw_ubigeo')
            ->where('codigo', $codigoUbigeo)
            ->value('nombre');
        Log::info('📍 Ubigeo: ' . $ubigeo);

        // Cargar especialidades
        $especialidades = DB::connection('mysql_sigu')->table('tb_especialidad')->get();
        Log::info('🎓 Especialidades cargadas: ' . $especialidades->count());

        $pdf = Pdf::loadView('pdf.declaracionJurada.informe-declaracion-jurada', [
            'declaracion' => $declaracion,
            'especialidades' => $especialidades,
            'nombreDistrito' => $ubigeo,
            'data' => $data,
        ]);

        Log::info('✅ PDF generado correctamente.');

        return $pdf->download('declaracion-jurada-' . $dni . '.pdf');
    }

}
