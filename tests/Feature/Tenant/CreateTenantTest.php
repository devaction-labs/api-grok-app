<?php

use App\Models\Tenant;

it('can create a tenant', function () {
    $tenant = Tenant::factory()->create([
        'name'   => 'Tenant Test',
        'domain' => 'tenant-test.example.com',
    ]);

    expect($tenant)->toBeInstanceOf(Tenant::class)
        ->and($tenant->name)->toBe('Tenant Test');
});
