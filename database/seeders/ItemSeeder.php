<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener los IDs de los módulos por código
        $modulos = DB::table('modules')->pluck('id', 'codigo');

        $items = [
            //Dashboard
            ['module_codigo' => 'DASH', 'nombre' => 'Dashboard Admin', 'codigo' => 'DASH.1'],
            ['module_codigo' => 'DASH', 'nombre' => 'Dashboard Postulante', 'codigo' => 'DASH.2'],
            // Permisos
            ['module_codigo' => 'PER', 'nombre' => 'Lista de Usuarios', 'codigo' => 'PER.1'],
            ['module_codigo' => 'PER', 'nombre' => 'Permisos de Usuario', 'codigo' => 'PER.2'],
            // Postulante
            ['module_codigo' => 'POS', 'nombre' => 'Informacion Personal', 'codigo' => 'POS.1'],
            ['module_codigo' => 'POS', 'nombre' => 'Pagos Incripcion', 'codigo' => 'POS.2'],
            ['module_codigo' => 'POS', 'nombre' => 'Adjuntar Documentos', 'codigo' => 'POS.3'],
            // Admisión
            ['module_codigo' => 'ADM', 'nombre' => 'Lista de postulantes', 'codigo' => 'ADM.1'],
            ['module_codigo' => 'ADM', 'nombre' => 'Historial declaración jurada', 'codigo' => 'ADM.2'],
            ['module_codigo' => 'ADM', 'nombre' => 'Validar docs.', 'codigo' => 'ADM.3'],
            ['module_codigo' => 'ADM', 'nombre' => 'Control de documentos', 'codigo' => 'ADM.4'],
            ['module_codigo' => 'ADM', 'nombre' => 'Validar docs. Responsable', 'codigo' => 'ADM.5'],

            // Director
            ['module_codigo' => 'DIR', 'nombre' => 'Convalidación', 'codigo' => 'DIR.1'],
            // COA
            ['module_codigo' => 'COA', 'nombre' => 'Listado COA', 'codigo' => 'COA.1'],
            // OSAR
            ['module_codigo' => 'OSA', 'nombre' => 'Listado OSAR', 'codigo' => 'OSA.1'],
            // Tesorería
            ['module_codigo' => 'TES', 'nombre' => 'Listado Tesorería', 'codigo' => 'TES.1'],
        ];

        foreach ($items as $item) {
            $moduleId = $modulos[$item['module_codigo']] ?? null;

            if ($moduleId) {
                DB::table('items')->updateOrInsert(
                    ['module_id' => $moduleId, 'codigo' => $item['codigo']],
                    [
                        'nombre' => $item['nombre'],
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }
        }
    }
}
