<?php

namespace Database\Factories\Cnpja;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'cpf'  => $this->faker->cpf,
        ];
    }
}
