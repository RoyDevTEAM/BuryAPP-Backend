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
        Schema::create('mesas', function (Blueprint $table) {
            $table->id(); // Campo ID auto-incremental
            $table->string('Descripcion')->nullable(); // Campo Descripcion
            $table->decimal('Precio', 10, 2); // Campo Precio
            $table->decimal('Anticipo', 10, 2); // Campo Anticipo
            $table->Integer('Bar_ID')->nullable(); // Campo Bar_ID
            $table->string('Imagen')->nullable(); // Campo Imagen

            // Definir la clave foránea para Bar_ID
            $table->foreign('Bar_ID')->references('id')->on('bares')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mesas', function (Blueprint $table) {
            // Eliminar la clave foránea antes de eliminar la tabla
            $table->dropForeign(['Bar_ID']);
        });

        Schema::dropIfExists('mesas');
    }
};
