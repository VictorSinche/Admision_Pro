<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionPostulanteSeeder extends Seeder
{
    // public function run(): void
    // {
    //     // Opcional: asegurarse de tener un postulante con id = 1
    //     $postulanteId = DB::table('postulantes')->value('id'); // solo uno como prueba

    //     // Obtener todos los ítems del módulo 'Postulante'
    //     $moduloId = DB::table('modules')->where('codigo', 'POS')->value('id');
    //     $itemIds = DB::table('items')->where('module_id', $moduloId)->pluck('id');

    //     foreach ($itemIds as $itemId) {
    //         DB::table('permissions_postulantes')->updateOrInsert(
    //             ['postulante_id' => $postulanteId, 'item_id' => $itemId],
    //             [
    //                 'estado' => 'A',
    //                 'created_at' => now(),
    //                 'updated_at' => now()
    //             ]
    //         );
    //     }
    // }
}
