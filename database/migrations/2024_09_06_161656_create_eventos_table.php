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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('ID'); // Identificador único para el evento
            $table->string('nombre', 100);
            $table->string('url_img', 255)->nullable();
            $table->string('url_video', 255)->nullable();
            $table->Integer('Bar_ID'); // Clave foránea hacia la tabla bares

            $table->foreign('Bar_ID')->references('ID')->on('bares')->onDelete('cascade');

            $table->timestamps(); // Campos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
