<?php

namespace App\Http\Controllers;

use App\Http\Requests\FriendStoreRequest;
use App\Models\User;

class FriendStoreController extends Controller
{
    public function __invoke(FriendStoreRequest $request)
    {
        $request->user()->addFriend(User::whereEmail($request->email)->first());
        return back();
    }
}
