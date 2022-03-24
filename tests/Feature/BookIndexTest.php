<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


it('shows books that user wants to read', function () {
    $this->user->books()->attach($book = Book::factory()->create(), [
        'status' => 'WANT_TO_READ',
    ]);
    actingAs($this->user)
        ->get('/')
        ->assertSeeInOrder(['Want to read', $book->title]);
});

it('shows books that user is reading', function () {
    $this->user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);
    actingAs($this->user)
        ->get('/')
        ->assertSeeInOrder(['Reading', $book->title]);
});


it('shows books that user has read', function () {
    $this->user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READ',
    ]);
    actingAs($this->user)
        ->get('/')
        ->assertSeeInOrder(['Read', $book->title]);
});
