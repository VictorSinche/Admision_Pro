<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['nombre' => 'Postulante', 'codigo' => 'POS'],
            ['nombre' => 'Admisión', 'codigo' => 'ADM'],
            ['nombre' => 'COA', 'codigo' => 'COA'],
            ['nombre' => 'OSAR', 'codigo' => 'OSA'],
            ['nombre' => 'Director', 'codigo' => 'DIR'],
            ['nombre' => 'Tesorería', 'codigo' => 'TES'],
        ];

        foreach ($modules as $modulo) {
            DB::table('modules')->updateOrInsert(
                ['codigo' => $modulo['codigo']], // Condición de búsqueda
                [
                    'nombre' => $modulo['nombre'],
                    'estado' => 'A',
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }
    }
    
}
