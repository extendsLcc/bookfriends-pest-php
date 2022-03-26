<?php

use App\Models\Pivot\BookUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('only allow authenticated users')
    ->expectGuest()
    ->toBeRedirectedFor('/books/create');


it('shows the available status on the form', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/books/create')
        ->assertSeeInOrder(BookUser::$statuses);
});
