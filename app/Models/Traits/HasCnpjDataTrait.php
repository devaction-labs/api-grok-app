<?php

namespace App\Models\Traits;

use App\Models\Cnpja\{Activity, Address, Company, Email, Person, Phone, Registration};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasCnpjDataTrait
 *
 * @mixin Model
 */
trait HasCnpjDataTrait
{
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'entity');
    }

    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'entity');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'entity');
    }

    public function registrations(): MorphMany
    {
        return $this->morphMany(Registration::class, 'entity');
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'entity');
    }

    public function people(): MorphMany
    {
        return $this->morphMany(Person::class, 'entity');
    }

    public function company(): MorphMany
    {
        return $this->morphMany(Company::class, 'entity');
    }
}
