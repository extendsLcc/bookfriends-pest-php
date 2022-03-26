<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


it('redirects unauthenticated users')
    ->expectGuest()
    ->toBeRedirectedFor('/books/1', 'put');

it('fails if the book does not exists', function () {
    actingAs(User::factory()->create())
        ->put('books/1')
        ->assertStatus(Response::HTTP_NOT_FOUND);
});

it('validates request details', function () {
    $user = User::factory()->create();
    $user->books()->attach($book = Book::factory()->create(), [
        'status' => 'WANT_TO_READ',
    ]);

    actingAs($user)
        ->put("books/$book->id")
        ->assertSessionHasErrors(['title', 'author', 'status']);
});


it('fails if the user does not own the book', function () {
    $bookOwnerUser = User::factory()->create();
    $anotherUser = User::factory()->create();

    $bookOwnerUser->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($anotherUser)
        ->put("/books/$book->id", [
            'title' => 'new title',
            'author' => 'new author',
            'status' => 'WANT_TO_READ',
        ])
        ->assertStatus(Response::HTTP_FORBIDDEN);
});

it('updates the book', function () {
    $user = User::factory()->create();
    $user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($user)
        ->put("/books/$book->id", [
            'title' => 'Updated title',
            'author' => 'Updated author',
            'status' => 'WANT_TO_READ',
        ]);

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'title' => 'Updated title',
        'author' => 'Updated author',
    ]);

    $this->assertDatabaseHas('book_user', [
        'book_id' => $book->id,
        'status' => 'WANT_TO_READ',
    ]);
});
