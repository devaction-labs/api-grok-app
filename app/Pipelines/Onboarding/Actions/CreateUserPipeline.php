<?php

namespace App\Pipelines\Onboarding\Actions;

use App\Models\{Tenant, User};
use Closure;
use Illuminate\Http\Request;

class CreateUserPipeline
{
    public function handle(Request $request, Closure $next): mixed
    {

        /** @var Tenant $tenant */
        $tenant = $request['tenant'];

        $user = User::query()->updateOrCreate(
            ['email' => $request['email']],
            [
                'name'      => $request['name'],
                'password'  => $request['password'],
                'tenant_id' => $tenant->id,
            ]
        );

        $request->merge(['user' => $user]);

        return $next($request);
    }
}
