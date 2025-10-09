<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('puzzle_id')->constrained('puzzles')->restrictOnDelete();
            $table->unsignedInteger('quantite');
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('total_ligne', 10, 2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
