<?php

use App\Models\Tenant;
use Spatie\Multitenancy\Tasks\PrefixCacheTask;

it('prefixes cache when switching tenant', function () {

    $tenant = Tenant::factory()->create([
        'name'      => 'Tenant 2',
        'domain'    => 'tenant2.example.com',
        'is_active' => true,
    ]);

    $task = new PrefixCacheTask();
    $task->makeCurrent($tenant);

    expect(config('cache.prefix'))->toContain($tenant->id);
});

it('can create a tenant', function () {
    $tenant = Tenant::factory()->create([
        'name'   => 'Tenant Test',
        'domain' => 'tenant-test.example.com',
    ]);

    expect($tenant)->toBeInstanceOf(Tenant::class)
        ->and($tenant->name)->toBe('Tenant Test');
});
