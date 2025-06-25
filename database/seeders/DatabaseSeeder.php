<?php

namespace Database\Seeders;

use App\Models\ModalidadIngreso;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserAdminSeeder::class,
            ModuleSeeder::class,
            ItemSeeder::class,
            PermissionSeeder::class,
            EstadosIngresoSeeder::class,
            PermissionPostulanteSeeder::class,
        ]);
    }
}
