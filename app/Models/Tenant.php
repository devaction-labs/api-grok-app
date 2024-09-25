<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Models\Concerns\{ImplementsTenant};

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $domain
 * @property bool $is_active
 */
class Tenant extends Model implements IsTenant
{
    use ImplementsTenant;
    use HasFactory;
    use HasUlids;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
