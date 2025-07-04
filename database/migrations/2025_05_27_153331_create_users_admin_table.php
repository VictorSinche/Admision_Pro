<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users_admin', function (Blueprint $table) {
            $table->id();
            $table->string('cod_user')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->string('grado')->nullable(); // ejem: Lic., Ing., Dra.
            $table->boolean('estado')->default(true); // activo = 1, inactivo = 0
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_admin');
    }
};
