<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DeclaracionJurada;
use Illuminate\Support\Facades\Log;

class DeclaracionJuradaController extends Controller
{

public function descargarDeclaracionJuradaPDF($dni = null)
{
    // Si no viene como parámetro y no hay sesión, bloquear
    if (!$dni) {
        $dni = session('c_numdoc');
    }

    if (!$dni) {
        Log::warning('⛔ No hay DNI proporcionado ni sesión activa.');
        return redirect()->route('login.postulante')->with('error', 'Debes iniciar sesión.');
    }

    Log::info('📥 Iniciando descarga de declaración jurada para DNI: ' . $dni);

    $declaracion = DeclaracionJurada::whereHas('infoPostulante', function ($query) use ($dni) {
        $query->where('c_numdoc', $dni);
    })->first();

    if (!$declaracion) {
        Log::warning('❌ No se encontró la declaración para el DNI: ' . $dni);
        return redirect()->back()->with('error', 'No se encontró la declaración jurada.');
    }

    $data = DB::connection('mysql_sigu')
        ->table('sga_tb_adm_cliente')
        ->where('c_numdoc', $dni)
        ->first();

    if (!$data) {
        Log::error('❌ No se encontraron datos del postulante en mysql_sigu para el DNI: ' . $dni);
        return redirect()->back()->with('error', 'No se encontraron datos completos del postulante.');
    }

    $codigoUbigeo = $data->c_dptodom . $data->c_provdom . $data->c_distdom;
    $ubigeo = DB::connection('mysql_sigu')
        ->table('vw_ubigeo')
        ->where('codigo', $codigoUbigeo)
        ->value('nombre');

    $especialidades = DB::connection('mysql_sigu')->table('tb_especialidad')->get();

    $pdf = Pdf::loadView('pdf.declaracionJurada.informe-declaracion-jurada', [
        'declaracion' => $declaracion,
        'especialidades' => $especialidades,
        'nombreDistrito' => $ubigeo,
        'data' => $data,
    ]);

    Log::info('✅ PDF generado correctamente para ' . $dni);

    return $pdf->stream('declaracion-jurada-' . $dni . '.pdf', [
        'Attachment' => false,
    ]);
}

}
