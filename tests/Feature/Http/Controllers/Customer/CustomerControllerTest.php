<?php

use App\Enum\Authorize\PermissionsEnum;
use App\Models\{Customer, Tenant, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, deleteJson, getJson, postJson, putJson};

beforeEach(function () {
    global $user, $tenant;

    $tenant = Tenant::factory()->create();
    $user   = User::factory()
        ->role('Customer', $tenant)
        ->permissions([PermissionsEnum::VIEW_CUSTOMERS, PermissionsEnum::CREATE_CUSTOMERS, PermissionsEnum::EDIT_CUSTOMERS, PermissionsEnum::DELETE_CUSTOMERS])
        ->create(['tenant_id' => $tenant->id]);

});

it('should return a list of customers', function () {
    global $user, $tenant;

    actingAs($user);

    Customer::factory(10)->create(['tenant_id' => $tenant->id]);

    $response = getJson(route('customers.index'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'email',
                'phone',
                'address',
                'tax_id',
                'city',
                'state',
                'zipcode',
                'is_active',
                'tenant_id',
                'user_id',
            ],
        ],
    ]);
});

it('should be able to create customers', function () {
    global $user, $tenant;

    actingAs($user);

    $customer = Customer::factory()->make(['tenant_id' => $tenant->id]);

    $response = postJson(route('customers.store'), $customer->toArray());

    $response->assertStatus(204);
    assertDatabaseHas('customers', ['email' => $customer->email]);
});

it('should be able to show a customer', function () {
    global $user, $tenant;

    actingAs($user);

    $customer = Customer::factory()->create(['tenant_id' => $tenant->id]);

    $response = getJson(route('customers.show', $customer->id));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'tax_id',
            'city',
            'state',
            'zipcode',
            'is_active',
            'tenant_id',
            'user_id',
        ],
    ]);
});

it('should be able to update a customer', function () {
    global $user, $tenant;

    actingAs($user);

    $customer = Customer::factory()->create(['tenant_id' => $tenant->id]);

    $response = putJson(route('customers.update', $customer->id), ['name' => 'New Name', 'tenant_id' => $tenant->id]);

    $response->assertStatus(204);
    assertDatabaseHas('customers', ['name' => 'New Name']);
});

it('should be able to delete a customer', function () {
    global $user, $tenant;

    actingAs($user);

    $customer = Customer::factory()->create(['tenant_id' => $tenant->id]);

    $response = deleteJson(route('customers.destroy', $customer->id));

    $response->assertStatus(204);
});
