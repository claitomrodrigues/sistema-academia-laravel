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
    Schema::create('treinos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('aluno_id')
    ->constrained('alunos')
    ->onDelete('cascade');
    $table->string('tipo'); //A,B,C...
    $table->string('status');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinos');
    }
};
