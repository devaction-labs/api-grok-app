<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use App\Http\Requests\Onboarding\OnboardingRequest;
use App\Jobs\Onboarding\OnboardingJob;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OnboardingController extends Controller
{
    public function __invoke(OnboardingRequest $request): JsonResponse
    {

        $data = $request->validated();

        OnboardingJob::dispatch($data);

        return response()->json(['message' => 'Account being created'], Response::HTTP_CREATED);
    }
}
