<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_each_role_is_redirected_to_its_dashboard_after_login(): void
    {
        $dashboards = [
            User::ROLE_SUPER_ADMIN => 'superadmin.dashboard',
            User::ROLE_ADMIN_TENANT => 'admin.dashboard',
            User::ROLE_STAFF => 'admin.dashboard',
            User::ROLE_MEMBER => 'member.dashboard',
        ];

        foreach ($dashboards as $role => $route) {
            $user = User::factory()->create(['role' => $role]);

            $this->post('/login', [
                'email' => $user->email,
                'password' => 'password',
            ])->assertRedirect(route($route, absolute: false));

            auth()->logout();
        }
    }

    public function test_member_cannot_open_academy_management_routes(): void
    {
        $member = User::factory()->create(['role' => User::ROLE_MEMBER]);

        $this->actingAs($member)
            ->get(route('alunos.index'))
            ->assertForbidden();

        $this->get(route('superadmin.dashboard'))
            ->assertForbidden();
    }

    public function test_superadmin_can_open_the_saas_dashboard(): void
    {
        $superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);
        Tenant::create(['name' => 'Academia de Teste', 'slug' => 'academia-de-teste']);

        $this->actingAs($superAdmin)
            ->get(route('superadmin.dashboard'))
            ->assertOk()
            ->assertSee('Gestão do SaaS')
            ->assertSee('Academia de Teste');

        $this->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_tenant_admin_and_staff_can_open_the_academy_dashboard(): void
    {
        foreach ([User::ROLE_ADMIN_TENANT, User::ROLE_STAFF] as $role) {
            $user = User::factory()->create(['role' => $role]);

            $this->actingAs($user)
                ->get(route('admin.dashboard'))
                ->assertOk()
                ->assertSee('FitCloud');
        }
    }
}
