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
        Schema::create('historial_verificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_postulante_id')->constrained('info_postulante');
            $table->string('campo'); // ejemplo: formulario, pago, etc.
            $table->boolean('estado'); // 1 = válido, 0 = no válido
            // $table->string('actualizado_por')->nullable(); // opcional: usuario responsable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_verificaciones');
    }
};
