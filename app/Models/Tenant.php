<?php

namespace App\Models;

use App\Contracts\Cnpja\HasCnpjData;
use App\Models\Traits\HasCnpjDataTrait;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $domain
 * @property bool $is_active
 */
class Tenant extends Model implements HasCnpjData
{
    use HasFactory;
    use HasUlids;
    use HasCnpjDataTrait;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEntityType(): string
    {
        return get_class($this);
    }
}
