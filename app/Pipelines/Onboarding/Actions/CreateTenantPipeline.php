<?php

namespace App\Pipelines\Onboarding\Actions;

use App\Models\Tenant;
use Closure;

class CreateTenantPipeline
{
    /**
     * @param array<string, mixed> $request
     */
    public function handle(array $request, Closure $next): mixed
    {
        $tenant = Tenant::query()->firstOrCreate(
            ['tax_id' => $request['tenant_tax_id']],
            [
                'name'      => $request['tenant_name'],
                'slug'      => $request['tenant_slug'],
                'domain'    => $request['tenant_domain'],
                'is_active' => true,
            ]
        );

        $request['tenant'] = $tenant;

        return $next($request);
    }
}
