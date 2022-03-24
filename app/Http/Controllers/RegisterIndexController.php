<?php declare(strict_types=1);

namespace App\Http\Controllers;

class RegisterIndexController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke()
    {
        return view('auth.register');
    }
}
