<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\IndexController;
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
