<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
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
            'tax_id'    => $this->faker->unique()->uuid,
            'slug'      => $this->faker->slug,
            'domain'    => $this->faker->unique()->domainName,
            'is_active' => true,
        ];
    }
}
