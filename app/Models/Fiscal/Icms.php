<?php

namespace App\Models\Fiscal;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property Cfop $cfop_id
 * @property string $uf
 * @property string $cst
 * @property float $icms_rate
 * @property ?float $fcp_rate
 * @property ?string $calculation_modality
 * @property ?string $base_reduction
 * @property ?string $st_mva
 * 2@property ?string $st_base_reduction
 */
class Icms extends Model
{
    use HasFactory;
    use HasUlids;

    public function cfop(): BelongsTo
    {
        return $this->belongsTo(Cfop::class);
    }
}
