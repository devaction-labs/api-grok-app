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
        if ($useCache) {
            return Cache::remember('authenticated_user', now()->addMinutes(10), function () {
                return auth()->user();
            });
        }

        return auth()->user();
    }

    /**
     * Limpa o cache do usuário autenticado.
     */
    public function clearAuthenticatedUserCache(): void
    {
        Cache::forget('authenticated_user');
    }
}
