<?php

namespace App\Contracts\Cnpja;

use App\Models\Abstract\CnpjDataModel;
use App\Models\Cnpja\{Activity, Address, Company, Email, Phone, Registration};
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
    /**
     * @return MorphMany<Address>
     */
    public function addresses(): MorphMany;

    /**
     * @return MorphMany<Phone>
     */
    public function phones(): MorphMany;

    /**
     * @return MorphMany<Email>
     */
    public function emails(): MorphMany;

    /**
     * @return MorphMany<Activity>
     */
    public function activities(): MorphMany;

    /**
     * @return MorphMany<Registration>
     */
    public function registrations(): MorphMany;

    /**
     * @return MorphMany<Company>
     */
    public function company(): MorphMany;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getEntityType(): string;
}
