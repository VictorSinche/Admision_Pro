<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users_admin')->onDelete('cascade'); // puedes cambiar a postulante_id si es necesario
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->char('estado', 1)->default('A'); // A = Activo, I = Inactivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
