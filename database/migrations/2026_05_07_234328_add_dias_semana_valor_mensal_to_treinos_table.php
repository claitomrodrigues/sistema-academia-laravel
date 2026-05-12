<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->integer('dias_semana')->default(2)->after('tipo');
            $table->decimal('valor_mensal', 10, 2)->default(100)->after('dias_semana');
        });
    }

    public function down(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->dropColumn(['dias_semana', 'valor_mensal']);
        });
    }
};