<?php

namespace App\Permission;

use App\Models\Permission\{Permission, Role};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * Trait HasRoles
 *
 * @mixin Model
 */
trait HasRoles
{
    /**
     * Verifica se o usuário tem um determinado papel.
     *
     * @param string|Role $role
     * @return bool
     */
    public function hasRole(string|Role $role): bool
    {
        $roleName = $role instanceof Role ? $role->name : $role;

        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Relacionamento de muitos para muitos com os papéis.
     *
     * @return BelongsToMany<Role>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Verifica se o usuário tem uma determinada permissão através de seus papéis.
     *
     * @param string|Permission $permission
     * @return bool
     */
    public function hasPermission(string|Permission $permission): bool
    {
        $permissionName = $permission instanceof Permission ? $permission->name : $permission;

        /** @var Collection<int, Role> $roles */
        $roles = $this->roles;

        return $roles
            ->flatMap(fn (Role $role): Collection => $role->permissions()->get())
            ->contains('name', $permissionName);
    }

    /**
     * Atribui um papel ao usuário.
     *
     * @param string|Role $role
     * @return void
     */
    public function assignRole(string|Role $role): void
    {
        $roleInstance = $role instanceof Role ? $role : Role::query()->where('name', $role)->firstOrFail();
        $this->roles()->attach($roleInstance);
    }

    /**
     * Atribui uma permissão direta ao usuário.
     *
     * @param string|Permission $permission
     * @return void
     */
    public function givePermissionTo(string|Permission $permission): void
    {
        $permissionInstance = $permission instanceof Permission
            ? $permission
            : Permission::query()->where('name', $permission)->firstOrFail();

        $this->roles()->each(fn (Role $role) => $role->permissions()->attach($permissionInstance));
    }

    /**
     * Remove um papel do usuário.
     *
     * @param string|Role $role
     * @return void
     */
    public function removeRole(string|Role $role): void
    {
        $roleInstance = $role instanceof Role ? $role : Role::query()->where('name', $role)->firstOrFail();
        $this->roles()->detach($roleInstance);
    }
}
