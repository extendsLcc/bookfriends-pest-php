<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookEditController extends Controller
{
    public function __invoke(int $bookId, Request $request)
    {
        if (!$book = $request->user()->books->find($bookId)){
            abort(Response::HTTP_FORBIDDEN);
        }
        return view('books.edit', [
            'book' => $book,
        ]);
    }
}
