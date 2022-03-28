<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


it('redirects unauthenticated users')
    ->expectGuest()
    ->toBeRedirectedFor('/friends', 'post');

it('validates the email address exists', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post('/friends', [
            'email' => 'inexistent-user@mail.com'
        ])
        ->assertSessionHasErrors(['email']);
});

it('cant add self as friend', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post('/friends', [
            'email' => $user->email,
        ])
        ->assertSessionHasErrors(['email']);
});

it('stores the friend request', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    actingAs($user)
        ->post('/friends', [
            'email' => $friend->email,
        ]);

    $this->assertDatabaseHas('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id,
        'accepted' => false,
    ]);
});
