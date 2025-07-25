<?php

namespace App\Http\Controllers;

use App\Mail\CredencialesPostulanteMail;
use App\Models\PostulanteCredencial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            ->where('codesp', '<>', 'E1')
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
        // Valida lo mínimo indispensable (ajusta según tu caso)
        $request->validate([
            'c_apepat'   => 'required|string|max:50',
            'c_apemat'   => 'required|string|max:50',
            'c_nombres'  => 'required|string|max:50',
            'c_tipdoc'   => 'required|string|max:10',
            'c_numdoc'   => 'required|string|max:11|unique:mysql.sga_tb_adm_cliente,c_numdoc',
            'd_fecnac'   => 'required|date',
            'c_ubigeo'   => 'required|string|size:6',
            'c_dir'      => 'required|string|max:100',
            'c_celu'     => 'nullable|string|max:30',
            'c_email'    => 'required|email|max:50',
            'c_sexo'     => 'required|string|size:1',
            'id_proceso' => 'required|integer',
            'c_codesp1'  => 'required|string|max:5',
        ]);

        $numDoc = $request->input('c_numdoc');
        $ubigeo = $request->input('c_ubigeo');

        // Generamos la contraseña en texto plano que verá el postulante
        $passwordPlano = Str::upper(Str::random(3)) . $numDoc; // Ej: ABC12345678

        try {
            // Usa la misma conexión que usa tu tabla sga_tb_adm_cliente
            DB::connection('mysql')->beginTransaction();

            // 1) Insertar postulante y obtener su id_cliente
            $idCliente = DB::connection('mysql')
                ->table('sga_tb_adm_cliente')
                ->insertGetId([
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

                    // Mantienes los originales:
                    'id_user'        => 'web' . $numDoc,
                    'cod_asesor'     => 'web' . $numDoc,

                    // Valores por defecto / opcionales
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
                    'c_ietnica'      => $request->input('c_ietnica', ''),

                    'created_at'     => now(),
                    'updated_at'     => now(),
                ], 'id_cliente'); // explícito (opcional en MySQL)
            
            // 2) Insertar credenciales en la nueva tabla con contraseña hasheada
            PostulanteCredencial::create([
                'cliente_id'    => $idCliente,
                'username'      => $numDoc,
                'password_hash' => Hash::make($passwordPlano),
            ]);

            // 3) Enviar correo con el usuario + contraseña en texto plano
            Mail::to($request->input('c_email'))->send(
                new CredencialesPostulanteMail(
                    $request->input('c_nombres'),
                    $numDoc,   // usuario que mantienes
                    $passwordPlano,    // contraseña temporal en texto plano
                    $request->input('c_email')
                )
            );

            DB::connection('mysql')->commit();

            return response()->json(['message' => '¡Registro exitoso! Se enviaron tus credenciales al correo.']);
        } catch (\Throwable $e) {
            DB::connection('mysql')->rollBack();

            return response()->json([
                'message' => 'Error al registrar al postulante.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}