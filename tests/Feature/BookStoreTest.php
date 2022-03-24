<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();;
});

it('only allow authenticated users to post')
    ->post('/books')
    ->assertStatus(302);

it('creates a book', function () {

    actingAs($this->user)
        ->post('/books', [
            'title' => 'A book',
            'author' => 'An author',
            'status' => 'WANT_TO_READ',
        ]);
    $this->assertDatabaseHas('books', [
        'title' => 'A book',
        'author' => 'An author',
    ]);
    $this->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => 'WANT_TO_READ',
    ]);
});


it('requires a book title, author and status')
    ->tap(fn() => $this->actingAs($this->user))
    ->post('/books')
    ->assertSessionHasErrors(['title', 'author', 'status']);

it('requires a valid status')
    ->tap(fn() => $this->actingAs($this->user))
    ->post('/books', [
        'status' => 'INVALID',
    ])
    ->assertSessionHasErrors(['title', 'author', 'status']);
