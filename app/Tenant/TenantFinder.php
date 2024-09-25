<?php

namespace App\Tenant;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Contracts\IsTenant;

class TenantFinder extends \Spatie\Multitenancy\TenantFinder\TenantFinder
{
    public function findForRequest(Request $request): ?IsTenant
    {
        $domain = request()->getHost();

        return Tenant::query()->where('domain', $domain)->first();
    }
}
