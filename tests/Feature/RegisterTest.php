<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('shows errors if details are not provided', function () {
    post('/register')->assertSessionHasErrors(['name', 'email', 'password']);
});

it('register the user', function () {
    post('/register', [
        'name' => 'Extends',
        'email' => 'extends@mail.com',
        'password' => 'top_secret'
    ])->assertRedirect('/');

    $this->assertDatabaseHas('users', [
            'name' => 'Extends',
            'email' => 'extends@mail.com'
        ])
        ->assertAuthenticated();
});
