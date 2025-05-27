<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\password;

class PostulanteLoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'dni' => 'required',
    //         'password' => 'required',
    //     ]);

    //     // 🔴 LIMPIAR SESIÓN ANTERIOR SI EXISTE
    //     session()->forget([
    //         'dni_postulante',
    //         'datos_postulante',
    //         'postulante_data',
    //         'c_numdoc',
    //         'numero_documento',
    //         'nombre_completo',
    //         'correo',
    //     ]);

    //     $postulante = DB::connection('mysql_sigu')
    //         ->table('sga_tb_adm_cliente')
    //         ->where('c_numdoc', $request->dni)
    //         ->first();

    //     if ($postulante) {
    //         Log::info('📥 Datos del postulante:', (array) $postulante);

    //         $passwordEsperada = 'web' . $postulante->c_numdoc;

    //         if ($request->password === $passwordEsperada) {
    //             // ✅ GUARDAR DATOS ACTUALES EN SESIÓN
    //             session([
    //                 'dni_postulante'    => $postulante->c_numdoc,
    //                 'datos_postulante' => $postulante,
    //                 'c_numdoc'          => $postulante->c_numdoc,
    //                 'nombre_completo'   => $postulante->c_nombres . ' ' . $postulante->c_apepat . ' ' . $postulante->c_apemat,
    //                 'correo'            => $postulante->c_email_institucional ?? $postulante->c_email,
    //             ]);

    //             Log::info('📌 DNI guardado en sesión:', [
    //                 'dni' => session('dni_postulante')
    //             ]);

    //             return redirect()->route('student.registro');
    //         }

    //         return back()->with('error', '❌ Contraseña incorrecta.');
    //     }

    //     return back()->with('error', '❌ DNI no encontrado en el sistema.');
    // }

    public function login(Request $request)
{
    $request->validate([
        'dni' => 'required',
        'password' => 'required',
    ]);

    session()->forget([
        'dni_postulante',
        'datos_postulante',
        'postulante_data',
        'c_numdoc',
        'numero_documento',
        'nombre_completo',
        'correo',
    ]);

    $postulante = DB::connection('mysql_sigu')
        ->table('sga_tb_adm_cliente')
        ->where('c_numdoc', $request->dni)
        ->first();

    if ($postulante) {
        Log::info('📥 Datos del postulante:', (array) $postulante);

        $passwordEsperada = 'web' . $postulante->c_numdoc;

        if ($request->password === $passwordEsperada) {
            // ✅ GUARDAR DATOS EN SESIÓN
            session([
                'dni_postulante'    => $postulante->c_numdoc,
                'datos_postulante' => $postulante,
                'c_numdoc'          => $postulante->c_numdoc,
                'nombre_completo'   => $postulante->c_nombres . ' ' . $postulante->c_apepat . ' ' . $postulante->c_apemat,
                'correo'            => $postulante->c_email_institucional ?? $postulante->c_email,
            ]);

            // ✅ VERIFICAR O REGISTRAR POSTULANTE LOCAL
            $postulanteLocal = DB::table('postulantes')->where('dni', $postulante->c_numdoc)->first();

            if (!$postulanteLocal) {
                $postulanteId = DB::table('postulantes')->insertGetId([
                    'dni'       => $postulante->c_numdoc,
                    'nombres'   => $postulante->c_nombres,
                    'apellidos' => $postulante->c_apepat . ' ' . $postulante->c_apemat,
                    'email'     => $postulante->c_email_institucional ?? $postulante->c_email,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // ✅ ASIGNAR PERMISOS DEL MÓDULO 'Postulante'
                $moduloId = DB::table('modules')->where('codigo', 'POS')->value('id');
                $itemIds = DB::table('items')->where('module_id', $moduloId)->pluck('id');

                foreach ($itemIds as $itemId) {
                    DB::table('permissions_postulantes')->updateOrInsert(
                        ['postulante_id' => $postulanteId, 'item_id' => $itemId],
                        [
                            'estado' => 'A',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                }
            }

            return redirect()->route('student.registro');
        }

        return back()->with('error', '❌ Contraseña incorrecta.');
    }

    return back()->with('error', '❌ DNI no encontrado en el sistema.');
}


}
