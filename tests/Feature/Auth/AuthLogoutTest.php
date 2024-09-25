<?php

use App\Models\User;

it('logs out the user and revokes the current token', function () {
    /** @var User $user */
    $user = User::factory()->create();

    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson(route('auth.logout'));

    $response->assertStatus(200)
        ->assertJson(['message' => 'Logged out']);

    $this->assertDatabaseMissing('personal_access_tokens', ['tokenable_id' => $user->id]);
});
