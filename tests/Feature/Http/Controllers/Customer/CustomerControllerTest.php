<?php

use App\Enum\Authorize\PermissionsEnum;
use App\Models\{Customer, Tenant, User};

use function Pest\Laravel\{actingAs, getJson};

beforeEach(function () {
    global $user, $tenant;

    $tenant = Tenant::factory()->create();
    $user   = User::factory()
        ->role('Customer', $tenant)
        ->permissions([PermissionsEnum::VIEW_CUSTOMERS])
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
