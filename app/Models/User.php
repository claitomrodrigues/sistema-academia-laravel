<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use BelongsToTenant, HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'SuperAdmin';

    public const ROLE_ADMIN_TENANT = 'AdminTenant';

    public const ROLE_STAFF = 'Staff';

    public const ROLE_MEMBER = 'Member';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    public function normalizedRole(): ?string
    {
        return match ($this->role) {
            'super_admin' => self::ROLE_SUPER_ADMIN,
            'admin_tenant' => self::ROLE_ADMIN_TENANT,
            'instrutor' => self::ROLE_STAFF,
            'aluno' => self::ROLE_MEMBER,
            default => $this->role,
        };
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->normalizedRole(), $roles, true);
    }

    public function dashboardRoute(): ?string
    {
        return match ($this->normalizedRole()) {
            self::ROLE_SUPER_ADMIN => 'superadmin.dashboard',
            self::ROLE_ADMIN_TENANT, self::ROLE_STAFF => 'admin.dashboard',
            self::ROLE_MEMBER => 'member.dashboard',
            default => null,
        };
    }
}
