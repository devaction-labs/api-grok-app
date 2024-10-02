<?php

namespace Database\Factories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id'         => ProductFactory::new(),
            'warehouse_id'       => WarehouseFactory::new(),
            'batch_number'       => $this->faker->uuid,
            'manufacture_date'   => $this->faker->date(),
            'initial_quantity'   => $this->faker->randomNumber(3),
            'available_quantity' => $this->faker->randomNumber(3),
            'reserved_quantity'  => $this->faker->randomNumber(3),
            'blocked_quantity'   => $this->faker->randomNumber(3),
            'damaged_quantity'   => $this->faker->randomNumber(3),
            'expiry_date'        => $this->faker->date(),
        ];
    }
}
