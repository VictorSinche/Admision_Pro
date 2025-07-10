<?php

namespace App\Http\Controllers;

use App\Mail\CredencialesPostulanteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CreatePostulanteController  extends Controller
{
    public function mostrarFormulario()
    {
        // Traer todos los ubigeos desde la base mysql_sigu
        $ubigeos = DB::connection('mysql_sigu')
            ->table('vw_ubigeo')
            ->select('codigo', 'nombre')
            ->get();

        $procesos = DB::connection('mysql_sigu')
            ->table('sga_tb_adm_proceso')
            ->where('c_codpro', '20252')
            ->get();

        $especialidades = DB::connection('mysql_sigu')
            ->table('tb_especialidad')
            ->get();

            $modalidades = DB::connection('mysql_sigu')
            ->table('sga_tb_modalidad_ingreso')
            ->where('c_web', 'SI')
            ->get();

        return view('register.registro', [
            'modalidades' => $modalidades,
            'ubigeos' => $ubigeos,
            'procesos' => $procesos,
            'especialidades' => $especialidades,
            'data' => null
        ]);
    }

    public function registrarPostulante(Request $request)
        {
            try {
                $numDoc = $request->input('c_numdoc');
                $ubigeo = $request->input('c_ubigeo');

                DB::connection('mysql_sigu_permits')->table('sga_tb_adm_cliente')->insert([
                    'id_fase'        => $request->input('id_face', 1),
                    'id_mod_ing'     => $request->input('id_mod_ing'),
                    'c_apepat'       => $request->input('c_apepat'),
                    'c_apemat'       => $request->input('c_apemat'),
                    'c_nombres'      => $request->input('c_nombres'),
                    'c_tipdoc'       => $request->input('c_tipdoc'),
                    'c_numdoc'       => $numDoc,
                    'd_fecnac'       => $request->input('d_fecnac'),
                    'c_dptodom'      => substr($ubigeo, 0, 2),
                    'c_provdom'      => substr($ubigeo, 2, 2),
                    'c_distdom'      => substr($ubigeo, 4, 2),
                    'c_dir'          => $request->input('c_dir'),
                    'c_celu'         => $request->input('c_celu'),
                    'c_email'        => $request->input('c_email'),
                    'c_sexo'         => $request->input('c_sexo'),
                    'id_proceso'     => $request->input('id_proceso'),
                    'c_codesp1'      => $request->input('c_codesp1'),
                    'c_codesp2'      => $request->input('c_codesp1'),

                    // Valores por defecto o vacíos
                    'c_procedencia'  => $request->input('c_procedencia', ''),
                    'c_colg_ubicacion' => $request->input('c_colg_ubicacion', ''),
                    'c_anoegreso'    => $request->input('c_anoegreso', ''),
                    'c_tippro'       => $request->input('c_tippro', ''),
                    'c_codfac1'      => $request->input('c_codfac1', ''),
                    'c_codfac2'      => $request->input('c_codfac2', ''),
                    'c_codesp2'      => $request->input('c_codesp2', ''),
                    'c_sedcod'       => $request->input('c_sedcod', ''),
                    'c_codmod'       => $request->input('c_codmod', ''),
                    'id_tab_turno'   => $request->input('id_tab_turno', ''),
                    'id_tab_sitalu'  => $request->input('id_tab_sitalu', ''),
                    'c_nomapo'       => $request->input('c_nomapo', ''),
                    'c_dniapo'       => $request->input('c_dniapo', ''),
                    'c_fonoapo'      => $request->input('c_fonoapo', ''),
                    'c_celuapo'      => $request->input('c_celuapo', ''),
                    'id_tab_alu_contact' => $request->input('id_tab_alu_contact', ''),
                    'c_paisnac'      => $request->input('c_paisnac', ''),
                    'c_ietnica'      => $request->input('c_ietnica'),

                    // Concatenaciones
                    'id_user'        => 'web' . $numDoc,
                    'cod_asesor'     => 'web' . $numDoc,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Mail::to($request->input('c_email'))->send(
                    new CredencialesPostulanteMail(
                        $request->input('c_nombres'),
                        $numDoc,
                        $request->input('c_email')
                    )
                );

                return response()->json(['message' => '¡Registro exitoso! Se enviaron tus credenciales al correo.']);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Error al registrar al postulante.',
                    'error'   => $e->getMessage()
                ], 500);
            }
        }

}