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
    Schema::create('transacoes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pagamento_id')->constrained();
    $table->string('metodo');
    $table->text('codigo_barras')->nullable();
    $table->text('qr_code_pix')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
