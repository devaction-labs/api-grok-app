<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, MorphTo};

/**
 * @property string $id
 * @property string $name
 * @property string $equity
 * @property string $nature_id
 * @property string $size_id
 */
class Company extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
