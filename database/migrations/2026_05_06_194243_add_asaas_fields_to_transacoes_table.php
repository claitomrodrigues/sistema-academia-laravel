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
        Schema::table('transacoes', function (Blueprint $table) {
            $table->string('asaas_payment_id')->nullable()->after('pagamento_id');
            $table->string('status')->nullable()->after('metodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transacoes', function (Blueprint $table) {
            $table->dropColumn('asaas_payment_id');
            $table->dropColumn('status');
        });
    }
};
