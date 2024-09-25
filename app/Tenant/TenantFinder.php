<?php

namespace App\Tenant;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder as BaseTenantFinder;

class TenantFinder extends BaseTenantFinder
{
    public function findForRequest(Request $request): ?Tenant
    {
        if ($user = auth()->user()) {
            return $user->tenant_id;
        }

        return null;
    }
}
