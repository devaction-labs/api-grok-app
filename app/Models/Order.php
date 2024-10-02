<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use DevactionLabs\FilterablePackage\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

/**
 * @property string $id
 * @property string $status
 * @property float $total_amount
 * @property string $order_type
 * @property string $tenant_id
 */
class Order extends Model
{
    use HasFactory;
    use HasUlids;
    use Filterable;

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
