<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->foreignId('plano_id')
                ->after('aluno_id')
                ->constrained('planos');

            $table->boolean('personal')
                ->default(0)
                ->after('dias_semana');
        });
    }

    public function down(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->dropForeign(['plano_id']);
            $table->dropColumn(['plano_id', 'personal']);
        });
    }
};
