<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $acronym
 * @property string $text
 */
class Size extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    public $keyType = 'string';
}
