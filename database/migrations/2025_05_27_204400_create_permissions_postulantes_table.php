<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions_postulantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulante_id')->constrained('postulantes')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->char('estado', 1)->default('A'); // A = Activo, I = Inactivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions_postulantes');
    }
};
