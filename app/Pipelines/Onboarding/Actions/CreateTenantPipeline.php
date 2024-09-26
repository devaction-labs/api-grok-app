<?php

namespace App\Pipelines\Onboarding\Actions;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class CreateTenantPipeline
{
    public function handle(Request $request, Closure $next): mixed
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

        $request->merge(['tenant' => $tenant]);

        return $next($request);
    }
}
