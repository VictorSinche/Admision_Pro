<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificacionDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('verificacion_documentos', function (Blueprint $table) {
            $table->id();

            // Clave foránea al postulante
            $table->unsignedBigInteger('info_postulante_id')->unique();
            $table->foreign('info_postulante_id')->references('id')->on('info_postulante')->onDelete('cascade');

            // Campos booleanos de validación
            $table->boolean('formulario')->default(0);
            $table->boolean('pago')->default(0);
            $table->boolean('dni')->default(0);
            $table->boolean('seguro')->default(0);
            // $table->boolean('foto')->default(0);
            $table->boolean('dj')->default(0);
            $table->boolean('notificado')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verificacion_documentos');
    }
}
