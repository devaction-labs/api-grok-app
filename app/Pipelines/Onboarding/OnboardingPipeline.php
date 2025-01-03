<?php

namespace App\Pipelines\Onboarding;

use App\Events\User\UserRegistered;
use App\Models\User;
use App\Pipelines\Onboarding\Actions\{CreateFiscalPipeline, CreateTenantPipeline, CreateUserPipeline};
use Illuminate\Pipeline\Pipeline;

class OnboardingPipeline
{
    /**
     * @param array<string, mixed> $request
     */
    public function handle(array $request): mixed
    {
        return app(Pipeline::class)
            ->send($request)
            ->through([
                CreateTenantPipeline::class,
                CreateUserPipeline::class,
                CreateFiscalPipeline::class,
                function ($request, $next) {
                    /** @var User $user */
                    $user = $request['user'];
                    event(new UserRegistered($user));

                    return $next($request);
                },
            ])
            ->thenReturn();
    }
}
