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
    Schema::create('item_treinos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('treino_id')->constrained()->onDelete('cascade');
    $table->foreignId('exercicio_id')->constrained();
    $table->integer('series');
    $table->integer('reps');
    $table->string('carga');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_treinos');
    }
};
