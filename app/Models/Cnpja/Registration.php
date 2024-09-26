<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, MorphTo};

/**
 * @property string $id
 * @property string $customer_id
 * @property string $state
 * @property string $number
 * @property string $enabled
 * @property string $status_date
 * @property string $status_id
 * @property string $type_id
 */
class Registration extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(RegistrationType::class);
    }
}
