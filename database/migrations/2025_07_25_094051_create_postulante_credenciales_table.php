<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('postulante_credenciales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cliente_id'); // Debe coincidir con int(10) unsigned
            $table->integer('username')->unique();
            $table->string('password_hash');
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id_cliente')
                ->on('sga_tb_adm_cliente')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulante_credenciales');
    }
};
