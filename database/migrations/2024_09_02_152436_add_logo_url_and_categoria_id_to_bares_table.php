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

        Schema::table('bares', function (Blueprint $table) {
            $table->string('LogoURL', 255)->nullable()->after('Telefono');
            $table->integer('Categoria_ID')->nullable()->after('LogoURL');
            $table->foreign('Categoria_ID')->references('ID')->on('categorias');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bares', function (Blueprint $table) {
            $table->dropForeign(['Categoria_ID']);
            $table->dropColumn(['LogoURL', 'Categoria_ID']);
        });
    }
};
