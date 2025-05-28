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
        UserAdmin::updateOrCreate(
            ['email' => 'ti@uma.edu.pe'], // condición de búsqueda
            [
                'nombre'    => 'Super',
                'apellidos' => 'Administrador',
                'genero'    => 'Masculino',
                'grado'     => 'Admin',
                'estado'    => true,
                'password'  => Hash::make('admin123'), // puedes usar env('DEFAULT_ADMIN_PASS') si deseas
            ]
        );
    }
}
