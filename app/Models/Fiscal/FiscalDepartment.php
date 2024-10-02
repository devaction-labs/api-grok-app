<?php

namespace App\Models\Fiscal;

use App\Models\Cnpja\Company;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $name
 * @property string $company_id
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FiscalDepartment extends Model
{
    use HasFactory;
    use HasUlids;

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
