<?php

namespace Database\Factories\Fiscal;

use App\Models\Fiscal\Cfop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cfop>
 */
class CfopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fiscal_department_id'    => FiscalDepartmentFactory::new(),
            'cfop_exit_state'         => $this->faker->randomNumber(4),
            'cfop_exit_out_of_state'  => $this->faker->randomNumber(4),
            'cfop_entry_state'        => $this->faker->randomNumber(4),
            'cfop_entry_out_of_state' => $this->faker->randomNumber(4),
        ];
    }
}
