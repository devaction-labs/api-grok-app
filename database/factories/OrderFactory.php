<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status'       => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'total_amount' => $this->faker->randomFloat(2, 1, 1000),
            'order_type'   => $this->faker->randomElement(['sale', 'purchase']),
            'tenant_id'    => TenantFactory::new(),
        ];
    }
}
