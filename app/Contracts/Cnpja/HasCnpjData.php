<?php

namespace App\Contracts\Cnpja;

use App\Models\Abstract\CnpjDataModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Interface HasCnpjData
 *
 * @package App\Contracts\Cnpja
 * @mixin CnpjDataModel
 * @property string $id
 */
interface HasCnpjData
{
    public function addresses(): MorphMany;
    public function phones(): MorphMany;
    public function emails(): MorphMany;
    public function activities(): MorphMany;
    public function registrations(): MorphMany;
    public function company(): MorphMany;

    public function getId();
    public function getEntityType();
}
