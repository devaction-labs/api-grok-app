<?php

namespace Database\Factories\Fiscal;

use App\Models\Fiscal\FiscalDepartment;
use Database\Factories\Cnpja\CompanyFactory;
use Database\Factories\TenantFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FiscalDepartment>
 */
class FiscalDepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => $this->faker->name,
            'company_id' => CompanyFactory::new(),
            'tenant_id'  => TenantFactory::new(),
        ];
    }
}
