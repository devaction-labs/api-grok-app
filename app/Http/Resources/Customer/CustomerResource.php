<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 *  @property string $phone
 * @property string $address
 * @property string $tax_id
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property bool $is_active
 * @property string $tenant_id
 * @property string $user_id
 */
class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'tax_id'    => $this->tax_id,
            'city'      => $this->city,
            'state'     => $this->state,
            'zipcode'   => $this->zipcode,
            'is_active' => $this->is_active,
            'tenant_id' => $this->tenant_id,
            'user_id'   => $this->user_id,
        ];
    }
}
