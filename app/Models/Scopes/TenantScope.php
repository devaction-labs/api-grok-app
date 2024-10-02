<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\{Builder, Model, Scope};

class TenantScope implements Scope
{
    /**
     * @param Builder<Model> $builder
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (auth()->check() && auth()->user() !== null) {
            $builder->where('tenant_id', auth()->user()->tenant_id);
        }
    }
}
