<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pivot\BookUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'status' => [
                'required',
                Rule::in(array_keys(BookUser::$statuses))
            ],
        ]);

        $book = Book::create($request->only('title', 'author'));

        $request->user()->books()->attach($book, [
            'status' => $request->status,
        ]);

        return redirect('/');
    }
}
