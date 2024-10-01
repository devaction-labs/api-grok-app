<?php

use App\Enum\Authorize\PermissionsEnum;
use App\Models\{Permission\Permission, Permission\Role, Tenant, User};

use function Pest\Laravel\{actingAs, getJson, postJson, putJson};

it('should be able to list all permissions', function () {
    $tenant = Tenant::factory()->create();

    $user = User::factory()->create(['tenant_id' => $tenant->id]);
    $role = Role::factory()->create(['tenant_id' => $tenant->id]);

    $role->permissions()->attach(Permission::factory(49)->create());

    $viewPermission = Permission::factory()->create(['name' => PermissionsEnum::VIEW_PERMISSIONS->value]);
    $role->permissions()->attach($viewPermission);
    $user->assignRole($role);

    actingAs($user);

    $response = getJson(route('acle.permissions.index'))
        ->assertOk();

    expect($response->json('meta.total'))->toBe(50);
});

it('should be able to create permission', function () {
    $tenant = Tenant::factory()->create();
    $user   = User::factory()
        ->role('Manager', $tenant)
        ->permissions([PermissionsEnum::CREATE_PERMISSIONS])
        ->create([
            'tenant_id' => $tenant->id,
        ]);

    actingAs($user);

    postJson(route('acle.permissions.store'), [
        'name' => 'new_permission',
    ])
        ->assertNoContent();

    expect(Permission::query()->where('name', 'new_permission')->exists())->toBeTrue();

});

it('should be able to updated permission', function () {
    $tenant = Tenant::factory()->create();
    $user   = User::factory()
        ->role('Manager', $tenant)
        ->permissions([PermissionsEnum::EDIT_PERMISSIONS])
        ->create([
            'tenant_id' => $tenant->id,
        ]);

    actingAs($user);

    $role       = Role::factory()->create(['tenant_id' => $tenant->id]);
    $permission = Permission::factory()->create(['name' => 'permission:old']);

    $role->permissions()->attach($permission);

    $response = putJson(route('acle.permissions.update', ['permission' => $permission]), [
        'name' => 'new:permission',
    ]);

    $response->assertNoContent();
});
