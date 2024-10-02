<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $sku_unit_id
 * @property string $warehouse_id
 * @property string $tenant_id
 * @property integer $quantity
 * @property ?string $batch_number
 * @property ?string $expiry_date
 * @property ?string $manufacture_date
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SkuWarehouseStock extends Model
{
    use HasFactory;
    use HasUlids;

    public function sku(): BelongsTo
    {
        return $this->belongsTo(SkuUnit::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
