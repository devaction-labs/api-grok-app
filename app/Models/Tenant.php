<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $domain
 * @property bool $is_active
 */
class Tenant extends Model
{
    use HasFactory;
}
