<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property int $code
 * @property string $text
 */
class Nature extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';
}
