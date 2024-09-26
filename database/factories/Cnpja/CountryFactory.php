<?php

namespace Database\Factories\Cnpja;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->country,
            'code' => $this->faker->countryCode,
        ];
    }
}
