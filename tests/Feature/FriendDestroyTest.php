<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


it('redirects unauthenticated users')
    ->expectGuest()
    ->toBeRedirectedFor('/friends/1', 'delete');

it('deletes a friend request', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);

    actingAs($user)
        ->delete("/friends/$friend->id");

    $this->assertDatabaseMissing('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id,
    ]);
});
