<?php

namespace Database\Factories;

use App\Models\SkuWarehouseStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SkuWarehouseStock>
 */
class SkuWarehouseStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku_unit_id'      => SkuUnitFactory::new(),
            'warehouse_id'     => WarehouseFactory::new(),
            'quantity'         => $this->faker->randomNumber(2),
            'batch_number'     => $this->faker->uuid,
            'expiry_date'      => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'manufacture_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'status'           => $this->faker->randomElement(['healthy', 'damaged', 'expired']),
        ];
    }
}
