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
        Schema::table('candidats', function (Blueprint $table) {
            $table->string('entite')->nullable();
            $table->string('nom_entite')->nullable();
            // Changer le type de date_naissance (nécessite doctrine/dbal)
            $table->text('adresse')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidats', function (Blueprint $table) {
            $table->dropColumn(['entite', 'nom_entite']);
            $table->text('date_naissance')->change();
        });
    }
};
