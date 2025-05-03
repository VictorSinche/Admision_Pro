<?php

namespace Database\Seeders;

use App\Models\ModalidadIngreso;
use Illuminate\Database\Seeder;

class ModalidadesIngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modalidades = [
            ['id_mod_ing' => '0', 'descripcion' => 'SIN MODALIDAD'],
            ['id_mod_ing' => 'B', 'descripcion' => 'PRIMEROS PUESTOS'],
            ['id_mod_ing' => 'A', 'descripcion' => 'MODALIDAD ORDINARIO'],
            ['id_mod_ing' => 'O', 'descripcion' => 'ALTO RENDIMIENTO'],
            ['id_mod_ing' => 'D', 'descripcion' => 'TRASLADO EXTERNO'],
            ['id_mod_ing' => 'M', 'descripcion' => 'ADMISIÓN TÉCNICO'],
            ['id_mod_ing' => 'C', 'descripcion' => 'PRE UMA'],
        ];
        
        foreach ($modalidades as $n) {
            $m = new ModalidadIngreso($n);
            $m->save();
        }        
    }
}
