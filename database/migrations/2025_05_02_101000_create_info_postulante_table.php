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
            $table->string('numero_documento')->unique();
            $table->string('tipo_documento', 10);
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('correo')->nullable();
            $table->string('celular')->nullable();
            $table->foreignId('modalidad_ingreso_id')->constrained('modalidades_ingreso');
            $table->unsignedTinyInteger('programa_interes');
            $table->unsignedTinyInteger('proceso_admision');
            $table->unsignedTinyInteger('sede')->nullable();
            $table->tinyInteger('estado')->default(0); // 0 = No confirmado, 1 = Confirmado
            $table->timestamp('fecha_confirmacion')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infopostulante');
    }
};
