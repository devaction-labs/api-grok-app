<?php

namespace App\Traits\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait AuthenticatedUser
{
    /**
     * Retorna o usuário autenticado com cache opcional.
     *
     * @param bool $useCache
     * @return User|null
     */
    public function getAuthenticatedUser(bool $useCache = true): ?User
    {

        $user = User::query()->where('id', auth()->id())->first();

        if (!$user) {
            return null;
        }

        if ($useCache) {
            /** @var User $cachedUser */
            $cachedUser = Cache::remember('authenticated_user', now()->addMinutes(5), function () use ($user): User {
                return $user;
            });

            return $cachedUser;
        }

        return $user;
    }

    /**
     * Limpa o cache do usuário autenticado.
     */
    public function clearAuthenticatedUserCache(): void
    {
        Cache::forget('authenticated_user');
    }
}
