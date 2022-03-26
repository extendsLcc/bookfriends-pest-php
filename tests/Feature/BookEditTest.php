<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('redirects unauthenticated users')
    ->expectGuest()
    ->toBeRedirectedFor('/books/1/edit');

it('shows book details in the form', function () {
    $user = User::factory()->create();
    $user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);
    actingAs($user)
        ->get("/books/$book->id/edit")
        ->assertOk()
        ->assertSee([$book->title, $book->author])
        ->assertSee('<option value="READING" selected>Reading</option>', false);
});

it('fails if the user does not own the book', function () {
    $bookOwnerUser = User::factory()->create();
    $anotherUser = User::factory()->create();

    $bookOwnerUser->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($anotherUser)
        ->get("/books/$book->id/edit")
        ->assertStatus(Response::HTTP_FORBIDDEN);
});
