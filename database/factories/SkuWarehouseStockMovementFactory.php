<?php

namespace Database\Factories;

use App\Models\SkuWarehouseStockMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SkuWarehouseStockMovement>
 */
class SkuWarehouseStockMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id'    => ProductFactory::new(),
            'warehouse_id'  => WarehouseFactory::new(),
            'batch_id'      => BatchFactory::new(),
            'movement_type' => $this->faker->randomElement(['in', 'out']),
            'quantity'      => $this->faker->randomNumber(3),
            'created_at'    => $this->faker->dateTime(),
            'updated_at'    => $this->faker->dateTime(),
        ];
    }
}
