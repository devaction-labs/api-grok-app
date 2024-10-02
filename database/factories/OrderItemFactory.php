<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'    => OrderFactory::new(),
            'sku_unit_id' => SkuUnitFactory::new(),
            'quantity'    => $this->faker->randomNumber(2),
            'price'       => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
