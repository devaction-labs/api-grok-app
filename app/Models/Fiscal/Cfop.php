<?php

namespace App\Models\Fiscal;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $fiscal_department_id
 * @property string $cfop_exit_state
 * @property string $cfop_exit_out_of_state
 * @property string $cfop_entry_state
 * @property string $cfop_entry_out_of_state
 */
class Cfop extends Model
{
    use HasFactory;
    use HasUlids;

    public function fiscalDepartment(): BelongsTo
    {
        return $this->belongsTo(FiscalDepartment::class);
    }
}
