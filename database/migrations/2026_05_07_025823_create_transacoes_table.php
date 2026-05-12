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
        $table->foreignId('pagamento_id')->constrained('pagamentos')->onDelete('cascade');
        $table->string('asaas_payment_id')->nullable();
        $table->string('metodo')->nullable();
        $table->string('status')->nullable();
        $table->text('codigo_barras')->nullable();
        $table->text('qr_code_pix')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('transacoes');
}
};
