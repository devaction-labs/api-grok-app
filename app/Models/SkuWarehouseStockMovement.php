<?php

namespace App\Models;

use App\Models\Fiscal\{Cfop, FiscalDepartment, Icms};
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $sku_id
 * @property string $fiscal_department_id
 * @property string $cfop_id
 * @property string $icms_id
 * @property string $batch_id
 * @property string $tenant_id
 * @property ?string $origin_branch_id
 * @property ?string $destination_branch_id
 * @property string $quantity
 * @property string $movement_type
 * @property string $batch_number
 * @property string $status
 * @property float $tax_value
 * @property float $base_value
 * @property string $remarks
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SkuWarehouseStockMovement extends Model
{
    use HasFactory;
    use HasUlids;

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function fiscalDepartment(): BelongsTo
    {
        return $this->belongsTo(FiscalDepartment::class);
    }

    public function cfop(): BelongsTo
    {
        return $this->belongsTo(Cfop::class);
    }

    public function icms(): BelongsTo
    {
        return $this->belongsTo(Icms::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function originBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'origin_branch_id');
    }

    public function destinationBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'destination_branch_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
