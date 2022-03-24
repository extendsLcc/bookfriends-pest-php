<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('home', [
            'booksByStatus' => $request->user()?->books->groupBy('pivot.status'),
        ]);
    }
}
