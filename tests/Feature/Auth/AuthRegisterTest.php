<?php

use App\Events\User\UserRegistered;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\postJson;

it('can register a new user and tenant and fire the UserRegistered event', function () {
    Event::fake();

    $response = postJson(route('auth.register'), [
        'tenant_name'   => 'My Company',
        'tenant_domain' => 'mycompany.com',
        'tenant_slug'   => 'my-company',
        'tenant_tax_id' => '123456789',
        'name'          => 'Test User',
        'email'         => 'testuser@example.com',
        'password'      => 'password',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('tenants', ['name' => 'My Company']);
    $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);

    Event::assertDispatched(UserRegistered::class, function ($event) {
        return $event->user->email === 'testuser@example.com';
    });
});
