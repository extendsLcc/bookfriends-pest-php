<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedIndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('feed.index', [
            'books' => $request->user()->booksOfFriends
        ]);
    }
}
