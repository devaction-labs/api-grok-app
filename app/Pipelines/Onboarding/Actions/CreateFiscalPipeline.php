<?php

namespace App\Pipelines\Onboarding\Actions;

use App\Actions\Cnpja\{GetCnpjAction, SaveCnpjDataAction};
use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use JsonException;
use Saloon\Exceptions\Request\{FatalRequestException, RequestException};

class CreateFiscalPipeline
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws JsonException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        /** @var Tenant $tenant */
        $tenant = $request['tenant'];

        $fiscalData = (new GetCnpjAction())->execute($request['tenant_tax_id']);

        (new SaveCnpjDataAction())->execute($fiscalData, $tenant);

        return $next($request);
    }
}
