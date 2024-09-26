<?php

namespace Database\Factories\Cnpja;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->company,
            'cnpj'        => $this->faker->cnpj,
            'status_id'   => StatusFactory::new(),
            'activity_id' => ActivityFactory::new(),
            'address_id'  => AddressFactory::new(),
        ];
    }
}
