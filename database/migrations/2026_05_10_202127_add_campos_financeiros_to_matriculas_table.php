<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {

            $table->integer('dias_semana')
                ->default(2);

            $table->boolean('personal')
                ->default(false);

            $table->decimal('valor_final', 10, 2)
                ->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {

            $table->dropColumn([
                'dias_semana',
                'personal',
                'valor_final'
            ]);

        });
    }
};