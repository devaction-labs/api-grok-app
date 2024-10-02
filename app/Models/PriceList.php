<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $name
 * @property string $tenant_id
 */
class PriceList extends Model
{
    use HasFactory;
    use HasUlids;

    public function skus(): BelongsToMany
    {
        return $this->belongsToMany(SkuUnit::class, 'sku_price_list')
            ->withPivot('price');
    }
}
