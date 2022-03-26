<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FriendIndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('friends.index', [
            'friends' => $request->user()->friends,
            'pendingFriends' => $request->user()->pendingFriendsOfMine,
            'requestingFriends' => $request->user()->pendingFriendsOf,
        ]);
    }
}
