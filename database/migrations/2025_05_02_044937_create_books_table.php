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
        Schema::create('books', function (Blueprint $table) {
            $table->string('isbn')->primary(); // ISBN-13 format
            $table->string('titre');
            $table->string('auteur1');
            $table->string('editeur');
            $table->year('annee');
            $table->unsignedInteger('nombre_exemplaires');
            $table->enum('type', ['livre', 'magazine', 'dictionnaire'])->default('livre');
            $table->enum('genre', ['comédie', 'science', 'science-fiction', 'horreur', 'drame', 'romance'])->nullable();
            $table->unsignedSmallInteger('tome')->nullable();
            $table->unsignedInteger('disponible')->default(true);         // Available copies
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
