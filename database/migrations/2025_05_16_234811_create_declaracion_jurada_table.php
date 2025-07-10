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
        Schema::create('declaracion_jurada', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_postulante_id')->constrained('info_postulante')->onDelete('cascade');
            $table->char('id_mod_ing', 1); // Modalidad de ingreso (A, B, C, etc.)
            $table->string('formulario_inscripcion')->nullable();
            $table->string('comprobante_pago')->nullable();
            $table->string('certificado_estudios')->nullable();
            $table->string('copia_dni')->nullable();
            $table->string('seguro_salud')->nullable();
            // $table->string('foto_carnet')->nullable();
            $table->string('certificado_notas_original')->nullable();
            $table->string('constancia_primera_matricula')->nullable();
            $table->string('syllabus_visados')->nullable();
            $table->string('titulo_tecnico')->nullable();
            $table->string('constancia_colegio')->nullable();
            $table->string('selectVinculo')->nullable();
            $table->string('universidad_traslado')->nullable();
            $table->string('modalidad_estudio')->nullable();
            $table->date('fecha_matricula')->nullable();
            $table->string('anno_culminado')->nullable();
            $table->unsignedTinyInteger('estado')->default(0); // Opcional: estado global del documento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaracion_jurada');
    }
};
