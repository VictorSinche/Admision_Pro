<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosIngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ['estado' => '1', 'tabla' => 'documentos_postulante', 'tipo_estado' => 'incompletos'],
            ['estado' => '2', 'tabla' => 'documentos_postulante', 'tipo_estado' => 'completos'],
            ['estado' => '1', 'tabla' => 'declaracion_jurada', 'tipo_estado' => 'completo'],
            ['estado' => '0', 'tabla' => 'verificacion_documentos', 'tipo_estado' => 'en revisión o falta'],
            ['estado' => '1', 'tabla' => 'verificacion_documentos', 'tipo_estado' => 'válido'],
            ['estado' => '2', 'tabla' => 'verificacion_documentos', 'tipo_estado' => 'válido'],
        ];

        foreach ($estados as $estado) {
            DB::table('tipos_estados')->updateOrInsert(
                [
                    'estado' => $estado['estado'],
                    'tabla' => $estado['tabla'],
                    'tipo_estado' => $estado['tipo_estado']
                ],
                [
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }
    }
}
