<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $code
 */
class Country extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
