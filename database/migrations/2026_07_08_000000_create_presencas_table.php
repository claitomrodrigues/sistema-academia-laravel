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
        Schema::create('presencas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->onDelete('cascade');

            $table->date('data_presenca');
            $table->time('horario');
            $table->string('observacao')->nullable();
            $table->timestamps();

            $table->unique(['aluno_id', 'data_presenca']);
            $table->index('data_presenca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presencas');
    }
};
