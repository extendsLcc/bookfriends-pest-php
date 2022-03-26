<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('can have pending friends', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);

    expect($user->pendingFriendsOfMine)->toHaveCount(1);
});

it('can have friend requests', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $friend->addFriend($user);

    expect($user->pendingFriendsOf)->toHaveCount(1);
});

it('does not create duplicated friend requests', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $user->addFriend($friend);

    expect($user->pendingFriendsOfMine)->not()->toHaveCount(2);
});

it('can accept friends', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $friend->acceptFriend($user);

    expect($user->acceptedFriendsOfMine)->toHaveCount(1);
    expect($user->acceptedFriendsOfMine->pluck('id'))->toContain($friend->id);
});
