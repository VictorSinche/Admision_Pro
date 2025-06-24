<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_verificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_postulante_id')
                ->constrained('info_postulante')
                ->onDelete('cascade');
            $table->string('campo');
            $table->boolean('estado');
            $table->string('actualizado_por')->nullable();
            $table->string('cod_user');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_verificaciones');
    }
};
