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

        Schema::create('videos', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('Titulo', 100)->nullable();
            $table->string('URL', 255);
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
        Schema::dropIfExists('videos');
    }
};
