<?php

use App\Http\Controllers\BookCreateController;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterIndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);

Route::get('/auth/register', RegisterIndexController::class);
Route::get('/auth/login', LoginController::class);


Route::middleware('auth')->group(function () {
    Route::post('/books', BookStoreController::class);
    Route::get('/books/create', BookCreateController::class);
});
