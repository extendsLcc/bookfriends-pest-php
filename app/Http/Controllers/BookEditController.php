<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookEditController extends Controller
{
    /**
     * @param Book $book
     * @param Request $request
     * @return View
     * @throws AuthorizationException
     */
    public function __invoke(Book $book, Request $request): View
    {
        $this->authorize('update', $book);
        $book = $request->user()->books->find($book->id);
        return view('books.edit', [
            'book' => $book,
        ]);
    }
}
