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

        Schema::create('producto', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('Nombre', 100);
            $table->decimal('Precio', 10, 2);
            $table->string('Descripcion', 500)->nullable();
            $table->integer('Bar_ID')->nullable();
            $table->foreign('Bar_ID')->references('ID')->on('bares');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
