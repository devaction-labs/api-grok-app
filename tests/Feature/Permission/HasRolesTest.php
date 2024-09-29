<?php

use App\Models\Permission\{Permission, Role};
use App\Models\{Tenant, User};

describe('Tenant-specific Roles', function () {
    it('can create a tenant-specific role', function () {
        /** @var Tenant $tenant */
        $tenant = Tenant::factory()->create();
        /** @var Role $role */
        $role = Role::factory()->create(['tenant_id' => $tenant->id]);

        expect($role->tenant_id)->toBe($tenant->id);
    });

    it('can assign a role to a user in the same tenant', function () {
        /** @var Tenant $tenant */
        $tenant = Tenant::factory()->create();
        /** @var User $user */
        $user = User::factory()->create(['tenant_id' => $tenant->id]);
        /** @var Role $role */
        $role = Role::factory()->create(['tenant_id' => $tenant->id]);

        $user->assignRole($role, $tenant);

        expect($user->roles()->pluck('id'))->toContain($role->id);
    });
});

describe('Global Roles', function () {
    it('can assign a global role to a user', function () {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Role $role */
        $globalRole = Role::factory()->create(['tenant_id' => null]);

        $user->assignRole($globalRole);

        expect($user->roles()->pluck('id'))->toContain($globalRole->id);
    });
});

describe('User Role and Permission Checks', function () {
    it('can check if a user has a specific role', function () {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Role $role */
        $role = Role::factory()->create();

        $user->assignRole($role);

        expect($user->hasRole($role))->toBeTrue();
    });

    it('can check if a user has a specific permission via role', function () {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Role $role */
        $role       = Role::factory()->create();
        $permission = Permission::factory()->create();

        $role->permissions()->attach($permission);

        $user->assignRole($role);

        expect($user->hasPermission($permission->name))->toBeTrue();
    });
});

describe('Role Removal', function () {
    it('can remove a role from a user', function () {
        $tenant = Tenant::factory()->create();
        /** @var User $user */
        $user = User::factory()->create(['tenant_id' => $tenant->id]);
        /** @var Role $role */
        $role = Role::factory()->create(['tenant_id' => $tenant->id]);

        // Atribui a role ao usuário
        $user->assignRole($role);

        // Verifica se o usuário tem a role
        expect($user->hasRole($role))->toBeTrue();

        // Remove a role do usuário
        $user->removeRole($role);

        // Verifica se a role foi removida
        expect($user->hasRole($role))->toBeFalse();
    });

    it('can handle role assignment and removal for users in different tenants', function () {
        $tenant1 = Tenant::factory()->create();
        $tenant2 = Tenant::factory()->create();

        // Dois usuários, um para cada tenant
        $userTenant1 = User::factory()->create(['tenant_id' => $tenant1->id]);
        $userTenant2 = User::factory()->create(['tenant_id' => $tenant2->id]);

        // Roles específicas de cada tenant
        $roleTenant1 = Role::factory()->create(['tenant_id' => $tenant1->id, 'name' => 'admin']);
        $roleTenant2 = Role::factory()->create(['tenant_id' => $tenant2->id, 'name' => 'manager']);

        // Atribuir roles aos respectivos usuários
        $userTenant1->assignRole($roleTenant1, $tenant1);
        $userTenant2->assignRole($roleTenant2, $tenant2);

        // Verificar se cada role está associada corretamente
        expect($userTenant1->roles()->pluck('id'))->toContain($roleTenant1->id)
            ->and($userTenant2->roles()->pluck('id'))->toContain($roleTenant2->id);

        // Remover uma role e verificar
        $userTenant1->removeRole($roleTenant1);
        expect($userTenant1->roles()->pluck('id'))->not()->toContain($roleTenant1->id);
    });

});
