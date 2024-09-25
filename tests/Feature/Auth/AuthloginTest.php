<?php

use App\Models\{Tenant, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('can authenticate a user and return a token', function () {

    $tenant = Tenant::factory()->create();

    /** @var User $user */
    $user = User::factory()->create([
        'email'     => 'test@example.com',
        'password'  => Hash::make('password'),
        'tenant_id' => $tenant->id,
    ]);

    $response = postJson(route('auth.login'), [
        'email'    => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'token',
        ]);

    $this->assertNotNull($user->tokens()->first());
});
