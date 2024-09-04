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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            // Ajustar tipos de datos para coincidir con las claves referenciadas
            $table->unsignedBigInteger('user_id');
            $table->Integer('bar_id');
            $table->timestamps();

            // Definir claves foráneas con tipos correctos
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bar_id')->references('ID')->on('bares')->onDelete('cascade');

            // Asegurarse de que no haya duplicados
            $table->unique(['user_id', 'bar_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
