<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademyRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_creates_tenant_admin_and_authenticates_them(): void
    {
        $this->get(route('register'))->assertOk();

        $response = $this->post(route('register'), [
            'tenant_name' => 'Academia Exemplo',
            'tenant_slug' => 'Academia-Exemplo',
            'document' => '12.345.678/0001-95',
            'admin_name' => 'Responsável',
            'email' => 'responsavel@example.com',
            'password' => 'senha-segura-123',
            'password_confirmation' => 'senha-segura-123',
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $tenant = Tenant::query()->where('slug', 'academia-exemplo')->firstOrFail();
        $user = User::query()->where('email', 'responsavel@example.com')->firstOrFail();

        $response->assertRedirect(route('admin.dashboard', absolute: false));
        $this->assertAuthenticatedAs($user);
        $this->assertSame('12345678000195', $tenant->document);
        $this->assertSame($tenant->id, $user->tenant_id);
        $this->assertSame(User::ROLE_ADMIN_TENANT, $user->role);
        $this->assertTrue(password_verify('senha-segura-123', $user->password));
    }

    public function test_registration_rejects_duplicate_academy_slug_and_cnpj(): void
    {
        Tenant::create([
            'name' => 'Academia Existente',
            'slug' => 'academia-existente',
            'document' => '12345678000195',
        ]);

        $this->from(route('register'))
            ->post(route('register'), [
                'tenant_name' => 'Outra Academia',
                'tenant_slug' => 'academia-existente',
                'document' => '12.345.678/0001-95',
                'admin_name' => 'Responsável',
                'email' => 'outro@example.com',
                'password' => 'senha-segura-123',
                'password_confirmation' => 'senha-segura-123',
            ])
            ->assertSessionHasErrors(['tenant_slug', 'document']);

        $this->assertDatabaseCount('tenants', 1);
        $this->assertDatabaseMissing('users', ['email' => 'outro@example.com']);
    }
}
