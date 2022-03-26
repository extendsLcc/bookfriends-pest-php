<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;

class BookUpdateController extends Controller
{
    public function __invoke(Book $book, BookUpdateRequest $request)
    {
        $book->update($request->only('title', 'author'));
        $request->user()->books()->updateExistingPivot($book, [
            'status' => $request->status,
        ]);

        return redirect('/');
    }
}
