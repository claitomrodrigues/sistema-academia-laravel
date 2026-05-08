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
    Schema::create('pagamentos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('matricula_id')
    ->constrained('matriculas')
    ->onDelete('cascade');
    $table->decimal('valor', 8, 2);
    $table->date('vencimento');
    $table->string('status');
    $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
