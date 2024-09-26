<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, MorphTo};

/**
 * @property string $id
 * @property string $since
 * @property string $company_id
 * @property string $member_role_id
 * @property string $person_id
 */
class Member extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(MemberRole::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
