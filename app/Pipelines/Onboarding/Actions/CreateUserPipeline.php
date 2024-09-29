<?php

namespace App\Pipelines\Onboarding\Actions;

use App\Models\{Tenant, User};
use Closure;

class CreateUserPipeline
{
    /**
     * @param array<string, mixed> $request
     */
    public function handle(array $request, Closure $next): mixed
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

        ds($user);
        $request['user'] = $user;

        return $next($request);
    }
}
