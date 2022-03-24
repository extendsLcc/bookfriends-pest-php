<?php

namespace App\Http\Controllers;

class BookCreateController extends Controller
{
    public function __invoke()
    {
        return view('books.create');
    }
}
