<?php

namespace Database\Factories\Cnpja;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'country_id'   => $this->faker->uuid,
            'state'        => $this->faker->state,
            'city'         => $this->faker->city,
            'neighborhood' => $this->faker->word,
            'street'       => $this->faker->streetName,
            'number'       => $this->faker->buildingNumber,
            'complement'   => $this->faker->sentence(3),
            'zip_code'     => $this->faker->postcode,
        ];
    }
}
