<?php

namespace App\Models\Permission;

use DevactionLabs\FilterablePackage\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 */
class Permission extends Model
{
    use HasFactory;
    use HasUlids;
    use Filterable;
}
