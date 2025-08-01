<?php

namespace App\Http\Controllers;

use App\Models\PostulanteCredencial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\UserAdmin;
class PostulanteLoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function viewUser()
    {
        $usuarios = UserAdmin::all();
        return view('auth.listyPermisos.listuser', compact('usuarios'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'dni' => 'required', // sigue siendo un solo input, puede ser DNI o correo
            'password' => 'required',
        ]);

        $input = $request->dni; // puede ser DNI o correo

        // 🔄 Limpiar sesión previa
        session()->forget([
            'dni_postulante',
            'datos_postulante',
            'postulante_data',
            'c_numdoc',
            'numero_documento',
            'nombre_completo',
            'correo',
        ]);

        // 🧠 ¿Es correo o DNI?
        $esCorreo = filter_var($input, FILTER_VALIDATE_EMAIL);

        if ($esCorreo) {
            // 🔐 ADMIN: buscar por email
            $admin = \App\Models\UserAdmin::where('email', $input)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                // 💾 Guardar sesión
                session([
                    'admin_id'        => $admin->id,
                    'admin_name'      => $admin->nombre . ' ' . $admin->apellidos,
                    'nombre_completo' => $admin->nombre . ' ' . $admin->apellidos,
                    'correo'          => $admin->email,
                    'rol'             => 'admin',
                    'cod_user'        => $admin->cod_user,
                ]);
                Log::info('📥 Datos del administrador:', (array) $admin);
                return redirect()->route('dashboard.dashboard');
            }
            return back()->with('error', '❌ Credenciales inválidas (admin).');
        } else {
            // 🔐 POSTULANTE: buscar por DNI
            $dni = $input;

            $postulante = DB::connection('mysql')
                ->table('sga_tb_adm_cliente')
                ->where('c_numdoc', $dni)
                ->first();

            if (!$postulante) {
                return back()->with('error', '❌ DNI no encontrado.');
            }

            // Buscar credenciales por cliente_id y username = dni
            $credencial = PostulanteCredencial::where('cliente_id', $postulante->id_cliente)
                ->where('username', $dni)
                ->first();

            if (!$credencial) {
                return back()->with('error', '❌ No tienes credenciales generadas. Comunícate con Admisión.');
            }

            // Verificar contraseña hash
            if (!Hash::check($request->password, $credencial->password_hash)) {
                return back()->with('error', '❌ Contraseña incorrecta (postulante).');
            }

            // ✅ Password correcta: crear sesión
            session([
                'dni_postulante'   => $postulante->c_numdoc,
                'datos_postulante' => $postulante,
                'c_numdoc'         => $postulante->c_numdoc,
                'nombre_completo'  => $postulante->c_nombres . ' ' . $postulante->c_apepat . ' ' . $postulante->c_apemat,
                'correo'           => $postulante->c_email,
                'rol'              => 'postulante',
            ]);

            // Crear en base local si no existe
            $postulanteLocal = DB::table('postulantes')->where('dni', $postulante->c_numdoc)->first();

            if (!$postulanteLocal) {
                $postulanteId = DB::table('postulantes')->insertGetId([
                    'dni'        => $postulante->c_numdoc,
                    'nombres'    => $postulante->c_nombres,
                    'apellidos'  => $postulante->c_apepat . ' ' . $postulante->c_apemat,
                    'email'      => $postulante->c_email,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Asignar todos los ítems del módulo POS
                $moduloPosId = DB::table('modules')->where('codigo', 'POS')->value('id');
                $itemPosIds = DB::table('items')->where('module_id', $moduloPosId)->pluck('id');

                foreach ($itemPosIds as $itemId) {
                    DB::table('permissions_postulantes')->updateOrInsert(
                        ['postulante_id' => $postulanteId, 'item_id' => $itemId],
                        [
                            'estado'     => 'A',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                }

                // Asignar el ítem dash.2
                $itemDash = DB::table('items')->where('codigo', 'dash.2')->first();
                if ($itemDash) {
                    DB::table('permissions_postulantes')->updateOrInsert(
                        ['postulante_id' => $postulanteId, 'item_id' => $itemDash->id],
                        [
                            'estado'     => 'A',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                }

                // Asignar el ítem PET.1
                $itemPet = DB::table('items')->where('codigo', 'PET.1')->first();
                if ($itemPet) {
                    DB::table('permissions_postulantes')->updateOrInsert(
                        ['postulante_id' => $postulanteId, 'item_id' => $itemPet->id],
                        [
                            'estado'     => 'A',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                }
            }

            return redirect()->route('dashboardPost.dashboard');
        }

    }

    public function createUpdateUser(Request $request)
    {
        $request->validate([
            'nombre'    => 'required',
            'apellidos' => 'required',
            'email'     => 'required|email|unique:users_admin,email,' . $request->id,
            'genero'    => 'required',
            'grado'     => 'nullable|string',
            'password'  => $request->id ? 'nullable|min:6' : 'required|min:6',
        ]);

        if ($request->id) {
            // 🔁 ACTUALIZAR
            $usuario = \App\Models\UserAdmin::findOrFail($request->id);
            $usuario->nombre    = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->email     = $request->email;
            $usuario->genero    = $request->genero;
            $usuario->grado     = $request->grado;

            if ($request->filled('password')) {
                $usuario->password = bcrypt($request->password);
            }

            $usuario->save();
            $mensaje = '✅ Usuario actualizado correctamente.';

        } else {
            // 🆕 CREAR
            $codigo = strtoupper(substr($request->nombre, 0, 1) . substr($request->apellidos, 0, 2));
            $rand   = substr(Str::uuid(), 0, 5);
            $cod_user = "{$codigo}{$rand}";

            UserAdmin::create([
                'cod_user'  => $cod_user,
                'nombre'    => $request->nombre,
                'apellidos' => $request->apellidos,
                'email'     => $request->email,
                'genero'    => $request->genero,
                'grado'     => $request->grado,
                'password'  => bcrypt($request->password),
            ]);

            $mensaje = '✅ Usuario creado correctamente.';
        }

        return back()->with('success', $mensaje);
    }

    public function logout(Request $request){
        session()->flush();
        return redirect()->route('login.postulante');
    }
}
