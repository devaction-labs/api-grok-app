<?php

namespace App\Services\Authorize;

use App\Enum\Authorize\PermissionsEnum;
use App\Exceptions\Authorize\AuthorizationException;
use App\Traits\Auth\AuthenticatedUser;
use Illuminate\Support\Facades\Auth;

class AuthorizeAccount
{
    use AuthenticatedUser;

    /**
     * Autoriza o acesso baseado na permissão, senão lança exceção.
     *
     * @param PermissionsEnum $permission
     * @throws AuthorizationException
     */
    public static function authorize(PermissionsEnum $permission): void
    {
        if (!self::hasPermission($permission)) {
            throw new AuthorizationException();
        }
    }

    /**
     * Verifica se o usuário autenticado tem a permissão fornecida.
     *
     * @param PermissionsEnum $permission
     * @return bool
     */
    public static function hasPermission(PermissionsEnum $permission): bool
    {
        $user = Auth::user();

        return $user && $user->hasPermission($permission->value);
    }
}
