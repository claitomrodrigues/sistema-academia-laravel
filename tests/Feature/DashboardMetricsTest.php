<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Plano;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardMetricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_academy_dashboard_shows_tenant_scoped_operational_metrics(): void
    {
        $tenant = Tenant::create([
            'name' => 'Academia de Métricas',
            'slug' => 'academia-metricas',
        ]);

        $admin = User::factory()->create(['role' => User::ROLE_ADMIN_TENANT]);
        $admin->tenant_id = $tenant->id;
        $admin->save();
        $this->actingAs($admin);

        $member = User::factory()->create(['role' => User::ROLE_MEMBER]);
        $member->tenant_id = $tenant->id;
        $member->save();

        $aluno = Aluno::create([
            'user_id' => $member->id,
            'nome' => $member->name,
            'cpf' => '12345678901',
            'nascimento' => '1990-01-01',
            'objetivo' => 'Condicionamento',
        ]);

        $plano = Plano::create([
            'nome' => 'Mensal',
            'valor' => 79.90,
            'descricao' => 'Plano mensal',
            'periodo' => 'mensal',
        ]);

        $matricula = Matricula::create([
            'aluno_id' => $aluno->id,
            'plano_id' => $plano->id,
            'data_inicio' => today(),
            'status' => 'ativa',
        ]);

        DB::table('pagamentos')->insert([
            [
                'matricula_id' => $matricula->id,
                'valor' => 79.90,
                'vencimento' => today()->toDateString(),
                'status' => 'pago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricula_id' => $matricula->id,
                'valor' => 79.90,
                'vencimento' => today()->subDay()->toDateString(),
                'status' => 'pendente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Alunos ativos')
            ->assertSee('R$ 79,90')
            ->assertSee('Alunos inadimplentes');

        $this->get(route('alunos.index'))
            ->assertOk()
            ->assertSee('Inadimplente')
            ->assertSee($member->name);

        $this->get(route('planos.index'))
            ->assertOk()
            ->assertSee('Cadastro rápido')
            ->assertSee('Mensal')
            ->assertSee('aria-modal="true"', false);
    }
}
