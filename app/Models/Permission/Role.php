<?php

namespace App\Models\Permission;

use App\Models\Scopes\TenantScope;
use App\Models\Tenant;
use DevactionLabs\FilterablePackage\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

/**
 * @property string $id
 * @property string $name
 * @property string$permissions
 * @property string $tenant_id
 */
class Role extends Model
{
    use HasFactory;
    use HasUlids;
    use Filterable;

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    /**
     * Relacionamento de muitos para muitos com as permissões.
     *
     * @return BelongsToMany<Permission>
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function isDefault(): bool
    {
        return is_null($this->tenant_id);
    }
}
