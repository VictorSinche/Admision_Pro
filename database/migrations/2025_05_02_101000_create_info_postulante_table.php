<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_postulante', function (Blueprint $table) {
            $table->id();

            $table->char('id_mod_ing', 1);                  // Modalidad
            $table->string('c_apepat', 50);                 // Apellido paterno
            $table->string('c_apemat', 50);                 // Apellido materno
            $table->string('c_nombres', 50);                // Nombres
            $table->string('c_tipdoc', 10);                 // Tipo documento
            $table->string('c_numdoc', 11)->unique();       // Número documento
            $table->string('c_email', 50)->nullable();      // Correo
            $table->string('c_celu', 30)->nullable();       // Celular
            $table->string('nomesp', 100)->nullable();      // Nombre de la especialidad
            $table->string('c_codesp1', 5);                 // Programa de interés (especialidad)
            $table->integer('id_proceso');                  // Proceso de admisión
            $table->string('c_sedcod', 4)->nullable();      // Sede
            $table->tinyInteger('estado')->default(0);      // Estado: 0 = No confirmado, 1 = Confirmado
            $table->timestamp('fecha_confirmacion')->nullable(); // Fecha de confirmación
            $table->date('fecha_limite_docs')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_postulante');
    }
};
