<?php declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows register page')->get('/auth/register')->assertOk();

it('shows errors if details are not provided')
    ->post('/register')
    ->assertSessionHasErrors(['name', 'email', 'password']);

it('register the user')
    ->tap(function () {
        $this->post('/register', [
            'name' => 'Extends',
            'email' => 'extends@mail.com',
            'password' => 'top_secret'
        ])
            ->assertRedirect('/');
    })
    ->assertDatabaseHas('users', [
        'email' => 'extends@mail.com',
    ]);
