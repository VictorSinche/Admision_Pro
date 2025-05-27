<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Hash;
class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserAdmin::create([
            'nombre'     => 'Super',
            'apellidos'  => 'Administrador',
            'email'      => 'admin@uma.edu.pe',
            'genero'     => 'Masculino',
            'grado'      => 'Lic.',
            'estado'     => true,
            'password'   => Hash::make('admin123'), // Cambia esto luego por seguridad
        ]);
    }
}
