<?php

namespace App\Models\Cnpja;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $email
 * @property string $customer_id
 * @property string $domain
 */
class Email extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
