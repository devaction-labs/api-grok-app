<?php

namespace Database\Factories\Cnpja;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->randomNumber(4),
            'text' => $this->faker->sentence(3),
        ];
    }
}
