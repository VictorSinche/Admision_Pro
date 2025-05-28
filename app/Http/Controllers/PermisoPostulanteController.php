<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserAdmin;

class PermisoPostulanteController extends Controller
{
    public function index(Request $request)
    {
        $usuario = null;
        $permisosActuales = [];
        $items = [];

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');

            // Si es un correo, asumimos que es un admin
            if (filter_var($buscar, FILTER_VALIDATE_EMAIL)) {
                $admin = UserAdmin::where('email', $buscar)->first();

                if ($admin) {
                    $usuario = (object)[
                        'id'        => $admin->id,
                        'nombres'   => $admin->nombre,
                        'apellidos' => $admin->apellidos,
                        'email'     => $admin->email,
                        'tipo'      => 'admin'
                    ];

                    $permisosActuales = DB::table('permissions')
                        ->where('user_id', $admin->id)
                        ->pluck('item_id')
                        ->toArray();
                }
            } else {
                // Si no es correo, buscamos en postulantes
                $postulante = DB::table('postulantes')
                    ->where('dni', $buscar)
                    ->orWhere('email', $buscar)
                    ->first();

                if ($postulante) {
                    $usuario = (object)[
                        'id'        => $postulante->id,
                        'nombres'   => $postulante->nombres,
                        'apellidos' => $postulante->apellidos,
                        'dni'       => $postulante->dni,
                        'tipo'      => 'postulante'
                    ];

                    $permisosActuales = DB::table('permissions_postulantes')
                        ->where('postulante_id', $postulante->id)
                        ->pluck('item_id')
                        ->toArray();
                }
            }

            if ($usuario) {
                $items = DB::table('items')
                    ->join('modules', 'items.module_id', '=', 'modules.id')
                    ->select('items.id', 'items.nombre as item', 'items.codigo', 'modules.nombre as modulo')
                    ->orderBy('modules.nombre')
                    ->orderBy('items.nombre')
                    ->get();
            }
        }

        return view('auth.listyPermisos.permisos', compact('usuario', 'permisosActuales', 'items'));
    }

    public function update(Request $request)
    {
        $itemsSeleccionados = $request->input('items', []);

        if ($request->has('postulante_id')) {
            $postulanteId = $request->input('postulante_id');

            DB::table('permissions_postulantes')->where('postulante_id', $postulanteId)->delete();

            foreach ($itemsSeleccionados as $itemId) {
                DB::table('permissions_postulantes')->insert([
                    'postulante_id' => $postulanteId,
                    'item_id'       => $itemId,
                    'estado'        => 'A',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }

        if ($request->has('user_id')) {
            $userId = $request->input('user_id');

            DB::table('permissions')->where('user_id', $userId)->delete();

            foreach ($itemsSeleccionados as $itemId) {
                DB::table('permissions')->insert([
                    'user_id'    => $userId,
                    'item_id'    => $itemId,
                    'estado'     => 'A',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('user.listPermisos')->with('success', 'Permisos actualizados correctamente.');
    }
}
