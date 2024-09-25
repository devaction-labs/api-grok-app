<?php

namespace App\Tenant;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder as BaseTenantFinder;

class TenantFinder extends BaseTenantFinder
{
    public function findForRequest(Request $request): ?Tenant
    {

        $host      = $request->getHost();
        $subdomain = explode('.', $host)[0];

        return Tenant::query()->where('domain', $subdomain)->first();
    }
}
