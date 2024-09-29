<?php

namespace App\Pipelines\Onboarding\Actions;

use App\Actions\Cnpja\{GetCnpjAction, SaveCnpjDataAction};
use App\Models\Tenant;
use Closure;
use JsonException;
use Saloon\Exceptions\Request\{FatalRequestException, RequestException};

class CreateFiscalPipeline
{
    /**
     * @param array<string, mixed> $request
     * @throws FatalRequestException
     * @throws RequestException
     * @throws JsonException
     */
    public function handle(array $request, Closure $next): mixed
    {
        /** @var Tenant $tenant */
        $tenant = $request['tenant'];

        $tax_tenant_id = toString($request['tenant_tax_id']);

        $fiscalData = (new GetCnpjAction())->execute($tax_tenant_id);

        (new SaveCnpjDataAction())->execute($fiscalData, $tenant);

        return $next($request);
    }
}
