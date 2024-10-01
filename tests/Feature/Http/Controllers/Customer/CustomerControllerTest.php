<?php

use App\Enum\Authorize\PermissionsEnum;
use App\Models\{Customer, Tenant, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, deleteJson, getJson, postJson, putJson};

use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    global $tenant, $user;

    $tenant = Tenant::factory()->create();
    $user   = User::factory()
        ->role('Customer', $tenant)
        ->permissions([
            PermissionsEnum::VIEW_CUSTOMERS,
            PermissionsEnum::CREATE_CUSTOMERS,
            PermissionsEnum::EDIT_CUSTOMERS,
            PermissionsEnum::DELETE_CUSTOMERS,
        ])
        ->create(['tenant_id' => $tenant->id]);

    actingAs($user);
});

it('should return a list of customers', function () {
    global $tenant;
    Customer::factory(10)->create(['tenant_id' => $tenant->id]);

    $response = getJson(route('customers.index'));

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'name', 'email', 'phone', 'address', 'tax_id',
                    'city', 'state', 'zipcode', 'is_active', 'tenant_id', 'user_id',
                ],
            ],
        ]);
});

it('should be able to create a customer', function () {
    global $tenant;

    $customer = Customer::factory()->make(['tenant_id' => $tenant->id]);

    $response = postJson(route('customers.store'), $customer->toArray());

    $response->assertStatus(Response::HTTP_CREATED);
    assertDatabaseHas('customers', ['email' => $customer->email]);
});

it('should be able to show a customer', function () {
    global $tenant;

    $customer = Customer::factory()->create(['tenant_id' => $tenant->id]);

    $response = getJson(route('customers.show', $customer->id));

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id', 'name', 'email', 'phone', 'address', 'tax_id',
                'city', 'state', 'zipcode', 'is_active', 'tenant_id', 'user_id',
            ],
        ]);
});

it('should be able to update a customer', function () {
    global $tenant;

    $customer = Customer::factory()->create(['tenant_id' => $tenant->id]);

    $response = putJson(route('customers.update', $customer->id), ['name' => 'Updated Name', 'tenant_id' => $tenant->id]);

    $response->assertStatus(Response::HTTP_OK);
    assertDatabaseHas('customers', ['name' => 'Updated Name']);
});

it('should be able to delete a customer', function () {
    global $tenant;
    $customer = Customer::factory()->create(['tenant_id' => $tenant->id]);

    $response = deleteJson(route('customers.destroy', $customer->id));

    $response->assertStatus(204);
});

it('should not allow creating a customer without permission', function () {
    global $tenant;

    $userWithoutPermission = User::factory()->create(['tenant_id' => $tenant->id]);
    actingAs($userWithoutPermission);

    $response = postJson(route('customers.store'), Customer::factory()->make()->toArray());

    $response->assertStatus(Response::HTTP_FORBIDDEN);
});

it('should return filtered list of customers', function () {
    global $tenant;

    Customer::factory()->create(['name' => 'John Doe', 'tenant_id' => $tenant->id]);

    $response = getJson(route('customers.index', ['name' => 'John Doe']));

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'John Doe']);
});
