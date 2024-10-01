<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->name,
            'email'     => $this->faker->unique()->safeEmail,
            'phone'     => $this->faker->phoneNumber,
            'address'   => $this->faker->address,
            'tax_id'    => $this->faker->cnpj,
            'city'      => $this->faker->city,
            'state'     => $this->faker->stateAbbr,
            'zipcode'   => $this->faker->postcode,
            'is_active' => $this->faker->boolean(90),
            'tenant_id' => TenantFactory::new(),
            'user_id'   => UserFactory::new(),
        ];
    }
}
