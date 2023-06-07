<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\VideogameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

// when the user comes with the GET request method to the URL /awards
// handle the request by the App\Http\Controllers\AwardController controller
// and its index method
Route::get('/awards', [AwardController::class, 'index']);

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/genre/action', [MovieController::class, 'actionMovies']);
Route::get('/person', [PersonController::class, 'detail']);

// originally: /movie?id=111161
// now:        /movie/111161
Route::get('/movie/{id}', [MovieController::class, 'detail'])->whereNumber('id');
Route::get('/search', [MovieController::class, 'search']);
Route::get('/movies/shawshank-redemption', [MovieController::class, 'shawshank']);
Route::get('/top-rated-movies/{year?}/{order?}', [MovieController::class, 'topRated'])->where('year', '^\d{4}$')->whereIn('order', ['name', 'rating', 'votes_nr']);
Route::get('/games', [VideogameController::class, 'index']);
Route::get('/top-rated-games', [VideogameController::class, 'topRated']);


//                   view identifier
//                          ↓
Route::view('/welcome', 'welcome');


Route::redirect('/vitejte', '/welcome');