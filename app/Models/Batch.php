<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Query\Builder;

/**
 * @property string $id
 * @property string $product_id
 * @property string $warehouse_id
 * @property string $tenant_id
 * @property string $batch_number
 * @property string $manufacture_date
 * @property int $initial_quantity
 * @property int $available_quantity
 * @property int $reserved_quantity
 * @property int $blocked_quantity
 * @property int $damaged_quantity
 * @property string $expiry_date
 * @property string $created_at
 * @property string $updated_at
 */
class Batch extends Model
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

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(SkuWarehouseStockMovement::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('available_quantity', '>', 0);
    }

    public function scopeReserved(Builder $query): Builder
    {
        return $query->where('reserved_quantity', '>', 0);
    }

    public function scopeBlocked(Builder $query): Builder
    {
        return $query->where('blocked_quantity', '>', 0);
    }

    public function scopeDamaged(Builder $query): Builder
    {
        return $query->where('damaged_quantity', '>', 0);
    }

    public function scopeExpiring(Builder $query): Builder
    {
        return $query->where('expiry_date', '<', now()->addMonth());
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('expiry_date', '<', now());
    }

}
