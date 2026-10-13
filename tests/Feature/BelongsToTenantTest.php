<?php

namespace Tests\Feature;

use App\Models\Plano;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BelongsToTenantTest extends TestCase
{
    public function test_queries_and_new_records_use_the_authenticated_users_tenant(): void
    {
        Schema::create('tenants', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('document')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('role')->default('aluno');
            $table->string('password');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->timestamps();
        });

        Schema::create('planos', function (Blueprint $table): void {
            $table->id();
            $table->string('nome');
            $table->decimal('valor', 8, 2);
            $table->text('descricao');
            $table->integer('periodo');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->timestamps();
        });

        $firstTenant = Tenant::create(['name' => 'Academia A', 'slug' => 'academia-a']);
        $secondTenant = Tenant::create(['name' => 'Academia B', 'slug' => 'academia-b']);

        $firstUser = new User([
            'name' => 'Usuário A',
            'email' => 'a@example.com',
            'password' => 'password',
        ]);
        $firstUser->tenant_id = $firstTenant->id;
        $firstUser->save();

        $secondUser = new User([
            'name' => 'Usuário B',
            'email' => 'b@example.com',
            'password' => 'password',
        ]);
        $secondUser->tenant_id = $secondTenant->id;
        $secondUser->save();

        DB::table('planos')->insert([
            ['nome' => 'Plano A', 'valor' => 10, 'descricao' => 'A', 'periodo' => 30, 'tenant_id' => $firstTenant->id],
            ['nome' => 'Plano B', 'valor' => 20, 'descricao' => 'B', 'periodo' => 30, 'tenant_id' => $secondTenant->id],
        ]);

        $this->actingAs($firstUser);

        $this->assertSame(['Plano A'], Plano::query()->orderBy('id')->pluck('nome')->all());
        $this->assertSame([$firstUser->id], User::query()->orderBy('id')->pluck('id')->all());

        $newPlan = Plano::create([
            'nome' => 'Novo plano',
            'valor' => 30,
            'descricao' => 'Plano do tenant autenticado',
            'periodo' => 30,
        ]);

        $this->assertSame($firstTenant->id, $newPlan->tenant_id);
    }
}
