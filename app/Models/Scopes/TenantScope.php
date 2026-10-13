<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    /**
     * Apply the tenant constraint to the model query.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $guard = Auth::guard();

        if ($model instanceof Authenticatable && ! $guard->hasUser()) {
            return;
        }

        $user = $guard->user();

        if ($user === null) {
            $builder->whereRaw('1 = 0');

            return;
        }

        if ($user instanceof User && $user->hasRole(User::ROLE_SUPER_ADMIN)) {
            return;
        }

        $builder->where($model->qualifyColumn('tenant_id'), data_get($user, 'tenant_id'));
    }
}
