<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_code' => $this->faker->unique()->uuid,
            'name'         => $this->faker->name,
            'description'  => $this->faker->sentence,
            'is_active'    => true,
            'tenant_id'    => TenantFactory::new(),
        ];
    }
}
