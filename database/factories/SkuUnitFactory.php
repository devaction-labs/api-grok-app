<?php

namespace Database\Factories;

use App\Models\SkuUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SkuUnit>
 */
class SkuUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku_code'   => $this->faker->unique()->uuid,
            'variation'  => $this->faker->sentence,
            'price'      => $this->faker->randomFloat(2, 1, 1000),
            'tenant_id'  => TenantFactory::new(),
            'product_id' => ProductFactory::new(),
        ];
    }
}
