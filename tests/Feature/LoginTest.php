<?php declare(strict_types=1);


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('redirects authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/auth/login')
        ->assertRedirect();
});


it('shows an errors if credentials are not provided')
    ->post('/login')
    ->assertSessionHasErrors(['email', 'password']);

it('logs the user in', function () {
    $user = User::factory()->create([
        'password' => bcrypt('top_secret')
    ]);

    post('/login', [
        'email' => $user->email,
        'password' => 'top_secret',
    ])
        ->assertRedirect('/');

    $this->assertAuthenticatedAs($user);
});
