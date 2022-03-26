<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


it('redirects unauthenticated users')
    ->expectGuest()
    ->toBeRedirectedFor('/friends');

it('shows a list of the users pending friends', function () {
    $user = User::factory()->create();
    $friends = User::factory()->times(2)->create();

    $friends->each(fn(User $friend) => $user->addFriend($friend));

    actingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(array_merge(['Pending friend request'], $friends->pluck('name')->toArray()));
});

it('shows a list of a users friend request', function () {
    $user = User::factory()->create();
    $friends = User::factory()->times(2)->create();

    $friends->each(fn(User $friend) => $friend->addFriend($user));

    actingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(array_merge(['Friend requests'], $friends->pluck('name')->toArray()));
});

it('shows a list of users accepted friends', function () {
    $user = User::factory()->create();
    $friends = User::factory()->times(2)->create();

    $friends->each(function (User $friend) use ($user) {
        $user->addFriend($friend);
        $friend->acceptFriend($user);
    });

    actingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(array_merge(['Friends'], $friends->pluck('name')->toArray()));
});
