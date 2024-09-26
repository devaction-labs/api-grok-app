<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{AuthRegisterRequest, AuthRequest};
use App\Pipelines\Onboarding\OnboardingPipeline;
use Illuminate\Http\{JsonResponse, Request};
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        protected OnboardingPipeline $onboardingPipeline
    ) {}

    /**
     * Login User
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $user  = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Register User Tenant
     *
     * @param AuthRegisterRequest $request
     * @return JsonResponse
     */
    public function register(AuthRegisterRequest $request): JsonResponse
    {
        $this->onboardingPipeline->handle($request);

        return response()->json(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Logout User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], Response::HTTP_OK);
    }
}
