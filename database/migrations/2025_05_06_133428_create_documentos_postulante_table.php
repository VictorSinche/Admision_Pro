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
        Schema::create('documentos_postulante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_postulante_id')->constrained('info_postulante')->onDelete('cascade');

            $table->string('formulario')->nullable();
            $table->string('pago')->nullable();
            $table->string('constancia')->nullable();
            $table->string('constancianotas')->nullable();
            $table->string('dni')->nullable();
            $table->string('seguro')->nullable();
            // $table->string('foto')->nullable();
            $table->string('constmatricula')->nullable();
            $table->string('certprofecional')->nullable();
            $table->string('syllabus')->nullable();
            $table->string('merito')->nullable();
            $table->unsignedTinyInteger('estado')->default(0); // Opcional: estado global del documento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_postulante');
    }
};
