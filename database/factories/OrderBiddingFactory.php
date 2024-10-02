<?php

namespace Database\Factories;

use App\Models\OrderBidding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderBidding>
 */
class OrderBiddingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'       => OrderFactory::new(),
            'bidding_number' => $this->faker->uuid,
            'supply_order'   => $this->faker->uuid,
        ];
    }
}
