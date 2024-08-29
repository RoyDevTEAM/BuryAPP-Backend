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

        Schema::create('horarios', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('Dia', 20);
            $table->time('HoraApertura');
            $table->time('HoraCierre');
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
        Schema::dropIfExists('horarios');
    }
};
