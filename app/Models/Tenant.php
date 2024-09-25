<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
