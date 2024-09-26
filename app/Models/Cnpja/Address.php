<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, MorphTo};

/**
 * @property string $id
 * @property string $customer_id
 * @property int $municipality_code
 * @property string $street
 * @property string $number
 * @property string $details
 * @property string $district
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country_id
 */
class Address extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
