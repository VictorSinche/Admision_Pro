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
        Schema::create('control_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_postulante_id')->constrained('info_postulante')->onDelete('cascade');

            // Bloqueo individual por campo
            $table->boolean('formulario')->default(false);
            $table->boolean('pago')->default(false);
            $table->boolean('constancia')->default(false);
            $table->boolean('constancianotas')->default(false);
            $table->boolean('dni')->default(false);
            $table->boolean('seguro')->default(false);
            $table->boolean('certprofesional')->default(false);
            $table->boolean('syllabus')->default(false);
            $table->boolean('merito')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_documentos');
    }
};
