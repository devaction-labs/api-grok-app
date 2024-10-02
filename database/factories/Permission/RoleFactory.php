<?php

namespace Database\Factories\Permission;

use App\Models\Permission\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->randomElement(['admin', 'manager', 'user']),
            'tenant_id' => null,
        ];
    }
}
