<?php

namespace App\Http\Controllers\Auth;

use App\Events\User\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{AuthRegisterRequest, AuthRequest};
use App\Models\{Tenant, User};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{DB};
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
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
        $data = $request->validated();

        DB::transaction(static function () use ($data) {
            $tenant = Tenant::query()->create([
                'name'   => $data['tenant_name'],
                'domain' => $data['tenant_domain'],
                'slug'   => $data['tenant_slug'],
                'tax_id' => $data['tenant_tax_id'],
            ]);

            $user = User::query()->create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => $data['password'],
                'tenant_id' => $tenant->id,
            ]);

            event(new UserRegistered($user));
        });

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
