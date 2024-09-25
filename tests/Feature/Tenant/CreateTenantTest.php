<?php

use App\Models\Tenant;
use App\Tenant\TenantFinder;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Tasks\PrefixCacheTask;

it('can identify tenant based on subdomain', function () {
    $tenant = Tenant::factory()->create([
        'domain' => 'tenant1',
    ]);

    $request = Request::create('http://tenant1.localhost');
    $request->server->set('HTTP_HOST', 'tenant1.localhost');

    $tenantFinder = app(TenantFinder::class);
    $foundTenant  = $tenantFinder->findForRequest($request);

    expect($foundTenant)->toBeInstanceOf(Tenant::class)
        ->and($foundTenant->id)->toBe($tenant->id);
});

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
