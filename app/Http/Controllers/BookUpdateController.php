<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pivot\BookUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class BookUpdateController extends Controller
{
    public function __invoke(Book $book, Request $request)
    {
        $this->authorize('update', $book);
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'status' => [
                'required',
                Rule::in(array_keys(BookUser::$statuses))
            ],
        ]);
        $book->update($request->only('title', 'author'));
        $request->user()->books()->updateExistingPivot($book, [
            'status' => $request->status,
        ]);

        return redirect('/');
    }
}
