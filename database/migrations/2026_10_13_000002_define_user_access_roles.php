<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->where('role', 'instrutor')->update(['role' => 'Staff']);
        DB::table('users')->where('role', 'aluno')->update(['role' => 'Member']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('Member')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('role', 'Staff')->update(['role' => 'instrutor']);
        DB::table('users')->where('role', 'Member')->update(['role' => 'aluno']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('aluno')->change();
        });
    }
};
