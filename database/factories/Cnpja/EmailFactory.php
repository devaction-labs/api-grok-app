<?php

namespace Database\Factories\Cnpja;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => $this->faker->email,
        ];
    }
}
