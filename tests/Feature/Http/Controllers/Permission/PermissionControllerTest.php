<?php

use App\Models\{Permission\Permission, Permission\Role, Tenant, User};

use function Pest\Laravel\{actingAs, getJson};

it('should be able to list all permissions', function () {
    $tenant = Tenant::factory()->create();
    $user   = User::factory()->create(['tenant_id' => $tenant->id]);
    $role   = Role::factory()->create(['tenant_id' => $tenant->id]);

    $user->assignTenantRole($role, $tenant);

    $role->permissions()->attach(Permission::factory(50)->create());

    $user->assignRole($role);

    actingAs($user);

    $response = getJson(route('acle.permissions.index'))
        ->assertOk();

    expect($response->json('meta.total'))->toBe(50);
});
