<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

/**
 * @property string $id
 * @property string $sku_code
 * @property string $variation
 * @property float $price
 * @property string $tenant_id
 * @property string $product_id
 */
class SkuUnit extends Model
{
    use HasFactory;
    use HasUlids;

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouseStock(): HasMany
    {
        return $this->hasMany(SkuWarehouseStock::class);
    }
}
