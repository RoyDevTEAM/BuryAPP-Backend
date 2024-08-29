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
        Schema::disableForeignKeyConstraints();

        Schema::create('bares', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('Nombre', 100);
            $table->string('Descripcion', 500)->nullable();
            $table->string('Ubicacion', 255)->nullable();
            $table->string('Telefono', 20)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bares');
    }
};
